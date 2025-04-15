I feel like I've spent a lot of time now making plans, writing markup, creating tasks and looking at the code for unique IDs and classes.

So, it's time to start developing. Just looking at the page I've developed so far makes the job feel overwhelming. Even with AI in your arsenal. At times like that you just have to remind yourself to break down a big project into smaller steps.

I'm going to start by creating a new chat dialog box in Cursor and making sure 4 files are available.

   + index.php
   + game.php
   + app.js
   + sass/_main.scss

Now, Cursor knows the files it is working on initially, and it knows what is in those files.

What we want to do first is make sure that the game recognises the initial player score of 501.

I don't need AI for that, do I?

In the app.js file, I wrote a simple `let` variable with that value.

```javascript
let initialScore = 501;
```

To make sure that the value of this variable is the one displayed in the `#current---score` element. I changed the value to zero (0).

```html
<span id="current---score">Current Score: <strong>0</strong></span>
```

Then, I turned to the new chat window I created in Cursor AI. Now, you'll have to trust me here. And I honestly didn't intend to do this... I wanted to create a line space to start a prompt. But, having added the files as a prompt, I pressed enter without holding on to the shift key to create a new line. And Cursor generated some stuff for me.

When I say "generated some stuff" it ended up creating the very basics of the flow of the application.

`I'll help you build out the darts scoring app functionality. Based on the files provided, here's what we should add to app.js to implement the core scoring logic:`

And it did. The model, `claude-3.5-sonnet` wrote about 50 to 60 lines of code with some functions that took care of some of my intended functionality. But not quite all.  

Here's what it gave me.

```javascript

let lastmodified = new Date();
console.log("app.js - connected - " + lastmodified);

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

// Score button handlers
document.querySelectorAll('.score---points--btn').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        const basePoints = parseInt(button.textContent === 'MISS' ? 0 : button.textContent);
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
    if (throwCount >= 3) {
        resetVisit();
    }
});

function recordThrow(points) {
    if (currentScore - points < 0) {
        alert('Bust! Score would go below 0');
        resetVisit();
        return;
    }
    
    currentVisit[throwCount] = points;
    throwDisplays[throwCount].textContent = points;
    currentScore -= points;
    currentScoreDisplay.textContent = currentScore;
    throwCount++;
    
    if (currentScore === 0) {
        alert('Game Shot!');
        window.location.href = 'index.php';
    }
}

function resetVisit() {
    throwCount = 0;
    currentVisit = [];
    throwDisplays.forEach(display => display.textContent = '0');
}

// Initialize display
currentScoreDisplay.textContent = currentScore;

```

This is what I was left with. It takes away the value of the score button pressed directly from the `initialScore` variable. It allows you to do this 3 times for each Oche visit. It allows you to click "throw dart" to reset the score values and move on to the next Oche visit. It even takes into account the 2 checkboxes that double and triple the score values. In fact, it gives us the very basics of the game from start to finish by announcing the `"Game shot"` and basic safeguards against trying a "bust" shot.

The "throw dart" button is a bit of an odd one though, because it was originally intended to work for one "dart" at a time rather than applying to all three darts in a visit. I kept the button text as it is all the same.

I can see what's happening with the points button handler. It bases its calculations on the text content of each button, which works for us because the button text is the value of a Darts point.

After each visit, the score is deducted, and another visit can be played as before.

That's the basics. Already. In what must have been about 10 seconds maximum of code generation time.

But of course, it's not yet worthy of release to the public. What we've been left with is a starting point. For one thing, one bug I've noticed already is that the total values of double and triple scores are applied when both checkboxes are checked. That will need to be addressed.

I also want to dynamically change the display text of the score buttons when either checkbox is checked; so that when someone throws a Triple 20, the score says 60 instead of 20.

So while I really had not intended to get that above boost in the code generation, it is an amazing example of how Cursor AI (or the Claude LLM) can understand from just from markup, an accidental chat prompt, and so little JavaScript can be used to generate code.

Just to ram home the point, I'm not a developer; I'm a designer. This was what I started out with when I generated that prompt.

```javascript
    let lastmodified = new Date();

    console.log("app.js - connected - " + lastmodified);

    let initialScore = 501;
```

