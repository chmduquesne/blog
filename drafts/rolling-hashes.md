Title: Which rolling hash is the best?
Date: 2018-05-30 23:11
Category: golang
Tags: golang, go, rolling, hash

Rolling hashes have been a little hobby of mine since a few years. I
discovered them while digging in the [bup][1] design document. Since 2015,
I maintain a go library named [rollinghash][2] where I implemented a few
rolling hashes that I found interesting. One of the notable users of this
library is the decentralized synchronisation solution [syncthing][3],
which uses it to [detect shifted blocks][4] in order to avoid unnecessary
downloads.

In this article, I want to discuss about the intrinsic 

[1]: https://bup.github.io/
[2]: https://github.com/chmduquesne/rollinghash
[3]: https://syncthing.net/
[4]: https://kastelo.net/blog/2018-06/syncthing-syncing/
