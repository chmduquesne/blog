Les lecteurs de flux rss, en ligne, indépendants, libres (suite).
#################################################################
:date: 2008-05-02 18:51
:category: Actualité, BonTuyaux, Sécurité
:tags: Libre

Hier, j'expliquais pourquoi je préférais de loin utiliser un
lecteur de flux rss en ligne et je donnais un petit panorama des
web-agregator libres que j'avais pu découvrir. J'ai fait ma petite
étude, et tiny tiny rss sort à mon avis grand gagnant. D'abord,
comme rien ne vaut un petit essai pour se faire une idée, voici des
liens vers les versions de démo que j'ai pu trouver : Tiny tiny rss
-> [`site`_] [`démo`_] :

-  Sait aggréger plusieurs flux pour en former un seul dont vous
   pourrez donner l'adresse à vos amis
-  Peut marcher sous PostgreSQL comme sur MySQL
-  Gestion des tags par des règles de filtrage très facile à
   utiliser
-  Sait s'autentifier pour lire des flux protégés (autentification
   simple, le https n'est pas encore supporté)
-  navigation clavier intuitive (vim-like, comme gmail)
-  bénéficie d'une `extension firefox pour les notifications`_
-  développement très actif
-  installation difficile chez free (bug dans l'importation d'opml,
   voir les commentaires du billet précédent pour corriger ça, et les
   tags ne marchent pas du tout)

gregarius -> [`site`_] [`démo`_] :

-  ne marche qu'avec mysql, mais par contre buggue moins
-  un énorme avantage : supporte des thèmes et des plugins divers
   et variés``_
-  La navigation clavier est moins intuitive et moins complète
-  installation super facile
-  a aussi une bonne intégration avec firefox, mais pas de système
   de notification.
-  développement moins actif

Je n'ai pas trouvé de version de test disponible pour feed on feeds
->[`site`_]. Sachez que Feed on feeds est assez vieux et que s'on
développement est apparemment arrêté. Il a donné lieu à deux
projets : FoFredux ->[`site`_] [`démo`_] et à MonkeyChow
->[`site`_], pour lequel je dispose simplement d'un `screencast`_
(en flash, beurk). Je n'ai pas poussé beaucoup mes tests, car aucun
d'eux n'a vu de nouvelle version sortir depuis 2006, ce qui est
selon moi trop vieux pour espérer voir maintenus ces projets qui
semblent par ailleurs assez prometteurs. En résumé, je ne retiens
que deux projets : Tiny tiny rss et gregarius. Même si gregarius et
beaucoup plus facile à installer, plus stable et bénéficie d'un
très bon système de plugins, ma préférence se porte sur Tiny tiny
rss, qui a un développement plus dynamique, et surtout dont
l'interface se révèle bien plus agréable et rapide à utiliser : si
j'ai un lecteur de flux rss, c'est pour gagner en productivité.

.. _site: http://tt-rss.org/trac/
.. _démo: http://tt-rss.org/demo/tt-rss.php
.. _extension firefox pour les notifications: https://addons.mozilla.org/firefox/3342/
.. _site: http://gregarius.net/
.. _démo: http://rss.gregarius.net/
.. _site: http://feedonfeeds.com/
.. _site: http://fofredux.sourceforge.net/
.. _démo: http://code.highearthorbit.com/fofredux/fofredux_demo/view.php
.. _site: http://sourceforge.net/projects/monkeychow/
.. _screencast: http://www.shokk.com/mc.html
