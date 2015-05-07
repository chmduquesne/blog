Title: SSH over SSL, episode 2: replacing proxytunnel with socat
Date: 2010-11-15 23:53
Category: howto
Tags: socat, ssh, ssl

If you are reading this, you might be interested in the full list of my
articles about doing SSH over SSL. I have been improving my configuration
over the years, so the more recent, the better:

* 2010-11-12: [Quick and minimal config](/ssh-over-ssl-a-quick-and-minimal-config.html)
* 2010-11-15: [Replacing proxytunnel with socat](/ssh-over-ssl-episode-2-replacing-proxytunnel-with-socat.html)
* 2011-07-11: [Avoiding using a patched Apache](/ssh-over-ssl-episode-3-avoiding-using-a-patched-apache.html)
* 2014-10-19: [HAproxy based configuration](/ssh-over-ssl-episode-4-a-haproxy-based-configuration.html)

---

Last week, I wrote [an article][1] about how to quickly set up a server
and a client for doing ssh over ssl.  In this article, I was using
proxytunnel, but I realized today that it could probably be replaced with
socat (socat can do almost anything)...

The principle is simple: Following the first part of
the tutorial, you make your server accept proxy\_connect requests
to its private port localhost:22 through its public port 443,
encapsulating the whole thing in SSL (as a reminder, 22 and 443 are
respectively the standard ports for ssh and ssl).

We now want to configure the ssh clients in order to connect through this
ssl tunnel. I said I was configuring the clients with proxytunnel. The
exact command (in .ssh/config) was:

    proxytunnel -q -E -p server.com:443 -d 127.0.0.1:22

I'll explain it:

- `-q` is for quiet
- `-E` is for encrypting between the proxy and us
- `-p` is for choosing the proxy
- `-d` is for requesting a destination (from the proxy point of view)

So basically, this means: "connect stdio to server.com on port 443 (-p
server.com:443) , in an encrypted way (-E), then from this server, require
to be connected to 127.0.0.1:22 (-d 127.0.0.1:22)".

For those who like to play with all sorts of streams, socat is really the
best tool ever invented. I was wondering if I could reproduce
proxytunnel's behavior with socat, and it turns out you can. Here is how
to proceed: First, create an ssl tunnel between your client's
localhost:1080 and server.com:443:

    socat TCP-LISTEN:1080 OPENSSL:server.com:443

This way, the port 443 of server.com is now available unencrypted
on localhost:1080 Then, use socat and its proxy mode to ask for
localhost:1080 (which is actually server.com:443 unencrypted) to
connect to localhost:22 (which is then server.com:22).

    socat - PROXY:127.0.0.1:127.0.0.1:22,proxyport=1080

Bingo! You should see the ssh prompt. For the fun, I replaced in my
.ssh/config the former

    ProxyCommand proxytunnel -q -E -p server.com:443 -d 127.0.0.1:22

with

    ProxyCommand socat TCP-LISTEN:1080 OPENSSL:server.com:443,verify=0 & socat - PROXY:127.0.0.1:127.0.0.1:22,proxyport=1080

**Edit 2015-05-07**: See [Vincent's
comment](https://blog.chmd.fr/ssh-over-ssl-episode-2-replacing-proxytunnel-with-socat.html#comment-2010371675)
for a cool idea to wrap the ssh command with the `-fMN` options.

It works just fine. There is however a flaw in what I did: I use a
hardcoded port, thus I can't establish two ssh connections at the
same time. Forwarding the server.com:443 on localhost:1080 fails
the second time, since this port is already occupied by the first
connection. The best way to fix that would be to use stdio for the
proxy\_connect requests, instead of a port of localhost (since the
number of these port is limited). However, with my version of socat
(1.7.1.3), I don't see how to proceed differently: the PROXY method
requires three arguments and one of them is a port. If one of my
readers has a suggestion, he/she's welcome. This remains a cool hack!

**Edit**: The great [Marco Fontani][2] gave a cool solution (see the
comments). Here is how my .ssh/config looks like:

    Host server.com
        ProxyCommand socat TCP-LISTEN:1080 OPENSSL:server.com:443,verify=0 & sleep 1 && socat - PROXY:127.0.0.1:127.0.0.1:22,proxyport=1080
        DynamicForward 1080
        ServerAliveInterval 60
        ControlMaster auto
        ControlPath ~/.ssh/tmp/%h_%p_%r

[1]: ../ssh-over-ssl-a-quick-and-minimal-config.html
[2]: https://darkpan.com/
