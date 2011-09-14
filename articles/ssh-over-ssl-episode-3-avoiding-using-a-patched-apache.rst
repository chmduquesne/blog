SSH over SSL, episode 3: Avoiding using a patched apache.
#########################################################
:date: 2011-07-11 13:12
:category: Sécurité

Another episode of my adventures of firewall bypassing. In order to
use the http CONNECT method to tunnel ssh, you have to configure
apache as I previously showed in
`"SSH over SSL, a quick and minimal config."`_. Sadly, the current
version of apache does not allow to do it over https: there has
been a `bug report`_ for years and various patches have been
proposed, but as far as I know, still not any of these patches made
it to the official release. My solution so far was to apply the
patch manually and recompile the relevant module. Doing this for
every release can be annoying, so I've been looking for a different
solution that would not involve recompiling apache. The workaround
I now use is fun enough for me to talk about it here. Since apache
has no problem with the CONNECT method when SSL is not involved, I
have decided to do the SSL part by myself. Thus, I configure apache
to serve normally on the port 80, and I use stunnel to secure
apache on the port 443. Here is how I do it: I remove the SSL part
of my apache config and I add in my (normal, unencrypted) apache
configuration:
::

    ProxyRequests On
    AllowConnect 22
    < Proxy *>
    Order deny,allow
    Deny from all
    </Proxy>
    <Proxy 127.0.0.1>
    Order deny,allow
    Allow from all
    </Proxy>

Then, I install stunnel, and I set it up to listen on the port 443
(https) and to forward it to the port 80 (http).
::

    cert = /etc/stunnel/stunnel.pem
    
    ...
    
    [https]
    accept  = 443
    connect = 80
    TIMEOUTclose = 0

stunnel requires a bit of configuration. From the `documentation`_,
here is how to generate a certificate:
::

    cd /etc/stunnel
    openssl req -new -x509 -days 365 -nodes -config stunnel.cnf -out stunnel.pem -keyout stunnel.pem
    chown stunnel:stunnel stunnel.pem
    chmod 600 stunnel.pem

I also nedded to add in /etc/hosts.allow
::

    sshd: ALL
    stunnel: ALL
    https: ALL

And that is all. I restart stunnel and httpd and I can enjoy SSH
over SSL. (actually since I did not want double encryption, I have
started to do telnet over SSL, but that is more or less the same
story). Other alternatives I have considered: - Switching from
apache to another http server: it turns out I was unable to find
any other http server supporting the http CONNECT method (at least
thttpd, lighttpd and nginx don't support it) - Using a perl script
that serves on the port 443, waiting for the CONNECT method and
forwarding every other message to apache (see
`http://www.karlrunge.com/x11vnc/connect\_switch`_): I did not try
this second method, but it seems rather cool. If anyone does and
has any success with it, please leave a comment here, I am
interested. I would also be interested if someone knows any http
server lighter than apache and guaranteed to support the CONNECT
method...

.. _"SSH over SSL, a quick and minimal config.": http://chm.duquesne.free.fr/blog/?p=190
.. _bug report: https://issues.apache.org/bugzilla/show_bug.cgi?id=29744
.. _documentation: http://www.stunnel.org/?page=docs
.. _`http://www.karlrunge.com/x11vnc/connect\_switch`: http://www.karlrunge.com/x11vnc/connect_switch
