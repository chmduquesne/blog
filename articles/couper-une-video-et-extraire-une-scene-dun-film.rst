Couper une vidéo et extraire une scène d'un film
################################################
:date: 2008-04-07 22:28
:category: BonTuyaux
:tags: Howto, Libre

Comme promis dans le dernier billet, voici comment on fait pour
extraire une scène d'un film, par exemple pour en faire un fichier
.gif (cf post précédent)... Pour cela vous utiliserez mencoder :
::

    sudo apt-get install mencoder

Et la syntaxe est la suivante :
::

    mencoder -ss     h:mm:ss    \
             -endpos h:mm:ss    \
             film_origine.avi   \
             -o extrait.avi     \
             -oac copy -ovc copy


-  L'argument de -ss est le temps à partir duquel commence la scène
   à extraire.
-  celui de -endpos est la durée de la scène à extraire (oui, je
   sais, c'est bizarre, j'aurais plutôt mis le temps où finit la
   scène)

En espérant que ça vous serve! PS : Ce billet est assez court, je
compte me rattraper en en faisant un plus substantiel bientôt...

