Title: SSH over SSL, episode 3: Avoiding using a patched apache.
Date: 2011-07-11 13:12
Category: howto
Tags: ssh, ssl, stunnel, apache

If you are reading this, you might be interested in the full list of my
articles about doing SSH over SSL. I have been improving my configuration
over the years, so the more recent, the better:

* 2010-11-12: [Quick and minimal config](/ssh-over-ssl-a-quick-and-minimal-config.html)
* 2010-11-15: [Replacing proxytunnel with socat](/ssh-over-ssl-episode-2-replacing-proxytunnel-with-socat.html)
* 2011-07-11: [Avoiding using a patched Apache](/ssh-over-ssl-episode-3-avoiding-using-a-patched-apache.html)
* 2014-10-19: [HAproxy based configuration](/ssh-over-ssl-episode-4-a-haproxy-based-configuration.html)

---

Another episode of my adventures of firewall bypassing...

In order to use the http CONNECT method to tunnel ssh, you have to
configure apache as I previously showed in [a previous post][1].  Sadly,
the current version of apache does not allow to do it over https. There
has been a [bug report][2] for years and various patches have been
proposed, but as far as I know, still not any of these patches made it to
the official release.

My solution so far was to apply the patch manually and recompile the
relevant module. Doing this for every release can be annoying, so I've
been looking for a different solution that would not involve recompiling
apache.

**Edit 2015-05-07:** This bug has been fixed for 3 years. I still
recommend not to use the CONNECT method, because only apache supports it
and it will force you to use it. There are cooler, faster webservers out
there. Using the HAproxy based configuration is by far the most flexible
way I know (it allows you to use any web server, apache included).

The workaround I now use is fun enough for me to talk about it here. Since
apache has no problem with the CONNECT method when SSL is not involved, I
have decided to do the SSL part by myself. Thus, I configure apache to
serve normally on the port 80, and I use stunnel to secure apache on the
port 443. Here is how I do it: I remove the SSL part of my apache config
and I add in my (normal, unencrypted) apache configuration:

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

    cert = /etc/stunnel/stunnel.pem
    ...
    [https]
    accept  = 443
    connect = 80
    TIMEOUTclose = 0

stunnel requires a bit of configuration. From the [documentation][3], here
is how to generate a certificate:

    cd /etc/stunnel
    openssl req -new -x509 -days 365 -nodes -config stunnel.cnf -out stunnel.pem -keyout stunnel.pem
    chown stunnel:stunnel stunnel.pem
    chmod 600 stunnel.pem

I also nedded to add in /etc/hosts.allow

    sshd: ALL
    stunnel: ALL
    https: ALL

And that is all. I restart stunnel and httpd and I can enjoy SSH
over SSL. (actually since I did not want double encryption, I have
started to do telnet over SSL, but that is more or less the same
story).

Other alternatives I have considered:

* Switching from apache to another http server: it turns out I was unable
  to find any other http server supporting the http CONNECT method (at
  least thttpd, lighttpd and nginx don't support it)
* Using a perl script that serves on the port 443, waiting for the CONNECT
  method and forwarding every other message to apache (see
  [connect_switch][4])

I did not try this second method, but it seems rather cool. If
anyone does and has any success with it, please leave a comment
here, I am interested. I would also be interested if someone knows
any http server lighter than apache and guaranteed to support the
CONNECT method...

[1]: ../ssh-over-ssl-a-quick-and-minimal-config.html
[2]: https://issues.apache.org/bugzilla/show_bug.cgi?id=29744
[3]: http://www.stunnel.org/?page=docs
[4]: http://www.karlrunge.com/x11vnc/connect_switch
