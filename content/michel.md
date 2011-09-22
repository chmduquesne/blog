Title: Releasing Michel, a flat-text-file-to-google-tasks uploader
Date: 2011-09-22
Tags: gtasks
Category: code

When it comes to handling my todo list, I'm a huge fan of flat text files.
The main reason why I prefer them over anything else is that I find it
far easier to display it with notification popups this way.

I also heavily rely on gmail to organise myself. When I am reading emails
and organizing my life, it feels natural to use gtasks to take notes for
later.

Since I both use text files and gtasks, I was missing was a way to sync
them together. Unfortunately, for a long time, google [made us wait][1]
for a gtask API. But no more! I discovered at the beginning of the week
that they had [announced][2] a brand new RESTful interface.

I decided to give it a go and I have written a small program that suit my
needs to help me handle my todo list text file. So here comes [Michel][3],
your friendly mate that helps you managing your todo list. It features two
commands

    michel pull
    michel push <file>

which respectively push and pull taks in a text fashion.

The code is on [github][3]. Just like any python package, you should be
able to install it using easy\_install (provided you install pyxdg with
your standard package manager, which does not seem to be installable from
easy\_install).

    easy_install michel

[1]: http://code.google.com/p/gdata-issues/issues/detail?id=987
[2]: http://googleappsdeveloper.blogspot.com/2011/05/getting-organized-with-tasks-api.html
[3]: https://github.com/chmduquesne/michel
