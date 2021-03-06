Title: SSH over SSL, episode 4: a HAproxy based configuration
Date: 2014-10-19 17:40
Category: howto
Tags: ssh, ssl, HAproxy

Purpose of this article
-----------------------
In this article, I am describing how to SSH to a remote server as
discreetly as possible, by concealing the SSH packets into SSL. The
server will still be able to run an SSL website.

Rationale
---------
In most cases, when your outgoing firewall blocks ssh, you can work around
with [sslh](http://www.rutschle.net/tech/sslh.shtml), a tool that listens
on the port 443 server-side, and selectively forwards, depending on the
packet type, the incoming TCP connections to a local SSH or SSL service.
You can then happily ssh to your server on the port 443 (normally
dedicated to HTTPS), and also run a website on the same server so your
connections look you are just harmlessly visiting this website. However,
if your firewall is really sneaky, it will detect that you are sending the
wrong packet type to the SSL port, and block your connection. In this
case, there is not much choice: we must hide the SSH connection into a
real SSL tunnel.

Comment for the long time readers
---------------------------------
I know, I know: I covered this topic a few times already (here are the
[first](/ssh-over-ssl-a-quick-and-minimal-config.html),
[second](/ssh-over-ssl-episode-2-replacing-proxytunnel-with-socat.html),
and [third](/ssh-over-ssl-episode-3-avoiding-using-a-patched-apache.html)
episodes). All of these setups were relying on a feature of HTTP 1.1
called CONNECT. However, it turns out that most webserver do not implement
this CONNECT feature. As a consequence, if you wanted to do this, you were
more or less stuck with Apache. This time, we are breaking free from
Apache, with a HAproxy-based configuration. We will use HAproxy advanced
packet inspection capabilities to implement a switch of protocol, the same
way sslh works.

Server configuration
--------------------
Some assumptions:

* The port 443 of your server is publicly reachable
* It runs ssh (but no need for the port 22 to be reachable)
* Some web server is running on the port 80 and it supports the
  'X-Forwarded-Proto' header (see the documentation of your webserver to
  enable that).
* You have generated ssl certificates (you copied the public key and the
  private key in the same file /etc/ssl/private/certs.pem)

Now, you need to setup HAproxy. HAproxy defines backends and frontends, and it
can communicate with these backends both at the HTTP and at the TCP level. Let
us start with the backends:

The web server backend: we tell HAproxy that a server is running on the
port 80, and speaks HTTP. On this backend, we add a X-Forwarded-Proto
header, such that the web server knows that the clients are connecting
securely. If you expose the same backend with HAproxy on the port 80,
don't forget to filter the X-Forwarded-Proto header!

    backend secure_http
        reqadd X-Forwarded-Proto:\ https
        rspadd Strict-Transport-Security:\ max-age=31536000
        mode http
        option httplog
        option forwardfor
        server local_http_server 127.0.0.1:80

The ssh server:

    backend ssh
        mode tcp
        option tcplog
        server ssh 127.0.0.1:22
        timeout server 2h

And now, the magic. This happens in the frontend section. We listen in TCP mode
and inspect the connections. Depending on whether we see ssh or not, we hook it
to one of the backends.

    frontend ssl
        bind X.X.X.X:443 ssl crt /etc/ssl/private/certs.pem no-sslv3
        mode tcp
        option tcplog
        tcp-request inspect-delay 5s
        tcp-request content accept if HTTP
    
        acl client_attempts_ssh payload(0,7) -m bin 5353482d322e30
    
        use_backend ssh if !HTTP
        use_backend ssh if client_attempts_ssh
        use_backend secure_http if HTTP

Once you are done, you can test if this works by connecting on the server
with openssl.

    openssl s_client -connect server.com:443 -quiet

If you see a string that looks like

    SSH-2.0-OpenSSH_6.6.1p1 Debian-7

then everything went fine!

Connecting from an SSH client
-----------------------------
To connect to your server from linux, just drop this in your ~/.ssh/config:

    Host server.com
        ProxyCommand openssl s_client -connect server.com:443 -quiet

If you are on windows and you cannot install anything client side, there
is also a solution for you. Download socat and putty (none of them
requires admin rights). Then, with socat, run:

    socat TCP-LISTEN:8888 OPENSSL:server.com:443,verify=0

And with putty, direct your client to 127.0.0.1 on the port 8888.

For the technically aware readers
---------------------------------
So how does this work exactly? Basically, the [RFC 4253, section
4.2](https://tools.ietf.org/html/rfc4253#section-4.2) states that clients
must send a string that starts with 'SSH-2.0' (this is also how sslh does
it). Moreover, 5353482d322e30 is the binary representation of the string
'SSH-2.0'. So everything boils down to this line:

    acl client_attempts_ssh payload(0,7) -m bin 5353482d322e30

When a new connection is made on the port 443, HAproxy decrypts the SSL
layer, and checks whether the stream of data sent by the client starts
with this string. We use the result of this condition to choose the
backend. This handles the case of 'active' SSH clients (like
openssh-client on linux), who send a packet as soon as they connect.
There are also 'passive' SSH clients (like putty), who wait for the server
to send a string. These clients will get that string after 5 seconds (the
inspect-delay).

Conclusion
----------
Happy SSH!
