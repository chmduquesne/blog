Title: Coup de gueule : mettez vous à openPGP!
Date: 2008-06-07 16:36
Category: misc
tags: gnupg, openpgp

Si vous posez la question, même aux plus purs geeks que vous
rencontrez : "et toi tu utilises openPGP pour signer tes mails?",
et bien vous pouvez être sûr que la réponse sera "non." pour la
plupart d'entre eux. L'excuse (mauvaise) qu'on vous sort dans ce
genre de cas, c'est le webmail : "J'utilise un webmail, donc ça
n'est pas possible pour moi d'utiliser openPGP".

Eh bien sachez que cette excuse n'en est pas une.  Par exemple,
l'extension firefox [FireGPG](http://getfiregpg.org/) sait très bien
signer vos mails.  Pourtant, falsifier un mail, c'est
[facile](http://www.tech-faq.com/lang/fr/send-fake-mail.shtml).  Vraiment,
je vous assure! c'est une des premières choses que j'ai appris à faire en
réseaux. Le protocole d'envoi de mails, smtp (Simple Mail Transfer
Protocol), ne sait tout simplement pas vérifer l'identité de l'expéditeur
et ne sait pas non plus empêcher les serveurs de mails (que n'importe qui
peut mettre en place - donc vous aussi) de modifier le corps des messages.

J'ai envoyé des mails en tant que
[benoitXVI@vatican.it](mailto:benoitXVI@vatican.it), alors que je savais à
peine utiliser une ligne de commande (dans le cadre de TP et uniquement au
sein de mon école, rassurez-vous). Et tout le monde, que ce soit gmail,
yahoo, [placez ici votre fournisseur] fait pourtant confiance à ce
protocol foireux parce que c'est tout simplement le standard.

Alors voilà : vous avez FireGPG, vous avez
la même chose pour Thunderbird, il n'y a pas d'excuse pour ne pas
s'y mettre! Le principe est simple : vous envoyez votre mail, il
est signé automatiquement grâce à un système de clefs que vous avez
généré auparavant. La signature permet au correspondant (s'il
utilise aussi openpgp) de s'assurer que c'est bien vous qui avez
envoyé ce mail, et que ce mail n'a pas été modifié. Vous avez même
la possibilité d'envoyer des mails cryptés à vos correspondants,
que eux seuls pourront ouvrir.

Je gueule donc un petit coup. À tous ceux qui me lisent : chiffrez vos
mails, ou au moins signez-les! Ça coûte rien, c'est super facile à mettre
en place et ensuite c'est automatique. Vous voyez une raison de ne pas le
faire? Moi non. PS (Pour mes propres correspondants) : et arrêtez de
m'embêter en disant que ça sert à rien. OpenPGP c'est le bien.

[Le principe de PGP (wikipedia)](http://fr.wikipedia.org/wiki/Pretty_good_privacy)
[L'implémentation libre d'openPGP avec gnuPG (wikipedia)](http://fr.wikipedia.org/wiki/GNU_Privacy_Guard)
[Utiliser gnuPG (ubuntu-fr)](http://doc.ubuntu-fr.org/gnupg)
[Utiliser PGP facilement avec l'extension enigmail de thunderbird (ubuntu-fr)](http://doc.ubuntu-fr.org/enigmail)



