Title: vpnc, network-manager et enc_passwd (h4ck3r inside!)
date: 2008-04-17 20:34
category: howto
tags: libre, vpnc, vpn, security

Je me refuse depuis toujours à installer le client vpn cisco
officiel sur ma machine. Non seulement par principe (non libre = le
mal), mais en plus il parait que ce con de programme se casse à
chaque fois qu'on met à jour le noyau. Jusqu'à il n'y a pas si
longtemps, je m'en sortais avec vpnc. Je récupérais sa
configuration à partir du fichier .pcf fournit par mon admin
réseau, le tout grâce à un petit script vachement sympa fournit
avec vpnc : /usr/share/vpnc/pcf2vpnc pour ceux qui sont sous ubuntu
gutsy. Je dis "je m'en sortais"à l'imparfait, car j'ai fini par me
mettre à nm-applet et son plugin vpnc. Le problème de nm-applet,
c'est qu'il ne prend pas en charge les .pcf qui contiennent des
mots de passe obfusqués. Or, malgré le fait que ce soit
complètement stupide, la plupart des gens s'entêtent à vous fournir
des fichiers pcf où malheureusement ces mots de passe sont
obfusqués. Oui, je dis que c'est stupide : du moment qu'on dispose
du fichier .pcf, on peut se connecter. Alors avoir ce mot de passe
en clair ou en crypté ne change rien : la seule chose à laquelle ce
mot de passe sert, c'est se connecter, et pour remplir cette
fonction, les deux marchent. Si vous me trouvez en quoi d'autre ça
peut être dangereux que je dispose de la version non encryptée,
dîtes-le moi... Heureusement, je ne suis pas le seul à penser comme
ça. En cherchant comment faire gérer à nm-applet les mots de passes
obfusqués, j'ai fini par tomber sur un petit programme, qui
décrypte ce fameux mot de passe. Enjoy!
[cisco vpnclient password decoder](http://www.unix-ag.uni-kl.de/~massar/bin/cisco-decode?)
Compilation :

    gcc -Wall -o cisco-decrypt cisco-decrypt.c \
            $(libgcrypt-config --libs --cflags)

Utilisation :

    ./cisco-decrypt DEADBEEF...012345678 424242...7261

Et bien sûr, tout ce code est libre... Sympa, non?



