---
title: "Quality Versus Speed"
date: 2010-04-29
tags: [code, process]
author: "Dave Rapin"
published: true
---

The quality versus speed question is one that constantly comes up whether you're a freelancer or a salaryman, and the answer is usually situational. However, by situational I don't mean given a specific project. Instead I think it's more about your personality and commitment as a developer.

As a freelancer you have a lot more control over the quality of your work and it's essential to enjoying your profession. We inevitably have to deal with some unreasonable clients now and then, who want everything done yesterday and aren't willing to compensate you appropriately for your time. So how do we deal with it?

For me, with fixed quote work, once I agree to take a project on I simply put compensation out of my mind. If I was unable to correctly scope and quote building a quality application, it's not going to stop me from doing my best anyways. One of the luxuries of freelancing is the authority to decide that you will do what it takes to deliver something you're proud of. In my mind it's just not acceptable to deliver less than my best effort, and it would stress me out not to do so. Using an agile process can also help to limit losses you may incur by misquoting projects.

This means all of my client's will get a great deal, even those I may have misquoted. I'll sometimes take a loss, but for me it's not worth the stress of building something you aren't proud of. At the core, it's really that simple. I get to feel good about my work and I'm still able to put food on the table even when I take a loss. I'll learn new technologies and techniques which may eventually balance out the occasional losses.

So to take this a little further, whenever I'm building software, there's usually quite a few moving parts behind the scenes that the client is blissfully unaware of. That doesn't mean they're unimportant. In fact when I take on the work I'm essentially saying, yes I have the expertise to do this, and yes I will take care of all of the details including the more complex hidden challenges.

For example, let's say I'm building a storefront web application. I'm extremely focused on conversion and put together a great payment flow to reduce the friction associated with purchasing online. I've implemented SSL properly wherever customer information is being submitted. I'm storing their details using opt-out rather than opt-in. The customer is always being sent to the most relevant next step, and in general I'm presenting them with as little data entry fields as possible. The customer feels safe and they are able to make their payment quickly. Returning customers are delighted that it's even faster the next time they make a purchase.

So far this sounds like a pretty great job. The client is in total agreement. Their sales are up, CSR calls are down, and I feel like my work is appreciated.

What the client is unaware of is how I'm storing credit card information and passwords. I could be storing them in clear text or using weak encryption (salt-less). Let's say that I also enforced very few if any restrictions when customers choose a password, since that would increase payment friction. So we have weak or unencrypted passwords, they're easy to crack via dictionary attacks; like "joe", "password", "12345", plus they're all associated with unencrypted credit card information.

Now the client may never care so long as nothing *bad* happens. They're certainly not going to pay me to implement a far more secure solution if I didn't make room for it in my initial quote. Good enough? Well sort of... most of the time this probably goes unnoticed. Meaning the customer is happy and they didn't have to pay me for the extra time to nail down the security (however, for this example at least, PCI enforcement is going to change that). So what's the problem? The problem is I'm not happy. I know that some very critical mistakes have been made. Therefore I would never deliver this application until I corrected these mistakes. This isn't actually a real world scenario, but it serves as a decent enough example of hidden complexity.

There are many programmers like myself, who's personality and commitment to a quality solution will simply not let them stop at good enough. Even if the client is happy and completely unaware of the insecurity of their system and the liability associated with it. These programmers will be compelled to finish the job, even if they are over budget.

There are times though where a passionate and committed programmer can blow out a project's budget without the customer's best interest at heart. I've heard a lot of criticism in programming circles about this type of programmer. However, I've noticed that almost always these criticisms come from either programmers with very limited experience, or MBA types who've never written a line of code in their life. There is absolutely no job satisfaction in delivering inferior products. Period. The passionate and committed programmer may seem to make some things a little more complicated than they need to be, but they will learn from it, and in the end you will end up with a better and more efficient product.

As a self-professed programming perfectionist of many years, my opinion is that there are many applications out there that I'm simply not suited to work on. I accept that this attention to details can be a strength in some scenarios and a weakness in others. There's probably thousands of programmers that can do the same work cheaper, with less questions, and produce an equally satisfactory product in some scenarios. In fact most of them probably don't even need to be programmers, in that they have no real interest in programming. Many projects are simply glueing together existing libraries and frameworks and require very little creative problem solving.

I would argue that there's nothing wrong with either of these programmer personalities. I think the market has room for both of us. There are many prototyping and proof of concept projects out there with extremely frugal owners / managers that simply aren't willing to invest either the time or money into a great solution and are happy enough with a mess of libraries glued together behind a pretty user interface. In fact, unless the stakeholder is willing to invest their own time and effort in the project, then they're unlikely to be happy with any solution they get, and would just frustrate the more passionate and committed developers anyways.

In the end, I'm happy to be writing quality software that will live for a while and need to be supported and improved. I enjoy refactoring my code. There's something extremely satisfying about it.

As a client, if the project is your baby, and you're very committed to it, then you will want an equal level of commitment from whoever works on it.
