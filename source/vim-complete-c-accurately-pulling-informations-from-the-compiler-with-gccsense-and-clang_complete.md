Title: Vim: complete C++ accurately, pulling informations from the compiler, with gccsense and clang_complete
Date: 2010-10-27 23:11
Category: code
Tags: vim, gccsense, clang_complete

It has been a while since I first dreamt about a reliable way to complete
C++ code within vim. Sure, there was omnicppcomplete, which was able to
complete more or less accurately from ctags databases, but the quality of
the completion was greatly dependent on your coding style (I never could
get myself used to put all my methods declarations on the same line).
What we missed was a clever completion plugin, something that would be
able to look deep inside the code, to resolve the types of the object you
are refering to and to provide the set of accurate methods. Actually, we
needed a plugin that would have the same knowledge the compiler has. That
is a huge task, which is probably the reason why it has been let aside for
so long.  But recently, almost at the same time, two plugins have
appeared, based on this idea.

The first plugin, clang_complete, uses a feature from the compiler
clang++, from the llvm project. This new C++ compiler aims at being as
reliable as g++. Though as far as I know, it is still not ready for
production, it recently compiled boost, so expect to hear about it again.
clang++ features the ability to complete a given line of code from the
command line, and our first plugin is based on this feature: see
[http://www.vim.org/scripts/script.php?script][1] for more information.

The second plugin is based on a crazy gcc modification called
gcc-code-assist. The author has hacked in gcc's code and provides a
replacement for gcc that also builds a sqlite database at the same time
you build your code with it. Then a command line tool called gccsense
allows to query this database.  Basically, you just replace gcc with
gcc-code-assist in your makefile, and you install the plugin provided on
the author's website: [http://cx4a.org/software/gccsense/][2].  The
modified gcc is really easy to compile, I even made a package for
archlinux that you can find on AUR. Obviously, this stuff is very unlikely
to make it to gcc's upstream...

So, what to use?  Well, if clang++ builds your project without errors, I'd
go for it, because this is for sure a feature that will continue to be
maintained by the llvm crew. Otherwise, gccsense should work exactly like
gcc-4.4. Honestly, I did not have the chance to really test any of them,
so it will be difficult to provide good feedback for me. If someone has
the opportunity to test it, please leave a comment!

[1]: http://www.vim.org/scripts/script.php?script_id=3302
[2]: http://cx4a.org/software/gccsense/
