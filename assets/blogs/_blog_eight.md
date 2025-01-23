CSS Styling and UX



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

a little bit of paddding on the header.

Next we have to make some decisions about how to style the score dispays in .game---status.

```scss
section.game---state {   

    .game---status {  

        #game---score {

            width: 100%;

            #current---score {

                display: inline-block;
                text-align: center;
            }
        }

        .number---of---throws {

        }

        .tally---throws {

            width: 100%;

            div {

                display: inline-block;
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


        }   

    }

}
```


```scss

.game---score {

    width: 100%;
    border: solid 1px blue;
    text-align: center;
    margin: 10px 0;
}
```

Centralise the remaining score. with text align

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


.display-messages.

included a fixed height. This way we get no ui descrepancies in the when game status messages are dynamically removed.  #js-message is display none by default - which removes the space taken on the DOM. 

#js-message {

    letter-spacing: 1px;
    text-transform: uppercase;
    color: red;
    font-size: 15pt;
    font-weight: bold;
    padding: 10px 0;
}



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


Now that we've standardised these button styles... we should @extend them using sass.

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



one point of difference for the game on button  needs something to overrride the inlineblock in the extend. 


    
    #btn---game--on {

        @extend %btn---main;

        display: block !important;

    }



    Score buttons 


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

I also switched the #throw--dart--btn button and the multipliers to try and make this a better UI experience.

```html
 <section class="score---multipliers">

        <label for="triple---point--score">Apply Triple Score</label>
        <input type="checkbox" id="triple---point--score" class="score---multiplier">
        <label for="double---point--score">Apply Double Score</label>
        <input type="checkbox" id="double---point--score" class="score---multiplier">

    </section>
    
    <a href="#" class="throw---dart" id="btn---throw--dart">Throw Dart &gt;</a>

```



.modal  

```PROMPT: we need to make the modal look nicer, be more imposing on the screen and not push the content below it in the document tree further down the screen
```

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


