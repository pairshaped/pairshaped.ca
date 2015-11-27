---
title: "Give tables some love and sweat the details"
date: 2015-10-15
tags: [programming, User Experience, reactjs]
author: "Dayton Pereira"
---

We work with a lot of tabular data. In fact, it’s safe to say that every project or product we develop requires presenting data in some kind of tabular format. Player statistics, real-time scores, team statistics, real-time sensor data - the list goes on. While tables are generally simple displays of rows and columns our world of unpredictable screen sizes throws a wrench into the best laid plans.

Here's the basic problem:

> A table with columns that just fit on a desktop screen (~1100px wide) does not scale down well to accommodate a mobile screen.

And here’s the humdrum solution:

>Make the overflowing table scroll horizontally.

That is usually where the story ends. Simply put, scrolling a table horizontally on a phone is a painful user experience. I cringe at the thought, and yet we have been guilty of this lazy approach time and time again. Tables get no lovin’.

In a recent project where we were tasked with presenting statistical data for a hockey league we finally tackled the problem of presenting tabular data effectively with more than just multiple screen sizes to consider.

We had the following situation:

* The data source was an external JSON feed.
* The tables could be of any size, few columns or many columns.
* The tables could have so many rows of data that pagination was needed.
* The data source was continuously updated with new live data.

We looked around for various approaches to solve these problems. While there are many excellent solutions, the one that really stood out was [Tablesaw](https://github.com/filamentgroup/tablesaw) from Filament Group. The plugin solved the problem of responsive tables with several solutions , our favorite being to hide columns as the screen size reduced and made available via an options menu. Awesome. Problem solved... except using jQuery was not going to work for us.

We use [React](https://facebook.github.io/react/), so this Tablesaw library, as awesome as it was, couldn’t be used right out of the box. Instead we had to write our own version with the features we needed. Here’s the project on Github if you’d like to take a look, fork, contribute or customize it to suit your own needs. For more on why we use React, read this series on [Our Stack](/about.html).

Now that we were on our merry way writing a custom table view component in React, these are the features it needed to support:

* Sort columns in ascending or descending order;
* Specify columns to hide at specific breakpoints;
* Toggle the visibility of any column;
* Set the order of columns regardless of how the data was ingested; and,
* Perform basic calculations and formatting on ingested data.

##Table usability

There are some pretty obvious ways to make a user friendly  table possible:  zebra stripes to break up rows of data; table headers; padding; spacing etc. However the tables functions we had in mind included sorting, toggling visibility and pagination among others, and we needed to ensure excellent usability for each of these functions. 

###Column Sorting

Not all columns in a table need sorting.  To identify the sortable columns we used an arrow icon.  Currently loving the Material UI icon fonts from Zavoloklom. A really comprehensive collection of little font icons. Highlighting sorted columns was another additional detail that improved the usability.

![Column Sorting](/images/blogs/table-love/tables-love-sorting.jpg)

###Showing and Hiding Columns

To put some context around why this is necessary, let’s take a real life example like a table displaying player statistics. It has several columns, about 20 or so, like the ones you see below.

One might assume that the order of priority of these columns to be left to right, with the leftmost column having the highest priority.  If that were true, the decision to hide columns could be made generic, where the rightmost or lowest priority columns would hide if they didn’t fit the screen. However, this is not the case in our example, the order, is actually based on subjective requirements.

We developed a method to display exactly the columns needed, by order and breakpoint. With this we are able to show the most relevant columns of data for specific screen sizes.

With fine control over displaying specific columns taken care of, the option to reveal hidden columns was the next task. For this, we went back to what we liked about the Tablesaw library - an options menu to reveal hidden columns. We implemented this as a little show/hide button at the top of the table that would open a modal dialog box with the available column  options as toggles.

![Showing and Hiding Columns](/images/blogs/table-love/tables-love-filters.gif)

If the user chose to turn on more columns than would fit the screen, the table would scroll horizontally. We felt this to be an acceptable user experience because the hard work of showing the most relevant content in the initial view was already done.

###Optimizing the data

While this particular task does wander into the realm of data presentation, it also  belongs in the category of usability. The date format is a great example of this.

There are various date formats, some longer than others. We needed a meaningful format that did not diminish the ability to understand the data. In this case, a season schedule table,  the format we ended up choosing was DD MMM, or 23 Jan, we didn’t need to specify the year because it was already presented in the page title. We took this approach with caution, it doesn’t always pay to be minimalist. If our data set spanned multiple years the lack of years in this date format would be a source of frustration.

There are other examples of worked data  in the tables we created.  The purpose of these adjustments was to provide all the information necessary while occupying the fewest number of columns. Another example was a links column, that displayed a tickets link with an accompanying ticket icon. On desktop we displayed both, on mobile we only show the icon. 

###Pagination

While it’s not applicable to all tabular data, there are instances where pagination is necessary. One such instance is when a data set is so large that the JSON payload itself is over a couple of megs, that’s a lot of data. So loading the data in chunks is pretty much the only option. And while that may be true, how we present this loaded data is within our control, and with React we can do all sorts of fun things. 

We love the design pattern of continuously loaded content, either infinite scroll or user initiated. Applying this approach to paged  data seemed like a natural extension. However, there were some gotchas that we needed to consider:

* Deep linking into other pages besides the first;
* Navigating from within deep linked pages; and,
* Sorting columns within paged tables.

###Deep Linking

Our use of React for these data tables allows us the ability to update the table view without a page refresh. With this approach we also need to update the URL to reflect what page of data the user is on. Now consider that this page, (second, third or nth page) is shared via email or social media. The URL would look like this /longstats/n. For the recipient of the deep link, the table would display the nth page of data just like the URL suggests with a Load Previous button at the top of the table and a Load More button at the bottom - making for a more optimized user experience.


###Sorting Columns on paged tables

If the user is on the 3rd page and chooses to sort the table by a different column, what should happen?

* Table should sort on the data it has in memory.
* Table should sort on the entire data set but remain on the 3rd page.
* Table should sort on the entire data set but jump to the 1st page.

To answer this question we had to understand what the user was trying to do. In all likelihood it would be to find the highest or lowest ranked item sorted by that column.

That rules out option 1 **(it was never really an option anyway)**.

Option 2 appears to be a decent solution that maintains the context of the current page the user is on. but it doesn’t solve the basic need, i.e., who’s on top? Instead it unexpectedly puts the user in the middle.

That leaves option 3, and also happens to be the least complicated to implement.

##TL;DR

While I recognize that Table Usability isn’t exactly the most exciting topic, it’s one that is often overlooked even by the most experienced teams. If you were too busy (lazy) to read the whole thing, here’s the takeaways:

* Be uncompromising in the your pursuit to present data in the best possible way
* The data availability cannot be diminished because of the screen size
* The requirements of each table’s data can be different across one data sets, make the effort to understand what is being presented
* Use the strategies outline here to give tables the love they deserve



