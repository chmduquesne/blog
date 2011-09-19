Title: Continuous background compilation within vim
date: 2010-03-14 16:36
category: code
tags: vim, makefile

You _can_ do continuous background compilation within vim. The
following code snippet will compile your project with 'make' each
time you save the current buffer:

    augroup c++
        autocmd BufWritePost *.{hpp,cpp}
                    \ silent execute ":!make > ~/.vim/cpperrors 2>&1 &" |
                    \ redraw! |
                    \ cgetfile ~/.vim/cpperrors
    augroup END

of course you could replace the make command with something more
complicated (for example calling some script that would run the
compilation on another machine, and getting the error file back in
your \~/.vim directory). BTW I just started a github project where
I keep my dotfiles. It's here:
[[http://github.com/chmduquesne/my-dot-files](http://github.com/chmduquesne/my-dot-files)](http://github.com/chmduquesne/my-dot-files)



