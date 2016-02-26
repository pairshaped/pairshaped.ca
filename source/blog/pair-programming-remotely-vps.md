---
title: "Pair Programming Remotely"
date: 2013-07-04
tags: [code, pairing, vps, tmux]
author: "Dave Rapin"
published: true
---

At Pair Shaped we firmly believe that pair working is the future (and the present). However a good part of our team works remotely and this can be a real challenge.

While remote pairing solutions are becoming increasingly popular, as a coder it's hard to beat the Vim + Tmux combination. It's simple, fast, and there's no client OS or application dependencies.

In this post we take you through all of the steps to setup an amazing remote pairing environment using an affordable cloud server (VPS). What this will allow you and your team to do:

1. Securely share persistent tmux (shell) sessions on a linux box on the cloud.
2. Watch each other code.
3. Take turns coding.
4. Rotate between different persistent pairing sessions with multiple team members all within the same server.

I highly recommend adding voice to the mix whether it's Skype, Google Voice, or a SIP provider.

For starters, we'll need a linux box in the cloud. For the server we're going to go [Digital Ocean](https://www.digitalocean.com) since it is one of the most affordable options at the time of this post. However, the steps are essentially the same with other hosts like [Linode](https://www.linode.com/) and [EC2](http://aws.amazon.com/ec2/), so definitely check them out too.

<div class="blog-content__video-wrapper">
  <iframe width="100%" height="315" src="//www.youtube.com/embed/aU7W4O9a61o" frameborder="0" allowfullscreen></iframe>
</div>

Sign up for an account at Digital Ocean and then create a 512MB droplet running <em>Ubuntu 12.04 x32</em>. If you're not sure about the hostname option, a good choice would be something like <em>pair.yourcompanydomain.com</em>. Make sure you chose a region that's close to you and your team to minimize latency.

At this end of this tutorial you can shut you droplet down if you aren't going to use it, and it'll only end up costing you a few cents.

Once you've created the droplet, you should receive an email from Digital Ocean with your new boxe's IP address and credentials. For the rest of this post I'll use a fictional IP. Just substitute the IP you were given as needed.

Open up a terminal if you don't already have one up and follow along with these commands to setup and install the basics.


## Basic Server Setup

    # Log into your droplet and enter the provided password when prompted.
    ssh root@198.199.xx.x

    # Update the system. This will take a little while to complete.
    aptitude update
    aptitude safe-upgrade

    # Install essential build tools, git, tmux, vim, and fail2ban.
    aptitude install build-essential git tmux vim fail2ban

    # For more details on configuration options for fail2ban start here:
    # https://www.digitalocean.com/community/articles/how-to-protect-ssh-with-fail2ban-on-ubuntu-12-04

Next we'll need to setup user accounts for our pair. You can of course setup as many users as you want and run multiple tmux sessions, but that's the topic of a future post.

Follow along with these commands, substituting your preferred usernames for "dave" and "dayton".


## Create Your Pairs

    # Create the wheel group
    groupadd wheel
    visudo
    # Add the following line to the bottom of the file
    %wheel ALL=(ALL) ALL
    # Save and quit. (:wq)

    # Create our pair users
    # You'll want to substitude your own usernames for dave and dayton
    adduser dave
    adduser dayton

    # Add them to the wheel group
    usermod -a -G wheel dave
    usermod -a -G wheel dayton

Now that we have your users setup with full rights (this is something you may want to change down the road), we can disable the root account and instead use a pair account.

## Secure the Server

    # Copy your shh key to the server
    scp ~/.ssh/id_rsa.pub dave@198.199.xx.x:

    # Login to your account
    ssh dave@198.199.xx.x

    # Enable ssh access using your rsa key
    mkdir .ssh
    mv id_rsa.pub .ssh/authorized_keys

    # Now you should be able to ssh to the server using your key. Go ahead and try it. 
    exit
    ssh dave@198.199.xx.x
    # If you have to enter a password, something went wrong. Try these steps again.

    # Edit the sshd config
    sudo vi /etc/ssh/sshd_config
    # Disable root login
    PermitRootLogin no
    # Save and quit. (:wq)

    # Reload ssh
    sudo reload ssh

Now we have a fairly secure server with our pair accounts using password-less access and it's time to setup the pairing environment. We're going to use [wemux](https://github.com/zolrath/wemux) which is backed by tmux to manage the sessions.


## Wemux Installation

    # Install wemux
    sudo git clone git://github.com/zolrath/wemux.git /usr/local/share/wemux
    sudo ln -s /usr/local/share/wemux/wemux /usr/local/bin/wemux
    sudo cp /usr/local/share/wemux/wemux.conf.example /usr/local/etc/wemux.conf

    # Change the host_list value to your pair usernames
    sudo vim /usr/local/etc/wemux.conf
    host_list=(dave dayton)
    # Save and quit (:wq)

You are now the proud owner of a remote pairing environment.


## Start pairing

It's time to take it for a spin and make sure everything's copasetic.

    # Launch a shared tmux session.
    wemux

You should now be running in a shared tmux session. One of your other accounts (pair2, etc.) can login and use the same command to join your session.

You will definitely want to checkout the [wemux documentation](https://github.com/zolrath/wemux) for all of the configuration options.
