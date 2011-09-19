Title: Gérer ses plugins vim avec :GetLatestVimScripts
Date: 2009-11-05 18:52
category: howto
tags: vim

J'ai envie d'attirer l'attention sur une fonctionnalité sympa de
vim, qui pourtant semble méconnue de pas mal de monde, même des
utilisateurs avancés: la commande `:GetLatestVimScripts`, ou son
alias `:GLVS`.

Le principe est simple: vous installez un script pour vim, et vous voulez
que ce script se maintienne à jour (c'est à dire que vous voulez profiter
des versions successives du script par l'auteur).  Au lieu de vous embêter
à vérifier si il y a des nouvelles versions périodiquement et d'avoir à
suivre un procédé d'installation qui differera selon que vous ayez affaire
à un vimscript, un vimball, ou une quelconque archive, vous pouvez tout
simplement dire à vim de gérer tous vos scripts d'un coup. Pour cela, il
vous suffit de maintenir à jour la liste des scripts qui vous intéressent
dans le fichier `~/.vim/GetLatest/GetLatestVimScripts.dat`. Le format de
ce fichier est simple:

    <numéro du script> <numéro de version installée du script> :AutoInstall: <nom du script>

Le numéro du script est dans l'url sur sourceforge, donné par `scriptid`.
La version installée du script est maintenue directement par la commande
`:GLVS`. Si vous voulez être sûr que la mise à jour soit faite, mettez 1.

Maintenant, votre répertoire `~/.vim` est assez facile à transporter. J'ai
pour habitude d'en garder une copie "vide", avec une arborescence sous la
forme:

    \.vim/
        |-GetLatest/
                   |-GetLatestVimScripts.dat

*Un test?*

Vous pouvez tester l'astuce assez simplement: Sauvez votre répertoire
`~/.vim` (si vous en avez un) en le bougeant sous un autre nom, et faites
en un nouveau ou vous recréerez l'arborescence décrite précedemment.
Insérez dans GetLatestVimScripts.dat les lignes suivantes:

    ScriptID SourceID Filename
    --------------------------
    # Les lignes commençant par '#' sont des commentaires
    # Les deux premières lignes sont nécessaires
    #
    # Script permettant d'avoir une complétion grâce à la touche <tab>
    # le premier numéro a été obtenu dans l'url du script:
    # http://www.vim.org/scripts/script.php?script_id=1643
    1643 1 :AutoInstall: supertab.vim

- Ouvrez vim, tapez :GLVS. Le script va se mettre à jour de
  lui-même.
- Vous pouvez tester le script, assez sympa, qui permet de
  compléter les mots que vous tapez avec la touche de tabulation
  (pour savoir comment ça se paramètre, lisez le script, pour
  l'instant sa doc est incluse en commentaire dans le code - j'ai
  proposé au mainteneur un patch avec une vraie doc vim, accessible
  par :help et j'ai bon espoir qu'il l'inclue dans une future
  version)
- Fin de la démo. Vous pouvez supprimer votre répertoire .vim et
  remettre votre ancienne configuration (si vous en aviez une).

Une petite explication supplémentaire s'impose. Le mot clé :AutoInstall:
dans la ligne que j'ai préconisée n'est pas obligatoire. Cela vient du
fait que tous les scripts ne sont pas installables automatiquement (mais
tous sont téléchargeables automatiquement). Cela dit, les scripts
sourceforge sont assez standards et la plupart seront autoinstallables
même si l'auteur du script ne connaissait pas la fonctionnalité. Si jamais
votre script ne s'installe pas correctement, vous pouvez écrire à son
auteur afin qu'il le modifie (ça marche, je l'ai fait [récemment][1] avec
[zenburn][2] en aidant son auteur à le mettre sous forme de vimball) et en
attendant, retirer ce mot clé.

En espérant que ça serve... En bonus, voici la liste des plugins
que j'utilise. C'est très orienté C++. Mon conseil, c'est de vous
abonner au flux rss de vim.org, comme ça vous serez au courant des
plugins sympa qui sortent.

    ScriptID SourceID Filename
    --------------------------
    39   1 :AutoInstall: matchit.zip
    40   1 :AutoInstall: Drawit.vim
    273  1 :AutoInstall: taglist.zip
    294  1 :AutoInstall: Align.vim
    302  1 :AutoInstall: AnsiEsc.vim
    415  1 :AutoInstall: zenburn.vim
    489  1 :AutoInstall: Manpageview.vim
    610  1 :AutoInstall: ctags.vim
    642  1 :AutoInstall: getscript.vim
    1066 1 :AutoInstall: cecutil.vim
    1075 1 :AutoInstall: netrw.vim
    1116 1 :AutoInstall: maplesyrup.tar.gz
    1195 1 :AutoInstall: vis.vba.gz
    1502 1 :AutoInstall: vimball.vim
    1506 1 :AutoInstall: LargeFile.vim
    1520 1 :AutoInstall: omnicppcomplete.zip
    1643 1 :AutoInstall: supertab.vim
    1658 1 :AutoInstall: NERD_tree.zip
    1697 1 :AutoInstall: surround.vim
    2136 1 :AutoInstall: repeat.vim
    2164 1 :AutoInstall: renamec.vim
    2527 1 :AutoInstall: jpythonfold.vim
    2540 1 :AutoInstall: snipMate.zip
    2645 1 :AutoInstall: colourscheme_bandit.vim
    2646 1 :AutoInstall: ctags_highlighting.vba

[1]: http://slinky.imukuppi.org/2009/10/24/zenburn-v2-13/
[2]: http://www.vim.org/scripts/script.php?script_id=415
