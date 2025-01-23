As you go through the process of developing an app, even with all the planning you might have done, you will notice things you overlooked like a couple of score buttons that should be there but were not originally included in the markup. Yes, I forgot to add buttons for the Bullseye and semi-bullseye scores. (worth, 50 and 25, respectively) 

So we'll need to add those later.

But this is okay because Cursor AI notes and takes into account changes in your code made in another text editor. So I like to develop in Visual Studio Code and run code generations in Cursor. 

Moving on, in this blog I'm going to look at some edge cases in terms of making sure that the point scoring logic is sound. I need to do this to try and flush out any bugs in the scoring logic. I had started to notice that when the player gets to the checkout stage of the game, it seemed that double scores (or even triple scores) were not being taken into account, and were instead being processed as single scores. 

So with Edge caes we can go through gaming scenarios and see how the application behaves.

like as below

```
edge case text

one
-----------

[Apply Triple Score checkbox]

60 -> 60 -> 60 -> Throw Dart

60-> 60-> 60 -> Throw Dart

57 -> 60 -> [ switch to double score] -> 24  

"Game Shot"


two
-----------
[Apply Triple Score checkbox]

60 -> 60 -> 60 -> Throw Dart

60-> 60-> 60 -> Throw Dart

57 -> 60 -> [ switch to double score] -> 8  Throw Dart

[uncheck double score] 9 -> [Apply Double Score] -> 10 ->

"Game Shot"



three
-----------
[Apply Triple Score Checkbox]

60 -> 60 -> 60 -> Throw Dart

[Single Score Checkbox] -> 20 -> [APPLY TRIPLE SCORE] -> 60 -> 60 -> Throw Dart

36 -> 60 -> 45 -> Throw Dart

[double Score Checkbox] -> 40

"Game Shot"



four
-----------

20 -> 20 -> 20 -> Throw Dart

60(t) -> 19 -> 57(t) -> Throw Dart

60(t) -> 60(t) -> 60(t) -> Throw Dart

45(t) -> 60(t) -> 20(d)

"Game Shot"
```

Now those were just a few examples. Hopefully they adequately show what I was planning to do. I've tried many, many edge cases like this one., and I've yet to find one that replicates the behaviour I previously described.  All the ones I've tried according to Darts rules have behaved as it should.

I'm going to keep trying but now I am surmising that I for myself confused about the values for given numers given as doubles or single scores.  I might have been pressing the wrong numbers d3 for 6 points rather than d6 for 12, just as an example.  Maybe.

But the fact I'm having this confusion means there are UX improvements to consider. It'll be worth highlighting labels when either multiplier is checked... or giving the user text feedback when "shooting" for a double score.

There is however another bug to consider. 

```
PROMPT: At the moment it is possible to win a "game shot" on a triple or a single score. We need to tighten this up so that a player can get a "game shot" only when checking out on a double score.  So "double score" must be checked for before a "game shot" can be awarded. 
```

The way to fix this bug is to modify the recordThrow function to check for a double score before a "game shot" can be awarded. 

The model has decided to do this check when the score reaches zero. by adding an additional condition check. So if the score is zero, then check to see if the player has a double score enabled. The way to do this is to look at the boolean valur of the checked property of the Double Score multiplier.. If this is the case we can safely proceed to the end of the game. 

```
if (currentScore === 0) {
     if (!doubleCheckbox.checked) {
            alert('You must finish on a double!');
            // Undo the throw
            currentScore += points;
            currentScoreDisplay.textContent = currentScore;
            throwCount--;
            throwDisplays[throwCount].textContent = '0';
            currentVisit.pop();
            return;
        }
    alert('Game Shot!');
    window.location.href = 'index.php';
}
```

We have now implemented the safeguard against fialing to checkout on a doulble score. 

In Darts, when you bust, you score more points than the amount you have available. When that happens you forfeit the rest of your visit and have to wait until your opponent finishes their visit; or even the game.

We still need to add a safeguard that busts a player if they try to score a 0 on a single or treble score. 

But at this point, I really want to think about adding the 2 remaining score buttons 50, and 25 for the bull, and integrate them into the scoring logic.

```PROMPT: I have added 2 new buttons for the scoring logic.  This is for the bullseye and the outer bull.  These should always score 50 and 25 respectively. 

How do we ensure they're not affected by the score multiplier checkboxes?
```

It's interesting to note about the robustness of the current scoring logic. Simply adding the buttons in the same vein, they already integrated into the logic. 

This is because  50 and 25 are gvien as text content. 

```
<br />
    <a href="#" class="score---points--btn" id="apply---50--points" alt="Inner Bull" title="Inner Bull">50</a>
    <a href="#" class="score---points--btn" id="apply---25--points" alt="Single Bull" title="Single Bull">25</a>
```

Our solution is found in the score button handlers and the updateButtonText function.

```javascript
// Special handling for bull and outer bull
        if (basePoints === 50 || basePoints === 25) {
            recordThrow(basePoints);
            return;
        }
```

And we expand the conditoion that blocks hanges made by the multipliers. 

```javascript
// Skip MISS, bull and outer bull
        if (originalValue === 'MISS' || originalValue === '50' || originalValue === '25') return;
```

This ensures that:

Bullseye always scores 50
Outer bull always scores 25
The multiplier checkboxes have no effect on these scores
The button text for these scores remains unchanged when multipliers are toggled

And in a beautful turn of events, the bull now qualifies for the game shot.

That brings us a long wat into finising the game logic... if not there already.

there are some things to do behind the scenes like building the score history. and I#ll note we can do some things for UI like showing the score for each visit as the gamr is playing. 

We'll do that next. 

....
```

<br />
        <a href="#" class="score---points--btn" id="apply---50--points" alt="Inner Bull" title="Inner Bull">50</a>
        <a href="#" class="score---points--btn" id="apply---25--points" alt="Single Bull" title="Single Bull">25</a>


These 2 new buttons present the following issues. 

The Bullseye and the Semi Bull do not have double and triple scores. They will be completely unaffected by the the Double and Treble checkboxes and always score 50 and 25.

We will need to make sure the new scores are added to the scoring logic in the same way as the other scoring buttons.
```