---
title: Delete old email automatically using Google Apps Script
date: '2020-04-30T08:00:00.000Z'
excerpt: For the last six months I’ve had my Gmail account configured to automatically delete unarchived mail after 7 days that hasn't been starred or marked as important. And it’s been wonderful!
author:
  name: Ben Bjurstrom
  picture: 'https://benbjurstrom.com.s3.us-west-2.amazonaws.com/img/headshot.jpg'
ogImage:
  url: '/assets/blog/dynamic-routing/cover.jpg'
featured: 1
tags: ['optimization']
---

<YouTube url="https://www.youtube.com/embed/OFuaoeq7gSw" />
<br/>

For the last six months I’ve had my Gmail account configured to automatically delete unarchived mail after 7 days that hasn't been starred or marked as important. And it’s been wonderful!

As of this writing I have less than 150 emails in my inbox and I have spent literally zero time organizing them.

I was able to set this up using a very basic programming script running in Google’s own [Apps Script](https://developers.google.com/apps-script) service which allows you to write Javascript to interact with many of google’s services;

![google-apps-script.png](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/google-apps-script.png)

## But why?

Over the last five years I’ve noticed the majority of emails hitting my personal inbox have changed. Conversations with friends and family have mostly moved to dedicated chat apps like iMessage and Hangouts. Meanwhile I’ve diligently unsubscribed from any unwanted newsletters.

What’s left is what I categorize as _notification emails_ and they probably make up 95% of the email I receive day to day. Things like:

> "Your package has shipped!"

or

> "A large credit card transaction has been approved."

I don’t want to disable these notifications as I do get value from being notified in the moment. However, a few years go by and suddenly I've got tens of thousands of notification emails that either need to be archived or deleted.

What’s worse is the few emails I actually want to keep are mixed in with all of the noise described above. By switching things to retain email on an opt-in basis these problems go away with practically zero effort.

## Backup your mailbox before proceeding

Since we’re going to be deleting email in bulk using tools we don’t fully understand, it’s probably a good idea for you to backup your entire Gmail mailbox offline before proceeding. To do so you can use Google's takeout service found at [https://takeout.google.com](https://takeout.google.com).

By default all of Google's services are pre-selected. But since we’re just interested in Gmail click _Deselect All_ and then navigate down to _Mail_ and select it by checking the box on the right.

![google-takeout-select-gmail](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/google-takeout-select-gmail.png)

You can see it’s going to archive the email into an MBox file. This can then be opened on your computer using free email clients like Apple Mail or Mozilla Thunderbird.

Then scroll down all the way to the bottom and click _Next Step_, select your delivery method as email, and click _Create export_.

![google-takeout-select-file-type](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/google-takeout-select-file-type.png)

A few hours later you'll get an email with a link to download your email archive as a zip file.

![google-takeout-your-archive-is-ready.png](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/google-takeout-your-archive-is-ready.png)

To verify the backup worked I recommend unzipping the archive and opening it up in the mail client of your choice. If you're using Apple mail go up to _File_ and click _Import Mailboxes_. Then select _Files in mbox format_.

![apple-mail-import-mailbox-in-mbox-format.png](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/apple-mail-import-mailbox-in-mbox-format.png)

Click _Continue_ and navigate to the folder where you unzipped the takeout download. Then inside the mail folder select the .mbox file and click _Choose_.

## Apps Script Dashboard

Now that we’ve verified our backup, lets’ go ahead and create the script that will automatically purge our old emails. Start by heading over to the Apps Script dashboard found at [https://script.google.com](https://script.google.com/home/start).

If you look at the navigation sidebar you’re currently on the "My Projects" tab.

![google-apps-script-dashboard.png](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/google-apps-script-dashboard.png)

Click on _New Project_ in the upper left and a new project will open in a simple integrated development environment.

In the left hand bar you can see a list of files included in this project. There should be one file present by default called "Code.gs" which is the file we have open right now. Since this project will be relatively simple it's the only file that we’ll need.

![google-apps-script-new-project.png](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/google-apps-script-new-project.png)

## Apps Script Triggers

Before moving on to the script itself let's take a moment to discuss Apps Script triggers. Obviously if we want our email purge script to run every day it will need to be triggered somehow.

![google-apps-script-timebased-trigger-docs.png](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/google-apps-script-timebased-trigger-docs.png)

Thankfully Apps Script provides triggers which can call project functions. However, one gotcha we'll need to deal with is that Google imposes a 20 trigger limit and completed triggers are not removed automatically. Therefore, we'll need to manually garbage collect any completed triggers.

## Purge email script

All of the code we’ll be using is available at [https://gist.github.com/benbjurstrom/00cdfdb...](https://gist.github.com/benbjurstrom/00cdfdb24e39c59c124e812d5effa39a) which I've also embedded at the bottom of the article.

At the top of the script we define a constant called `PAGE_SIZE` which I’ve set to 150 by default. This is the number of messages that our purge function will attempt to delete each time it’s invoked.

```js
// Maximum number of message threads to process per run.
var PAGE_SIZE = 150
```

Deleting emails is kind of a slow process and Apps Script sets a 6 minute timeout on all function calls. So if you need to delete thousands of emails you can't do that in a single execution. In my experience deleting 150 messages takes about 30 seconds making for a very safe default.

Next we define a the `setPurgeTrigger` function which creates a new Apps Script trigger that will call the `purge` function daily. This is the function you will need to execute manually to _install_ the script later on once we have everything setup.

```js
function setPurgeTrigger() {
  ScriptApp.newTrigger('purge').timeBased().everyDays(1).create()
}
```

After that we define the `setPurgeMoreTrigger` function which will trigger the `purgeMore` function two minutes later.

```js
function setPurgeMoreTrigger() {
  ScriptApp.newTrigger('purgeMore')
    .timeBased()
    .at(new Date(new Date().getTime() + 1000 * 60 * 2))
    .create()
}
```

Next we have the `removePurgeMoreTriggers` function. This is necessary because a large inbox could end up with way more than 20 triggers being set, which if not deleted, would cause errors due to the project’s 20 trigger limit. Here we're only deleting those triggers who's handler function is `purgeMore`.

```js
function removePurgeMoreTriggers() {
  var triggers = ScriptApp.getProjectTriggers()
  for (var i = 0; i < triggers.length; i++) {
    var trigger = triggers[i]
    if (trigger.getHandlerFunction() === 'purgeMore') {
      ScriptApp.deleteTrigger(trigger)
    }
  }
}
```

Next is a function that will delete all triggers of any type for this project. This is the function you should manually execute if you ever want to _uninstall_ the script to stop it from running every day.

```js
function removeAllTriggers() {
  var triggers = ScriptApp.getProjectTriggers()
  for (var i = 0; i < triggers.length; i++) {
    ScriptApp.deleteTrigger(triggers[i])
  }
}
```

After that is our `purgeMore` function definition. Which is just a wrapper for our main `purge` function. We need to keep `purge` and `purgeMore` separate so we can delete our `purgeMore` more triggers without deleting the daily `purge` trigger.

```js
function purgeMore() {
  purge()
}
```

Finally we have our main purge function that encapsulates all of the actual logic we’ll be using to delete old emails. The first thing the purge function does is make a call to the `removePurgeMoreTriggers()` function to clean up any completed triggers.

```js
function purge() {
  removePurgeMoreTriggers()
  ...
}
```

Next we’re defining our search string and saving it to a variable called _search_. Then we're passing that search string to the `GmailApp.search` method and getting back the matching threads. Any mail that matches this search is the mail that will be deleted by the code that comes next.

```js
function purge() {
  ...
    var search = 'in:inbox -in:starred -in:important older_than:' + DELETE_AFTER_DAYS + 'd'
    var threads = GmailApp.search(search, 0, PAGE_SIZE)
  ...
}
```

Next we check to see if the number of message threads returned matches our `PAGE_SIZE` constant. If so we’ll assume there are more messages that need deleting and set a trigger for our `purgeMore` function.

```js
function purge() {
  ...
    if (threads.length === PAGE_SIZE) {
        console.log('PAGE_SIZE exceeded. Setting a trigger to call the purgeMore function in 2 minutes.')
        setPurgeMoreTrigger()
      }
  ...
}
```

Finally for each _GmailThread_ object that matched our search we’ll check to see if the most recent message in the thread is older than our `DELETE_AFTER_DAYS` constant. If so we’ll move the entire thread to the trash by calling the `moveToTrash` method on the object.

```js
function purge() {
  ...
  var cutoff = new Date()
  cutoff.setDate(cutoff.getDate() - DELETE_AFTER_DAYS)

  // For each thread matching our search
  for (var i = 0; i < threads.length; i++) {
    var thread = threads[i]

    // Only delete if the newest message in the thread is older then DELETE_AFTER_DAYS
    if (thread.getLastMessageDate() < cutoff) {
      thread.moveToTrash();
    }
  }
}
```

## Installing the script

The next step is to manually execute our `purge` function to make sure it works. You can do that by selecting the `purge` function from the execution toolbar and clicking on the play button.

![google-apps-script-run-function.png](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/google-apps-script-run-function.png)

When you do so for the first time you’ll be asked to grant your app permission to access your email. Because your app isn’t published or reviewed by Google you’ll get a warning that _You should avoid this app_. But remember this is your own app so you can safely ignore the warning.

![google-apps-script-not-verified-warning.png](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/google-apps-script-not-verified-warning.png)

As I mentioned before, because we’re only deleting 150 emails at a time, it may take a number of cycles to delete everything. Keep an eye on the executions tab in the Apps Script dashboard to make sure the script is still re-triggering itself to grab a fresh 150 messages every couple of minutes.

![google-apps-script-executions.png](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/google-apps-script-executions.png)

For my inbox with thousands of emails this went on for quite a while with each invocation of the `purgeMore` function happening two minutes after the last. Until all of the emails in my inbox older then 7 days that haven’t been starred or marked as important were deleted.

## Managing Email

One note, because we programmed our script to move matching threads to the trash, the message won’t be permanently deleted for another 30 days. So if you need to free up space right away you will need to go to the trash and permanently delete the items that have been moved there.

The rest of the time this extra 30 day buffer is nice to have. There’s been a couple of times where I forgot to star, archive, or mark something I needed as important and I luckily caught it before 30 days were up and was able to pull it from the trash.

What’s great about this system is that starred or important but unarchived email starts to stack up at the end of your inbox. Then it becomes super easy to sort through by simply archiving anything you want to keep or removing the important designation from any email you’d like to be deleted during the next daily purge.

![gmail-unpurged-email.png](https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/purge-email/gmail-unpurged-email.png)

I typically spend less then a minute sorting through these about once a month since there’s usually less than 50 emails that have accumulated.

[https://gist.github.com/benbjurstrom/00cdfdb24e39c59c124e812d5effa39a](https://gist.github.com/benbjurstrom/00cdfdb24e39c59c124e812d5effa39a)
