Title: Using openid and the likes to protect static content (lighttpd)
Date: 2013-10-29 14:22
Category: howto
Tags: openid lighttpd

I [recently](/sigal-a-static-gallery-generator.html) set up a self-hosted
gallery for my pictures. Obviously, I did this because I wanted to stop
giving my content to external platforms, but also to gain some level of
privacy: I want to limit the number of people who are able to look at
these pictures.

While setting up the gallery was relatively easy, restricting the access
was an interesting problem. I did not want to use a global
`username:password` combination, because this kind of credentials
inevitably become public at some point. A different combination for each
user would have been better, but some people are not as careful as I am
with their own credentials, and they may just give away their own access
to others. It is also a lot of maintenance, and I don't want to deal with
the risks involved with securely processing my friends' passwords.

I then had a look at single sign on solutions such as openid. This kind of
technology was appealing, for several reasons:

- No password to process on my side
- People would identify with a very personal account (gmail, facebook),
  that they are unlikely to be willing to share with anyone else.
- It is very easy to use for the end user.

I have thus been looking for a solution to get openid/oauth authentication
to cooperate with lighttpd in order to protect my new gallery. After some
work, I came up with [a lua magnet
script](https://git.chmd.fr/?p=lighttpd-external-auth;a=blob_plain;f=external-auth.lua)
that does the job. It is inspired by [this
module](https://github.com/tai/mod-auth-ticket-for-lighttpd), but it does
not require to be compiled and works out of the box on recent versions of
lighttpd (e.g.  debian stable). I also believe that it offers [a better
security](https://github.com/tai/mod-auth-ticket-for-lighttpd/issues/4).

It works pretty well! You can try to visit
[gallery.chmd.fr](https://gallery.chmd.fr)  and you should be presented
with my very own login page. Should you try to login, the script will
gently tell you that though your openid/oauth login was successful, you
cannot access the gallery because it is a privilege reserved to the people
I explicitly authorized. Beware that if you are not using linux, you might
experiment a warning from your browser: that is because I use a
certificate signed by [cacert](http://www.cacert.org/), a community-driven
certificate authority whose root certificate is not included in commercial
OS (yet).

If you want to use this script on your own lighttpd server, I have set up
a [dedicated website](http://lighttpd-external-auth.chmd.fr/) to explain
how to proceed. Check it out!

One last thing: I am not a security expert, and I did this for fun. I
believe it is pretty secure (provided you trust the third parties
involved, of course), but I still have to warn you: don't use this to
protect important documents. If you have knowledge about security and want
to comment - or even better: to contribute - be my guest!
