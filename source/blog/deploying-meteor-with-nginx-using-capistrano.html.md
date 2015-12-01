---
title: "Deploying Meteor with Nginx using Capistrano"
date: 2015-10-15
tags: [meteor, nginx, capistrano, deployment, linux]
author: "Dave Rapin"
published: false
---

## Prerequisites

* Meteor
* Ruby

## Deployment Setup

We're going to use my "tehgosu" meteor app for illustration. You can of course use whatever meteor app you like.

```
git clone git@github.com:pairshaped/tehgosu.git
cd tehgosu
```

Install Capistrano:

```
gem install capistrano
```

Capify you Meteor app:

```
cap install
```

Open up the Capfile and uncomment the line:

```
require 'capistrano/passenger'
```

Open up the config directory
