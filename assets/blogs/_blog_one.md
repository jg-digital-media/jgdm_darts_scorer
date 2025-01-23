# Blog One: 

In this series of blogs, I wanted to do a bit of a deepdive on to the development of a Darts Scorer application.

As I write this it's January 2025, I came up with the idea of doing an app like this a couple of months ago while on a walk and it seemed like a relatively simple idea to begin with. But as I thought about wireframing the app I began to realise how involving it would be. It's one thing to create a wireframe, and to build the user interface via HTML. But it's another thing to actually do the coding and do the mathematics and logics behind the scenes that runs app. You start to get an understanding of the brief and the little details.

So what I am going to do in this repository is talk about decisions made in the planning process. I'll discuss a lot of the AI prompts I used; Why I'm using AI at all. And talk about the touches I add with my own code throughout. I will be using a combination of Visual Studio Code, Supermaven and Cursor AI to develop the app.

I intend to use CSS/HTML/JavaScript to create the app, but at this stage I'm not sure what it will make the application run as a Darts scorer. Whether it's an API or a database or something else I'm not sure.

With an application like this it's worth thinking about user flows - how you expect users to interact with the application. And that's all I'm really doing at this moment. As well as the wireframes, part of my planning process was writing down some algorithms; a way of thinking about the problem that I'm trying to solve. It's a good way of breaking down the problem into smaller parts and listing them out.

Here's a brief outline of the steps and user flows I've planned for the app.

```
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

That's a brief but involving outline of the steps and user flows I've planned for the app. You can probably imagine the variables at play here and things that are going to have to overlap and interact with each other. Some behind the scenes

There is one other thing I had planned but forgot to include in my algorithmic thinking.

We want the app to be able to predict of show us the "outs" and point combinations available for the player (e.g T20 T20 D20) - Players must finish on a double dart score to get to 0 points.

So I'm going to see if I can use AI (if I can) to predict the "outs" and point combinations available for the player. Although it might just be that I need to connect the app to an API in order to do this.

```

+ should predict "outs" and point combinations available for the player (e.g T20 T20 D20) - Players must finish on a double dart to get to 0 points.

```

During the process of wireframing you're making decisions on the fly about your layout and by extension, what you're app is going to do. I spent some time decising whether "throws" of a dart would be represented by a text input or a press of a button. Ultimately, I decided to use buttons because I wanted to utalise as much user interactiion as possible. So the press of score buttons, (1 to 20), would represent a throw or 0 would represent a missed throw.

The first steps are straightforward. Having finished the wireframing, I then spend time building the user interface with HTML and CSS.

My algorithmic language spoke of an initial screen.  

`Game on` button

I've written the algorithm plan, I've drawn the wireframes, I've built the user interface. [including the id's and classes]. I've connected the script and stylesheet. The only thing I haven't done yet is styling the whole of the app.

Maybe this is the wrong thing to do but my preference is to get the functionality working first before I finish the visual look.

I've got a lot of work to do on this. But I'm excited to get started.