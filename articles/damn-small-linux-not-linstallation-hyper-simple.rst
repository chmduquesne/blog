Damn Small Linux (Not) : l&#039;installation hyper simple
#########################################################
:date: 2008-03-19 01:52
:category: BonTuyaux
:tags: Libre, Ubuntu

Malgré le fait que je pense qu'avoir un linux sur une clé usb est
en fait assez inutile, il fut une époque où je m'amusais à suivre
mille tutoriels pour arriver à - miracle - booter sur un système
tenant sur 50Mo. Après avoir constaté les limites d'untel système,
j'étais tranquillement retourné à la normale, sous mon ubuntu, et
j'avais oublié mes aventures rocambolesques avec un des systèmes
les plus compact au monde. En fait il se trouve que c'est pas si
inutile que ça, puisque mon pote Max, qui avait planté son mac dont
le lecteur cd est cassé, et a qui j'avais parlé de mes
expérimentations, voulait m'emprunter la fameuse clef pour
investiguer sur son ordi. Le problème, c'est que j'avais fini par
formater cette clef. J'ai donc dû me taper à nouveau tous les bons
vieux tutos. Or, comme c'est long et chiant de creuser partout pour
avoir ce qu'on cherche (et encore plus la deuxième fois). Je vous
donne donc la méthode la plus courte que j'ai trouvé (si vous êtes
sous ubuntu ou debian, bien sûr). J'ai choisi d'installer DSL-N (is
not `DSL`_!). En gros, c'est comme DSL, mais c'est un peu plus gros
: au lieu de tenir sur 50Mo, ça doit tenir sur 100, et ça permet
une meilleure reconnaissance du matériel, des programmes plus
jolis, du gtk, etc... En plus DSL est basée sur knoppix, lui-même
basé sur debian, et moyennant quelques manip que vous trouverez sur
le `wiki officiel`_, vous pouvez la rendre complètement
debian-compatible (en faire un OS qui supporte les installations
type apt-get). Les infos que je donne sont valables qu'on installe
DSL ou DSL-N. Commencez par télécharger la bête. Ça se passe
`ici pour DSL`_ et `ici pour DSL-N`_. Prenez le miroir qui vous
plait et téléchargez-y le .iso le plus récent. Mettez le dans /tmp,
comme ça vous pourrez l'oublier après avoir fait vos manips...
Ensuite, il faut installer gparted et syslinux. (Oui, je sais, pour
gparted, on pourrait se débrouiller avec fdisk, mais je trouve
gparted bien fait et facile d'utilisation)
::

    sudo apt-get install gparted syslinux

Puis utilisez gparted : formatez votre clef en FAT16 (mieux
supporté) et mettez lui un drapeau de boot, le tout à coups de
clics droit. Ensuite, montez temporairement l'iso téléchargé
quelque part avec l'option '-o loop' (/mnt est fait pour ça, mais
vous faites comme vous le voulez). Ça donne un truc du style :
::

    sudo mount /tmp/dsl.iso /mnt -o loop

Puis copiez le contenu de /mnt (ou du 'quelque part' où vous avez
monté) dans votre clef. Après cela, dans votre clef, cherchez le
répertoire isolinux (il se trouve probablement dans le répertoire
boot) et mettez tous les fichiers qu'il contient sur la racine de
la clef. Renommez 'isolinux.cfg' en 'syslinux.cfg'. Une fois tout
cela accompli, démontez la clef. Faites un petit
::

    syslinux /dev/sdX1

en adaptant le X à votre cas. C'est fini! Rebootez, pour faire un
test... Petit conseil en passant : allez sur le wiki, il est
bien...

.. _DSL: http://fr.wikipedia.org/wiki/Damn_Small_Linux
.. _wiki officiel: http://damnsmalllinux.org/wiki/
.. _ici pour DSL: http://damnsmalllinux.org/download.html
.. _ici pour DSL-N: http://damnsmalllinux.org/dsl-n/download.html
