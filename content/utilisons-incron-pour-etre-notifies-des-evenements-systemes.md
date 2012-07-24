Title: Utilisons incron pour être notifiés des événements du système de fichiers
Date: 2010-02-18 00:26
Category: howto
Tags: incron, inotify, notify-send

[incron](http://incron.aiken.cz/) est un programme fonctionnant sur
le même principe que cron, mais basé sur des événements dans le
système de fichiers plutôt que sur des moments de la journée. C'est
très propre: pour l'utiliser, on spécifie un ou des fichiers à
surveiller, un type d'action à détecter sur le(s) fichier(s) en
question, et une commande à déclencher lorsque l'événement
survient. Je me suis dit que c'était l'occasion où jamais de mettre
à jour un vieux script que j'avais, qui me met au courant des
modifications sur mes logs (je tire l'idée de ce script
[d'un ancien post sur le planet libre](http://www.daemontux.org/?q=node/31)).
Après avoir installé incron, j'édite ma table de configuration
incron:

    incrontab -e

Avec mon éditeur favori, je lui mets la ligne suivante:

    /var/log/kernel.log IN_MODIFY sh /home/me/documents/scripts/popLog.sh /var/log/kernel.log

popLog.sh est un script qui prend en argument un log, en extrait la
dernière ligne modifiée, la colorise avec \`source-highlight\`\_ et
l'envoie en notification par le biais de \`notify-send\`\_. Le but
de ce script est donc d'afficher le dernier log dans une bulle,
avec coloration syntaxique. Je fournis le script en question, et
j'ajoute quelques explications:

-   source-highlight a besoin de parler un code couleurs compris
    par les bulles de notifications. notification-daemon comprend des
    couleurs de type <span color="couleur"\>mots à colorier</span\>,
    d'où le fichier supplémentaire awesome.outlang (que j'avais écrit à
    l'origine pour naughty et donc compatible avec celui-ci, pour les
    utilisateurs d'[awesome wm](http://awesome.naquadah.org/) - à ce
    propos il y a plusieurs entrées dans le wiki pour faire des choses
    semblables).
-   incron ne comprend pas bien les variables d'environnement, il
    vaut mieux les redéfinir dans le script, comme je l'ai fait.
-   faites attention à ne pas faire n'importe quoi avec incron, il
    est facile de créer une boucle infinie en surveillant par exemple
    /var/log/everything.log (vous notifiant du lancement de ce script,
    et donc générant une nouvelle notification): IN\_NO\_LOOP est votre
    ami.
-   incron prend des chemins absolus.

Après tous ces avertissements, voici
/home/me/documents/scripts/popLog.sh:

    #!/usr/bin/env bash

    # Usage: popLog /var/log/yourlog
    # pops a colored log with the last line of the log

    export DISPLAY=":0.0"
    export HOME="/home/me"

    #Urgency
    infoUrgency='low'
    warningUrgency='normal'
    errorUrgency='critical'
    securityUrgency='critical'

    #Popup time
    infoPopupTime=5000
    warningPopupTime=8000
    errorPopupTime=11000
    securityPopupTime=11000

    #Icons
    infoIcon='/usr/share/icons/gnome/32x32/status/dialog-information.png'
    warningIcon='/usr/share/icons/gnome/32x32/status/dialog-warning.png'
    errorIcon='/usr/share/icons/gnome/32x32/status/dialog-error.png'
    securityIcon='/usr/share/icons/gnome/32x32/status/security-medium.png'

    coloredLog=$(tail -n 1 $1 |                   \
      source-highlight --failsafe                 \
                       --src-lang=log             \
                       --style-file=default.style \
                       --outlang-def=${HOME}/documents/scripts/awesome.outlang)

    if [[ $coloredLog!='' ]]; then

        if [[ $(echo $1|grep info) ]]; then messageType='info'; fi
        if [[ $(echo $1|grep warn) ]]; then messageType='warning'; fi
        if [[ $(echo $1|grep err) ]]; then messageType='error'; fi
        if [[ $(echo $1|grep auth) ]]; then messageType='security'; fi
        if [[ $(echo $1|grep access) ]]; then messageType='security';fi
        if [[ $(echo $notification|grep 'UFW BLOCK INPUT') ]]; then
            messageType='security'; fi
        if [[ $messageType == '' ]]; then messageType='info'; fi

        case $messageType in
        info)
            urgency=$infoUrgency
            icon=$infoIcon
            popupTime=$infoPopupTime
        ;;
        warning)
            urgency=$warningUrgency
            icon=$warningIcon
            popupTime=$warningPopupTime
        ;;
        error)
            urgency=$errorUrgency
            icon=$errorIcon
            popupTime=$errorPopupTime
        ;;
        security)
            urgency=$securityUrgency
            icon=$securityIcon
            popupTime=$securityPopupTime
        ;;
        esac

        notify-send -u $urgency -t $popupTime -i "$icon" "$1" "$coloredLog"
    fi

Et voici /home/me/documents/scripts/awesome.outlang:

    extension "awesome"

    color "<span color=\"$style\">$text</span>"

    colormap
    "green" "#33CC00"
    "red" "#FF0000"
    "darkred" "#990000"
    "blue" "#0000FF"
    "brown" "#9A1900"
    "pink" "#CC33CC"
    "yellow" "#FFCC00"
    "cyan" "#66FFFF"
    "purple" "#993399"
    "orange" "#FF6600"
    "brightorange" "#FF9900"
    "brightgreen" "#33FF33"
    "darkgreen" "#009900"
    "black" "#000000"
    "teal" "#008080"
    "gray" "#808080"
    "darkblue" "#000080"
    default "#66FFFF"
    end

Je vous laisse faire joujou, je suis sûr que vous allez trouver
plein d'idées.



