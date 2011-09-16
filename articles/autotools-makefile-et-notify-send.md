Title: autotools, makefile et notify-send
date: 2009-07-03 10:18
category: code
tags: autotools, makefile, notify-send

Au boulot, j'usilise les autotools comme buildsystem de mon projet.
C'est pas l'idéal, je préfererais un truc plus moderne du style
cmake, mais vu que tout le monde y est j'ai pas trop le choix. Bon,
et qu'est ce qu'on fait pendant que ça compile? Généralement, rien
: ça dure pas assez longtemps pour se mettre à un autre truc et
trop pour ne pas glander sur
[xkcd](http://imgs.xkcd.com/comics/compiling.png). Alors voilà un
bon truc, qui s'adaptera facilement à des Makefile classiques, pour
être prévenu par un popup lorsque votre compilation ou vos tests se
terminent: vous ajoutez un appel à notify-send dans la cible par
défaut de vos Makefiles, de manière à ce que celui-ci vienne en
dernier. Autant sur un Makefile, c'est pas très dur, autant avec
les autohells, j'ai galéré. En fait c'est tout simple, il suffit
d'utiliser une cible '-local' dans le Makefile.am, qui permet
d'overrider les cibles par défaut. Ici, ça sera donc all-local.
Bon, et comme vous voulez que le projet continue à marcher si vous
ne disposez pas de notify-send, il faut modifier aussi le
configure.ac. Ça donne: configure.ac :

    #-----------------------------------------------------------------------
    # Support for notify-send
    #-----------------------------------------------------------------------
    AC_CHECK_PROG([notify_ok], [notify-send], [yes], [no])
    AM_CONDITIONAL([NOTIFYSEND], [test "x$notify_ok" = xyes])

Makefile.am :

    if NOTIFYSEND
    all-local:
        notify-send --icon=${PWD}/chemin/vers/icone/du/projet "My project" "Finished!"
    endif

Voilà, j'espère que ça va vous servir. Pour info, notify-send est
un outil utilisant dbus qu'on trouve la plupart du temps dans le
paquet libnotify. On doit même pouvoir faire sans, en utilisant
directement dbus-send, mais la syntaxe est moins aisée (si vous
l'avez, n'hésitez pas à laisser un commentaire).



