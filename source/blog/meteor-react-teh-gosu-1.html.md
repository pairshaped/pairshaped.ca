---
title: "Let's Build Something With Meteor and React - Part 1"
date: 2015-10-15
categories: [programming, javascript, meteor, reactjs, coffeescript]
---

This is part one of a series of posts that go through creating a new web app with Meteor and React.

## Prerequisites

1. [Meteor](https://www.meteor.com/install)
2. [Nodejs](https://nodejs.org/en/)
3. OSX, Linux, or Cygwin.

## Why Metor?

We're always on the lookout for new methodologies in the web stack, and Meteor is one we've been keeping an eye on for a while.
Here's what we like about it:

* Nodejs on the server performs significantly better than some other dynamic stacks like Ruby on Rails.
* Websockets consume significantly less bandwidth than REST since there is no need to send HTTP headers every time.
* No need to constantly customize APIs (also something GraphQL would solve).
* Responding to data changes is straightforward via pub / sub. With React this is even easier.
* Updating data is straightforward via Meteor methods.

## Why React

We love React for it's simplicity and always use it for our web UIs.
Declaritive UI programming is where it's at.

Code next to Markup was a bad idea right?
Not really.
As it turns out, having your UI code in your views when they are small (components) makes a ton of sense.

Don't take our word for it though.
[Give it a whirl for yourself](https://facebook.github.io/react/docs/getting-started.html)
There's a decent chance you'll agree.

## The Project Requirements

We're going to step through building a Hot or Not style of application tailored to sports plays.

The three main components are:

#### Submit a Play

User should be able to submit a new play. The play will have a title, description, and Youtube URL.

#### Vote on Plays

User should be able to see two plays and vote for one of them.

Once user has voted for a play, they will be replaced with two new plays that they can then vote on.

There is no limit to the number of plays the user can vote on, however the user may not vote on the same play more than once.

#### Leaderboard

User should see a list of top ten plays with the most votes, ordered by number of votes descending.
This list will update in real time as votes are added.

## Getting Started

Create our project:

    meteor create tehgosu

This creates a basic Meteor application that we can run right away:

    cd tehgosu
    meteor

Then visit [http://localhost:3000](http://localhost:3000)

### React and CoffeeScript

Before we can start working on any views, we need to install React since that's what we'll be using instead of Blaze.

Adding libraries to Meteor is super simple:

    meteor add react

We personally prefer CoffeeScript over JavaScript due to the readability of significant whitespace.
There's a popular opinion at the moment that CoffeeScript is obsolete now that we have ES6 and Babel.
I disagree because I think browsers will eventually support [WebAssembly](https://brendaneich.com/2015/06/from-asm-js-to-webassembly/).
Once they do we'll see even more JavaScript alternatives.

    meteor add coffeescript

Now we'll need to do some standard tweaks in order to have React and CoffeeScript play nice without excessive amounts of syntax.
First we'll create a lib folder and add a component.coffee library to it.

    mkdir lib
    touch lib/component.coffee

In component.coffee we're going to add a function that we'll be calling instead of React.createClass

    @Component =
      create: (spec) ->
        React.createFactory React.createClass(spec)

Notice the __@__ symbol used to declare our Component object?
CoffeeScript places our code in a closure so as not to pollute the global namespace.
In Meteor we need to attach our object to the global namespace using __this__ (@ = this.).
This is a little counter intuitive compared to CommonJS style requires, and maybe some day we'll have a better alternative.

For now __@Component__ makes our object accessible throughout the application.

Now we can create a React component in CoffeeScript like so:

    TestComponent = Component.create
      render: ->
        div className: 'test-component',
          'Test Component'

The equivalent in JSX without our library would look like this:

    TestComponent = React.createClass({
      render: function() {
        return (
          <div class="test-component">
            Test Component
          </div>
        );
      }
    });

### Project Structure

Now is as good a time as any to setup our basic structure for the application.
Meteor has a convention where any code that's placed within a directory named __client__ will only run on the client.
And naturally code in a directory named __server__ will only run on the server.

We want the following directories under the root of the project:

* lib: Common library functions. These are loaded before the other directories.
* client: Code that should only be run on the client (browser).
* server: Code that should only be run on the server.
* public: Only served to the public. We'll put our robots.txt and images in here.

    mkdir lib client server public

Let's remove the initial files that meteor created. We don't need them.

    rm tehgosu.*

### Time to Write Some Code

Create a new HTML file in the client directory.
Since we're using React for our views, this will be the only HTML file we need.

    vi client/index.html

In this HTML file we just need a div element which react will replace once it's loaded.

    <head>
      <title>Teh Gosu</title>
    </head>

    <body>
      <div id="app">Loading...</div>
    </body>

Now we need to attach our React views.
Create a new CoffeeScript file in the client directory.

    vi client/index.coffee

In this CoffeeScript file we load up our React views and attache them to the DOM.

    Meteor.startup ->
      React.render(
        App({}),
        document.getElementById 'app'
      )

We're referencing an object called __App__ within the Render method, so we need to build that.
Create a new CoffeeScript file in the client directory for it.

    vi client/app.coffee

Our new app.coffee is going to hold our top level React component code.

    { h1 } = React.DOM

    @App = Component.create
      render: ->
        h1 {},
          'Teh Gosu!'

We're keeping it simple. All we're doing is rendering an h1 tag with the text __Teh Gosu!__.
Notice the __@__ symbol prefix to the App declaration.
Again this is because of CoffeeScript's automatic closure and the fact that Meteor needs the object to be on __this__ to be accessible outside the file.

At this point we should have a working React + Meteor application. Run the server with:

    meteor

Then visit [http://localhost:3000](http://localhost:3000)

You should see __Teh Gosu!__.

Your directory structure should be:

    client
      app.coffee
      index.coffee
      index.html
    lib
      component.coffee
    server
    public

This concludes part one of our Meteor + React series.
In part two we'll add some data and the match view.
