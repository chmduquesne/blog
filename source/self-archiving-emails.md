Title: Self-Archiving Emails
Date: 2025-08-19 19:00
Category: email
Tags: gmail

The concept of Inbox Zero has been around since 2007, and we can thank
Merlin Mann for popularizing it. If you have not watched the
[presentation][1], I highly recommend doing it, because it is still
relevant in 2025.

For the past 3 years, I have been running an automation which I now
consider essential to keeping my inbox tidy. I call it *self-archiving
emails*. The concept is simple: if an email has been sitting in my inbox
for long enough (and for me, that's currently 8 months), I will probably
never do anything about it. So it might as well archive itself. In
practice, 8 months is a worst-case scenario, because a lot of the emails I
receive are only interesting for a few days. The expiration date is set on
a case by case situation, using regular email rules.

## Gmail implementation

I am leveraging labels to implement this strategy. My flow is as follows:
using basic filters, I label every incoming email with one of the
following: `archive-1d`, `archive-3d`, `archive-7d`, `archive-1m`,
`archive-2m`, `archive-4m` or `archive-ifread`. Every hour, a script
archives every message which sits in my inbox and is older than what the
label indicates.

The script runs as a google apps script:

```javascript
function run() {
  // find all the archive-xx labels
  var labels = GmailApp.getUserLabels()
    .map(label => label.getName())
    .filter(name => name.startsWith("archive-") && name.length == "archive-xx".length);

  // archive all the expired emails according to their respective labels
  for (const label of labels) {
    var duration = label.split("-")[1];
    archive("in:inbox label:" + label + " older_than:" + duration)
  }

  // archive anything older than 8m
  archive("in:inbox older_than:8m");

  // archive emails which have no value once I have seen them
  archive("in:inbox is:read label:archive-ifread");
}

function archive(search) {
  Logger.log("archiving: " + search)

  var threads = GmailApp.search(search);
  
  Logger.log("found " + threads.length + " threads:");
  for(var i = 0; i < threads.length; i++) {
   var thread = threads[i];
   Logger.log((i+1) + ". " + thread.getFirstMessageSubject());
  }
  
  var batch_size = 100;
  while (threads.length) {
    var this_batch_size = Math.min(threads.length, batch_size);
    var this_batch = threads.splice(0, this_batch_size);
    GmailApp.moveThreadsToArchive(this_batch);
  }
}
```

There are already plenty of google apps scripts tutorials, so I will not
go into the details of deploying this script, but it roughly involves
going to [script.google.com][2], pasting this code into a new project and
setting the function `run` to trigger every hour. I am sure you will
figure this out.

## Office 365

My workplace uses office 365, but that did not stop me from implementing
the same logic using MS powerflows. It is, however, massively ugly, so I
will not share it here. If you are interested in how to do it, send me an
email, I may post another article about it if this is a popular request.

## Feedback

I have been running this automation for more than 3 years already. It
works. I can report that this concept of self-archiving emails has
drastically reduced the size of my inbox, to the point that I could not
imagine living without it. Surprisingly, I am the only person I know who
runs such an automation. I discussed about it with some friends the other
day, and because this generated some interest, I decided to share it here.
If you end up using it as well, feel free to shoot me an email, and if you
promote this approach to others, please credit me 😉

[1]: https://www.youtube.com/watch?v=z9UjeTMb3Yk
[2]: https://script.google.com
