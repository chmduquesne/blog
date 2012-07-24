Title: De l'intérêt de détacher des programmes de la console (sans screen)
Date: 2010-04-09 09:57
Category: howto
Tags: tmux, irssi, dtach

Qui n'a jamais perdu par erreur une compilation, une session ssh ou
une fenêtre irssi en fermant une console par inadvertance, à cause
d'un lag réseau, ou bien à cause d'un redémarrage brutal de X11?
Les outils présentés ici permettent de vous affranchir de ce genre
de problème. dtach est un petit programme bien pratique qui sert à
détacher un programme de la console où celui-ci tourne. De manière
simple, ça veut dire que si on quitte le terminal dans lequel on a
lancé le programme détaché, on pourra par une courte commande
récupérer ce programme. Exemple, la commande suivante permet de
lancer le programme irssi en détaché, sur le socket /tmp/irssi.sock
(qui sera créé par le programme), où, s'il est déjà lancé, de
récupérer ce programme. `dtach -A /tmp/irssi.sock /usr/bin/irssi`
J'en connais des tas qui ne jurent que par gnu screen. Mais  à quoi
bon, si on peut se contenter d'un simple alias?
`alias irssi='dtach -A /tmp/irssi.sock /usr/bin/irssi'` Jusque là,
je me contentais de deux ou trois alias du genre, et j'avais une
petite fonction au début de mon .zshrc qui me permettait de
toujours lancer mon shell en détaché. Cependant, tout ceci manquant
de souplesse, je me suis intéressé à screen et à ses alternatives,
et je dois dire que je trouve tmux vraiment propre. Je mets de côté
tous les aspects de coupage d'écran en deux, onglets et tutti
quanti, qui  sont plus ou moins inutiles quand on utilise
[un vrai window manager](http://awesome.naquadah.org/). Si screen
et tmux peuvent tous deux ouvrir un nombre illimité de sessions
(screen pouvant, si j'ai bien compris, ouvrir jusqu'à 10 fenêtres
au sein de la même session), tmux offre un mécanisme pour alterner
entre différentes sessions que j'ai cherché en vain dans screen (je
vois d'ici les ardents défenseurs de leur programme favori venir me
crucifier dans les commentaires: tant pis, si ça existe, j'assume
ma mauvaise lecture des pages de manuel). Dans tmux, avec la
configuration par défaut, un simple CTRL-b suivi de s montre une
liste à choix des sessions ouvertes (attachées ou détachées) et il
suffit alors de selectionner une entrée pour que tmux se connecte à
ladite session (et si vous aimez couper l'écran en deux et mettre
plusieurs fenêtres dans la même session, vous pouvez, sans
limitation de nombre). Voici quelques lignes que j'ai rajoutées au
début de mon .zshrc: elles garantissent qu'une nouvelle session
tmux est toujours lancée avec le shell. La fermeture de la session
en cours entraine l'essai de connection à une autre session, sauf
s'il n'y a plus aucune session de lancée.

    # TMUX
    # if no session is started, start a new session
    if test -z ${TMUX}; then
        tmux
    fi
    # when quitting tmux, try to attach
    while test -z ${TMUX}; do
        tmux attach || break
    done

Et désormais je lance irssi de la manière suivante:

    # IRSSI IN TMUX
    # switch to irssi session (and if necessary starts this session before)
    irssi()
    {
        if tmux has -t irssi >/dev/null; then
             tmux switch -t irssi
        else
            TMUX="" tmux new -d -s irssi /usr/bin/irssi
            tmux switch -t irssi
        fi
    }

Si vous utilisez zsh et/ou urxvt, et que vous souhaitez tenter
l'essai, je vous suggère de jeter un coup d'oeil à
[ma configuration](http://github.com/chmduquesne/my-dot-files) (les
problèmes de couleurs et de scrolling y sont réglés). À noter qu'il
existe d'autres alternatives à gnu screen, dont le très prometteur
[neercs](http://caca.zoy.org/wiki/neercs), qui permet entre autre
de détacher des programmes qu'on avait oublié de lancer dans
neercs.



