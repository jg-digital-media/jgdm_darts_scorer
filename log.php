<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="pdf-downloadable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google Font(s) -->
    <link href="" rel="stylesheet">

    <!-- Meta Tags -->
    <meta name="description" content="This is a simple web application that you can use to score your Darts matches as they'ew being played. Get a game on">
    <meta name="keywords" content="darts games, darts app, score, scoring, darts scoring darts scoring app, darts scorer, ai, machine learning">
    <meta name="image" content="htttps://projects.jonniegrieve.co.uk/darts_scorer_app/assets/images/app-image.png">

    <!-- FACEBOOK: Open Graph -->
    <meta property="og:title" content="Darts Scorer App (AI) by Jonnie Grieve Digital Media">
    <meta property="og:description" content="This is a simple web application that you can use to score your Darts matches as they'ew being played. Get a game on">
    <meta property="og:image" content="htttps://projects.jonniegrieve.co.uk/darts_scorer_app/assets/images/app-image.png">
    <meta property="og:url" content="https://projects.jonniegrieve.co.uk/darts_scorer_app/log.php">

    <!-- TWITTER: Open Graph -->
    <meta name="twitter:title" content="Darts Scorer App (AI) by Jonnie Grieve Digital Media">
    <meta name="twitter:description" content="This is a simple web application that you can use to score your Darts matches as they'ew being played. Get a game on">
    <meta name="twitter:image" content="htttps://projects.jonniegrieve.co.uk/darts_scorer_app/assets/images/app-image.png">
    <meta name="twitter:card" content="footbal_score_comparator">
    
    <!-- Add Favicon -->
    <link rel="icon" href="favicon.png" type="image/png">
    
    <!-- Canonical link -->
    <link rel="canonical" href="https://projects.jonniegrieve.co.uk/darts_scorer_app/log.php">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" />

    <!-- Page Title-->
    <title>App Log | Darts Scorer App (AI) by Jonnie Grieve Digital Media</title>

</head>
<body>

    <header>

        <h1>Darts Scorer App (AI) <span id="app_version">v1.2.1</span></h1>
        <h2>by Jonnie Grieve Digital Media</h2>
        <a href="https://github.com/jg-digital-media/jgdm_darts_scorer" target="_blank" id="app_repo">Repository</a>

    </header>

    <section class="development---log">

        <p id="app_intro">Development log for the Darts Scorer App (AI)</p>

        <a href="game.php" class="button" id="btn---game--on">Game On</a>

        <article>

            <div class="log---header">
                <span class="log---version">v1.2.2</span>
                <span class="log---date">28/02/2025</span>
            </div>

            <ul class="dev---log">

                <li>Add meta tags</li>   
                <li>Add first favicon</li>
                <li></li>         

            </ul>

            <div class="log---header">
                <span class="log---version">v1.2.1</span>
                <span class="log---date">13/02/2025</span>
            </div>

            <ul class="dev---log">

                <li>Change the score button text to match checkout suggestion notation:  e.g. 20 D20 T20</li>   
                <li>Removes filestamps from pages - game.php index.php about.php </li>         

            </ul>

            <div class="log---header">
                <span class="log---version">v1.1.1</span>
                <span class="log---date">28/01/2025</span>
            </div>

            <ul class="dev---log">

                <li>Add link to repository on log.php</li>   
                <li>Add link to repository in website header</li> 
                <li>Fixes horizontal scroll on medium breakpoints and lower</li>               

            </ul>

            <div class="log---header">
                <span class="log---version">v1.1</span>
                <span class="log---date">23/01/2025</span>
            </div>

            <ul class="dev---log">
                <li>This application was developed over 2 weeks.  It is largely functional though some known bugs still remain. Initial development notes are below.</li>
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
    
    <script src="app.js" type="text/javascript"></script>

</body>
</html>