Voler les mots de passe d&#039;encryption dans la RAM, une action bientôt possible pour n&#039;importe qui.
###########################################################################################################
:date: 2008-04-25 01:26
:category: Actualité, Sécurité
:tags: Libre

Voici une news qui va intéresser les hackers. Dans un des premiers
billets de ce blog, je parlais de
`comment crypter un disque dur de manière à ce que celui-ci soit indéchiffrable si votre ordinateur se faisait voler`_.
Cette technique comporte une faille majeure, qui à ce jour ne
connait pas de solution : si votre ordinateur est allumé au moment
du vol, même verrouillé en veille avec un mot de passe, on pouvait,
moyennant assez peu de moyens, récupérer au vol votre mot de passe
en clair directement dans la mémoire vive (j'en parlais aussi).
Puisqu'aucune solution de protection n'était connue, les chercheurs
à l'origine de la démonstration "proof of concept" de la faille
avaient choisi de ne pas mettre en ligne le code permettant
d'exploiter celle-ci. Ce point de détail n'est plus complètement
vrai : désormais, on peut trouver en ligne un système bootable sur
clef usb, qui permet de récupérer, pour peu que votre ordinateur ne
soit pas éteint depuis plus d'une minute, le contenu intégral de la
RAM afin de l'analyser ultérieurement. Il s'agit de msramdump, que
l'on peut trouver à cette adresse :
`http://www.mcgrewsecurity.com/projects/msramdmp/`_. De là à penser
que le code pour récupérer ce mot de passe sera disponible bientôt
d'une façon ou d'une autre, il n'y a qu'un pas...

.. _comment crypter un disque dur de manière à ce que celui-ci soit indéchiffrable si votre ordinateur se faisait voler: http://chm.duquesne.free.fr/blog/?p=8
.. _`http://www.mcgrewsecurity.com/projects/msramdmp/`: http://www.mcgrewsecurity.com/projects/msramdmp/
