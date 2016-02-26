---
title: "TDD, BDD, and False Assumptions"
date: 2011-01-18
tags: [automated testing, process]
author: "Dave Rapin"
published: true
---

After watching another *Test First* presentation related to the Ruby world I figured out what it is that bothers me the most about the *TDD Religion*.

It seems that everytime a TDD evangelist speaks about non-test driven / traditional development they paint a completely exaggerated and unrealistic picture of what it means to not use TDD. It usually goes something like this: "You spend a year creating a specification, and then another year coding until you've built this monolithic application then you manually go through all of the functionality you built for another year fixing bugs etc.". Seriously? I know we've all got horror tales, but come on... who in their right mind has ever worked like this even before all of the Test-first buzz back in 2000? This is a fallacy, and even coding in Fortran sounds better than being involved in this fantasy process.

I don't actually have a problem with TDD the practice, or BDD as a practice, or even EDD (experiment) the practice. What I do have an issue with are the religious zealots that think it solves all of their problems and will criticize anyone who doesn't share the same beliefs. Really, it doesn't.

Here's how Joe the Programmer who's never bothered with TDD *actually* performs his work on a daily basis. He thinks about the big picture. Breaks it up into small accessible problems (basic problem solving). Dives right in and starts building out a solution to tackle one of these small problems. Then he *manually tests* his small solution to make sure it works and *provokes more thought* on how it fits into the big picture. Once he's happy with it, he tackles the next small problem. All the time he's constantly reevaluating the big picture, identifying new problems, speaking with the client, etc.

Sounds a lot more reasonable than "code for a year" doesn't it? It almost sounds like it would work really well in most scenarios. It doesn't help sell the latest tickets to your speech on TDD though, because honestly, how much would TDD actually improve his process?

Please, before you tell everyone how amazing the latest test / behaviour / experiment driven development methodology or tool is, watch this presentation from Rich Hickey on *Hammock-Driven Development* first and let it sink in. <http://clojure.blip.tv/file/4457042/>
