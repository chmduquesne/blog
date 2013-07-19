Title: Sigal, a static gallery generator
Date: 2013-07-20 15:11
Category: misc
Tags: sigal gallery static

I wanted to self-host my pictures. Nothing crazy, just a way to share them
with my friends without using a third party service. At first, I thought
about writing a lighttpd module that would generate thumbnails. Then I
thought about a using a php script, but all of them have too many options,
and are too complicated for what I intended to do. I wanted something
simple and secure (e.g. no upload interface)! Then I thought about how
this blog is built: using a static blog generator! Did it exist for
galleries?

It turns out that yes, there are [plenty of
solutions](http://www.nico.schottelius.org/docs/static-image-gallery-generator-comparison/)
available. I tested some of them, and I found that
[sigal](http://sigal.saimon.org) was my prefered one.

Sigal is beautiful, and minimalistic. It lets you theme your gallery with
jinja templates, exactly like pelican. Furthermore, it is mature and very
well maintained (my main concern when I install something): there is a
testsuite, a good online documentation (not that it needs it, it is dead
simple to use) and continuous integration. There is even
[two](http://saimon.org/sigal-demo/colorbox/)
[demo](http://saimon.org/sigal-demo/galleria/) galleries, for you to test
it live before installing it. And of course, for maximal conveniency,
there is a python package, that you can install very simply: just run

    pip install sigal

The only thing that I was missing was video support. I sometimes film
short movies with my cameras, and I want to include them in the pictures
that I am sharing. I thus decided to give a go to the code, in order to
see if it easy to patch. It turned out to be rather easy. There's a [pull
request](https://github.com/saimn/sigal/pull/18) pending...

TL;DR you should try sigal!
