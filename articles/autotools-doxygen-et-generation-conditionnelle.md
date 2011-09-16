Title: autotools, doxygen, et génération conditionnelle
date: 2009-07-10 12:54
category: code
tags: autotools, doxygen, libre

On m'a donné une astuce bien sympa pour générer de la documentation
de manière conditionnelle avec doxygen. J'utilise ça dans le projet
que je code au boulot, et je pense que ça vaut le coup de partager.
L'idée est de générer la  documentation automatiquement à chaque
compilation de mon projet, en faisant appel aux features avancées
de doxygen en fonction des outils dont dispose l'utilisateur : dot,
htags, perl, etc... On va donc vérifier quels programmes sont
présents grâce au configure.ac, et on va générer le doxyfile en
fonction desquels sont présents. L'exemple que je donne n'est pas
complet, mais vous pouvez vous en inspirer: Fichier configure.ac

    AC_CHECK_PROG([DOT], [dot], [yes], [no])
    AC_CHECK_PROG([HTAGS], [htags], [yes], [no])
    AC_PATH_PROG([PERL], [perl], [])
    AM_CONDITIONAL([DOXYGEN], [test "x$doxygen_ok" = xyes])
    AM_CONDITIONAL([DOT], [test "x$dot_ok" = xyes])

    AC_CONFIG_FILES(
        doc/doxygen_html.cfg
    )

Ensuite, il suffit de glisser les bonnes références dans le fichier
doc/doxygen\_html.cfg.in :

    USE_HTAGS              = @HTAGS@
    PERL_PATH              = @PERL@
    HAVE_DOT               = @DOT@

Ainsi, après l'appel de ./configure, le fichier doxygen\_html.cfg
va être généré, et les expressions entre @ vont y être remplacées
par les bonnes valeurs. Vous pourrez ensuite vous servir de ce
fichier pour véritablement générer la doc...



