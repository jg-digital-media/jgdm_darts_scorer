let lastmodified = new Date();

console.log("app.js - connected!" + lastmodified);

let initialScore = 501;
let currentScore = initialScore;
let throwCount = 0;
let currentVisit = [];

// DOM Elements
const currentScoreDisplay = document.querySelector('#current---score strong');
const throwDisplays = [
    document.querySelector('#throw---one'),
    document.querySelector('#throw---two'), 
    document.querySelector('#throw---three')
];

// Add multiplier checkbox handlers
const tripleCheckbox = document.querySelector('#triple---point--score');
const doubleCheckbox = document.querySelector('#double---point--score');
const scoreButtons = document.querySelectorAll('.score---points--btn');

// Add to DOM Elements section - throw total display
const throwTotalDisplay = document.querySelector('#trows---total');


// Modal elements
const modal = document.querySelector('#modal');
const closeBtn = document.querySelector('.close');
const openHistoryBtn = document.querySelector('.open---throw--history');
const scoreTable = document.querySelector('#score---table');
let visitNumber = 0;

// Add to DOM Elements section
const checkoutDisplays = [
    
    document.querySelector('#checkout---one'),
    document.querySelector('#checkout---two'),
    document.querySelector('#checkout---three')
];

// Add to DOM Elements section
const messageDisplay = document.querySelector('#js-message');

// Modal controls
openHistoryBtn.addEventListener('click', (e) => {
    e.preventDefault();
    modal.style.display = "block";
});

closeBtn.addEventListener('click', () => {
    modal.style.display = "none";
});

window.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.style.display = "none";
    }
});

function updateButtonText() {
    scoreButtons.forEach(button => {
        const originalValue = button.getAttribute('data-original-value') || button.textContent;
        if (!button.getAttribute('data-original-value')) {
            button.setAttribute('data-original-value', originalValue);
        }
        
        // Skip MISS, bull and outer bull
        if (originalValue === 'MISS' || originalValue === '50' || originalValue === '25') return;
        
        const baseValue = parseInt(originalValue);
        
        // Update display text with prefix
        if (tripleCheckbox.checked) {
            button.textContent = `T${baseValue}`;
        } else if (doubleCheckbox.checked) {
            button.textContent = `D${baseValue}`;
        } else {
            button.textContent = baseValue; // Reset to original value
        }
    });
}

tripleCheckbox.addEventListener('change', () => {
    if (tripleCheckbox.checked) {
        doubleCheckbox.checked = false;
    }

    updateButtonText();
});

doubleCheckbox.addEventListener('change', () => {
    if (doubleCheckbox.checked) {
        tripleCheckbox.checked = false;
    }

    updateButtonText();
});

// Score button handlers
document.querySelectorAll('.score---points--btn').forEach(button => {


    button.addEventListener('click', (e) => {
        e.preventDefault();
        // Use the original value for scoring, not the display value
        const originalValue = button.getAttribute('data-original-value') || button.textContent;
        const basePoints = parseInt(originalValue === 'MISS' ? 0 : originalValue);

        // Special handling for bull and outer bull
        if (basePoints === 50 || basePoints === 25) {
            recordThrow(basePoints);
            return;
        }       
        
        // Normal scoring logic for other button
        const tripleMultiplier = document.querySelector('#triple---point--score').checked ? 3 : 1;
        const doubleMultiplier = document.querySelector('#double---point--score').checked ? 2 : 1;
        const points = basePoints * tripleMultiplier * doubleMultiplier;
        
        if (throwCount < 3) {
            recordThrow(points);
        }
    });
});

// Throw dart button handler
document.querySelector('#btn---throw--dart').addEventListener('click', (e) => {
    e.preventDefault();
    if (throwCount > 0) {  // Only record if there were throws
        recordVisitToHistory();
        resetVisit();
    }
});


// reload button handler
document.querySelector('#btn---restart').addEventListener('click', (e) => {
    e.preventDefault();
    window.location.reload();
});

function suggestCheckouts(score) {

    // Clear previous suggestions
    checkoutDisplays.forEach(display => display.textContent = '');
    
    // Only suggest checkouts for scores between 2 and 170
    if (score < 2 || score > 170) return;
    
    const checkouts = getCheckoutPaths(score);
    checkouts.slice(0, 3).forEach((path, index) => {
        checkoutDisplays[index].textContent = path;
    });
}

