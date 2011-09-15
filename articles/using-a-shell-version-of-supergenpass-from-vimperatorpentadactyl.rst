Using a shell version of supergenpass from vimperator/pentadactyl
#################################################################
:date: 2010-12-20 18:39
:category: howto
:tags: supergenpass, pentadactyl

Last week, I was glad to be a `supergenpass`_ user:
`gawker.com was hacked`_ and a huge number of their
username/password hashes was exposed. While I am not happy with the
fact my email was part of the leak and I've stopped reading
anything from them, I know there are very little chances for me to
get problems with that, because the password I used on their site
was not reused elsewhere. But `supergenpass is not that secure`_.
Any script executed in the same page as supergenpass is able to see
your master password. If the webmaster of the site you are visiting
is evil, he could grab your master password and hack all your
accounts. If you are a vimperator/pentadactyl user, it is easy to
fix that, by executing supergenpass as a shell command (What
follows is from my pentadactylrc):
::

    map -modes=n,v <C-F6> y:!~/.scripts/supergenpass<Space>'<S-Insert>'<Return><Esc>2gi<S-Insert><Return>
    map -modes=i <C-F6> <Esc><C-F6>

Where ~/.scripts/supergenpass is a python supergenpass script I
customized for my needs (it uses the gtk-based ssh-askpass program
to get the password, instead of using the python getpass library,
which is command line based). You'll find it in `my dotfiles`_.
Original version from `Michael Gorven`_. A little explanation:
CTRL-F6 is the shortcut to trigger the script (I've been using it
for ages, it is originally the default shortcut used in the
`password hasher firefox extension`_). "y" yanks the url,
":!~/.scripts/supergenpass<Space>'<S-Insert>'<Return>" will call
the program ~/.scripts/supergenpass with the content of the
clipboard (using Shift+Insert), <Esc>2gi will then focus the second
field (I usually call it once I've filled my login) and <S-Insert>
will paste the clipboard (now filled with the generated password)
in this focused field.

.. _supergenpass: http://supergenpass.com/
.. _gawker.com was hacked: http://www.businessinsider.com/gawker-hacked-2010-12
.. _supergenpass is not that secure: http://akibjorklund.com/2009/supergenpass-is-not-that-secure
.. _my dotfiles: https://bitbucket.org/chmduquesne/dotfiles/src/624d4f104f7d/scripts/supergenpass
.. _Michael Gorven: http://michael.gorven.za.net/blog/2009/06/18/supergenpass-cellphones-command-line
.. _password hasher firefox extension: https://addons.mozilla.org/fr/firefox/addon/3282/
