# Darts AI - Scorer App

This is a simple web app that you can use to score your darts games.

Link: https://projects.jonniegrieve.co.uk/darts_scorer_app

## version 1.0 

### Planning

+ User presented with a representation of the Oche
  + Below is a button with the text "Game On"
  
+ A text box where users can enter a maximum number of 180 for a player score - 
  + Each player starts with 501 points
  + Enter a score in a text box. Pressing Enter submits that score - each entry representing the sum of 3 dart throws

+ Need to keep track of the points scored by the player with each entry and keep track of remaining points available after each entry.

+ should predict "outs" and point combinations available for the player (e.g T20 T20 D20) - Players must finish on a double dart to get to 0 points.

+ After player gets to 0 points, the game is over and button appears to "play again".

### Tasks

+ Swap out oche.png image
+ Finish Responsive Web Design
+ change "Throw Dart" button to say "Next Visit"
+ The remaining score must be available to see at all times.
+ We still need to add a safeguard that busts a player if they try to score a 0 on a single or treble score. 
+ BUG: We need a safeguard that guards against a player ending up on a score of 1 point remaining.
+ BUG: Investigate this game scenario
    + This scenario needs some investigation
        + 3 Darts	2 9 13	24	477
        + 6 Darts	60 60 60	180	297
        + 9 Darts	57 60 60	177	120
        + 12 Darts	60 57 0	117	3

+ UI: Find a way to not display empty checkout suggestion elements.
+ UI: Change score button text D20 T20 20 when multiplier checkboxes are applied
+ UI: Apply a vertical scrollbar when necessary on the modal area



### Completed Tasks

+ Ensure that only one checkbox (Double or Triple) is checked at a time
+ Check bugs with scoring with Edge Cases
    + Check out edge cases that guard against busts
    + Players must finish on a double score
+ It takes away the value of the score button pressed, directly from the initialScore variable. 
+ It allows you to do this 3 times for each Oche visit. 
+ Add a score for the bullseye and semi-bullseye (50 or 25 points respectively)
+ It allows you to click "throw" dart to reset the score values and move on to the next Oche visit. 
    + It even takes into account the 2 checkboxes that double and triple the score values. 
+ In fact, it gives us the very basics of the game from start to finish, by announcing the "Game shot", 
+ Basic safeguards against trying a "bust" shot.
+ Basic alert box that announces a "game shot" against trying a "bust" shot.
+ Safeguard against trying to "bust" a score on anything other than a double score.
+ #new style and placement for `btn---restart`
+ Basic alert box that announces a "bust" - i.e. against trying to "bust" a score on anything other than a double score.

+ BUG: a player "bust" is not recorded in the throw history
+ BUG: throw history scores should be in correct order darts - 3 darts - 6 darts - 9 etc
+ BUG: Some checkout suggestions are so low, they are displayed as floating point numbers. e.g. 1.5  2.5. Programatically sound,  No good for Darts
+ BUG: Some checkout suggestions are not displayed for scores of 160 or more
+ BUG: You must finish on a double", when attempting to checkout on the bullseye (50). We should not need to check "Double" to checkout on the bullseye.

  + 9 Darts 50 50 50	150	0
  + 6 Darts	57 60 54	171	150
  + 3 Darts	60 60 60	180	

  + 9 Darts 60 50 50	160	0
  + 6 Darts	60 60 50	170	160
  + 3 Darts	57 57 57	171 330	

+ Modify the end game phase so users can see the throw history before a new game starts

+ Add a "Restart" button to restart the game. We can probably change this to new game when we've achieved "game shot" and the remaining score is zero. Add a "New Game" button to start a new game. 

+ UI: Add a tally about how many darts have been thrown in each 3 dart visit.

+ UI: Calculate a score for individual visits = sum of 3 throws

+ Stylesheet developed using Sass - CSS Layout technique basics applied
                
+ Modal styles - Generated using Cursor. - On this occasion that came at a point in my development where I'd like to start putting it online now and introduce improvements as and when they come.

### Suggestions from Cursor AI Chat

`The code integrates with your existing HTML structure and uses the styling you've defined in your SASS files. You can further enhance this by:
  + Adding throw history to the modal
  + Implementing checkout suggestions
  + Adding sound effects or animations
  + Adding validation for proper checkout (requiring a double)
  + Would you like me to elaborate on any of these additional features?`
