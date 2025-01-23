From hereonin, We're going to add some UX features and bug fixes to the app.

A good scoring application for Darts should have a way to suggest a checkouts.  When I was going about planning this app I was aware it was going to be the most involving part of the app - or one of the most at least. It will involve getting data from a structured source.

From 2 to 170 points is a checkout score. My app will initially give options of 3 scores to get to checkout - in the following format/

e.g. `10 6 D20`,`T20 T20 D20` or  `D19 D20 D10` where D or T tell us where trebles or Doubles are required

But there is also a question of how dynamic we want this to be. If a player for example fails a checkout, how do we then bring up the next available checkout suggestion? We will have to guide the player through every visit - maybe even every shot.

One idea that I had was that to suggest a checkout, could get information in a structured dataset, like a json file and display that suggestion according to the last 3 throws.

here's the HTML, I'm using

```HTML
<div class="points---to--checkout">

            <div id="checkout---one" class="checkout">&nbsp;</div>
            <div id="checkout---two" class="checkout">&nbsp;</div>
            <div id="checkout---three" class="checkout">&nbsp;</div>

        </div>
```

I'll put a level 3 heading to tell the user what the numbers are all about. 

```HTML
<div class="points---to--checkout">

    <h3>Checkout suggestions</h3>

            <div id="checkout---one" class="checkout">&nbsp;</div>
            <div id="checkout---two" class="checkout">&nbsp;</div>
            <div id="checkout---three" class="checkout">&nbsp;</div>

        </div>
```



```
PROMPT: We now need to find a way to suggest checkout pathways to zero and win a game.  

we're putting this in the .points---to--checkout" element where you'll see one element for each score.  Checkout scores are 2-170.  We start suggesting checkout at the start of each visit where we're in this range

```

Now, before I try and implement the generated code, I'm going to try and inspect it and see what it might be doing. Because what I had in mind was something involving retrieving data from a source.  It makes some bold claims about it clearly believes it has implemented with its code..

```
Shows checkout suggestions at the start of each visit when score is between 2-170
Provides multiple possible checkout paths:
Single double finishes (e.g., "D16" for 32)
Bull finish for 50
Double-double combinations
Triple-double combinations
3. Clears suggestions during throws within a visit
Updates suggestions when a new visit starts
Shows up to 3 possible checkout paths
```

So from the sounds of things we get 3 numbers in each .checkout item rather than 1 number.

`For 40: "D20", "D10 D10", "T8 D8"`

First, what we're saying is we have a new object literal for each checkout item where we place the checkout suggestions. 

```javascript

// Add to DOM Elements section
const checkoutDisplays = [
    document.querySelector('#checkout---one'),
    document.querySelector('#checkout---two'),
    document.querySelector('#checkout---three')
];

```

The next part of the code looks involving and complext to begin with, but when you strip it down to the highest level we're adding 2 new functions 

```javascript

// Add this new function
function suggestCheckouts(score) {

}

// 
function getCheckoutPaths(score) {


}
```

in suggestCheckouts function we're clearing and getting ready for new suggestions per visit, by clearing what's there and making sure only the correct scores have checkout suggestions. 


```javascript

// Add this new function
function suggestCheckouts(score) {
    // Clear previous suggestions
    checkoutDisplays.forEach(display => display.textContent = '');
    
    // Only suggest checkouts for scores between 2 and 170
    if (score < 2 || score > 170) return;
    
    const checkouts = getCheckoutPaths(score);
    checkouts.slice(0, 3).forEach((path, index) => {
        checkoutDisplays[index].textContent = path;
    });
}
```

The next function is where we're getting the checkout suggestions.

```javascript
function getCheckoutPaths(score) {
    const checkouts = [];
    
    // Common checkout patterns
    if (score <= 40 && score % 2 === 0) {
        checkouts.push(`D${score/2}`);
    }
    
    if (score <= 50) {
        if (score === 50) checkouts.push('Bull');
        if (score === 25) checkouts.push('25');
    }
    
    // Double-Double combinations
    if (score <= 80 && score % 2 === 0) {
        const d1 = score/2;
        if (d1 <= 40) checkouts.push(`D${d1/2} D${d1/2}`);
    }
    
    // Triple-Double combinations
    if (score <= 170) {
        for (let i = 20; i >= 1; i--) {
            const remaining = score - (i * 3);
            if (remaining > 0 && remaining <= 40 && remaining % 2 === 0) {
                checkouts.push(`T${i} D${remaining/2}`);
            }
        }

    }

    return checkouts;
}
```

Finally out these function calls in where we need them - for example  resetVisit so we can actually see new checkout suggestions replacing the previous ones. 


    This function is going to return an array of checkout paths.  
    
    The first thing we're going to do is get the checkout paths for the score. 3 conditions for various scores and cobinations of checkouts. 



```javascript

// Add double-triple combinations
            for (let j = 20; j >= 1; j--) {
                const remainingAfterTriples = score - (i * 3) - (j * 3);
                if (remainingAfterTriples > 0 && remainingAfterTriples <= 40 && remainingAfterTriples % 2 === 0) {
                    checkouts.push(`T${i} T${j} D${remainingAfterTriples/2}`);
                }
            }

```

one loop inside the other. 

```javascript
if (score <= 170) {
        for (let i = 20; i >= 1; i--) {

        for (let j = 20; j >= 1; j--) {

        }

        }

} 
```  

Now we have impleented checkout suggestions - with simple calculations without the need to use a data source such as JSON file or an API.  The latter methods are probably the best way to do it, if I;m honest.

And there are still some edge cases with these checkout suggestions to consider. When I was testing this implementation, I found some checkout were giving floating point values. i.e, D1.5, D0.5 etc, which is not possible in Darts. So that's a bug to fix and a tradeoff for using this approach.

