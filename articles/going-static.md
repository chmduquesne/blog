Category: misc
Date: 2011-09-15 20:10
Title: Going static

I eventually got sick of wordpress and of my former hoster [free.fr][1].
Wordpress is probably awesome if you are a team of 15 authors who want to
handle mass production of articles with a nice web interface. On the other
hand, it needs constant updates, and the last ones where requiring a
version of php that my hoster did not provide.

Looking for an alternative, I found the [argument of nicdumz about
blogofile][2] pretty much convincing: why use php and databases where flat
html files could be just enough? I have thus decided to go for a static
website generator, and while I am at it, to host my blog on amazon s3.
This brings me the confort of writing my articles on vim, to version them
on git and to manage the whole process from a makefile.

Moving
======

If anyone who reads me plans to make such a move (wordpress to pelican),
I'll summarize the steps I went through.

Extracting your articles
------------------------

Being open and in the spirit of every good free software, wordpress lets
you export your blog using an xml format. Pelican can [take advantage][7]
of this xml file to generate rst files using pandoc. Or if you are lazy,
you can just provide an rss feed to the pelican importer, but you'll still
miss a way to get the comments.

Getting you comments
--------------------

Pelican does not provide a comment system by itself, but integrates nicely
with [disqus][4]. Just make an account and upload the Wordpress xml export
file I mentioned. Disqus provides a way to import comments from such a
file. You will later be able to reattach threads to their articles by
providing a csv map file following the syntax:

    old_url, new_url

Setting up an amazon account
----------------------------

The next step is to set up an amazon account for use with s3, and to buy a
domain name if you don't already own one. I bought the latter using
[gandi.net][5], and I used [vaporfile][6] to set up an amazon bucket. I
don't see much to add here, given the fact vaporfile provides a friendly
wizard that tells you what to do quite accurately.

What I could not fix
====================

The blog entries on my previous blog were obtained through links looking
like

    http://chm.duquesne.free.fr/blog/?p=xxx

Whereas on the new version, they look like

    http://blog.chmd.fr/title-of-the-article.html

It would have been cool to be able to put 301 redirect entries in a
.htaccess, for the sake of SEO-friendliness. However, this would require
some url rewriting, which [free][1] does not support. I decided to skip
this step. I am keeping [a map][8] between the former and the new urls,
just in case I'd have the courage to write these redirections in php...

[1]: http://free.fr
[2]: http://nicdumz.fr/blog/2010/12/why-blogofile/
[3]: http://readthedocs.org/docs/pelican/en/2.7.2/
[4]: http://disqus.com/
[5]: http://www.gandi.net/
[6]: https://github.com/enigmacurry/vaporfile
[7]: https://github.com/ametaireau/pelican/blob/master/tools/pelican-import
[8]: https://github.com/chmduquesne/blog/blob/master/legacy/urlmap.csv
