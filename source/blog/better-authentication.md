---
title: "Better Authentication"
date: 2010-12-11
tags: [authentication]
author: "Dave Rapin"
published: true
---

Since my last post on authentication and single sign-on I came across an incredibly clever little tool called PasswordMaker.

What makes it so clever is that it changes practically nothing from the normal flow of entering a password and stores nothing locally (so it doesn't matter if you change browser or computer). You type the same password for everything and it instead submits a unique and incredibly strong password for every site. This is done by creating a one-way hash. One-way hashes is also how we encrypt passwords on the backend of websites before storing them in the database. So basically you're original password is getting hashed twice for most websites.

How it works:

You install the PasswordMaker extension for your browser of choice.
You go to sign up for a new website service (or change your password for an existing one).
You type your typical password, let's say it's "b@ng3r5". You should still pick something fairly strong (mix of characters, numbers, symbols, etc.), but even if you didn't you're much better off than most.
When you submit the sign up form, the PasswordMaker extension creates a hash using the data you're entering combined with the domain of the website. In other words it's creating an encrypted version of your real password. This encrypted password is what's submitted to the website. It may end up being something like "4#ae2!9ljh2vk*8c$21h7wh%s$lz" for example.


You come back to the site another day and are asked to login
You type in the same typical password, "b@ng3r5" in this case.
When you submit the login form, the PasswordMaker performs the hashing operation again, using the same password and the same domain. This means it will come up with exactly the same hash as it did when you signed up.
The site's server see your encrypted password, I.e. "4#ae2!9ljh2vk*8c$21h7wh%s$lz" which it then submits to it's own authentication process (usually it also performs a one-way hash again using your password and a random string it generated when you initially signed up and compares that against the encrypted value it has stored against your account).


Benefits:

Some sites still store passwords in clear-text. You're way safer if one of these sites is compromised since you're password was already encrypted before it was sent to the site.
Using the same password for everything in way safer now than it was without this encryption... it's probably still a good idea to rotate passwords, but not as big of a deal as it was without the pre-encryption.
We're practically faking single sign-on.


I still think there may be some potential problems that you need to keep in mind.

If a clever hacker compromises a site that's storing passwords in clear-text they could still potentially crack your password since it will stick out like a sore thumb within the rest of the cleartext passwords. Said hacker will know that yours is the only one that's been encrypted and he may guess that it was encrypted using PasswordMaker. He would then know that your salt (part of the string being used to generate the hash) is the domain of the site and he can use that information to run dictionary attacks with the domain until he gets the same encrypted result.

Obviously this is pretty unlikely and not worth the effort since there's so many other passwords requiring no effort, but still using a strong password to begin with will make this practically impossible. The only way I see this happening is if someone is specifically targeting you and the added effort is really worth it... So maybe 1 chance in a google?



I highly recommend you checkout this tool. It has multiple extensions / plugins for every major browser.

<http://passwordmaker.org/>
