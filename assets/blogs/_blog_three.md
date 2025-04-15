As you go through the process of developing an app, even with all the planning you might have done, you will notice things you overlooked. For example, a couple of score buttons should be there but were not originally included in the markup. Yes, I forgot to add buttons for the Bullseye and semi-bullseye, which are worth 50 and 25, respectively.

So we'll need to add those later.

But this is okay because Cursor AI watches the codebase and takes into account changes to your code made in another text editor. In my development, I like to develop in Visual Studio Code and run code generations in Cursor.

Moving on in this blog, I'm going to look at some edge cases in terms of making sure that the point scoring logic is sound. I need to do this to try and flush out any bugs in the scoring logic. I had started to notice that when the player gets to the checkout stage of the game, it seemed that double scores (or even triple scores) were not being taken into account. Instead, they were being processed as single scores.

So, with Edge cases, we can go through game scenarios and see how the application behaves.

Here's an example case where we run through a process of a 9 dart scoring run.

```
edge case text

one
-----------

[Apply Triple Score checkbox]

60 -> 60 -> 60 -> Throw Dart

60-> 60-> 60 -> Throw Dart

57 -> 60 -> [ switch to double score] -> 24  

"Game Shot"

Here's another example where we reach "Game shot" in 11 throws.

two
-----------
[Apply Triple Score checkbox]

60 -> 60 -> 60 -> Throw Dart

60-> 60-> 60 -> Throw Dart

57 -> 60 -> [ switch to double score] -> 8  Throw Dart

[uncheck double score] 9 -> [Apply Double Score] -> 10 ->

"Game Shot"

And in 10, along the way testing our ability to switch between single, double and triple score throws.


three
-----------
[Apply Triple Score Checkbox]

60 -> 60 -> 60 -> Throw Dart

[Single Score Checkbox] -> 20 -> [APPLY TRIPLE SCORE] -> 60 -> 60 -> Throw Dart

36 -> 60 -> 45 -> Throw Dart

[double Score Checkbox] -> 40

"Game Shot"

One more example.  Remember, each time we click "Throw Dart", we're actually taking into account all 3 throw attempts of a single visit.


four
-----------

20 -> 20 -> 20 -> Throw Dart

60(t) -> 19 -> 57(t) -> Throw Dart

60(t) -> 60(t) -> 60(t) -> Throw Dart

45(t) -> 60(t) -> 20(d)

"Game Shot"
```

Now, those are just a few examples. Hopefully, they adequately show what I was planning to do. I've tried many, many edge cases like this one, and I've yet to find one that replicates the behaviour I previously described. All the ones I've tried according to Darts rules have behaved as they should.

I'm going to keep trying, but now I am surmising that I am confused about the values for given numbers given as doubles or single scores. I might have been pressing the wrong numbers d3 for 6 points rather than d6 for 12, just as an example. Maybe.

But the fact that I'm having this confusion means there are UX improvements to consider. It'll be worth highlighting labels when either multiplier is checked or giving the user text feedback when "shooting" for a double score.

There is, however, another bug to consider.

```
PROMPT: At the moment it is possible to win a "game shot" on a triple or a single score. We need to tighten this up so that a player can get a "game shot" only when checking out on a double score.  So "double score" must be checked for before a "game shot" can be awarded. 
```

The way to fix this bug is to modify the recordThrow() function to check for a double score before a "game shot" can be awarded.

The model has decided to do this check when the score reaches zero. by adding an additional condition check. So, if the score is zero, then check to see if the player has a double score enabled.

The way to do this is to look at the Boolean value of the checked property of the Double Score multiplier.. If this is the case, we can safely proceed to the end of the game.

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

We have now implemented the safeguard against failing to check out on a double score.

In Darts, when you bust, you score more points than the amount you have available. When that happens, you forfeit the rest of your visit and have to wait until your opponent finishes their visit.

What we need to do now is add a safeguard that busts a player if they try to score a 0 on a single or treble score.

But at this point, I really want to think about adding the 2 remaining score buttons 50, and 25 for the bull, and integrate them into the scoring logic.


```PROMPT: I have added 2 new buttons for the scoring logic.  This is for the bullseye and the outer bull.  These should always score 50 and 25 respectively. 

How do we ensure they're not affected by the score multiplier checkboxes?
```

It's interesting to note the robustness of the current scoring logic. Simply adding the buttons works in the same vein; they're already integrated.

This is because 50 and 25 are given as text content of the anchor elements.

```
<br />
    <a href="#" class="score---points--btn" id="apply---50--points" alt="Inner Bull" title="Inner Bull">50</a>
    <a href="#" class="score---points--btn" id="apply---25--points" alt="Single Bull" title="Single Bull">25</a>
```

Our solution is found in the score button handlers and the updateButtonText function.

These 2 new buttons present the following issues. 

The Bullseye and the Semi Bull do not have double and triple scores. They will be completely unaffected by the the Double and Treble checkboxes and always score 50 and 25.

We will need to make sure the new scores are added to the scoring logic in the same way as the other scoring buttons.

```javascript
// Special handling for bull and outer bull
        if (basePoints === 50 || basePoints === 25) {
            recordThrow(basePoints);
            return;
        }
```

And we expand the condition that blocks changes made by the multipliers.

```javascript
// Skip MISS, bull and outer bull
        if (originalValue === 'MISS' || originalValue === '50' || originalValue === '25') return;
```

This ensures that:

The Bullseye always scores 50
The outer bull always scores 25
The multiplier checkboxes have no effect on these scores
The button text for these scores remains unchanged when multipliers are toggled

And in a beautiful turn of events, the bull now qualifies for the game shot.

That brings us a long way into finising the game logic... if it is not there already.

There are some things to do behind the scenes, like building the score history. and I#ll note we can do some things for UI like showing the score for each visit as the gamr is playing.

We'll do that in the next blog.
