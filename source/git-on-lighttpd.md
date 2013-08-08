Title: Git on lighttpd
Date: 2013-08-08 16:09
Category: howto
Tags: git gitweb server

Intro
=====

I switched to lighttpd. The main reason for this change was the ease of
configuration: for example, with apache, when you want to serve the same
website with and without ssl, you end up doing something like this:

    # file: /etc/apache2/sites-available/domain.com.conf
    <VirtualHost *:80>
        Include /etc/apache2/domain.com.inc.conf
    </VirtualHost>
    <VirtualHost *:443>
        Include /etc/apache2/domain.com.inc.conf
        SSLEngine On
        SSLCertificateFile /etc/ssl/private/domain.com.pem
    </VirtualHost>

    # file: /etc/apache2/sites-available/domain.com.inc.conf
    ServerName domain.com
    DocumentRoot /var/www/domain.com

Including the website config as a separate file is pretty much the only
way to accomplish this without duplicating this config in both
virtualhosts. That is two files to maintain, for one domain.  If you want
to do this for every domain you control, you have to multiply the files
and includes.

Doing this with lighttpd is really easier:

    # file /etc/lighttpd/lighttpd.conf
    $SERVER["socket"] == ":443" {
        ssl.engine              = "enable"
        ssl.pemfile             = "/etc/ssl/private/domain.com.pem"
    }
    $HTTP["host"] == "domain.com" {
        server.document-root    = "/var/www/domain.com"
    }

git and lighttpd
================

Now, let's do cool things. One of the subdomains I own is dedicated to
hosting my public git repositories. I (quite obviously) named it
[http://git.chmd.fr](http://git.chmd.fr). I want to use it for:

- Serving a gitweb instance to browse all repositories, such that
  [https://git.chmd.fr/?p=netmon.git](https://git.chmd.fr/?p=netmon.git)
  takes you to browsing the repository of netmon.
- Serving the git protocol, such that
  `git clone https://git.chmd.fr/netmon.git` clones this repository.

Combining the two was tricky, but I ended up finding how to proceed. Here
is the relevant part of my config:

    $HTTP["host"] == "git.chmd.fr" {
    
        # This takes care of serving gitweb
        server.document-root    = "/usr/share/gitweb"
        cgi.assign = ( ".cgi" => "" )
        server.indexfiles = ( "gitweb.cgi" )
    
        # And this condition matches git objects
        $HTTP["url"] =~ "(?x)^/(.*/(HEAD | info/refs | objects/(info/[^/]+ | [0-9a-f]{2}/[0-9a-f]{38} | pack/pack-[0-9a-f]{40}\.(pack|idx)) | git-(upload|receive)-pack))$" {
            alias.url  += ( "" => "/usr/lib/git-core/git-http-backend")
            cgi.assign = ("" => "")
            setenv.add-environment = (
                "GIT_PROJECT_ROOT" => "/home/www/git-public-repos/",
                "GIT_HTTP_EXPORT_ALL" => ""
                )
        }
    }

Combined with the trick from above, you can get this to work on both http
and https. I hope this will help others!