function getCheckoutPaths(score) {
    const checkouts = [];
    
    // Common checkout patterns
    if (score <= 40 && score % 2 === 0) {
        checkouts.push(`D${score/2}`);
    }
    
    if (score <= 50) {
        if (score === 50) checkouts.push('Bull');
        if (score === 25) checkouts.push('25');
    }
    
    // Double-Double combinations
    if (score <= 80 && score % 2 === 0) {
        for (let i = 20; i >= 1; i--) {
            if ((score/2) === i * 2) {
                checkouts.push(`D${i} D${i}`);
            }
        }
    }
    
    // Triple-Double combinations for higher scores
    if (score <= 170) {
        for (let i = 20; i >= 1; i--) {
            const remaining = score - (i * 3);
            if (remaining > 0 && remaining <= 40 && remaining % 2 === 0) {
                checkouts.push(`T${i} D${remaining/2}`);
            }

            // Add double-triple combinations
            for (let j = 20; j >= 1; j--) {
                const remainingAfterTriples = score - (i * 3) - (j * 3);
                if (remainingAfterTriples > 0 && remainingAfterTriples <= 50) {
                    // Handle bull finish
                    if (remainingAfterTriples === 50) {
                        checkouts.push(`T${i} T${j} Bull`);
                    }
                    // Handle regular double finish
                    else if (remainingAfterTriples <= 40 && remainingAfterTriples % 2 === 0) {
                        checkouts.push(`T${i} T${j} D${remainingAfterTriples/2}`);
                    }
                }
            }
        }
    }

    // List of impossible checkout scores
    const impossibleCheckouts = [169, 168, 166, 165, 163, 162, 159];
    
    if (impossibleCheckouts.includes(score)) {
        checkouts.push("No checkout possible");
        return checkouts;
    }
    
    // For debugging - log scores with no checkouts
    if (checkouts.length === 0 && score >= 2 && score <= 170) {
        console.log(`No checkouts found for score: ${score}`);
    }
    
    return checkouts;
}

function resetVisit() {

    throwCount = 0;
    currentVisit = [];
    throwDisplays.forEach(display => display.textContent = '0');
    suggestCheckouts(currentScore); // Add checkout suggestions at start of visit
    throwTotalDisplay.textContent = '0'; // Reset the tally
    throwNumberDisplay.textContent = '0'; // Reset the throw number display

}

// Add to DOM Elements section
const throwNumberDisplay = document.querySelector('#throw---number');

// Add a function to handle message display
function showGameMessage(message, duration = 2000) {

    if (message === 'Game Shot!') {
        // Show game shot message with quit button
        messageDisplay.innerHTML = `
            ${message}
            <a href="index.php" id="quit---game" class="btn btn---quit message button">Quit Game</a>
        `;
        
        // Add event listener to quit button
        const quitButton = document.querySelector('#quit---game');
        quitButton.addEventListener('click', () => {
            window.location.href = 'index.php';
        });
    } else {
        // Normal message display
        messageDisplay.textContent = message;
    }
    messageDisplay.style.display = 'block';
    
    // Clear message after duration (unless it's 0)
    if (duration > 0) {
        setTimeout(() => {
            messageDisplay.textContent = '';
            messageDisplay.style.display = 'none';
        }, duration);
    }
}

function recordThrow(points) {
    if (currentScore - points < 0) {
        showGameMessage('Bust! Score would go below 0');
        recordVisitToHistory();
        resetVisit();
        return;
    }
    
    currentVisit[throwCount] = points;
    throwDisplays[throwCount].textContent = points;
    currentScore -= points;
    currentScoreDisplay.textContent = currentScore;
    
    // Special messages for notable scores
    if (points === 180) {
        showGameMessage('180!!!', 3000);
    } else if (points === 50) {
        showGameMessage('Bullseye!');
    } else if (points >= 100) {
        showGameMessage('Ton!');
    }
    
    // Update throw number display (1-based counting for display)
    throwNumberDisplay.textContent = throwCount + 1;

    // Calculate and display running tally
    const visitTotal = currentVisit.reduce((sum, score) => sum + score, 0);
    throwTotalDisplay.textContent = visitTotal;
    
    // Check for visit total of 180
    if (visitTotal === 180) {
        showGameMessage('ONE HUNDRED AND EIGHTY!!!', 3000);
    } 
    
    if (visitTotal === 100) {
        showGameMessage('TON!!!', 3000);
    }
     
    throwCount++;
    
    if (currentScore === 0) {
        // account for a bullseye checkout
        const originalValue = points === 50 ? 'Bull' : null;
        
        if (originalValue !== 'Bull' && !doubleCheckbox.checked) {
            showGameMessage('You must finish on a double!');
            // Undo the throw
            currentScore += points;
            currentScoreDisplay.textContent = currentScore;
            throwCount--;
            throwDisplays[throwCount].textContent = '0';
            currentVisit.pop();
            return;
        }

        showGameMessage('Game Shot!', 0);  // 0 duration means message stays
        recordVisitToHistory();
        // window.location.href = 'index.php';
    }
}

function recordVisitToHistory() {
    visitNumber++;
    const row = document.createElement('tr');
    
    // Calculate visit total
    const visitTotal = currentVisit.reduce((sum, score) => sum + score, 0);
    
    // Format throws with padding for missing throws
    const throwsDisplay = currentVisit.concat(Array(3 - currentVisit.length).fill(0)).join(' ');
    
    row.innerHTML = `
        <td>${visitNumber * 3} Darts</td>
        <td>${throwsDisplay}</td>
        <td>${visitTotal}</td>
        <td>${currentScore}</td>
    `;
    
    // Insert after header row
    if (scoreTable.rows.length > 1) {
        scoreTable.appendChild(row);
    } else {
        scoreTable.appendChild(row);
    }
}

// Initialize display
currentScoreDisplay.textContent = currentScore;

// Initialize checkout suggestions at start
suggestCheckouts(initialScore);

