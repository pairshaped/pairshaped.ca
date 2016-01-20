---
title: "Why BEM?"
date: 2016-1-20
tags: [javascript, coffeescript, CSS, SASS]
author: "Forrest Phillips"
published: true
---

BEM (Block Element Modifier) is a naming convention created by [Yandex](https://en.bem.info/method/) that we have adopted to help organize our CSS in a meaningful way.

## Problems we've solved using BEM

* The DOM is an indiscernible mess.
* File folders are disorganized making it difficult to find what you're looking for.
* CSS is an unmaintainable nightmare of spiderwebs.

## The DOM is an indiscernible mess

BEM can be a bit verbose, something to remember is that the class names do not necessarily need to reflect structure of the DOM. If you get caught, it's really easy to make a bit of a mess. However, even a BEM mess is still better than meaningless pile of unrelated class names. This will make your DOM ugly and make it difficult to reuse components. It also means that all of the styles for the header, navigation and links would be contained in the **header.coffee** and  **header.sass** files.

```coffeescript
div { className: 'header' },
  div { className: 'header__logo header__logo--bigger'}
    div { className: 'header__navigation' },
      div { className: 'header__navigation' },
        div { className: 'header__navigation-item' },
          a
            className: 'header__navigation-item-link'
            href: "#"
            target: '_blank'
```

One of our developers went so far as to code a library to help enforce the BEM naming conventions when writing javascript. Simply by using the [library](https://www.npmjs.com/package/bemmer-node) it makes class naming much simpler and more consistent.

In the following example you can see our preferred approach to the naming of DOM elements. You can see that the menu system rests inside the header but it's named in a way that makes it independent from the header. That also goes for the link inside the navigation, since in this case we don't want it styled any different from other links on the site. All of basic links on our site will use the class name "**default-link**" and share all of the declared styles. The independent blocks are also good indicators of reusable components.

```coffeescript
div { className: 'header' },
  div { className: 'header__logo header__logo--bigger'}
  div { className: 'header__navigation' },
      div { className: 'navigation' },
        div { className: 'navigation__item' },
          a
            className: 'default-link'
            href: "#"
            target: '_blank'
```

## File folders are disorganized and it's difficult to find what you're looking for

By following the BEM naming convention we found it that our file names, CSS and DOM are all more closely related. For example; Here we want to create a header and add a logo to it. So we create a component file, let's say in this case it's coffeescript. We will call the file  **header.coffee** and store it in the components folder.

Then we create a SASS file in the stylesheets -> components folder also called **header.sass**. In this header we also want to include a menu, but we know we'll be reusing the component in other places on the site. So we create two files for it as well, **navigation.coffee** and **navigation.sass** in their appropriate folders.

```
scripts/coffee/main.coffee
scripts/coffee/components/header.coffee
scripts/coffee/components/navigation.coffee

stylesheets/sass/base.sass
stylesheets/sass/components/header.sass
stylesheets/sass/components/navigation.sass
```

We now have a DOM that directly reflects the file structure. This makes our codebase much easier to maintain and reduces the amount of time spent hunting for files. It also helps developers consider how the components they are creating might be reused or extended.


## CSS is an unmaintainable nightmare of spiderwebs

BEM and SASS play very nice together. In our header.sass file we can declare a few things; First off some basic styles for the header layout, logo. The styles for the navigation will go in their own file. SASS supports inline media queries which are just fantastic. When styling with BEM one should readily avoid using the !important tag and nested styles. When BEM is employed correctly, the need for an !important flag can be an indicator that something is wrong.

We also approach our CSS mobile first, so all of our media queries are generally based on the min-width of tablet and desktop breakpoints. It's important to remember to declare the mobile styles first, then your tablet media query, followed by your desktop. Cascading means you don't always need to declare a max-width on your media queries. We even organize all our CSS styles to improve legibility, it seems tedious at first but we have found it be second nature now.

You can find a basic guideline we follow [here](http://codepen.io/ForrestPhillips/pen/oXoOmE?editors=010).

```sass
.header
  position: relative
  width: 100%
  &__logo
    position: absolute
    width: 80px
    height: 80px
    color: red
    @media (min-width: 1024px)
      width: 120px
      height: 120px
    &--bigger
      width: 240px
      height: 240px
```

## Conclusion

Our experience with BEM has been a primarily positive one. For us BEM has been easy to adopt because our company as a whole follows it. BEM is great for encouraging consistency, meaningful naming conventions. It also helps developers directly relate their file structure and CSS to the front end DOM.