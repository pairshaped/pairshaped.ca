---
title: "RubyMotion Provisioning Profiles"
date: 2013-02-05
tags: [ruby, iOS, code, provisioning]
author: "Dave Rapin"
published: true
---

I recently ran into an issue with RubyMotion where I couldn't build to a development device without explicitly setting the provisioning profile in the Rakefile. Not only is this annoying, but it's a big problem for team development because you'll always want to check your Rakefile into source control and each team member would have a different Rakefile.

So I started hunting for a solution.

## Official Documentation is Misleading

The [RubyMotion official project configuration documentation](http://www.rubymotion.com/developer-center/guides/project-management/#_configuration) states that it look for and use the first provisioning profile it finds on your computer. This is false though, at least when you have multiple profiles, because even if each of your profiles contains the device UID you're building to, this still won't work.

## Existing Solutions Insufficient

The existing solutions are simply to explicitly refer to your provisioning profile in your Rakefile. That's OK for solo development (but still annoying), however it's not a good solution for team development.

See this [stackoverflow Discussion](http://stackoverflow.com/questions/13539743/rubymotion-build-error-cant-find-a-provisioning-profile-named-mixios-tea)

## My Solution

After a [little light reading](https://github.com/HipByte/RubyMotion/blob/master/lib/motion/project/config.rb) I discovered that the RubyMotion build will check for a default profile named "iOS Team Provisioning Profile".

So we simply need to create a new provisioning profile via the [iOS provisioning portal](https://developer.apple.com/ios/manage/overview/index.action) named "iOS Team Provisioning Profile" and containing the device(s) we want to be able to run development builds on.


