---
title: "Backing up your MySQL Databases Offsite"
date: 2010-05-06
tags: [database, hosting]
author: "Dave Rapin"
published: true
---

I recently came across a nifty little tool called Tarsnap.

From the Tarsnap home page:

Tarsnap is a secure online backup service for BSD, Linux, OS X, Solaris, Cygwin, and can probably be compiled on many other UNIX-like operating systems. The Tarsnap client code provides a flexible and powerful command-line interface which can be used directly or via shell scripts.

Here's a quick and easy guide to get you up and running backup up all of your MySQL databases.

### Automate the MySQL Backup

1. In your home directory:

```bash
mkdir backups && cd backups
```

2. Download: <http://sourceforge.net/projects/automysqlbackup/> to the backups directory you just created.

3. Rename it:

```bash
mv automysqlbackup.sh.2.5 automysqlbackup.sh
```

4. Make it executable:

```bash
chmod u+rwx automysqlbackup.sh
```

5. Edit it:

```bash
nano automysqlbackup.sh
```

6. Fill out your database name, password, and the names of the databases you want to backup.

7. Look for the commented POSTBACKUP line. Add these two lines right below it (replace username with your username).

```bash
BACKUP_TIMESTAMP=$(date +"%m-%d-%Y_%T")
POSTBACKUP="tarsnap -c -f databases.$BACKUP_TIMESTAMP /home/username/backups"
```

### Install and Setup Tarsnap.

1. Follow the instructions on the Tarsnap getting started page: <http://www.tarsnap.com/gettingstarted.html>

2. You should have donwloaded, paid for, and installed Tarsnap before continuing.

3. We're going to use the tarsnap sample config (cache dir and key location).

```bash
cd /usr/local/etc
cp tarsnap.conf.sample tarsnap.conf
```

4. Now run your backup script:

```bash
sudo ./automysqlbackup.sh
```

5. Check to see if you're backup was created and stored remotely:

```bash
sudo tarsnap --list-archives
```

6. Now we're going to create a cronjob to run the script on a daily basis (or you could move it to your /etc/cron.daily).

```bash
sudo crontab -e
30 2 * * * /home/deploy/backups/automysqlbackup.sh > /home/deploy/cron.log
```

Now you're databases are being backed up daily on a rotation keeping weekly and monthly dumps and storing them both on and off-site (encrypted).
