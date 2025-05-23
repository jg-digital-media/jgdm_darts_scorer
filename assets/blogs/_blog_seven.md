Let's go over some UI and style improvements I made to the app.

First,  I added a "home" button that takes you back to the index.php page - I'm using this rather than a "Restart" button to do that job. So we will have the home button that goes to index.php, and restart will start a new visit to the "Oche" from the beginning.

```html
    <div class="application---buttons">
        <a href="index.php" class="button" id="btn---home">Home</a>
        <a href="#" class="button" id="btn---restart">Restart</a>
    </div>
```

Eventually, we'll need to add a reload element to the restart button. But we'll leave that for now, since we have that separation of functionality that we've just put in place.

I'm also going to introduce a Game Status Element. This is a container element which will contain and layout the various score and message displays. It feels like another fundamental change to the markup, so I'll do this now.

```html

    <div class="game---status">
        
    </div>
```

So we're adding a new containing element for the new status elements to go on. And then we can put the rest of the elements in this container.


```
.game---score
    #current---score strong

.tally---throws
	throw---one
	throw---two
	throw---three
	throws---total

.number---of---throws
	.throw---number

.points---to--checkout

.display---messages
    .message

```


Having this new element means we have a place give game feedback, such as "Game Shot!" or "Bust!", "Bullseye", "180!!!". This, I think, is a better user experience than using JavaScript alerts.


```

PROMPT: We're going to improve the UI by reducing the need for JavaScript alerts and adding in game messages.  In this element. 

<div class="display---messages">

    <div class="message" id ="js-message"></div>

</div>


```

Cursor's response was to create a message display system that slowly replaces the alert() functions and puts them in the above element as a new function.

```javascript 

// Add a function to handle message display
function showGameMessage(message, duration = 2000) {

    messageDisplay.textContent = message;
    messageDisplay.style.display = 'block';
    
    // Clear message after duration (unless it's 0)
    if (duration > 0) {

        setTimeout(() => {

            messageDisplay.textContent = '';
            messageDisplay.style.display = 'none';
        }, duration);
    }
}

```

So the code above gives us block-level elements that can be removed after a period of time that we set. The default parameter is for 2 seconds of display, which can be overridden by passing a value to a function call.

Crucially, messageDisplay the element item is the item element of the .display---message container elements, which means have some control of the document flow and available space.

```javascript

// Add to DOM Elements section
const messageDisplay = document.querySelector('#js-message');
```

And then, once the function is ready we can call the function in all the relevant places.  

e.g. 

```
recordThrow()   With this function all, you can call the function in different formats as well.  
showGameMessage('You must finish on a double!'); with only a string parameter 
showGameMessage('You must finish on a double!', 0) where we explicity state there should be no timeout duration.


```

In one case, we use a condition statrement to provide a message for notable scores.

```javascript

    // Special messages for notable scores
    if (points === 180) {
        showGameMessage('180!!!', 3000);
    } else if (points === 50) {
        showGameMessage('Bullseye!');
    } else if (points >= 100) {
        showGameMessage('Ton!');
    }

    // There may be an unintended bug here with checking 50 for a bull
```

tally the number of darts that have been thrown per visit.  Starting at 0 and incrementing by one each time a score button has been pressed


Tally the score for all throws in the game as they come in. That means each time a score button is pressed, the display counts up from 0 to 3 for each "dart thrown".


```html
<div id="trows---total" class="tally---all-throws">0</div>
```


```javascript
// Add to DOM Elements section
const throwTotalDisplay = document.querySelector('#trows---total');
```

```javascript

// Calculate and display running tally
    const visitTotal = currentVisit.reduce((sum, score) => sum + score, 0);
    throwTotalDisplay.textContent = visitTotal;

```    

We won't forget to reset the display on each visit. 

```javascript
function resetVisit() {

    // existing code snipped

    throwNumberDisplay.textContent = '0';  // Reset throw counter
    
    // existing code snipped
}
```


And now we have... a tally of the scores for each visit thar resets appropriately on each new visit



Behind the scenes, I added a new element to the DOM to display the total number of throws in a visit.  

```
0 out of 3
1 out of 3
etc 
```

Whether it was my prompt that was imperfect, or the AI didn't see the element and suggested I add a new element, seemingly not understanding that I had one in place for this purpose.

This is another pitfall you have to be aware of when you're coding with AI. I gave it a helping hand and pointed out the throws element. 


```

PROMPT: 
We don't need a new element. We can use these elements I added earlier.

 <div class="number---of---throws">

                <span id="throw---number">0</span>/ of 3

            </div>
```

I love its "ah perfect" human reaction. "Ah perfect! Let's use the existing element to track the dart count. Here's the modified code:"

```javascript


// Add to DOM Elements section
const throwNumberDisplay = document.querySelector('#throw---number');

```

```javascript
function recordThrow(points) {

    // Update throw number display (1-based counting for display)
    throwNumberDisplay.textContent = throwCount + 1;


}
```


 // Update throw number display (1-based counting for display)
    throwNumberDisplay.textContent = throwCount + 1;    
    

```javascript

 function resetVisit() {
    throwCount = 0;
    currentVisit = [];
    throwDisplays.forEach(display => display.textContent = '0');
    throwTotalDisplay.textContent = '0';
    throwNumberDisplay.textContent = '0';  // Reset throw counter
    suggestCheckouts(currentScore);
}

  throwNumberDisplay.textContent = '0'; // Reset the throw number display
```


----


Add a "Quit" button to quit the game and go back to the index.php page. - This will be a good way to exit app when we're finished playing our Darts games. 

```
PROMPT: Add a "Quit" button to quit the game on the moment of "game shot" which when clicked will go back to the index.php page. - This will be a good way to exit the app there and then in addition to the home button. 
```

```javascript
if (message === 'Game Shot!') {
        // Show game shot message with quit button
        messageDisplay.innerHTML = `
            ${message}
            <button id="quit---game" class="btn btn---quit">Quit Game</button>
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
```



This, I think, is a wrap for the main application development.  I may add one last blog for the CSS and some more UX.  But we've done the bulk of the development in these last couple of weeks. 

So, how was it?  

Everything about this process has been what I wanted it to be.  I was excited about it from the moment I came up with the idea.    

And I knew from a personal point of view that the only way I could get anywhere with this project was to work with AI.  Cursor Ai was merely the tool I used to do it.

So for me it's about Wireframing to come up with a User interface; building the markup so I can then present that context to Cursor; and then learning how to prompt Cursor to do the work of implementing the front-end capabilities.

It's been a real thrill to do this and I've learned a lot.

I have learning difficulties. It doesn't matter how many times I approach a brief and think about it... the brain matter just doesn't come to play, which allows me to convert a problem into a solution with code. But the solution that Cursor provides with the sonnet LLM, I can read it, and then my coding experience comes into play.