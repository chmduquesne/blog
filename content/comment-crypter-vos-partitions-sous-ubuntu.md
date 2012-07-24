Title: Comment crypter vos partitions sous ubuntu
Date: 2008-03-14 01:10
Category: howto
Tags: libre, dm-crypt, luks

*Attention*

Cet article date de 2008. Peut-être vaut-il mieux rechercher des sources
plus récentes?

*Introduction*

D'abord, la mauvaise nouvelle: tout cela ne servira à rien si on vous vole
votre ordinateur allumé, même verrouillé.  Il a été montré, vidéos à
l'appui, que dans ce cas on pouvait casser facilement ces beaux mécanismes
de protection avec un tournevis, une bombe à froid, un autre ordinateur et
10 minutes devant soi. Vous ne pourrez donc pas vous amuser à laisser
trainer votre ordinateur n'importe où sans surveillance. D'autre part,
sachez que cela fait perdre la possibilité d'utiliser le mécanisme de
veille prolongée. C'est le prix à payer pour la sécurité ;) la fameuse
vidéo, la voilà:

<iframe width="420" height="315" src="http://www.youtube.com/embed/JDaicPIgn9U" frameborder="0" allowfullscreen></iframe>

*C'est contraignant?*

Non. Cela impose juste de taper un mot de passe à chaque démarrage.
Après, vous pouvez utiliser votre système normalement: le mécanisme est
totalement transparent et le chiffrement/déchiffrement se fait à la volée.
Au passage, pour les accrocs de l'économie CPU, l'algorithme est
apparemment assez intelligemment codé et je n'ai constaté aucune baisse de
performances perceptible.

*Les manips*

Nous chiffrerons /home et /swap. Pour cela, vous aurez besoin d'une
partition libre (votre futur /home). Commencez par installer dm-crypt :

    sudo apt-get install dm-crypt

Partons du principe que vous avez choisi d'utiliser /dev/sda3 pour
votre nouvelle partition cryptée. Démontez-le.

    sudo umount /dev/sda3

Le [wiki anglais d'ubuntu][1] suggère de vérifier que votre partition se
porte bien, puis de la remplir de données aléatoires. Comme c'est long, si
vous êtes sûr que votre disque marche bien et que cette partition n'a rien
contenu de secret avant, laissez tomber et passez directement à la
creation de votre nouvelle partition LUKS :

    sudo cryptsetup
        --verify-passphrase\
        --verbose --hash=sha256\
        --cipher=aes-cbc-essiv:sha256\
        --key-size=256 luksFormat\
        /dev/sda3

Ensuite, faites ouvrir votre volume par cryptsetup :

    sudo cryptsetup luksOpen /dev/hda3 home

Puis créez-y le système de fichiers :

    sudo mke2fs\
        -j -O dir_index,filetype,sparse_super\
        /dev/mapper/home

On va temporairement monter cette partition chiffrée (sur /mnt), pour y
copier votre ancien home.

    sudo mount -t ext3 /dev/mapper/home /mnt

À ce moment là, plusieurs choix. Première possibilité, vous *pourriez*
recopier tout votre /home dans cette nouvelle partition :

    sudo cp -axv /home/* /mnt/

Je préfère m'y prendre autrement : j'ai fait le choix de continuer à me
servir de l'ancien /home pour y stocker toutes les données non
confidentielles (films, musiques, fonds d'écrans...). Si vous voulez faire
comme moi, créez d'abord le futur répertoire pour votre /home/user et
attribuez vous les droits :

    sudo mkdir /mnt/user && sudo chown user:user /mnt/user

Puis copiez tout, sauf les répertoires que vous voulez garder sur
l'ancienne partition.

    for i in `ls --almost-all /home/user
                                  --ignore videos\
                                  --ignore images\
                                  --ignore musique`;\
    do\
        sudo cp -avx $i /mnt/user/;
    done

Note pour ceux qui veulent appliquer la commande : 'ls --almost-all
/home/user' va lister tous les fichiers de /home/user, sauf les
répertoires spéciaux '.' et '..'. Je rajoute l'option '--ignore
nomdefichier' lorsque je veux éviter qu'un fichier nommé 'nomdefichier'
apparaisse dans la liste résultante. Ainsi, en français, cela donne :
"pour i appartenant à l'ensemble des fichiers de /home/user, sauf ceux qui
s'appellent 'images', 'musique' ou 'videos' (i.e. les répertoires dans
lesquels je conserve ma musique, mes images, mes vidéos), copier i dans
/mnt/user/ ( -avx : récursivement, en préservant au maximum les droits,
liens, propriétaires, dates, contexte de sécurité, etc; en explicitant ce
qui est copié; en gardant le même système de fichier)" C'est bon! Vous
effacerez les données chiffrées une fois que vous serez certain que ça
marche. Démontez:

    sudo umount /mnt

Éditez */etc/fstab* pour un montage automatique de votre nouveau /home
chiffré au démarrage : ajoutez y la ligne suivante (et commentez celle de
l'ancien home).

    /dev/mapper/home /home ext3 defaults 1 2

Éditez */etc/crypttab* ajoutez-y cette ligne :

    home /dev/hda3 none luks

C'est fini! Vous pouvez redémarrer.

*Cryptage du swap*

Vous allez être déçu, ça se fait en deux secondes : ouvrez */etc/fstab*,
commentez la ligne du swap. Celle-ci devrait être de la forme :

    /dev/sda5 none swap sw 0 0

Maintenant faites un simple remplacement de /dev/sda5 par
/dev/mapper/cswap :

    /dev/mapper/cswap none swap sw 0 0

Et ouvrez */etc/cryptab* pour lui dire de chiffrer aléatoirement le swap à
chaque démarrage en y ajoutant la ligne :

    cswap /dev/sda5 /dev/random swap

Voilà! C'est fini!

*Conclusion*

Vous faites désormais partie des paranoïaques qui cryptent leurs données.
Savourez cet instant... Si vous voulez des références sur le cryptage de
partition, il existe aussi [une liste de tutos faits par cep][2] sur le
forum d'ubuntu-fr.org...


[1]: https://help.ubuntu.com/community/EncryptedFilesystemHowto3
[2]: http://http://forum.ubuntu-fr.org/viewtopic.php?id=20840
