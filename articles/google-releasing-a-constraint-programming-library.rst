Google releasing a constraint programming library
#################################################
:date: 2010-09-25 00:31
:category: code
:tags: or

As an Operation Research engineer/PhD student, I was very
interested to discover that Google just released a project in my
field. It is simply called "`or-tools`_" and contains a constraint
programming solver. While CP is not my primary field of study, I
know the basics and I gave a quick look, just in order to know how
big it was and what I would fine inside. Technically, I liked what
I saw: What is actually inside is C++, wrapped in a swig interface.
There are 58 C++ files (24 of them are headers) and a total number
of 35998 lines of code, which is reasonable (= rather big, but
still readable by 1/2 persons) for a project in this language.
Embedding C++ in script languages is probably the best way I know
to get the best of the two worlds since you get the power of
scripts, and the speed of C++. While this technique is very
efficient and more and more projects are using it, Operations
Research is a field where things are usually moving slowly in terms
of technology, so I was glad to see that google engineers are doing
it, it might show the way for the rest of the community. The
project is supposed to build on the 3 major platforms. For linux,
it just uses a simple Makefile, which I liked even more: Having
used autotools a lot, I think I can now say I only have pure hate
for them (they never made things simpler) and I just want to hug
every programmers that are handling things with simple Makefiles.
There are examples in python and in C++ that are classic CP
exercises for students (at least I already knew most of them). The
only thing I did not like was the fact they are using subversion. I
find it easier to hack in projects when they are distributed with
DCVS. But I guess the guys who did this don't need my opinion,
since it is not the first time they are writing code. I was curious
and googled the name of the commiter: apparently he's a former
engineer from ilog (now part of IBM), which is famous in the OR
field for cplex, the famous MIP solver. There are a mailing list
`http://groups.google.com/group/or-tools-discuss`_ and a website
`https://sites.google.com/site/ortoolssite/`_, so I guess google
also plans to maintain this library. Conclusion: Good news for OR!

.. _or-tools: https://code.google.com/p/or-tools/
.. _`http://groups.google.com/group/or-tools-discuss`: http://groups.google.com/group/or-tools-discuss
.. _`https://sites.google.com/site/ortoolssite/`: https://sites.google.com/site/ortoolssite/
