---
title: "NBC Primetime Campanion App"
date: 2014-10-20
tags: [host, angularjs, ruby on rails]
author: "Dayton Pereira"
---

Pair Shaped has significant expertise in creating second screen experiences related to sports broadcasting. We were approached by NBC Sports to create a “Primetime Companion” app for their 2014 Sochi Olympics coverage. The goal was to provide NBC’s Primetime Olympics audience with a deeper, interactive “second screen” experience with content delivered via smartphone or tablet in a way that would coincide with what was happening on TV. This simultaneous, complementary mobile experience is what we call “Companion” - the app is meant to be an interactive, ongoing “live” content experience that supplements the sports broadcast.

![Sochi Devices](/images/blogs/nbc/sochi-devices.png)

Our firm has previous experience working with NBC and CTV in creating and implementing a similar Companion app product for the 2012 London Olympics. That first iteration of the Primetime Companion app proved to be a huge success that drove a significant volume of traffic to the Olympics Apps overall. For Sochi we wanted to repeat the success with an updated user experience that was more streamlined and a user interface that felt modern and sophisticated.

In 2012, the Companion had more of a card-based user experience: one card at a time would show up on the screen, as new events appeared on TV a new card would push the previous card out of the way. There was a high frequency of content being created, and it became a somewhat distracting user experience because users did not have control over when to see new content or how much content to view at a time.

For 2014’s Sochi Primetime Companion, we solved this problem by recommending a significant improvement in the user experience. We created a new feature called the “Timeline” feed, based on vertically stacked cards in chronological order. Instead of the Timeline automatically replacing cards as new content is introduced, the 2014 Timeline feature allows the user to be notified when new content is pushed to the feed, and gives users the option to decide when to access the new content. The 2014 version of the Timeline avoids unwanted interruptions, enables more user control over when to access content, and makes it easy to go back and view content from earlier in the TV broadcast / Timeline.

##Anatomy of the Timeline

![Showing and Hiding Columns](/images/blogs/nbc/timeline-stacked.png)

The Timeline was the key feature of the application, serving as a kind of “central dashboard” for the app and presenting a variety of card types which were pushed to the user in real time as decided by a producer using the Composer (the Primetime Companion’s customized Content Management System, described later in this article). Producers at NBC Sports prepared over 3,000 different snippets of content that they used to feed into the timeline during the Primetime Olympics broadcast.

We needed to make a decision for how content would be pushed into the Timeline whenever new things happened.

For example, if you’re watching Primetime Olympics coverage, and there is a feature on the U.S. Hockey Team, then a video clip, hockey facts, player bios, past results, and previous hockey medalists will appear on the Timeline to complement the coverage.

We knew that we wanted to give users the ability to control when or whether to see new content on the Timeline - we didn’t want to interrupt anyone’s ability to continue reading the content that they were already engaged with. So we created an alert that displayed at the top of the Timeline that incremented in real time as new cards were pushed in, and required user initiation before the content would load. Also, at the very bottom of the Timeline, we displayed a button to load content that had occurred earlier, enabling users to go back to view content that they might not have previously seen.

##Cards for Multiple Interactive Content Types

![Cards](/images/blogs/nbc/cards.png)

The Timeline consisted of six different card types: poll, trivia, fast fact, athlete bio, photo gallery and video. We also had Twitter and Instagram cards prepared to infuse a level of candid content captured at the Games by athletes and fans directly into the app.

Some of the cards were interactive and required audience feedback (such as polls and trivia). Once a selection was made within an interactive card, the results would refresh in real time.

##Customized Content Management

In order for the NBC Sports producers to create the content for the Primetime Companion app and determine when each video snippet or piece of content needed to be displayed within the Timeline, they needed a content management system (CMS).
The challenge for this project was that there was no off-the-shelf CMS on the market that could handle the association of pushing thousands of small pieces of content to a feed at specific times that are granular enough (down to the second) to meet the needs of real time Olympic Sports viewers. So we built a unique and precise CMS for the Companion app, which we’re calling the “Composer.”

When producing a live sporting event, speed is critical. Everything we can do to make it more efficient for producers to publish content will also make for a better real-time end user experience. To that end, we created the Composer as a “Single Page Application” that consists of one main screen with three sections. Producers can use the Composer to prepare content for publication as quickly as possible, without ever leaving the main page.

![Composer](/images/blogs/nbc/composer-main.png)

The right column is the “Library,” which offers access to all of the Primetime Companion cards and gives producers the tools to create new cards, edit existing cards, and search for cards. Producers can also preview the cards to finalize them before publication, and then add the cards to the “Drafts” and “Timeline” columns.

The “Drafts” column is the staging area where producers can short-list content when they aren’t sure of the exact time it should be published. This makes it easy to collect content related to a particular athlete (Shaun White) or a particular event (Ice Dancing) which may be needed, but without having to immediately commit to publishing the content to the Timeline.

The left column is the “Timeline.” The Timeline is the dashboard of the app and reflects what is seen by users. It is made up of cards that have been assigned to a specific time for display within the Primetime Companion. Cards may be assigned to multiple times within the Timeline. For example, it is very likely that a more generic poll or a gallery may run multiple times in the same night or across multiple days. Producers may also want to continue to offer content that is related to more popular sports or athletes. The Composer gives producers the flexibility to run content when and where it is likely to engage the most viewers, down to the second.

![Shaun White](/images/blogs/nbc/composer-shaun-white.png)

##Conclusion

Besides the fact that Canada won double golds for men's and women's Hockey and Curling, the Olympic Companion App was another memorable experience that we walked away from learning a few valuable things.

* Our updated design for the Companion App with the addition of the Timeline did prove to be a much smoother and friendly experience than its predecessor.
* We could have implemented more sharing features within each of the cards themselves if there was a web version that users could link to when seen in their social timelines
* We could have improved performance of the app’s Timeline with stale caching technique. Every time we flushed the Timeline, Rails would be inundated with a significant number of requests to generate the new cache. We could solve this by retaining the stale version until the new cache is generated, which only takes a few hundred milliseconds at most.
* The Rails stack ended up being a bottleneck when it came to handling writes, and added significant CPU strain. Node, Clojure or Go to handle the API write operations might be better choices.

We recognized that Composer, the CMS tool we built to manage this feed of various content types has more applications than this one product experience. We see that almost all content driven sites use so many types of media and yet very few consolidated them into a single stream of content like our Companion App. What if content could be ingested from various sources, and then managed in a central location using the Composer as the interface to do put it altogether in a presentable and meaningful way. New ideas brewing.

