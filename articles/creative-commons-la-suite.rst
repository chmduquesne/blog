Gérer la licence creative commons de votre blog wordpress
#########################################################
:date: 2008-03-23 11:16
:category: VieDuBlog
:tags: Libre

Je vous parlais
`du fait que j'avais mis ce blog sous licence creative commons`_.
Je me suis dit qu'il devait bien y avoir un plugin qui gérait ça
mieux que moi et mon vieux code copié collé. J'ai fini par trouver
un plugin qui était sensé gérer le passage de la licence à travers
les flux rss, il s'agit de `Creative Commons Configurator`_. Voici
la liste des features (sous licence `CC-BY-NC-SA`_, plus
restrictive que la mienne, c'est donc celle-ci qui s'applique à ce
post)
    
    -  Configuration page in the WordPress administration panel. No
       manual editing of files is needed for basic usage.
    -  License selction by using the web-based license selection engine
       from `CreativeCommons.org`_.
    -  The license information can be reset at any time. This action
       also removes the options that are stored in the WordPress database.
    -  Adds license information to:
       
       -  The HTML head area of the every blog page (this is for search
          engine bots only - Not visible to human visitors).
       -  The Atom, RSS 2.0 and RDF (aka RSS 1.0) feeds through the
          `Creative Commons RSS module`_, which validates properly. This
          option is compatible **only** with WordPress 2 or newer due to
          technical reasons. It will not appear on versions older than 2.0.
       -  Displays a block with license information under the published
          content. Basic customization (license information and formatting)
          is available through the configuration panel.

    -  Some template tags are provided for use in your theme templates.
    -  The plugin is ready for **localization**.


Je me suis amusé à traduire rapidement en français le texte
affiché. Je met en ligne `ma version modifiée`_, pour ceux que ça
intéresse. À priori, (et d'après mes tests) cette modification du
flux rss est invisible pour le lecteur. Il s'agit donc d'un tag xml
rajouté pour les machines. Çela permet d'être moins envahissant...
Je n'ai pas proposé ma traduction à l'auteur original
`*George Notaras*`_, car celle-ci est très partielle. Seul ce qui
s'affiche au lecteur du blog a été traduit en français. Le reste de
la gestion est toujours en anglais... [suite...] En continuant mes
recherches, je me suis rendu compte que j'avais trop vite survolé
les fonctionnalités du plugin officiel `Wplicense`_, qui gère en
fait lui aussi la transmission de la licence à travers le flux de
syndication (`dès la version 0.6`_). J'ai fini par re-basculer sur
celui-ci (bien que creative commons configurator offre plus de
souplesse dans la gestion) car je trouve qu'il est plus discret et
qu'il s'intègre mieux au site...

.. _du fait que j'avais mis ce blog sous licence creative commons: http://chm.duquesne.free.fr/blog/?p=14
.. _Creative Commons Configurator: http://www.g-loaded.eu/2006/01/14/creative-commons-configurator-wordpress-plugin/
.. _CC-BY-NC-SA: http://creativecommons.org/licenses/by-nc-sa/3.0/
.. _CreativeCommons.org: http://creativecommons.org/
.. _Creative Commons RSS module: http://backend.userland.com/creativeCommonsRssModule
.. _ma version modifiée: http://chm.duquesne.free.fr/blog/wp-content/cc-configurator.zip
.. _*George Notaras*: http://chm.duquesne.free.fr/blog/wp-admin/Published%20on%20February%2025th,%202008%20by%20George%20Notaras%20%20-%20%20Comments%20:%202
.. _Wplicense: http://wiki.creativecommons.org/WpLicense
.. _dès la version 0.6: http://wiki.creativecommons.org/WpLicense_Release_History#wpLicense_0.6.0
