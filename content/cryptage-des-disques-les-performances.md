Title: Cryptage des disques : les performances
Date: 2008-03-18 22:41
Category: misc
Tags: performance

En référence à [mon dernier article sur l'encryption][1], lorsque je
parlais des performances : Michael Larabel a fait [des tests récemment]
[2], et confirme le fait qu'à part si vous êtes un gamer fou à la
recherche de la performance absolue, vous ne ressentirez quasiment pas les
effets de ralentissement dû à ce cryptage. À bon entendeur...

> In the three Linux gaming benchmarks -- Enemy Territory, Doom 3,
> and Enemy Territory: Quake Wars -- the encrypted LVM had little
> impact on the frame-rate performance. In Doom 3 and ET: Quake Wars
> the frame-rate had dropped by just a couple frames when dm-crypt
> was in use. The biggest drop was with ET: Quake Wars, which equated
> to 2.9 frames or about a 10% drop in performance. When it came to
> encoding a WAV file to MP3 format with LAME and using Gzip
> compression on a 745MB file, the performance drop was small yet
> noticeable. In our last benchmark, which is the most disk
> intensive, which was copying 364 JPEG images amounting to 1.3GB in
> disk space from a
> [Corsair Flash Voyager GT](http://www.phoronix.com/vr.php?view=10194)
> drive over to the hard drive, the performance cost of using an
> encrypted LVM was at about 7%. Depending upon the situation, the
> performance impact of using dm-crypt will vary, but for mobile
> users with sensitive or just personal information, hard disk
> encryption is becoming a necessity and its benefits should out
> weigh the small performance impact. It's unfortunate that
> encryption support hasn't reached the Ubuntu Ubiquity LiveCD
> installer in time for
> [Ubuntu 8.04 LTS](http://www.phoronix.com/scan.php?page=search&q=Ubuntu%208.04),
> but hopefully it will be accomplished for
> [Ubuntu 8.10](http://www.phoronix.com/scan.php?page=search&q=Ubuntu%208.10).
> Ideally for this desktop encryption they will use Cryptsetup with
> LUKS support.


[1]: comment-crypter-vos-partitions-sous-ubuntu.html
[2]: http://www.phoronix.com/scan.php?page=article&item=ubuntu_hdd_encrypt&num=1
