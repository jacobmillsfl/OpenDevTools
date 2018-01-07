/*
Author: Carla Pastor & Jacob Mills
Date: 11/19/2017
Description: Create new role for Restricted
			Create new permissions for ManageBlog,CommentBlog,EditBlogComment
			Create associations between roles and permissions
*/

use opendevtools;

/*
-- Create new role for Restricted user
INSERT INTO userrole(name,description)
VALUES("Restricted","This user should have limited functionality");

-- Create new permissions

INSERT INTO permission (name,description,createdate)
VALUES ("ManageBlog","Roles with this permission have the ability to create and edit blogs",NOW());

INSERT INTO permission (name,description,createdate)
VALUES ("CommentBlog","Roles with this permission have the ability to comment on blogs",NOW());

INSERT INTO permission (name,description,createdate)
VALUES ("EditBlogComment","Roles with this permission have the ability to edit blog comments",NOW());

-- Associate roles to permissions

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (2,1); -- Blogger, ManageBlog

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (3,1); -- Moderator, ManageBlog

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (4,1); -- Admin, ManageBlog

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (1,2); -- General, CommentBlog

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (2,2); -- Blogger, CommentBlog

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (3,2); -- Moderator, CommentBlog

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (4,2); -- Admin, CommentBlog

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (3,3); -- Moderator, CommentBlog

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (4,3); -- Admin, CommentBlog


*/


INSERT INTO permission (name,description,createdate)
VALUES ("ManageForum","Roles with this permission have the ability to create and edit forums",NOW());

INSERT INTO permission (name,description,createdate)
VALUES ("CommentForum","Roles with this permission have the ability to comment on forums",NOW());

INSERT INTO permission (name,description,createdate)
VALUES ("EditForumComment","Roles with this permission have the ability to edit forum comments",NOW());

-- Associate roles to permissions
INSERT INTO roletopermission(userroleid,permissionid)
VALUES (1,4); -- Blogger, ManageForum

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (2,4); -- Blogger, ManageForum

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (3,4); -- Moderator, ManageForum

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (4,4); -- Admin, ManageForum

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (1,5); -- General, CommentForum

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (2,5); -- Blogger, CommentForum

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (3,5); -- Moderator, CommentForum

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (4,5); -- Admin, CommentForum

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (1,6); -- Moderator, EditForumComment

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (2,6); -- Admin, EditForumComment

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (3,6); -- Moderator, EditForumComment

INSERT INTO roletopermission(userroleid,permissionid)
VALUES (4,6); -- Admin, EditForumComment