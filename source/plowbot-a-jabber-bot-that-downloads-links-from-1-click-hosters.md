Title: plowbot, a jabber bot that downloads links from 1-click hosters
Date: 2011-07-26 13:46
Category: code
Tags: plowbot, plowshare

I wrote a jabber bot that does just one thing: it uses [plowshare][1] to
download what you paste. It is quite minimalist and thus does not offer
queue management features nor advanced captcha solving possibilities, so
you should not try to use it on links plowshare can't break automatically
(basically [those that use recaptcha][2]), otherwise it will eventually
freeze. I used python-jabberbot, and to maximize the simplicity I store
the user configuration in json in an xdg fashion (which happened to be
both user-friendly -probably - and easy to write - certainly). If you want
to fork it and add whatever you find useful, it's on github:

[https://github.com/chmduquesne/plowbot][3]

I am personally quite satisfied with it (it fits my limited usage
for this kind of service), but I am open to pull requests. Of
course, I also made an AUR package for arch users, which adds an rc
script for starting it at boot as your prefered user.


[1]: https://code.google.com/p/plowshare/
[2]: https://code.google.com/p/plowshare/wiki/Readme
[3]: https://github.com/chmduquesne/plowbot
