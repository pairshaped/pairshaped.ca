---
title: "Authentication and Single Sign On"
date: 2010-11-24
tags: [authentication]
author: "Dave Rapin"
published: true
---

I think the current solutions for single-signon are completely impractical. This includes FB Connect, Google, MS, Yahoo, OpenID, etc. What makes them impractical is they require all sites to participate in a fairly complicated integration and have single points of failure which can bring down your authentication (RPX goes down etc.).

I also happen to think the thick-client solutions (password managers) are far more practical. A password manager can maintain multiple profiles with unique auto-generated passwords so if any of the sites that stores your credentials is compromised (say they aren't encrypting your passwords properly) the problem is contained within the compromised site since every other site uses a different generated password. This is far easier to manage as both consumer and service provider. By using a password manager you only need to remember 1 password, the one used to unlock your password manager.

Now what would be great is if you could combine the thick client password manager concept with a cloud based redundant solution (no single point of failure) and have full integration for auto-filling fields with all major browsers.

So let's say you have a master account with a cloud provider like Google or Amazon etc. They provide you with a semi-thick client solution like a browser addon which maintains a connection witch can create profiles on demand for a given site and auto-fill username / password / email at your approval. The password is a very strong auto-generated key associated with the a resource identifier of the site. So that a site could do the standard email / password and include a simple meta-tag identifying it's unique resource. This would make integration on your application optional at worst, and extremely simple at best.

Xmarks is pretty close. It's missing a password generator though: <http://www.xmarks.com/>
