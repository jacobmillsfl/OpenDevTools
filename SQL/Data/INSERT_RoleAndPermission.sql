/*
Author: Carla Pastor & Jacob Mills
Date: 11/19/2017
Description: Create new role for Restricted
			Create new permissions for ManageBlog,CommentBlog,EditBlogComment
			Create associations between roles and permissions
*/

use opendevtools;

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