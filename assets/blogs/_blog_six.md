I've tried to say many times that we're going to add some UX features and bug fixes to the app. 

So let's now do it.

We're going to work on some bug fixes for the app


+ BUG: A player "bust" is not recorded in the throw history

This is a very verbose way of describing it, but what's actually happening is that if a player scores a bust, any correct scores are not being recorded in the throw history. 

We'd see something like this instread

e.g. 0 0 0 = 21. 

In this example, the third throw was bust. We should be therefore have been seeing something more like 60 60 0 = 21. So the tally for the visit is being recored as if valid scores have been thrown but are not being displayed.


```javascript

// Throw History
function recordThrow(points) {

    if (currentScore - points < 0) {

        alert('Bust! Score would go below 0');
        recordVisitToHistory();
        resetVisit();
        return;
    }

    // existng code

}

```

This, in the end, was one of the simpler fixes. We simply switch over the function calls so we're recording all throw results that we need to before the visit is reset. And since we know that when a bust is made, the visit to the oche ends. You have to get back all your points at the next visit.

And now we have throw histories correctly displayed when a bust occurs.

+ BUG: throw history scores should be in correct order darts - 3 darts - 6 darts - 9 etc


I thought I had this one nailed down without the need to consult AI.

My big idea was to change the order by switching to the insertAfter() method rather than insertBefore(). I actually believed there was an insertAfter() method that would do this. It turns out there isn't. I might have been thinking of some methods in jQuery.

??? 

```javascript
if (scoreTable.rows.length > 1) {

        // scoreTable.insertBefore(row, scoreTable.rows[1]);
        scoreTable.appendChild(row);
    } else {
        scoreTable.appendChild(row);
    }
```

```javascript

scoreTable.appendChild(row);

```

For now, I'm keeping it as

```javascript
// Insert after header row
    if (scoreTable.rows.length > 1) {

        scoreTable.appendChild(row);
    } else {
        
        scoreTable.appendChild(row);
    }
```



+ BUG: "You must finish on a double", when attempting to checkout on the bullseye (50). We should not need to check "Double" to checkout on the bullseye.

I actually made another one of these for the semi bullseye, 25. But that's not a legal way to get to zero points in Darts. So we can concentrate on fixing this bug on 50; the bullseye

To fix this, we need to modify the checkout logic to allow the bullseye (50) as a valid checkout without requiring the double checkbox.


```javascript

    // account for a bullseye checkout
    const originalValue = points === 50 ? 'Bull' : null;
        
    
    if (originalValue !== 'Bull' && !doubleCheckbox.checked) {


    }

```

+ BUG: Some checkout suggestions are so low, they are displayed as floating point numbers. e.g. 1.5  2.5. 

This may be programatically sound, but it's no good for a Darts app, so we need to look into the checkout suggestions code and manipulate the suggestions so that they don't show floating-point values.

The issue seems to be found in the double-double combinations. 

```javascript
// Double-Double combinations
    if (score <= 80 && score % 2 === 0) {
        const d1 = score/2;
        // Only add if d1 is even to avoid fractional numbers
        if (d1 <= 40 && d1 % 2 === 0) {
            checkouts.push(`D${d1/2} D${d1/2}`);
        }
    }
```


```javascript

 // Double-Double combinations
    if (score <= 80 && score % 2 === 0) {
        for (let i = 20; i >= 1; i--) {
            if ((score/2) === i * 2) {
                checkouts.push(`D${i} D${i}`);
            }
        }
    }

```

An extra one. 

// Clear previous suggestions
// checkoutDisplays.forEach(display => display.textContent = '');

This is so we get updated checkout suggestions after each visit rather than new suggestions piling on top of each other

+ BUG: Some checkout suggestions are not displayed for scores of 160 or more


I went through a process of elimination for this.  

```javascript
// For debugging - log scores with no checkouts
    if (checkouts.length === 0 && score >= 2 && score <= 170) {
        console.log(`No checkouts found for score: ${score}`);
    }
```


app.js:204 No checkouts found for score: 170
app.js:204 No checkouts found for score: 169
app.js:204 No checkouts found for score: 168
app.js:204 No checkouts found for score: 167
app.js:204 No checkouts found for score: 165
app.js:204 No checkouts found for score: 164
app.js:204 No checkouts found for score: 163
app.js:204 No checkouts found for score: 162
app.js:204 No checkouts found for score: 161
app.js:204 No checkouts found for score: 159
app.js:204 No checkouts found for score: for 3


It looks like the main reason for missing checkouts is that we weren't checking for bull checkouts for higher scores.

We simply added a new condition check for this when doing checkouts for triple-double combinations. 

```javascript
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

```

Key changes (according to Cursor):
1. Added bull finish handling for triple-triple combinations

2. Increased the remaining score check to 50 to include bull finishes
3. Split the finish logic between bull and regular doubles
Now you should see valid checkout suggestions for all scores 2-170, including:
170: "T20 T20 D25" or "T20 T20 Bull"
167: "T20 T19 D25" or "T20 T19 Bull"
164: "T20 T18 D25" or "T20 T18 Bull" etc

Now, I did this and still saw some empty checkouts. 

No checkouts found for score: 169
app.js:194 No checkouts found for score: 168
app.js:194 No checkouts found for score: 166
app.js:194 No checkouts found for score: 165
app.js:194 No checkouts found for score: 163
app.js:194 No checkouts found for score: 162
app.js:194 No checkouts found for score: 159

Now, what I could do here is post the back and forth I just had with the Cursor chat... but to cut a long story short,  we "disagreed" about which scores can be checked out in Darts and which cannot.  Cursor decreed that 169, 168, 166, 165, 163, 162, 159 are not valid checkouts.

I questioned this. And this is a pitfall of AI.  It's like sometimes it develops and inferiorty complex and becomes very quick to "apologise" to you and throw you some code to fix it

```I apologize for my mistake! You are absolutely correct, and I was wrong. Any score between 2 and 170 (inclusive) can be checked out in darts.

```

I'm looking at 2 examples of Darts checkout tables that verify that there are a handful of Darts scores that cannot be checked out.  So... this is one occasion where I had to go online and find the answer myself rather than just trusting the AI.  Humans make mistakes and so does AI.

http://www.darts-uk.co.uk/Checkout.html


https://www.baractivity.com/POS-002.html


Instead, I'm going to follow the AI's original suggestion and put a message in place to tell people when there are no checkouts available. 

```javascript
// List of impossible checkout scores
    const impossibleCheckouts = [169, 168, 166, 165, 163, 162, 159];
    
    if (impossibleCheckouts.includes(score)) {
        checkouts.push("No checkout possible");
        return checkouts;
    }
```


One last thing. 

On the game shot, we need to find another way to announce the game shot.

Players must be allowed to view the throw history when the game ends. 

Do we need AI for that? 

```JavaScript
        alert('Game Shot!');
        // window.location.href = 'index.php';

        recordVisitToHistory();
```

Remembering to also record the game set of darts so it's available in the throw history.

That is a lot of bugs now sorted out. Or some way forward to being sorted out at the very least. We've made so much progress on checkout scores, and we have a fully functional record of scores running away in the background that can now be seen at all stages of the app. 
        