---
title: "Let's Build Something With Meteor and React - Part 1"
date: 2015-10-15 15:02
categories: [programming, javascript, meteor, reactjs]
---

This is part one of a series of posts that go through creating a new web app with Meteor and React.

## Prerequisites

1. Meteor https://www.meteor.com/install
2. Nodejs https://nodejs.org/en/

## Why Metor?

We're always on the lookout for new methodologies in the web stack, and Meteor is one we've been keeping an eye on for a while.
Here's what we like about it:

* Nodejs on the server performs significantly better than Ruby / Rails.
* Websockets consume significantly less bandwidth than REST since there's no need to HTTP headers.
* No need to constantly customize APIs (also something GraphQL solves).
* Responding to data changes is straightforward via pub / sub. With React this is even easier.
* Updating data is also straightforward via Meteor methods.

## Why React

We love React for it's simplicity and always use it for our web UIs.
Declaritive UI programming is where it's at.

Code next to Markup was a bad idea right?
Not really.
As it turns out, having UI code in your views when your views are small (components) makes a ton of sense.

Don't take our word for it though, give it a whirl for yourself.
There's a decent chance you'll agree.
https://facebook.github.io/react/docs/getting-started.html

## The Project Requirements

We're going to take you through building a Hot or Not style application tailored to sports and esports plays.

The three main components are:

### Submit a Play

User should be able to submit a new play. The play will have a title, description, and Youtube URL.

### Vote on Plays

User should be able to see two plays and vote for one of them.

Once user has voted for a play, they will be replaced with two new plays that they can then vote on.

There is no limit to the number of plays the user can vote on, however the user may not vote on the same play more than once.

### Leaderboard

User should see a list of top ten plays with the most votes, ordered by number of votes descending.
This list will update in real time as votes are added.

## Getting Started

Create our project:

    meteor create tehgosu

This creates a basic Meteor application that we can run right away:

    cd tehgosu
    meteor

Then visit http://localhost:3000

### React and CoffeeScript

Before we can start working on any views, we need to install React since that's what we'll be using instead of Blaze.

Adding libraries to Meteor is super simple:

    meteor add react

We personally prefer CoffeeScript over JavaScript due to the readability of significant whitespace.
There's a popular opinion at the moment that CoffeeScript is obsolete now that we have ES6 and Babel.
I disagree because I think browsers will eventually support WebAssembly.
Once they do we'll see even more JavaScript alternatives.
https://en.wikipedia.org/wiki/WebAssembly

    meteor add coffeescript

Now we'll need to do some standard tweaks in order to have React and CoffeeScript play nice without excessive amounts of syntax.
First we'll create a lib folder and add a component.coffee library to it.

    mkdir lib
    touch lib/component.coffee

In component.coffee we're going to add a function that we'll be calling instead of React.createClass

    @Component =
      create: (spec) ->
        React.createFactory React.createClass(spec)

Notice the @ symbol used to declare our Component object?
CoffeeScript places our code in a clojure so as not to pollute the global namespace.
In Meteor we need to attach our object to the global namespace using this (@ = this.).
This is a little counter intuitive compared to CommonJS style requires, and maybe some day we'll have a better alternative.

For now @Component makes our object accessible throughout the application.

This Component object will allow us to create a React component in CoffeeScript like so:

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


