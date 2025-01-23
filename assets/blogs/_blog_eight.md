CSS Styling and UX


I want to do a brief explainer of the the CSS and SCSS I've used to style the Darts Scorer App.

First, the initial colour scheme for the app.  The scheme is based on the colours of the Darts oche. For now, I've settled on lighter versions of those colours and applied these to 2 Sass variables.

```scss

$bg---header:#ff9494; 
$bg---body: #bfffc4; 

```


```scss

    body {

        font-family: $font---family;
        color: $col---primary;    
        background: $bg---header;
    }

    header {

        background: $bg---header;
        padding: 10pt 0;
    }

```

I put on a little bit of padding on the header which contains the application title and author text.

I had to make some decisions about how to style the score dispays in `.game---status`.

```scss

section.game---state {   

    .game---status {  

        width: 100%;
        text-align: center;

        #game---score {

            width: 100%;
            /* border: solid 1px blue; */
            text-align: center;
            margin: 10px auto;

            #current---score {

                strong {

                    font-size: 30pt;
                    color: $col---tertiary;

                    @media (max-width: $breakpoint---md) {

                        font-size: 12pt;
                    }
                }
            }
        }

        .number---of---throws {

            /* border: solid 1px green;   */ 
            /* width: 200px; */
            width: 25%;
            display: inline-block;     
            font-size: 25pt;   
            color: $col---tertiary;

            @media (max-width: $breakpoint---md) {

                width: auto;
                font-size: 12pt;
            }

            #dart---icon {

                display: inline-block;
                width: 25px;
                height: 25px;
                margin: 0 auto;
                color: $col---tertiary;
            }

            span {

                color: $col---tertiary;
            }

        }

        .tally---throws {

            width: 100%;

            display: inline-block;
            font-size: 25pt;
            color: $col---tertiary;

            @media (max-width: $breakpoint---md) {

                width: auto;
                font-size: 12pt;
            }

            div {

                display: inline-block;
                width: 44px;
            }

        }

        .points---to--checkout {

            display: block;
            width: auto;

            .checkout {

                display: inline-block;
                width: 100px;
            }

        }

        .display---messages {

            /* border: solid 1px yellow; */
            height: 60px;
            width: 100%;
            text-align: center;

            @media (max-width: $breakpoint---md) {

                height: auto;
                width: auto;
            }

            #js-message {  

                display: inline-block;
                width: 100%;
                letter-spacing: 1px;
                color: red;
                font-size: 15pt;
                /* padding: 0px 18px; */
                margin: 10px 18px;
                margin: 10px auto;
            } 

            .message {


            }

        }   

    }

}

```

For the time being, I decided to stick with the basic layout options for CSS.

```scss

    .game---score {

        width: 100%;
        border: solid 1px blue;
        text-align: center;
        margin: 10px 0;
    }
```

I centered the remaining score display with central text alignment

```scss

.number---of---throws {

    border: solid 1px green;   
    width: 200px;
    display: inline-block;        

    #dart---icon {

        display: inline-block;
        width: 23px;
        height: 23px;
        border: gray solid 1px;
        vertical-align: middle;
        margin: 0 auto;
    }

}

.tally---throws {

    width: 100%;
    border: solid 1px orange;
    width: 100%;
    border: solid 1px orange;
    width: 200px;
    display: inline-block;

    div {

        display: inline-block;
    }

}
```

Lay the checkout scores side by side with inline-block which is what we're doing to keep as much of the interface above the fold as possible.

```scss

 .checkout {

    display: inline-block;
    width: 100px;

    display: block;
    width: 100%;

    /* text-align: center; */
    width: 100%;
    font-size: 17pt;
    font-weight: bold;
    color: red;
}
```

I included a fixed height on `.display-messages`, the last element of the score displays. This way we get a more smooth UI until such a time as I redesign that part of the app, when the text content of this element when game status messages are dynamically removed.  `#js-message` is display none by default - which removes the space taken on the DOM. 

```scss
.display-messages {

    /* border: solid 1px yellow; */
    height: 60px;
    width: 100%;
    text-align: center;

    #js-message {

        letter-spacing: 1px;
        text-transform: uppercase;
        color: red;
        font-size: 15pt;
        font-weight: bold;
        padding: 10px 0;
    }

}

```

