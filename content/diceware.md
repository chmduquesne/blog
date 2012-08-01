Title: Choose your passphrase with a die
Date: 2012-08-01 17:25
Category: howto
Tags: security, passphrase

Lurking on the archlinux [wiki][1], I found a very interesting
[resource][2] for choosing a strong, easy to remember passphrase. It's
called the **diceware method**. You basically pick a die and throw it
repeatedly to determine the words of your passphrase.

To associate a word with the results of the die, you are given a list of
words that looks like what follows:

    ...
    46154 ox
    46155 oxyda
    46156 oxyde
    46161 oxyder
    46162 oy
    46163 oz
    46164 ozone
    46165 ozones
    46166 p
    46211 pa
    46212 pacha
    46213 pack
    46214 packs
    46215 pacte
    ...

The numbers indicate what word you should pick on the base of 5 throws.
For example if you throw 4, 6, 1, 5, 5, you should pick the word 46155,
which is "oxyda". You then repeat this process until you have 6 or 7
words. Pick the words in the order you got them, and you now have a new
secure passphrase.

What I like about this method is that it is **fully automated**, yet
perfectly secure. You don't have to worry about making a choice: the die
makes it for you, and you still end up with something that is easy to
remember.

Sure, I read [xkcd][3] and I was already using long sentences that made
sense only if you are me, but this method beats mine, since there is no
way I was picking these words randomly.

Since I could not find a list of french words, I quickly made [my own][4].

[1]: https://wiki.archlinux.org/index.php/Disk_Encryption#Choosing_a_strong_passphrase
[2]: http://world.std.com/~reinhold/diceware.html
[3]: http://xkcd.com/936/
[4]: https://github.com/chmduquesne/diceware-fr
