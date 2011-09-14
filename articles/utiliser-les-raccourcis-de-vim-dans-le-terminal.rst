Utiliser les raccourcis de vim dans le terminal
###############################################
:date: 2008-06-06 21:43
:category: BonTuyaux
:tags: Libre

Je viens de découvrir ça sur `le wiki des astuces de vim.org`_ : on
peut éditer ses lignes de commande avec vim! Pour résumer le lien
ci-dessus, il vous suffit de créer ~/.inputrc et d'y placer les
lignes suivantes :
::

    # les deux lignes importantes
    set editing-mode vi
    set keymap vi
    
    # Exemple de chose sympa à ajouter:
    # deux fois echap pour faire un clear
    "\e\e": "\C-a\C-k"

À partir de ce moment là, vous pouvez utiliser echap pour passer an
mode normal et éditer votre ligne de commande (par défaut, on est
en mode insert). Je suis fan, ça va encore me faire gagner du
temps...

.. _le wiki des astuces de vim.org: http://vim.wikia.com/wiki/Use_vi_shortcuts_in_terminal
