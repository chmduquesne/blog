Title: [pour les vim-users] Vimperator 1.0 est sorti!
date: 2008-05-14 23:25
category: misc
tags: vim, vimperator

Hello à vous, geek obscurs ou simplement gens curieux qui venez
voir ce post par curiosité!
[Vimperator](http://vimperator.mozdev.org/source.html), pour les
vimistes qui ne connaissent pas (se pourrait-il qu'il en existe?),
c'est l'extension ultime pour firefox ([Vim](http://vim.org), c'est
l'éditeur trop bien en ligne de commande qui apparait dans la
plupart des distributions linux lorsque vous tapez "vim" dans un
terminal) : cette extension vous permet de naviguer... avec les
commandes de vim (!) donc sans toucher à votre souris... Donc j,k,
et h,l pour scroller verticalement et horizontalement, f pour faire
apparaitre les liens (on tape le début du lien pour cliquer dessus
ou bien on entre le raccourci clavier qui apparait en rouge juste à
côté), shift+h et shift+l pour avancer ou reculer dans
l'historique... etc. Même si ça a nécessité un petit temps
d'adaptation, je ne navigue plus que comme ça (en plus, vous gagnez
en place sur votre navigateur, puisque la barre d'adresse et les
menus sont inutiles!). Cette extension est en intense développement
et pour l'instant, le seul moyen d'obtenir la version 1.0 est de la
compiler du cvs :

    cvs -d :pserver:guest@mozdev.org:/cvs login
    cvs -z3 -d :pserver:guest@mozdev.org:/cvs co vimperator/src vimperator/www

Cette version cvs, vous ne pourrez la faire tourner que sous
firefox3 (la version précédente existe pour firefox2, mais
honnêtement elle est assez limitée). Attention, si vous venez de
l'extension pour firefox2, lisez bien le manuel : certaines
commandes ont changé. Par exemple, pour échapper vimperator, ça
n'est plus shift+i mais ctrl+q. La principale feature gagnée est
que l'on peut copier coller du texte en passant en mode visuel
(shift+i pour entrer en CARET mode, puis v comme sous vim), et vous
pouvez éditer les champs directement avec gvim (avec ctrl+i). La
mailing list des développeurs foisonne d'informations et de bons
tuyaux, mais surtout, c'est sur le
[wiki](http://vimperator.cutup.org/index.php?title=Main_Page) que
vous trouverez votre bonheur. Bonne navigation!



