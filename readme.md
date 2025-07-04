# Darts Scorer App - `version 1.2.3` 

`Last Updated: 04/07/2025 - 15:38`

This is a simple web app that you can use to score your darts games.

Link: https://projects.jonniegrieve.co.uk/darts_scorer_app

[Planning](#planning) | [Tasks](#tasks) | [Completed Tasks](#completed-tasks) | [Suggestions from Cursor AI Chat](#suggestions-from-cursor-ai-chat)

## Planning

+ User presented with a representation of the Oche
  + Below is a button with the text "Game On"
  
+ A text box where users can enter a maximum number of 180 for a player score - 
  + Each player starts with 501 points
  + Enter a score in a text box. Pressing Enter submits that score - each entry representing the sum of 3 dart throws

+ Need to keep track of the points scored by the player with each entry and keep track of remaining points available after each entry.

+ should predict "outs" and point combinations available for the player (e.g T20 T20 D20) - Players must finish on a double dart to get to 0 points.

+ After player gets to 0 points, the game is over and button appears to "play again".

[Back to Top](#top)

## Tasks

+ `TODO:` Finish the about.php page
+ `TODO:` On player score of 1; the score is bust, turn ends immediately and the score is returned to what it was at the start of that turn. For the purpose of this app, the remainng throw scores are 0 for the rest of the visit.
+ `TODO:` Swap out oche.png image
+ `TODO:` Finish Responsive Web Design
+ `TODO:` Change "Throw Dart" button to say "Next Visit"
+ `TODO:` The remaining score must be available to see at all times.
+ `TODO:` We still need to add a safeguard that busts a player if they try to score a 0 on a single or treble score. 
+ `TODO:` UI: Find a way to not display empty checkout suggestion elements, i.e. only display the suggested dheckout element when there are checkouts to display.
+ `TODO:` UI: Apply a vertical scrollbar when necessary on the modal area
+ `TODO:` App should initiate a modal to announce the game shot and the end of the game.
+ `TODO:` Modal to ask for confirmationn before restarting the game. `btn---restart`

## Completed Tasks: `25`

+ `COMPLETED:` Ensure that only one checkbox (Double or Triple) is checked at a time
+ `COMPLETED:` Check bugs with scoring with Edge Cases
    + Check out edge cases that guard against busts
    + Players must finish on a double score
+ `COMPLETED:` It takes away the value of the score button pressed, directly from the initialScore variable. 
+ `COMPLETED:` It allows you to do this 3 times for each Oche visit. 
+ Add a score for the bullseye and semi-bullseye (50 or 25 points respectively)
+ `COMPLETED:` It allows you to click "throw" dart to reset the score values and move on to the next Oche visit. 
    + It even takes into account the 2 checkboxes that double and triple the score values. 
+ `COMPLETED:` In fact, it gives us the very basics of the game from start to finish, by announcing the "Game shot", 
+ `COMPLETED:` Basic safeguards against trying a "bust" shot.
+ `COMPLETED:` Basic alert box that announces a "game shot" against trying a "bust" shot.
+ `COMPLETED:` Safeguard against trying to "bust" a score on anything other than a double score.
+ `COMPLETED:` #new style and placement for `btn---restart`
+ `COMPLETED:` Basic alert box that announces a "bust" - i.e. against trying to "bust" a score on anything other than a double score.

+ `COMPLETED:` BUG: a player "bust" is not recorded in the throw history
+ `COMPLETED:` BUG: throw history scores should be in correct order darts - 3 darts - 6 darts - 9 etc
+ `COMPLETED:` BUG: Some checkout suggestions are so low, they are displayed as floating point numbers. e.g. 1.5  2.5. Programatically sound,  No good for Darts
+ `COMPLETED:` BUG: Some checkout suggestions are not displayed for scores of 160 or more
+ `COMPLETED:` BUG: You must finish on a double", when attempting to checkout on the bullseye (50). We should not need to check "Double" to checkout on the bullseye.

  + 9 Darts 50 50 50	150	0
  + 6 Darts	57 60 54	171	150
  + 3 Darts	60 60 60	180	

  + 9 Darts 60 50 50	160	0
  + 6 Darts	60 60 50	170	160
  + 3 Darts	57 57 57	171 330	

+ `COMPLETED:` Modify the end game phase so users can see the throw history before a new game starts

+ `COMPLETED:` Add a "Restart" button to restart the game. We can probably change this to new game when we've achieved "game shot" and the remaining score is zero. Add a "New Game" button to start a new game. 

+ `COMPLETED:` UI: Add a tally about how many darts have been thrown in each 3 dart visit.

+ `COMPLETED:` UI: Calculate a score for individual visits = sum of 3 throws

+ `COMPLETED:` Stylesheet developed using Sass - CSS Layout technique basics applied
                
+ `COMPLETED:` Modal styles - Generated using Cursor. - On this occasion that came at a point in my development where I'd like to start putting it online now and introduce improvements as and when they come.
+ `COMPLETED:` BUG: We need a safeguard that guards against a player ending up on a score of 1 point remaining.
+ `COMPLETED:` UI: Change score button text D20 T20 20 when multiplier checkboxes are applied
+ `COMPLETED:` BUG: Investigate this game scenario 
  + Works with `1 D1` checkout.
  + This scenario needs some investigation
    + 3 Darts	2 9 13	24	477
    + 6 Darts	60 60 60	180	297
    + 9 Darts	57 60 60	177	120
    + 12 Darts	60 57 0	117	3
    
[Back to Top](#top)

## Suggestions from Cursor AI Chat

`The code integrates with your existing HTML structure and uses the styling you've defined in your SASS files. You can further enhance this by:
  + Adding throw history to the modal
  + Implementing checkout suggestions
  + Adding sound effects or animations
  + Adding validation for proper checkout (requiring a double)
  + Would you like me to elaborate on any of these additional features?`

[Back to Top](#top)
