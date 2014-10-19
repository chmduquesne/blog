Title: SSH over SSL, a quick and minimal config.
Date: 2010-11-12 11:52
Category: howto
Tags: apache, ssh, ssl, tunnel

Update 2014-10-19: The content of this article is still valid, but I found
[a nicer way](/ssh-over-ssl-episode-4-a-haproxy-based-configuration.html)
to do it.

So you are behind a vicious firewall that filters outgoing ssh and
vpn, and the only safe way out is SSL. In this article, I'll
describe how to SSH over SSL to a machine that runs an ssh server
and apache2. This machine will still be able to run an SSL website.
Clients will connect using a standard ssh client and proxytunnel.

Server configuration
====================
I assume that:

- The server is accessible on the port 443 through the "server.com" domain
  name (otherwise using the raw ip will do the trick).
- It also runs an ssh server (but no need for the port 22 to be
  reachable).
- You already have set up certificates for SSL
- You've enabled the modules for ssl (a2enmod ssl)
- You're running the default ssl website in
  /etc/apache2/sites-available/default-ssl and it is enabled (a2ensite
  default-ssl)
- You've enabled necessary modules for proxying and using proxy connect
  methods (a2enmod proxy proxy\_connect proxy\_http)

File /etc/apache2/sites-available/default-ssl
=============================================
It's minimalistic on purpose, so you can see what is really needed.

    <IfModule mod_ssl.c>
    <VirtualHost _default_:443>
        # enable ssl
        SSLEngine on
        SSLCertificateFile    /etc/ssl/certs/ssl-cert-snakeoil.pem
        SSLCertificateKeyFile /etc/ssl/private/ssl-cert-snakeoil.key
        # proxytunnel
        Include /etc/apache2/proxytunnel/main.conf
    </VirtualHost>
    </IfModule>

File /etc/apache2/proxytunnel/main.conf
=======================================
It enables forward proxying for anyone, but only if the client asks for
127.0.0.1:22 (other requests will be denied). This results in exposing the
port 22 (ssh) of your server through a proxy, in an encrypted way.

    ProxyRequests On
    AllowConnect 22
    <Proxy *>
        Order deny,allow
        Deny from all
    </Proxy>
    <Proxy 127.0.0.1>
        Order deny,allow
        Allow from all
    </Proxy>

Client configuration
====================
I assume that:

- An ssh client is installed
- proxytunnel is installed

First, you'll need to test your server setting using proxytunnel alone.
Since debugging encryption problems can be tedious, at first, I suggest
you set up your server to provide the proxy in a non encrypted way,
commenting the three SSL related lines (you can switch to encrypted when
it works). Proxytunnel can "chain" two proxies (a local one, and a remote
one), but if the place you connect from does not use such a setting, here
is how you can proceed:

    proxytunnel -E -p server.com:443 -d 127.0.0.1:22 -v

-v is for verbose. Replace it with -q (quiet) if it works. You can say it
works when you are prompted an ssh login. Apache2 used to have [a bug][1]
with proxy\_connect and SSL, so using encryption may require some extra
work (like patching and recompiling the mod\_proxy shared libraries or
using the latest alpha).

File .ssh/config
================
Once you're done, just drop the working command line in the .ssh/config of
your clients:

    Host server.com
        ProxyCommand proxytunnel -q -E -p server.com:443 -d 127.0.0.1:22
        DynamicForward 1080
        ServerAliveInterval 60

If you are stuck, I recommend you read [this excellent article][2]. One
problem remains with this config: If the traffic is correctly monitored,
the ip of you server could be logged (even though it will be impossible to
prove you have been doing something not allowed). First, you should run an
https website on this ip (like a blog, or a code repository), in order to
make this traffic more realistic. What could also be cool would be to
chain proxies, [using for example the appengine][3]. This way your traffic
will look like it's going to google.

[1]: https://issues.apache.org/bugzilla/show_bug.cgi?id=29744
[2]: http://www.saulchristie.co.uk/how-to/bypass-firewalls
[3]: http://lifehacker.com/5484934/run-your-own-free-proxy-through-the-google-app-engine
