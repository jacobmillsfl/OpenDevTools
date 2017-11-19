/*
Author: Carla Pastor
Date: 11/19/2017
Description: Add content to blog
*/


INSERT INTO Blog (userId,title,content,imgUrl,createDate,blogCategoryId,views)
VALUES (1,'The success of Open Source','A fundamental principle of open-source development is that the source code should be freely
available. The source code of the program can be freely downloaded, used, modified and
redistributed by anyone. The open source model could and should be applied in all types of
research and development, not only in software. Many of the most successful companies in the
world attribute at least some of their success to open source platforms: Amazon uses Apache as
a web server, large parts of Yahoo! they are built on Linux, FreeBSD and Apache, written in PHP
and Perl; Google has completely based on Linux its Android mobile operating system; Mozilla has
developed Firefox, one of the most used browsers for years in the world.
The flexibility of free software makes it possible to reduce costs in many ways and accelerate
the development of projects by having fewer restrictions that can be presented using closed
models. The freedoms end up being important for the users, for the developers and for the
companies; and at the same time, society can adapt the model to make culture flourish, just as
scientific research can obtain results more quickly, which will have an impact on the benefit
of the whole of humanity.','/images/opensource.Carla.png',NOW(),5,0)