USE opendevtools;

INSERT INTO UserRole(name,description)
VALUES ("General","General User with minimal priviledges");

INSERT INTO UserRole(name,description)
VALUES ("Blogger","Blogger User extending the priviledges of the General User to also include access to create and edit Blogs");

INSERT INTO UserRole(name,description)
VALUES ("Moderator","Moderator User extending the priviledges of Blogger to allow editing and deleting of user provided content");

INSERT INTO UserRole(name,description)
VALUES ("Admin","Admin User with the highest level of priviledges");