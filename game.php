<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="pdf-downloadable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-N9WB623MVP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-N9WB623MVP');
    </script>

    <!-- Google Font(s) -->
    <link href="" rel="stylesheet">

    <!-- Meta Tags -->
    <meta name="description" content="This is a simple web application that you can use to score your Darts matches as they'ew being played. Get a game on">
    <meta name="keywords" content="darts games, darts app, score, scoring, darts scoring darts scoring app, darts scorer, ai, machine learning">
    <meta name="image" content="htttps://projects.jonniegrieve.co.uk/darts_scorer_app/assets/images/app-image.pn">

    <!-- FACEBOOK: Open Graph -->
    <meta property="og:title" content="Darts Scorer App (AI) by Jonnie Grieve Digital Media">
    <meta property="og:description" content="This is a simple web application that you can use to score your Darts matches as they'ew being played. Get a game on">
    <meta property="og:image" content="htttps://projects.jonniegrieve.co.uk/darts_scorer_app/assets/images/app-image.png">
    <meta property="og:url" content="https://projects.jonniegrieve.co.uk/darts_scorer_app/game.php">

    <!-- TWITTER: Open Graph -->
    <meta name="twitter:title" content="Darts Scorer App (AI) by Jonnie Grieve Digital Media">
    <meta name="twitter:description" content="This is a simple web application that you can use to score your Darts matches as they'ew being played. Get a game on">
    <meta name="twitter:image" content="htttps://projects.jonniegrieve.co.uk/darts_scorer_app/assets/images/app-image.png">
    <meta name="twitter:card" content="footbal_score_comparator">

    <!-- Add Favicon -->
    <link rel="icon" href="favicon.png" type="image/png">

    <!-- Canonical link -->
    <link rel="canonical" href="https://projects.jonniegrieve.co.uk/darts_scorer_app/game.php">

    <!-- Stylesheet -->
    <link rel="stylesheet" type="text/css" href="style.css" />

    <!-- Page Title-->
    <title>Game On | Darts Scorer App (AI) by Jonnie Grieve Digital Media</title>

</head>
<body> 
    
    <header>

        <h1>Darts Scorer App (AI) <span id="app_version"><a href="log.php">v1.2.1</a></span></h1>
        <h2>by Jonnie Grieve Digital Media</h2>
        <a href="https://github.com/jg-digital-media/jgdm_darts_scorer" target="_blank" id="app_repo">Repository</a>

    </header>

    <section class="game---state">
    
        <img src="assets/images/oche.png" alt="An Oche - Darts Scorer App Local" title="An Oche - Darts Scorer App Local" id="app---logo--gamestate" />

        <div class="game---status">

            <div class="game---score">

                <span id="current---score">Current Score: <strong>0</strong></span>

            </div>

            <div class="number---of---throws">

                <img src="assets/images/dart.png" id="dart---icon" alt="Darts Thrown Tally" title="Darts Thrown Tally" />
                <span id="throw---number">0</span> of 3

            </div>

            <div class="tally---throws">

                <div id="throw---one" class="throw---score">&nbsp;0</div>
                <div id="throw---two" class="throw---score">&nbsp;0</div>
                <div id="throw---three" class="throw---score">&nbsp;0</div>
                <div id="trows---total" class="tally---all-throws">0</div>

            </div>

            <div class="points---to--checkout">

                <h3>Suggested Checkouts:</h3>

                <div id="checkout---one" class="checkout">&nbsp;</div>
                <div id="checkout---two" class="checkout">&nbsp;</div>
                <div id="checkout---three" class="checkout">&nbsp;</div>

            </div>

            <div class="display---messages">

                <!-- <h3>Display messages: </h3> -->
                <div class="message" id="js-message"></div>

            </div>

        </div>     

    </section>

    <!-- <a href="#" class="open---throw--history">Throw History</a> -->

    <!-- Start Modal Area -->        
    <div id="modal" class="modal">

        <div class="modal-content">

            <span class="close">&times;</span>
            <h2>The Scoreboard</h2>
            <p>Score points for the throw.</p>

            <div class="scoreboard---container">

                <table id="score---table">
                    <tr>
                        <th>Visit (#)</th>
                        <th>Throws</th>
                        <th>Score</th>
                        <th>Points Remaining</th>
                    </tr> <!--
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
                    <tr>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr> -->
                </table>
            </div>
        </div>
    </div>
    <!-- End Modal Area -->

    <section class="score---points--container">

        <a href="#" class="score---points--btn" id="apply---0--point">MISS</a>
        <a href="#" class="score---points--btn" id="apply---1--point">1</a>
        <a href="#" class="score---points--btn" id="apply---2--points">2</a>
        <a href="#" class="score---points--btn" id="apply---3--points">3</a>
        <a href="#" class="score---points--btn" id="apply---4--points">4</a>
        <a href="#" class="score---points--btn" id="apply---5--points">5</a>
        <a href="#" class="score---points--btn" id="apply---6--points">6</a>
        <a href="#" class="score---points--btn" id="apply---7--points">7</a>
        <a href="#" class="score---points--btn" id="apply---8--points">8</a>
        <a href="#" class="score---points--btn" id="apply---9--points">9</a>    
        <a href="#" class="score---points--btn" id="apply---10--points">10</a>
        <a href="#" class="score---points--btn" id="apply---11--points">11</a>
        <a href="#" class="score---points--btn" id="apply---12--points">12</a>
        <a href="#" class="score---points--btn" id="apply---13--points">13</a>
        <a href="#" class="score---points--btn" id="apply---14--points">14</a>
        <a href="#" class="score---points--btn" id="apply---15--points">15</a>
        <a href="#" class="score---points--btn" id="apply---16--points">16</a>
        <a href="#" class="score---points--btn" id="apply---17--points">17</a>
        <a href="#" class="score---points--btn" id="apply---18--points">18</a>
        <a href="#" class="score---points--btn" id="apply---19--points">19</a>
        <a href="#" class="score---points--btn" id="apply---20--points">20</a>
        
        <a href="#" class="score---points--btn" id="apply---50--points" alt="Inner Bull" title="Inner Bull">50</a>
        <a href="#" class="score---points--btn" id="apply---25--points" alt="Single Bull" title="Single Bull">25</a>

    </section>

    
    <!-- <br /> -->

    <section class="score---multipliers">

        <label for="triple---point--score">Apply Triple Score</label>
        <input type="checkbox" id="triple---point--score" class="score---multiplier">
        <label for="double---point--score">Apply Double Score</label>
        <input type="checkbox" id="double---point--score" class="score---multiplier">

    </section>
    
    <a href="#" class="throw---dart" id="btn---throw--dart">Throw Dart &gt;</a>

    <div class="application---buttons">
        <a href="index.php" class="button" id="btn---home">Home</a>       
        <a href="#" class="open---throw--history">Throw History</a>
        <a href="#" class="button" id="btn---restart">Restart</a>
        <a href="about.php" class="button" id="btn---about">About the App</a> 
    </div>

    <footer>

        <h2>Darts Scorer App (AI) Created using Cursor AI and Supermaven</h2>
        <h3>by <a href="#" target="_blank">Jonnie Grieve Digital Media</a></h3> 

    </footer>
    
    <script src="app.js" type="text/javascript"></script>
</body>
</html>