Let's tackle those last 2 tasks I talked about. First, let's make sure we can't use both of the checkboxes when one is ticked before I then go on to manipulate the score button text. 

```
PROMPT: This is a great start.  Let's fix a found bug in the program so we cannot have both the double and triple checkboxes checked at the same time. 
```

```javascript
// Add multiplier checkbox handlers
const tripleCheckbox = document.querySelector('#triple---point--score');
const doubleCheckbox = document.querySelector('#double---point--score');

tripleCheckbox.addEventListener('change', () => {
    if (tripleCheckbox.checked) {
        doubleCheckbox.checked = false;
    }
});

doubleCheckbox.addEventListener('change', () => {
    if (doubleCheckbox.checked) {
        tripleCheckbox.checked = false;
    }
});
```

I am aware that we could probably have got around this by using a radio button instead of a checkbox, but this is a simple fix by using change event handlers to perform simple changes to the checkboxes. However that presents a similar problem. We can't have both the triple and double checkboxes checked at the same time, but we can have neither of them checked; a behaviour which represents single value scores. That's why I think 2 checkboxes is the best solution for our needs. 

Now, we need the text on the buttons to take into account the multipliers on the scores.


`
PROMPT: change the button text on the buttons to reflect the values of the scores when multipliers are applied. i.e. 10 becomes 30 when the triple checkbox is checked and back to 10 when unchecked. 
`

This introduces a new function, `updateButtonText();` which we call on both checkboxes.

```javascript

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
```

Now, `sonnet` tried to solve this by multiplying the scores against the text values - or what it called the base values. 

```javascript

    const baseValue = parseInt(originalValue);
    let newValue = baseValue;
        
    if (tripleCheckbox.checked) {

        newValue = baseValue * 3;

    } else if (doubleCheckbox.checked) {

        newValue = baseValue * 2;
    }
        
    button.textContent = newValue;

```

I noticed this straight away where one dart with a triple 20 was giving a score of 180 instead of 60.

`
PROMPT: This last attempt introduces a bug. We already had the correct game logic in place. All we wanted to was manipulate the text content of the buttons. So one throw of Triple 20 now gives a score of 180 for one dart, which is not what we want 
`

What we want is a solution that keeps the scoring logic separate from the button display text. 


```javascript

    // ... existing code ...

    function updateButtonText() {
        scoreButtons.forEach(button => {
            const originalValue = button.getAttribute('data-original-value') || button.textContent;
            if (!button.getAttribute('data-original-value')) {
                button.setAttribute('data-original-value', originalValue);
            }
        
            if (originalValue === 'MISS') return;
        
            const baseValue = parseInt(originalValue);
            let displayValue = baseValue;
        
            if (tripleCheckbox.checked) {
                displayValue = baseValue * 3;
            } else if (doubleCheckbox.checked) {
                displayValue = baseValue * 2;
            } else {
                displayValue = baseValue; // Reset to original value
            }
        
            button.textContent = displayValue;
        });
    }

    // Score button handlers
    document.querySelectorAll('.score---points--btn').forEach(button => {

        button.addEventListener('click', (e) => {
            e.preventDefault();
            // Use the original value for scoring, not the display value
            const originalValue = button.getAttribute('data-original-value') || button.textContent;
            const basePoints = parseInt(originalValue === 'MISS' ? 0 : originalValue);
            const tripleMultiplier = document.querySelector('#triple---point--score').checked ? 3 : 1;
            const doubleMultiplier = document.querySelector('#double---point--score').checked ? 2 : 1;
            const points = basePoints * tripleMultiplier * doubleMultiplier;
            
            if (throwCount < 3) {
                recordThrow(points);
            }
        });
    });

// ... rest of existing code ...
```

So... I think we've achieved enough for part 2 of this series.

We've made a lot of progress so far. We have some user flow from the beginning to the end of a Darts game. We have a scoring system that works - partially. We have generated some code that scores 3 throws for a visit and keeps tallying the score down as it goes. And we've made preparations for a UI feature that displays score values on the buttons as when applied with a triple or double score.

This has introduced a bug however, when we get to checkout scores. It seems that when we get to checkout range, which is 170 or lower or higher than 1 we have some discrepancies in the remaining points score as compared to the score buttons we press/click.

We'll try to fix those in the next blog by exploring some edge cases.