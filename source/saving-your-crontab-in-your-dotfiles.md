Title: Saving your crontab in your dotfiles
Date: 2010-12-02 19:25
Category: howto
Tags: crontab

In order to share them across several machine, like a lot of people, I
synchronize my dotfile using a DVCS on [a public
repository](http://bitbucket.org/chmduquesne/dotfiles). I save as much
stuff as I can, provided it does not contains sensitive stuff like
passwords. Problem: How do you save your crontab? I finally had a look at
the crontab manual to realize that crontab could be called on a file. The
following line goes into my `~/.zshrc`:

    alias crontab-e='vi ~/.crontab && crontab ~/.crontab'

Edit: I now find even better to use a shell function rather than an
alias:

    # CRONTAB
    if test -z $CRONTABCMD; then
        # allows to source zshrc twice
        export CRONTABCMD=$(which crontab)
        crontab()
        {
            if [[ $@ == "-e" ]]; then
                vim ~/.crontab && $CRONTABCMD ~/.crontab
            else
                $CRONTABCMD $@
            fi
        }
        $CRONTABCMD ~/.crontab
    fi



