Title: Scripting sudo with pass
Date: 2020-01-06 14:30
Category: passwords
Tags: shell

Like a lot of folks, I use [zx2c4's pass][1]. Like even more
people, I use sudo for administrative tasks on my machines. The obvious
advantage of pass is its scriptability. A lot of tools ([offlineimap][2],
[docker][3], [ansible-vault][5]...) offer a way to provide the password
through an external command. This allows your passwords to be all in one
place, with no overhead in your workflow.

If you want to run a sudo command without typing the password
interactively, you can use the [NOPASSWD][5] option in `/etc/sudoers`.  I
do not find it desirable: should you leave a console unattended, this
exposes you to somebody running administrative commands too easily.

So can you instead tell sudo to use pass for the password input? Yes, but,
not seamlessly. The `-A` [command line option][6] is designed to provide
the password through an helper program. To quote the manpage:

> If the -A (askpass) option is specified, a (possibly graphical) helper
> program is executed to read the user's password and output the password
> to the standard output. If the `SUDO_ASKPASS` environment variable is set,
> it specifies the path to the helper program.

I store in pass my different "`user@host`" passwords under the path
`host/<user>@<host>`. If you adopt the same convention, this is what you can
do:

Save the following file as executable under `~/.local/bin/sudo-askpass`

    :::bash
    #!/bin/bash
    pass show hosts/$(whoami)@$(hostname) | head -n1

Insert your password in pass accordingly

    :::bash
    pass edit hosts/$(whoami)@$(hostname)

And now if you run

    :::bash
    export SUDO_ASKPASS=$HOME/.local/bin/sudo-askpass
    sudo -A whoami

The answer should be `root`. Neat, but not seamless, since you need the -A
switch. You *could* solve the problem by adding these 2 lines in your shell
startup file

    :::bash
    export SUDO_ASKPASS=$HOME/.local/bin/sudo-askpass
    alias sudo='sudo -A'

However, programs which invoke `sudo` (such as [yay][9]) will not know about
this alias, and you will still be required to type your password
interactively. What I do instead is to create my own sudo executable with
higher precedence in the path whicht insert the proper options before
invoking the real binary:

    :::bash
    #!/bin/bash

    SCRIPTDIR=$(dirname $(which $0))
    PATH_WITHOUT_SCRIPTDIR=$(echo $PATH | tr ":" "\n" | grep -v "$SCRIPTDIR" | tr "\n" ":")
    REAL_SUDO=$(env PATH=$PATH_WITHOUT_SCRIPTDIR which sudo)
    exec env SUDO_ASKPASS=$HOME/.local/bin/sudo-askpass $REAL_SUDO --askpass "$@"

If your distribution follows the [systemd file hierarchy][8], you can save
this file under `~/.local/bin/sudo` and it will happily take precedence
over the real sudo.

I employ a similar trick for unlocking my ssh keys with keychain. I store
in pass the password of the private ssh key of `<user>@<host>` as
`ssh/<user>@<host>`. The following file is saved as executable under
`~/.local/bin/ssh-askpass`

    :::bash
    #!/bin/bash
    pass show ssh/$(whoami)@$(hostname) | head -n1

And this goes in my shell startup file

    :::bash
    {type keychain > /dev/null} && {type ssh-askpass > /dev/null} && \
        source <(SSH_ASKPASS=ssh-askpass keychain --quiet --eval id_rsa </dev/null)

If you have a look at my [dotfiles][10], you will realize that there is
more to this setup. The main additional thing to know is that I use a
[smartcard][7] to handle the gpg decryption, so that no machine contains
the gpg key that I use with `pass`. This will likely be the purpose of a
different article. Until then, happy sudo-ing!

[1]: https://www.passwordstore.org/
[2]: http://www.offlineimap.org/
[3]: https://github.com/docker/docker-credential-helpers
[4]: https://docs.ansible.com/ansible/latest/user_guide/vault.html
[5]: https://www.sudo.ws/man/1.8.15/sudoers.man.html
[6]: https://www.sudo.ws/man/1.8.3/sudo.man.html
[7]: https://www.yubico.com/
[8]: http://man7.org/linux/man-pages/man7/file-hierarchy.7.html
[9]: https://github.com/Jguer/yay
[10]: https://github.com/chmduquesne/dotfiles
