Title: Makepasswd, un utilitaire sympa pour générer des mots de passe
Date: 2008-03-19 03:16
Category: howto
Tags: makepasswd

On ne pouvait pas parler de sécurité sans aborder ce sujet. Comment
choisir un bon mot de passe? C'est la partie qui me bloque à chaque
fois. Trop simple/court, il est faible. Trop long/compliqué, on ne
le retient pas. Le choix est crucial. Pour vous en convaincre :

-   [comment s'y prennent les programmes qui cassent vos mots de passe, de Bruce Schneier (en)](http://www.schneier.com/essay-148.html)
-   [le top 10 des mots de passe les plus utilisés](http://www.threadwatch.org/node/14095)
-   [Où trouver de bonnes listes de mots pour les attaques dictionnaires (aircrack-ng.org)](http://www.aircrack-ng.org/doku.php?id=faq&s=dictionnary#where_can_i_find_good_wordlists)

J'en profite donc pour mettre en valeur un petit outil à la cool :
makepasswd. Il est dans les dépôts ubuntu et s'installe avec
apt-get. makepasswd perlet de générer un mot de passe aléatoire.
Vous pouvez lui passer des options, pour gérer tout un tas de
choses :

-   forcer la longueur du mot de passe '--char N'
-   en faire plusieurs d'affilée '--count N'
-   forcer à prendre les charactères dans un ensemble donné
    '--string STRING' (utile si vous voulez éviter certains caractères
    spéciaux dont la disposition va changer d'un clavier à l'autre)
-   et d'autres...

Si vous êtes en panne d'inspiration, ce programme peut vous être
utile (De même, si vous êtes webmaster et que vous souhaitez
renvoyer un nouveau mot de passe à un utilisateur qui aurait perdu
ses identifiants...). Pour finir, deux liens vers des site donnant
des conseils pas trop mauvais pour faire vos propres mots de
passe.

-   [chez orange, je les ai trouvé pas mal](http://assistance.orange.fr/12.php?dub=2&)
-   [ceux de commentçamarche sont bien aussi.](http://www.commentcamarche.net/faq/sujet-8275-choisir-un-bon-mot-de-passe)



