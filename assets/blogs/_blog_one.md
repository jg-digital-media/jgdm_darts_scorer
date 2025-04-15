# Blog One: 

In this series of blogs, I wanted to do a bit of a deep dive into the development of a Darts Scorer application.

When I first started developing the app, it was January 2025. I came up with the idea of doing an app like this a couple of months prior, before the turn of the year while I was on a walk, and it seemed like a relatively simple idea to begin with. As well as an exciting one.

But as I thought about wireframing the app I began to realise how involving it would be. It's one thing to create a wireframe and to build the user interface via HTML. But it's another thing to actually do the coding and do the mathematics and logics behind the scenes that runs the app. You start to get an understanding of the brief and the little details.

So what I am going to do in this repository is lay out decisions I made in the planning process through this series of blogs. I'll talk about the AI prompts I used as well as why I'm using AI at all. I'll talk about the touches I add with my own code throughout. I am using a combination of Visual Studio Code, Supermaven and Cursor AI to develop the app.

I set out to use CSS/HTML/JavaScript to create the app, but in the early stages, I was not sure what it would take to make the application run as a Darts scorer. Whether it's an API or a database or something else, I wasn't sure.  I decided, though, that I would be dictated by the prompts I use and what is returned and hopefully learn some things along the way. That's the goal: to see where the journey takes me.

With an application like this, it's worth thinking about user flows, which means how you expect users to interact with the application. And that's all I'm really doing at this moment. As well as the wireframes, part of my planning process was writing down some algorithms, a way of thinking about the problem that I'm trying to solve. It's a good way of breaking down the problem into smaller parts and listing them out.

Here's a brief outline of the steps and user flows I planned for the app.

```
So what I am going to do in this repository is lay out decisions I made in the planning process through this series of blogs. I'll talk about the AI prompts I used as well as why I'm using AI at all. I'll talk about the touches I add with my own code throughout. I am using a combination of Visual Studio Code, Supermaven and Cursor AI to develop the app.

I set out to use CSS/HTML/JavaScript to create the app, but in the early stages, I was not sure what it would take to make the application run as a Darts scorer. Whether it's an API or a database or something else, I wasn't sure.  I decided, though, that I would be dictated by the prompts I use and what is returned and hopefully learn some things along the way. That's the goal: to see where the journey takes me.

With an application like this, it's worth thinking about user flows, which means how you expect users to interact with the application. And that's all I'm really doing at this moment. As well as the wireframes, part of my planning process was writing down some algorithms, a way of thinking about the problem that I'm trying to solve. It's a good way of breaking down the problem into smaller parts and listing them out.

Here's a brief outline of the steps and user flows I planned for the app.

+ User presented with a representation of the Oche via an image

  + Below this is a button with the text "Game On"

  + The user will click or press this button to go to the game screen

+ On the game screen is

  + An element that contains the number 501 - the starting score in any Darts match

  + A text box where users can enter a maximum number of 180 for a player score -

    + Each player starts with 501 points

    + A player can choose from a series of buttons representing the value of a throw (1-20) or a missed throw (0)

    + For Double and Triple Scores, a player can check either "Double Score" or "Triple Score" checkboxes to double or triple the score value of a button press.

    + If Double or Triple Score checkboxes are checked, the value of the buttons will change in realtime to reflect the new score value.

    + Pressing The score value submits that score - each entry representing the sum of 1 dart throws until 3 Darts are thrown. Remember it is 3 darts for one visit to the Oche.


+ Need to keep track of the points scored by the player with each entry and keep track of remaining points available after each entry.

+ After player gets to 0 points, the game is over. Players can open the "throw history" section to see the score history Modal - or restart the game at any time.

```

That's a brief but involving outline of the steps and user flows I've planned for the app. You can probably imagine the variables at play here and things that are going to have to overlap and interact with each other.

There is one other thing I had planned but forgot to include in my algorithmic thinking.

We want the app to be able to predict the out scores required to finish a game and to show us the "outs" and point combinations available for the player (e.g T20 T20 D20) - In Darts, players must finish on a double dart score to get to 0 points.

So, I'm going to see if I can use AI to predict the "outs" and point combinations available for the player. Although, it might just be that I need to connect the app to an API in order to do this.

```

+ should predict "outs" and point combinations available for the player (e.g T20 T20 D20) - Players must finish on a double dart to get to 0 points.

```

During the process of wireframing, you're making decisions on the fly about your layout and by extension, what you're app is going to do. I spent some time deciding whether "throws" of a dart would be represented by a text input or a press of a button.

Ultimately, I decided to use buttons because I wanted to utilise as much user interaction as possible. So the press of score buttons (1 to 20) would represent a throw, or 0 would represent a missed throw.

The first steps are straightforward. Having finished the wireframing, I then spent time building the user interface with HTML and CSS.

My algorithmic language spoke of an initial screen. which is where the idea of a "Game on" button comes in.

```html

<a href="game.php" class="button" id="btn---game--on">Game On</a>

```

I've written the algorithm plan, I've drawn the wireframes, and I've built the user interface. [including the id's and classes]. I've connected the script and stylesheet. The only thing I haven't done yet is to style the whole of the app.

Maybe this is the wrong thing to do, but my preference for an app I'm developing is to get the functionality working first before I work on the visual look.

There's a lot to do yet and about 6 blogs of development to get through. Without further ado, we get started.