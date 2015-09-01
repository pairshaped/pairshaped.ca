---
layout: blog
title: "Using CoffeeScript with ReactJS"
date: 2015-02-03 9:23
categories: [programming, javascript, coffeescript, reactjs]
---

Lately I've been using ReactJS a lot to build rich user experiences on the web, and it's been absolutely great. A huge improvement over AngularJS in my humble opinion.</p>

The only ugly spot with ReactJS is JSX. I can see the appeal of using declarative HTML in templates for readability, but having switched to HAML (and Slim and Jade) long ago, writing HTML feels like a step backwards.

Luckily, using CoffeScript for my ReactJS components and eschewing JSX entirely, we can accomplish a syntax that's very similar to HAML / Slim / Jade. If you're not a fan of CofeeScript, HAML variants, or significant whitespace, there's little chance I'll be able to convince you otherwise. However if you are a fan of any of those, then it's worth checking out.

This is the HTML we'll be converting.

```html
<div class="jumbotron">
  <div class="container">
    <h1>Hello, world!</h1>
    <p>
      <a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a>
    </p>
  </div>
</div>
```


Converting it to Javascript using ReactJS looks like this. It's pretty verbose.

```javascript
var Jumbotron = React.createClass({
  render: function() {
    return (
      React.createElement('div', {className: "jumbotron"},
        React.createElement('div', {className: "container"},
          React.createElement('h1', {},
            React.createElement('p', {}, 
              React.createElement('a', { className: "btn btn-primary btn-lg", href: "#", role: "button" }, "Learn more »")
            )
          )
        )
      )
    );
  }
});
```


Here's the JSX version. Quite an improvement I think, but it mixes HTML and Javascript together and that seems a bit messy and most likely throws off your editor's syntax highlighting.

```javascript
var Jumbotron = React.createClass({
  render: function() {
    return (
      <div className="jumbotron">
        <div className="container">
          <h1>Hello, world!</h1>
          <p>
            <a className="btn btn-primary btn-lg" href="#" role="button">Learn more »</a>
          </p>
        </div>
      </div>
    );
  }
});
```


Finally, here's the CoffeeScript version of the component. At least as succinct as the JSX version, and no mixed syntax or editor issues.

```coffeescript
{ div, h1, p, a } = React.DOM

Jumbotron = React.createClass
  render: ->
    div className: "jumbotron",
      div className: "container",
        h1 {}, "Hello World"
          p {},
            a
              className: "btn btn-primary btn-lg"
              href: "#"
              role: "button"
              "Learn more »"
```


For the sake of completeness, here's a CJSX version (CoffeeScript + JSX). Even more succinct, however again we're mixing HTML with our CoffeeScript, making it a bit messy and giving you editor issues.

```coffeescript
Jumbotron = React.createClass
  render: ->
    <div className="jumbotron">
      <div className="container">
        <h1>Hello, world!</h1>
        <p>
          <a className="btn btn-primary btn-lg" href="#" role="button">Learn more »</a>
        </p>
      </div>
    </div>
```


If you do opt for the straight CoffeeScript route, then there are a few gotchas to keep in mind. If you've been using CoffeeScript for a while, then they're pretty obvious, but can cause grief for newcomers.

#### Gotcha 1: Optional Curly Braces
CoffeeScript allows you to omit Curly braces on hashes. This can cause readability issues for the next person who comes along to read your code.

```coffeescript
{ div, h1, p, a } = React.DOM

Jumbotron = React.createClass
  render: ->
    div { className: "jumbotron" },
      div { className: "container" },
        h1 {}, "Hello World"
          p {},
            a {
              className: "btn btn-primary btn-lg"
              href: "#"
              role: "button"
              "Learn more »" }
```

#### Gotcha 2: Commas and New lines
CoffeeScript allows you to omit commas between hash assignments and opt instead for indented new lines. Again this can cause readability issues, especially when combined with Gotcha #1 above.

```coffeescript
{ div, h1, p, a } = React.DOM

Jumbotron = React.createClass
  render: ->
    div
      className: "jumbotron",
      div
        className: "container",
        h1
          {}
          "Hello World"
          p
            {}
            a
              className: "btn btn-primary btn-lg"
              href: "#"
              role: "button"
              "Learn more »"
```

Ultimately if you are going to use CoffeeScript for your ReactJS components instead of JSX then it's probably a good idea to agree upon some conventions with your team on when braces and commas are used. My preference has been to use braces for single line hash assignments, and I'm considering enforcing braces for multiple line attribute assignments w/ React to better separate them from the next element.
