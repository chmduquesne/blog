Un petit truc à propager sur la gestion de vos mots de passe.
#############################################################
:date: 2010-01-23 18:37
:category: misc
:tags: supergenpass, password

Dans un article intitulé `je connais ton mot de passe`_, freenews
vient de nous pondre une nouvelle preuve que la plupart des gens
n'ont strictement rien à faire que n'importe quel clampin avec un
peu trop de temps libre (ou, au choix, de mauvaises intentions)
puisse trouver en quelques secondes leur mot de passe. Alors,
évidemment, on connait tous les précautions d'usages: ça consiste
en gros à avoir un mot de passe différent pour chaque site et à en
faire un truc assez long et assez compliqué si bien que l'on va
l'oublier en deux secondes. Évidemment, soit on se balade avec un
calepin plein de mots de passes (oui mais si on perd ce calepin?),
soit on a un fichier crypté dans lequel on garde tout (oui mais si
on efface ce fichier?), soit on fait comme tout le monde: un mot de
passe simple, toujours le même, partout, et un (ou plusieurs, si on
est très très consciencieux) mot(s) de passe(s) compliqué(s) pour
les trucs importants (la banque, les achats en lignes, les mails,
le boulot). Afin de vous aider à remédier à cela, je vous propose
d'utiliser une astuce que je pensais connue mais qui finalement ne
l'est pas tant que ça. Alors attention, parmi mes amis, je pense
être pratiquement le seul à utiliser la technique suivante, et
pourtant celle-ci n'est pas contraignante et résout tous ces
problèmes de sécurité. Je vous présente donc `supergenpass`_,
`password hasher`_ et `hashapass`_. La première et la troisième
méthode sont des bookmarklets, la seconde est une extension
firefox. Je vais revenir sur les détails, mais en gros elles ont
toutes les trois le même principe: elles prennent en entrée un mot
de passe et le nom du site, et génère un mot de passe spécifique au
site qui obéit à tous les beaux critères du mot de passe parfait.
Je ne rentre pas dans les détails, je connais les 3 méthodes, je
les ai toutes testées et je vais tout de suite vous donner ma
préférée, c'est supergenpass. Pourquoi? - elle est disponible comme
application android - elle a plusieurs versions scriptées (perl,
python) et donc on peut l'invoquer dans une console - elle devine
le nom du site avec lequel "mélanger" le mot de passe J'ai
longtemps fonctionné avec password hasher, mais cette extension a
l'inconvénient majeur de ne pas être disponible en mode console et
de ne pas du tout être pratique/portée sur tous les autres
navigateurs (or je suis passé à `uzbl`_). À noter qu'avec toutes
les options par défaut, il est équivalent d'utiliser hashapass, qui
fournit une version console (la ligne de commande est très simple,
ce qui me plaisait bien). Le problème de ce dernier, c'est qu'il ne
faisait pas d'autodétection du nom du site, ce qui rend beaucoup
plus contraignante son utilisation et lui fait donc perdre
énormément d'intérêt (le but, c'est que la méthode soit rapide et
ne fasse pas perdre du temps par rapport à l'utilisation d'un mot
de passe "classique"). Faites passer le truc!

.. _je connais ton mot de passe: http://www.freenews.fr/spip.php?article7661
.. _supergenpass: http://supergenpass.com/
.. _password hasher: https://addons.mozilla.org/en-US/firefox/addon/3282
.. _hashapass: http://www.hashapass.com/
.. _uzbl: http://www.uzbl.org
