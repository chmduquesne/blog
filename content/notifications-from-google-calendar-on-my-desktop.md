Title: Notifications from google calendar on my desktop
date: 2010-11-23 15:11
category: howto
tags: notify-send

I just added this in a crontab:

    */30 * * * * DISPLAY=:0.0 gcalcli remind 240 'notify-send -t 300000 -i myniceicon.svg "Calendar" \%s'

So every 30 minutes, I get a notification with a 5 minutes timeout
for upcoming events in the next 4 hours. I really don't need more.



