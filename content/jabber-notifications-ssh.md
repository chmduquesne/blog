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
databases e.g. when passwords are changed. It can also be activated when
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

Note that the sendxmpp command runs in background and that its exit status
is ignored. Otherwise PAM would wait for the command to return before
letting me in, and it would deny me the access if the notification failed
to be delivered. Two things I clearly want to avoid.

Then, the following line goes at the end of `/etc/pam.d/sshd`:

    session         optional        pam_exec.so             /usr/local/bin/login_notify

There you go, notifications each time someone logs in.

Are you doing this for real? Read on...
=======================================

Ok, just a couple of extra instructions for you:

- Be really really careful before modifying `/etc/pam.d/sshd`. If you
  put a bogus command in there, you might screw up your remote access.
  Please double check that the command `/usr/local/bin/login_notify` is
  running with no error. Only when you are sure of that, you can add the
  line to `/etc/pam.d/sshd`.
- Don't forget to `chmod +x /usr/local/bin/login_notify`
- When you run `/usr/local/bin/login_notify`, you should receive a
  jabber message. If you don't, then you have to verify that you can
  actually send messages to your gmail account. Use a jabber client
  and try to have a conversation with your gmail account. Then, try to
  use `sendxmpp`, then try again with the `login_notify` script.
- My instructions are probably incomplete. Use your brain to fill in the
  blanks.
