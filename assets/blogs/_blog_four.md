By now, I've prompted and compiled (I do hesitate to say "developed", because as we covered in Part 3, the AI has done that) the app to the extent that we have the vast majority of the user flows that make the beginning and the end of a game of darts.

We have scoring for one player as they go through a game of Darts (note: by design, the app does not track an opponent's score).

The player records 3 throws per visit, as expected.  With each dart scored the player score reduces by that amount. 

We have a safeguard that prevents the player from scoring a 0 on a single or treble score.

There are still some scoring logic safeguards to consider. For example, we haven't yet considered what happens when a player lands on a remaining score of 1 point. No one can score a double of 1 point or less. There's still a lot more to do.

But there's another major feature of this app we need to build. - Building a "throw history".

The idea of the throw history is that we record the scores for each dart as it is thrown - for every vist to the Oche. Every time the user throws a dart (or finishes their visit), the scores for that visit will be recorded behind the scenes.

A visit number, 3 scores and the total score for that visit will be recorded and we will put this information in an HTML table.

Here's an example of what it would look like: 

```
0 Darts | 0 0 0 | 0 | 501
```

And the following rows will look like...

```
3 Darts | 60 60 60 | 180 | 341 
6 Darts | 20 20 20 | 60 | 241

etc

```

Based on the plan for the tables that I've made, I'll modify the table in the modal area to reflect it.

```html

<div class="scoreboard---container">

    <table id="score---table">
        <tr>
            <th>Visit (#)</th>
            <th>Throws</th>
            <th>Score</th>
            <th>Points Remaining</th>
        </tr>
        <tr>
            <td>0 Darts</td>
            <td>0 0 0</td>
            <td>0</td>
            <td>501</td>
        </tr>
        <tr>
            <td>3 Darts</td>
            <td>60 60 60</td>
            <td>180</td>
            <td>321</td>
        </tr>
        <!-- more rows -->

    </table>
    
</div>

```

I modified it to include 4 columns of data, so we can see the 3 individual throws, the sum total, and the effect it has on the remaining players' score.

So what's the best way to tackle this problem? I'll try to solve this problem with the following prompt. 

`PROMPT: We need a modal window that will record the history of the scores for the game as they come in, each time the player finishes a visit. i.e. clicking "Throw Dart"

`

Is this enough information for the model to finish the problem? 

Sometimes I ask an AI model to generate something for me, and I fear that there might be a breaking change it makes as a result of the code returned.

I did try the above prompt. And to be fair, I asked it to do a lot.

```
I asked it to handle the modal control functionality (open/close)

To record the scores for each visit when "Throw Dart" is clicked

To build a solution that creates a new row in the score table showing:
   Number of darts thrown
   Individual throw scores
   Total score for the visit
    Remaining points

To insert new scores at the top of the table

To handle incomplete visits (less than 3 darts)

```

Cursor AI added all the selectors and functions to control the modal functionality. The part that I wasn't sure about is the following function.

```javascript

// Throw dart button handler
document.querySelector('#btn---throw--dart').addEventListener('click', (e) => {
    e.preventDefault();
    // if (throwCount >= 3 )
    if (throwCount > 0) {  // Only record if there were throws

        recordVisitToHistory();
        resetVisit();
    }

});

```

So it wants to both record a visit and reset the displayed scores when the throw count is only above 0, not greater than or equal to 3. I'm sitting here worried it's going to affect the score logic as we go through the game.

But this is an AI project. And I'm going to trust the API and apply the suggested changes. 

It was fine.

There was a runtime error I had to handle.

```
app.js:180 Uncaught NotFoundError: Failed to execute 'insertBefore' on 'Node': The node before which the new node is to be inserted is not a child of this node.
    at recordVisitToHistory (app.js:180:20)
    at HTMLAnchorElement.<anonymous> (app.js:118:9)
```

So it encountered a node it didn't expect to find. So we simply remove the hard-coded elements that were present, and the record seems to be updated accordingly. 

We should work on keeping the table header in place though. Now the rows are added seamlessly

Before I finish this part, it's worth noting what these new functions have actually done.

In the first instance, sonnet provided the variables and selectors needed to control the modal declares modal area. 

```javascript


```

Event listeners for modal controls

```javascript

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
```

This is where the magic happens `function recordVisitToHistory() {`


```javascript

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

```


This function increments the visitor number. This increment is useful for telling the browser that it should put the next set of darts in a new table row.

currentVisit[] is an empty array. It's the way we store the scores of each throw of a dart.


```javascript
openHistoryBtn.addEventListener('click', (e) => {
    e.preventDefault();
    modal.style.display = "block";
});

```



```javascript 
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
        scoreTable.insertBefore(row, scoreTable.rows[1]);
    } else {
        scoreTable.appendChild(row);
    }
}

```

There was no issue in the end with changing the throwCount() condition, which ensures that nothing is added to the modal area until Darts are thrown by clicking the appropriate button.

```javascript
     if (throwCount > 0) {  // Only record if there were throws
        recordVisitToHistory();
        resetVisit();
    }
```

I'm partly glad I didn't do the CSS yet. Easier to do the testing on the modal throw history.

In the next blog, we'll look at how to display checkout suggestions, which I think will be an important UX feature for this kind of application. And then start looking in more detail at the bugs in the application and see if we can fix them.