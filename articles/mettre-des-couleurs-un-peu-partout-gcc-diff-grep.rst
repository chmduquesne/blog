Mettre des couleurs un peu partout (gcc, diff, grep...)
#######################################################
:date: 2009-06-19 21:31
:category: howto
:tags: colors, console

Aujourd'hui, après avoir passé un bout de temps à déchiffrer la
sortie d'une compilation, je me suis mis en quête d'améliorer mon
quotidien et d'y mettre... des couleurs! Pour ce faire, on cherche
un peu ce qui existe déjà, et on tombe sur colorgcc. C'est
disponible sur pas mal de distributions, c'est juste un script perl
à appeler à la place de gcc, et ça rajoute des couleurs. Pour en
profiter, il suffit de glisser dans vos Makefile
::

    CXX=/usr/bin/colorgcc

Avec les autotools, on peut régler ça à l'invocation du script
configure :
::

    ./configure CXX=/usr/bin/colorgcc

Bon. Pas mal. Maintenant, les diff. Au boulot, je n'ai pas mieux
sous la main qu'un svn comme gestionnaire de version. Quand je me
tape des svn diff, j'aime bien que ça soit un peu lisible. Et si on
se mettait ça en couleurs? En lisant un peu la doc, on voit qu'il
suffit de se faire un script. Mettons diffwrap.sh.
::

    #!/bin/sh
    # Configure your favorite diff program here.
    DIFF="/usr/bin/colordiff"
    # Subversion provides the paths we need as the sixth and seventh
    # parameters.
    LEFT=${6}
    RIGHT=${7}
    # Call the diff command
    $DIFF $LEFT $RIGHT
    # Return an errorcode of 0 if no differences were detected, 1 if some were.
    # Any other errorcode will be treated as fatal.

J'ai installé colordiff pour faire le boulot. Il suffit après
d'éditer ~/.subversion/config, et d'ajouter, section [helpers]
::

    diff-cmd = /path/to/diffwrap.sh

Bon ok, mais quand je fais make, j'ai toujours beaucoup de sortie
Il n'y aurait pas moyen de se cantonner aux erreurs gcc lorsqu'il y
en a? Aller, on va baisser un peu ça avec un petit peu (le -j3 est
pour multithreader le make : j'ai un dual core, autant en
profiter).
::

    alias make='make -j3 -s'

Bien entendu, en tant qu'adepte de vim, j'utilise aussi beaucoup
:make. Dans le .vimrc, il peut s'avérer utile de glisser alors:
::

    autocmd BufNewFile,BufRead,BufEnter *.cpp,*.hpp set makeprg=make\ -j3\ -s

Au passage, j'espère que vous connaissiez `omnicppcomplete`_, qui
va chez moi dans la même section du .vimrc:
::

    autocmd BufNewFile,BufRead,BufEnter *.cpp,*.hpp set omnifunc=omni#cpp#complete#Main

On combine tout ça à quelques alias assez connus, et on vit un peu
mieux dans sa console...
::

    # SOME COLORS
    if [ -x /usr/bin/dircolors ]; then
        eval "`dircolors -b`"
        alias ls='ls --color=auto'
        alias dir='dir --color=auto'
        alias vdir='vdir --color=auto'
        alias grep='grep --color=auto'
        alias fgrep='fgrep --color=auto'
        alias egrep='egrep --color=auto'
        alias diff='colordiff'
        alias less='less -R'
    fi

Si vous avez des trucs utiles, n'hésitez pas! Je suis en
particulier à la recherche d'un script vim qui exploiterait un rien
les options 'errorformat' et 'QuickFixCmdPost' afin d'améliorer
encore la lisibilité des compilations dans la fenêtre quickfix.

.. _omnicppcomplete: http://www.vim.org/scripts/script.php?script_id=1520
