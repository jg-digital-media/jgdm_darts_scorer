<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Darts Scorer App (AI) by Jonnie Grieve Digital Media</title>

    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <header>

        <h1>Darts Scorer App (AI) <span id="app_version">v1.1</span></h1>
        <h2>by Jonnie Grieve Digital Media</h2>

    </header>

    <section class="development---log">

        <p id="app_intro">Development log for the Darts Scorer App (AI)</p>

        <a href="game.php" class="button" id="btn---game--on">Game On</a>

        <article>

            <div class="log---header">
                <span class="log---version">v1.1</span>
                <span class="log---date">23/01/2025</span>
            </div>

            <ul class="dev---log">
                <li>This application was developed over 2 weeks.  It is largely functional though some known bugs still remain. Initial development notes are below.
                <li>Ensure that only one checkbox (Double or Triple) is checked at a time</li>
                <li>Check bugs with scoring with Edge Cases
                    <ul>
                        <li>Check out edge cases that guard against busts</li>
                        <li>Players must finish on a double score</li>
                    </ul>
                </li>
                <li>App allows score points 3 times for each Oche visit.</li>
                <li>Score buttons (1-50); a score for the bullseye and semi-bullseye (50 or 25 points respectively)</li>
                <li>App allows you to click "throw" dart to reset the score values and move on to the next Oche visit.

                    <ul>
                        <li>It even takes into account the 2 checkboxes that double and triple the score values.</li>
                    </ul>
                </li>

                <li>Basic safeguards against trying a "bust" shot.</li>
                <li>Basic alert box that announces a "game shot" against trying a "bust" shot.</li>
                <li>Safeguard against trying to "bust" a score on anything other than a double score.</li>
                <li>New style and placement for `btn---restart`</li>
                <li>Basic alert box that announces a "bust" - i.e. against trying to "bust" a score on anything other than a double score.</li>
                <li>BUG FIX: a player "bust" is not recorded in the throw history</li>
                <li>BUG FIX: throw history scores should be in correct order darts - 3 darts - 6 darts - 9 etc</li>
                <li>BUG FIX: Some checkout suggestions are so low, they are displayed as floating point numbers. e.g. 1.5 2.5. Programatically sound, No good for Darts</li>
                <li>BUG FIX: Some checkout suggestions are not displayed for scores of 160 or more</li>
                <li>BUG FIX: "You must finish on a double", when attempting to checkout on the bullseye (50). We should not need to check "Double" to checkout on the bullseye.</li>
                <li>Modify the end game phase so users can see the throw history before a new game starts</li>
                <li>Add a "Restart" button to restart the game. We can probably change this to new game when we've achieved "game shot" and the remaining score is zero. Add a "New Game" button to start a new game.</li>
                <li>UI: Add a tally about how many darts have been thrown in each 3 dart visit.</li>
                <li>Stylesheet developed using Sass - CSS Layout technique basics applied</li>
                <ul>
                    <li>Modal styles - Generated using Cursor. - On this occasion that came at a point in my development where I'd like to start putting it online now and introduce improvements as and when they come.</li>
                </ul>

            </ul>

        </article>

    </section>

    <footer>

        <h2>(&copy; 2025) Darts Scorer App - Created using Cursor AI and Supermaven</h2>
        <h3>by <a href="">Jonnie Grieve Digital Media</a></h3> 

        </footer>

    <p>index.php</p>
    
    <script src="app.js" type="text/javascript"></script>

</body>
</html>