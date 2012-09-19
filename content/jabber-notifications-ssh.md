Title: Jabber notifications on ssh login
Date: 2012-09-19 15:33
Category: howto
Tags: security, ssh

I coined this little trick the other day, I thought I might share it. I
wanted, for fun, to be notified on gtalk everytime someone logs in my
server. You never know, maybe I could discover unexpected connections. It
turned out to be possible, and the whole thing costed me reading a couple
of manpages and typing 5 lines of code.

Before you do the same thing with you own server, let me claim here that I
am absolutely not a security expert. It is more an experiment than
anything else, so I suggest being really careful and read all the manpages
involved if you want to do the same thing. Also, I'd be happy to be
notified of any potential threat in the comments.

Basically, you can have PAM (Pluggable Authentication Modules, the thing
that handles authentication on Linux) execute external commands. The
module in question is called `pam_exec`, and it is often used to rebuild
databases e.g. passwords are changed. It can also be activated when
someone logs in. The manpage explains that the following PAM items are
exported as environment variables to the program executed:

     PAM_RHOST, PAM_RUSER, PAM_SERVICE, PAM_TTY, PAM_USER, PAM_TYPE

I decided to use it to my advantage. I created on jabber.org an account
for my server. I added it in my gmail friends, and I wrote this little
script, using sendxmpp (saved as `/usr/local/bin/login_notify`):

    #!/bin/sh

    echo "$PAM_USER@`hostname` logged from $PAM_RHOST" | \
        sendxmpp -u server_account -j jabber.org -p xxxx me@gmail.com >/dev/null 2>&1 &
        exit 0

Note that the sendxmpp command runs in background and that I don't care
about its exit status. This is to prevent PAM from waiting for sendxmpp to
return before letting me logging in. Also, I don't really care if the
notifications fails to be delivered.

Then, the following line goes at the end of `/etc/pam.d/sshd`:

    session         optional        pam_exec.so             /usr/local/bin/login_notify

There you go, notifications each time your login.