a line of buttons as interface 




```scss
#btn---home,
    #btn---restart,
    #btn---about,
    .open---throw--history,
    .btn---quit {
    }

```

```scss

.btn---quit {

    display: inline-block;
    margin: 15px auto;
    width: 200px;
    max-width: 140px;
    padding: 10px;
    background-color: $bg---btn--one;
    color: $col---secondary;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    transition: background .3s;
}

```

Now that we've standardised these button styles... we should @extend them using sass.

```scss
%btn---main {

    display: inline-block;
    margin: 15px auto;
    width: 200px;
    max-width: 140px;
    padding: 10px;
    background-color: $bg---btn--one;
    color: $col---secondary;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    transition: background .3s;    

    &:hover {

        background-color: $bg---btn--hover-one;
        color: $col---secondary;
        text-decoration: none;
    }
}



#btn---home,
#btn---restart,
#btn---about,
.btn---quit {

    @extend %btn---main;
}
```

One point of difference for the game on button  needs something to overrride the inlineblock in the extend. 


```scss

    #btn---game--on {

        @extend %btn---main;

        display: block !important;

    }

    // Score buttons 
    section.score---points--container {

        width: 22%;
        width: 190px;
        text-align: center;

    }

    .score---points--container {

        display: block;
        width: 185px;
        margin: 0 auto;
        text-align: center;

        .score---points--btn {

            @extend %btn---score--darts;
        }
    }

```

    
```scss
%btn---score--darts {

    display: inline-block;
    width: 50px;

    background: lightgreen;

    &:hover {

        background: #ff5959;
    }

}


#btn---throw--dart {

    
}

.score---multipliers {
    
    text-align: center;
}

```

I also switched the #throw--dart--btn button and the multipliers to try and make this a better UI experience. The natural flow will be to select, a multiplier checkbox click a score burron and then click to "throw" the dart.

```html
<section class="score---multipliers">

    <label for="triple---point--score">Apply Triple Score</label>
    <input type="checkbox" id="triple---point--score" class="score---multiplier">
    <label for="double---point--score">Apply Double Score</label>
    <input type="checkbox" id="double---point--score" class="score---multiplier">

</section>
    
<a href="#" class="throw---dart" id="btn---throw--dart">Throw Dart &gt;</a>

```

Styling the modal

```PROMPT: we need to make the modal look nicer, be more imposing on the screen and not push the content below it in the document tree further down the screen
```

I did ask the question on the Cursor AI for this one. I did get a good outcome and I justfied it to myself because I wanted to speed up getting this app deployed to the web, and this repository.

The is a monocromatic colour scheme and good padding for the table.  It's something I'll look at in the future, whether I can add a more colourful scheme suited for the app.

```scss

/* Modal styles */
.modal {
    display: none;
    position: fixed;  /* Changed from absolute to fixed */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);  /* Semi-transparent overlay */
    z-index: 1000;  /* Ensure modal stays on top */
}

.modal-content {

    position: relative;
    background-color: #fefefe;
    margin: 10% auto;  /* Center vertically and horizontally */
    padding: 20px;
    width: 80%;
    max-width: 600px;  /* Limit maximum width */
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Close button */
.close {

    position: absolute;
    top: 10px;
    right: 15px;
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {

    color: #333;
    text-decoration: none;
}

/* Table styles within modal */
#score---table {

    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

#score---table th,
#score---table td {

    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

#score---table th {

    background-color: #f5f5f5;
    font-weight: bold;
}

#score---table tr:hover {

    background-color: #f9f9f9;
}

```

For the score buttons, i thought an inner shadow which gives them a distinctive look compared to the standard application buttons. And used the colour scheme of the the other buttons - to differentiate them.

```scss

.score---points--container {

    display: block;
    width: 185px;
    margin: 0 auto;
    text-align: center;

    .score---points--btn {

        @extend %btn---score--darts;
    }
}
```

The styles I've used above are a starting point that get the project up and running now and make incremental changes and updates in future.

That's why on 23-01-2025, I moved the development of the app to this [Repository](https://github.com/jg-digital-media/jgdm_darts_scorer/)