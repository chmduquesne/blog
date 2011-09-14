vim+gdb=vimgdb
##############
:date: 2009-02-25 00:29
:category: BonTuyaux, Code
:tags: Libre

Ça faisait longtemps que je n'avais pas fait d'article, j'en
profite donc pour rendre hommage au méconnu `vimgdb`_. vimgdb est
un patch pour vim qui permet de débogguer dans vim. On ne vantera
jamais assez les mérites d'un déboggeur (franchement, il y a un
stade où il faut arrêter les fprintf(stdout, "kikoo") et les cout
<<"lol"), que ce soit parce que c'est franchement plus élégant, que
c'est plus le pratique quand on maitrise, ou parce que c'est mille
fois plus puissant. Alors, me direz-vous, chers adeptes de gvim,
qu'il existe déjà un plugin pour vim nommé `clewn`_ (ou voir mieux,
`pyclewn`_) qui fait la même chose sans se taper de recompilation
intempestive de son éditeur favori. Eh bien moi je vous répond: oui
mais dans gvim on ne peut pas retrouver le shell en tapant Ctrl-Z
(ce qui met vim en arrière-plan) et c'est un sérieux handicap pour
les gens comme moi qui apprécient énormément cette feature (au
fait, fg est votre ami si vous découvrez en lisant l'article et que
vous ne savez pas comment revenir à vim). Malheureusement, le
paquet fait défaut sur la plupart des distrib (sauf archlinux, où
je me suis permis de l'ajouter dans `AUR`_ -- si vous avez des
suggestions pour améliorer le pkgbuild, n'hésitez pas). Vous pouvez
donc vous inspirer dudit pkgbuild pour `compiler votre version`_,
ou suivre les indications du site (je vais pas vous dire comment
compiler un programme, quand même!). Après, en installant le plugin
vim pour gdb (comme indiqué dans la procédure du lien précédent),
vous avez accès à tout un cas de commandes sympa (:help gdb pour
l'aide), qui permettent de voir vos variables et de suivre le
déroulement des opérations dans l'éditeur. Cool, non? Preuve que
c'est bien pensé, je n'ai eu à changer aucun des raccourcis par
défaut (J'ai juste changé un "where" en "where all" dans
.vim/macros/gdb\_mappings.vim). Evidemment, il est aussi possible
d'ajouter ses propres mappings ou de modifier ceux qui sont
fournis. N'oubliez pas de rajouter run macros/gdb\_mappings.vim
dans votre .vimrc! Je vous suggère aussi de vous renseigner sur gdb
et de suivre le tuto de `Peter Jay Salzman`_, qui m'a bien initié.
Pour ma part, je conserve aussi dans un coin `un excellent lien`_
qui me sert de référence en cas de trou de mémoire... Bon
déboggage! Si vous souhaitez des screenshots, regardez `par là`_...
PS: apparemment mon pkgbuild a été marqué "out of date", je vais
corriger ça dès que possible...

.. _vimgdb: http://clewn.sourceforge.net/
.. _clewn: http://clewn.sourceforge.net/
.. _pyclewn: http://pyclewn.wiki.sourceforge.net/
.. _AUR: http://aur.archlinux.org/packages.php?O=0&K=vimgdb&do_Search=Go
.. _compiler votre version: http://clewn.sourceforge.net/install.html
.. _Peter Jay Salzman: http://dirac.org/linux/gdb/
.. _un excellent lien: http://www.unknownroad.com/rtfm/gdbtut/gdbtoc.html
.. _par là: http://sourceforge.net/project/screenshots.php?group_id=111038
