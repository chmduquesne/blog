Google suppporte(rait) désormais openid (et c&#039;est pas officiel)
####################################################################
:date: 2008-04-10 00:54
:category: Sécurité
:tags: Libre

Voilà, une petite news en vitesse... Je viens de découvrir ça sur
le `flux rss de delicious`_. Si vous avez un compte google, vous
pouvez tester en vous rendant ici :
`http://openid-provider.appspot.com/`_ Sympa, non? qu'en
pensez-vous? [Edit :] (suite aux sages commentaires de `Pti-Seb`_
et Awikatchikae) En fait, `Techcrunch[UK]`_ avait déjà annoncé en
janvier que google avait l'intention d'entrer dans le mouvement
openid cette année (annonce reprise par `openid blog`_ par la
suite). Ceci va donc dans le sens de ces annonces. Cependant : il
est vrai (j'aurais du vérifier) que google n'a fait aucune annonce
à ce propos sur son blog officiel. Mon post est donc à prendre avec
des pincettes. Par ailleurs, précisons que si tout cela est bien
vrai, google devient **fournisseur** d'openid, à savoir que vous
pourriez désormais, si vous le souhaitez, utiliser votre compte
google comme compte openid (à la différence d'avant, où google
supportait déjà les openid sur blogger, mais n'en fournissait pas).
[Edit 2 : ] Après quelques recherches, j'ai fini par tomber sur le
blog de Brian Barret, développeur de Google App Engine, qui y fait
`l'annonce de cette nouvelle feature`_. On peut donc
raisonnablement penser qu'il n'est pas dangereux de tenter
l'expérience (ce que j'ai fait, d'ailleurs, car ça faisait
longtemps que je souhaitais tester openid). Toutefois, il ne s'agit
pas d'un produit officiel Google :
    it's just a sample app for App Engine; it's definitely not a
    full-fledged, official Google product.

D'après ce que j'ai compris (et lu dans son cv), notre ami est, à
ses heures perdues, contributeur du projet openid. C'est ce qui
l'aurait poussé à implémenter openid (et d'autres choses rigolotes)
chez google...
    When I found extra time, though, I had a lot of fun writing apps
    and libraries on top of App Engine. I particularly enjoyed writing
    an `interactive shell`_, an `OpenID provider`_, and a
    `full text search library`_.

Désolé pour les informations quelque peu erronées qui ont pu
tromper certains...

.. _flux rss de delicious: http://del.icio.us/rss/popular
.. _`http://openid-provider.appspot.com/`: http://openid-provider.appspot.com/
.. _Pti-Seb: http://www.tux-planet.fr/mini-blog
.. _Techcrunch[UK]: http://uk.techcrunch.com/2008/01/09/google-ibm-and-verisign-to-join-openid/
.. _openid blog: http://wordpress.openidblog.fr//2008/01/26/google-offre-un-openid-via-blogger/
.. _l'annonce de cette nouvelle feature: http://snarfed.org/space/2008-04-07_google_app_engine_launched
.. _interactive shell: http://shell.appspot.com/
.. _OpenID provider: http://openid-provider.appspot.com/
.. _full text search library: http://code.google.com/appengine/articles/bulkload.html
