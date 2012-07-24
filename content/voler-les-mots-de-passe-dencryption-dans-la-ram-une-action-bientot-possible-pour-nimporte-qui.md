Title: Voler les mots de passe d'encryption dans la RAM, une action bientôt possible pour n'importe qui.
Date: 2008-04-25 01:26
Category: misc
Tags: security, password

Voici une news qui va intéresser les hackers. Dans un des premiers billets
de ce blog, je parlais de [comment chiffre un disque dur][1] de manière à
ce que celui-ci soit indéchiffrable si votre ordinateur se faisait voler.
Cette technique comporte une faille majeure, qui à ce jour ne connait pas
de solution : si votre ordinateur est allumé au moment du vol, même
verrouillé en veille avec un mot de passe, on pouvait, moyennant assez peu
de moyens, récupérer au vol votre mot de passe en clair directement dans
la mémoire vive (j'en parlais aussi).  Puisqu'aucune solution de
protection n'était connue, les chercheurs à l'origine de la démonstration
"proof of concept" de la faille avaient choisi de ne pas mettre en ligne
le code permettant d'exploiter celle-ci. Ce point de détail n'est plus
complètement vrai : désormais, on peut trouver en ligne un système
bootable sur clef usb, qui permet de récupérer, pour peu que votre
ordinateur ne soit pas éteint depuis plus d'une minute, le contenu
intégral de la RAM afin de l'analyser ultérieurement. Il s'agit de
msramdump, que l'on peut trouver à cette adresse :
[http://www.mcgrewsecurity.com/projects/msramdmp/](http://www.mcgrewsecurity.com/projects/msramdmp/)
De là à penser que le code pour récupérer ce mot de passe sera disponible
bientôt d'une façon ou d'une autre, il n'y a qu'un pas...

[1]: comment-crypter-vos-partitions-sous-ubuntu.html
