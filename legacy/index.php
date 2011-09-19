<?

$url_map = array(
    "4" => "http://blog.chmd.fr/ouverture.html",
    "8" => "http://blog.chmd.fr/comment-crypter-vos-partitions-sous-ubuntu.html",
    "10" => "http://blog.chmd.fr/eviter-quon-puisse-utiliser-votre-ordinateur-en-cas-de-vol.html",
    "11" => "http://blog.chmd.fr/cryptage-des-disques-les-performances.html",
    "12" => "http://blog.chmd.fr/damn-small-linux-not-linstallation-hyper-simple.html",
    "13" => "http://blog.chmd.fr/choisir-un-bon-mot-de-passe-les-bons-trucs.html",
    "14" => "http://blog.chmd.fr/notre-ami-creative-commons.html",
    "15" => "http://blog.chmd.fr/personnaliser-wordpress-et-se-procurer-des-images-libres.html",
    "20" => "http://blog.chmd.fr/creative-commons-la-suite.html",
    "22" => "http://blog.chmd.fr/faire-un-screenshot-dune-page-web-en-entier.html",
    "24" => "http://blog.chmd.fr/cest-officiel-ton-blog-a-ete-tunne.html",
    "25" => "http://blog.chmd.fr/la-mentalite-securite.html",
    "27" => "http://blog.chmd.fr/imagine-a-place.html",
    "28" => "http://blog.chmd.fr/faire-un-gif-anime-a-partir-dun-film.html",
    "33" => "http://blog.chmd.fr/couper-une-video-et-extraire-une-scene-dun-film.html",
    "34" => "http://blog.chmd.fr/google-suppporte-desormais-openid.html",
    "35" => "http://blog.chmd.fr/vpnc-network-manager-et-enc_passwd-h4ck3r-inside.html",
    "36" => "http://blog.chmd.fr/voler-les-mots-de-passe-dencryption-dans-la-ram-une-action-bientot-possible-pour-nimporte-qui.html",
    "37" => "http://blog.chmd.fr/les-lecteurs-de-flux-rss-en-ligne-libres.html",
    "38" => "http://blog.chmd.fr/les-lecteurs-de-flux-rss-en-ligne-independants-libres-suite.html",
    "39" => "http://blog.chmd.fr/pour-les-vim-users-vimperator-10-est-sorti.html",
    "40" => "http://blog.chmd.fr/humour.html",
    "42" => "http://blog.chmd.fr/de-nouvelles-fonctionnalites-pour-tiny-tiny-rss-des-boutons-tiny-tiny-rss-et-vimperator.html",
    "46" => "http://blog.chmd.fr/utiliser-les-raccourcis-de-vim-dans-le-terminal.html",
    "47" => "http://blog.chmd.fr/coup-de-gueule-mettez-vous-a-openpgp.html",
    "48" => "http://blog.chmd.fr/luml-automatise-et-le-libre-cest-pas-gagne.html",
    "56" => "http://blog.chmd.fr/web-agregators-libres-des-nouvelles.html",
    "60" => "http://blog.chmd.fr/vimgdbvimgdb.html",
    "61" => "http://blog.chmd.fr/mettre-des-couleurs-un-peu-partout-gcc-diff-grep.html",
    "83" => "http://blog.chmd.fr/autotools-makefile-et-notify-send.html",
    "88" => "http://blog.chmd.fr/autotools-doxygen-et-generation-conditionnelle.html",
    "93" => "http://blog.chmd.fr/gdb-7-0-est-sorti-cest-une-merveille-et-vous-ne-le-saviez-pas.html",
    "104" => "http://blog.chmd.fr/gerer-ses-plugins-vim-avec-getlatestvimscripts.html",
    "116" => "http://blog.chmd.fr/la-todo-liste-du-pauvre.html",
    "120" => "http://blog.chmd.fr/un-petit-truc-a-propager-sur-la-gestion-de-vos-mots-de-passe.html",
    "122" => "http://blog.chmd.fr/utilisons-incron-pour-etre-notifies-des-evenements-systemes.html",
    "137" => "http://blog.chmd.fr/continuous-background-compilation-within-vim.html",
    "140" => "http://blog.chmd.fr/renaming-files-and-variables-from-vim.html",
    "144" => "http://blog.chmd.fr/de-linteret-de-detacher-des-programmes-de-la-console-sans-screen.html",
    "160" => "http://blog.chmd.fr/talkmyphone-une-appli-android-pour-recevoir-des-notifications-de-son-telephone.html",
    "164" => "http://blog.chmd.fr/mise-a-jour-de-talkmyphone.html",
    "171" => "http://blog.chmd.fr/google-releasing-a-constraint-programming-library.html",
    "181" => "http://blog.chmd.fr/vim-complete-c-accurately-pulling-informations-from-the-compiler-with-gccsense-and-clang_complete.html",
    "190" => "http://blog.chmd.fr/ssh-over-ssl-a-quick-and-minimal-config.html",
    "209" => "http://blog.chmd.fr/ssh-over-ssl-episode-2-replacing-proxytunnel-with-socat.html",
    "236" => "http://blog.chmd.fr/notifications-from-google-calendar-on-my-desktop.html",
    "243" => "http://blog.chmd.fr/saving-your-crontab-in-your-dotfiles.html",
    "246" => "http://blog.chmd.fr/using-a-shell-version-of-supergenpass-from-vimperatorpentadactyl.html",
    "273" => "http://blog.chmd.fr/je-prefere-ton-clone-padopi.html",
    "281" => "http://blog.chmd.fr/ssh-over-ssl-episode-3-avoiding-using-a-patched-apache.html",
    "289" => "http://blog.chmd.fr/plowbot-a-jabber-bot-that-downloads-links-from-1-click-hosters.html"
);

$requested_entry = $_GET['p'];
$feed_requested = $_GET['feed'];

// 1) redirect regular entries
if ( array_key_exists ($requested_entry, $url_map) )
{
    header("HTTP/1.0 301 Moved Permanently");
    header("Location: $url_map[$requested_entry]");
    header("Connection: close");
    exit();
}
// 2) redirect feeds
if ($feed_requested)
{
    header("HTTP/1.0 301 Moved Permanently");
    header("Location: http://blog.chmd.fr/feeds/all.atom.xml");
    header("Connection: close");
    exit();
}
// 3) and anyway redirect the whole blog
header("HTTP/1.0 301 Moved Permanently");
header("Location: http://blog.chmd.fr");
header("Connection: close");
exit();

?>
