Title: gdb 7.0 est sorti, c'est une merveille et vous ne le saviez pas.
Date: 2009-10-06 19:19
Category: misc
Tags: gdb

L'annonce vient de tomber sur la mailing liste : gdb vient de sortir dans
sa version 7.0! Vous vous dîtes: "Bof, gdb je connais, une nouvelle
version d'un débogueur qui sort, il n'y a pas de quoi fouetter un chat."
Détrompez-vous!  Les progrès apportés sont tels que je n'allais pas vous
laisser les ignorer.  Je veux bien entendu parler du "reverse debugging".
Hein? C'est quoi? Bon, j'explique : normalement, dans un debugger (ou un
"débogueur", en bon français), on déroule le programme toujours dans le
même sens. Et ben maintenant, on a la possibilité de revenir en arrière!
Dans le concept, c'est un peu comme rembobiner un film, mais pour un
programme. Donc voilà, par exemple, on avait "c" pour "continue", on a
maintenant "rc" pour "reverse continue".

Bon, ça paye pas de mine, comme ça, mais à faire c'est probablement assez
compliqué. Ça fait tellement longtemps qu'on parle d'ajouter cela dans gdb
que ça justifie amplement le passage direct de 6.8 à 7.0 dans les numéros
de versions. Ça explique aussi pourquoi les développeurs la qualifiaient
d'avance de "major release".

Là, on marque une pause et on s'incline. Ceux qui savent comment
fonctionne un ordinateur se demandent comment ça peut bien marcher (allez
regarder le code source, les gars). On se rend compte de l'exploit
technique que ça doit représenter, on y ajoute une petite réflexion sur le
nombre d'architectures que le machin supporte, et on se dit que
décidemment il y a des gens très forts.

Je ne m'arrête pas en si bon chemin. Ceux qui ont tenté d'utiliser gdb ont
probablement aussi un assez mauvais souvenir de la maniabilité du
programme.  C'est pas très, comment dire...  "user friendly". Bon, pour
répondre à ces gens là je ne vous promets pas de miracle, mais sachez que
gdb est devenu scriptable en python. Ça promet d'améliorer sérieusement sa
souplesse, mais aussi, mon petit doigt me dit qu'on devrait probablement
voir de nouveaux front-end ultra souples voir le jour. Voilà pour mes
features préférées, mais il y en a d'autres. Je vous lie la fameuse
annonce, qui vaut son pesant de cacahuètes. Vivement que ma distribution
le package.

[L'annonce](http://www.gnu.org/software/gdb/download/ANNOUNCEMENT)
[La nouvelle doc sur le reverse debugging](http://sourceware.org/gdb/download/onlinedocs/gdb_7.html#SEC51)



