/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/15/2017
Description:	Creates the Blog table and respective stored procedures

*/


USE opendevtools;



-- ------------------------------------------------------------
-- Create table
-- ------------------------------------------------------------



CREATE TABLE `opendevtools`.`Blog` (
id INT AUTO_INCREMENT,
userId INT,
title VARCHAR(255),
content VARCHAR(32768),
imgUrl VARCHAR(511),
createDate DATETIME,
blogCategoryId INT,
views INT,
CONSTRAINT pk_Blog_id PRIMARY KEY (id)
,
CONSTRAINT fk_Blog_userId_User_id FOREIGN KEY (userId) REFERENCES User (id)
,
CONSTRAINT fk_Blog_blogCategoryId_BlogCategory_id FOREIGN KEY (blogCategoryId) REFERENCES BlogCategory (id)
);


-- ------------------------------------------------------------
-- Create default SCRUD sprocs for this table
-- ------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Blog_Load`
(
	 IN paramid INT
)
BEGIN
	SELECT
		`Blog`.`id` AS `id`,
		`Blog`.`userId` AS `userId`,
		`Blog`.`title` AS `title`,
		`Blog`.`content` AS `content`,
		`Blog`.`imgUrl` AS `imgUrl`,
		`Blog`.`createDate` AS `createDate`,
		`Blog`.`blogCategoryId` AS `blogCategoryId`,
		`Blog`.`views` AS `views`
	FROM `Blog`
	WHERE 		`Blog`.`id` = paramid;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Blog_LoadAll`()
BEGIN
	SELECT
		`Blog`.`id` AS `id`,
		`Blog`.`userId` AS `userId`,
		`Blog`.`title` AS `title`,
		`Blog`.`content` AS `content`,
		`Blog`.`imgUrl` AS `imgUrl`,
		`Blog`.`createDate` AS `createDate`,
		`Blog`.`blogCategoryId` AS `blogCategoryId`,
		`Blog`.`views` AS `views`
	FROM `Blog`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Blog_Add`
(
	 IN paramuserId INT,
	 IN paramtitle VARCHAR(255),
	 IN paramcontent VARCHAR(32768),
	 IN paramimgUrl VARCHAR(511),
	 IN paramcreateDate DATETIME,
	 IN paramblogCategoryId INT,
	 IN paramviews INT
)
BEGIN
	INSERT INTO `Blog` (userId,title,content,imgUrl,createDate,blogCategoryId,views)
	VALUES (paramuserId, paramtitle, paramcontent, paramimgUrl, paramcreateDate, paramblogCategoryId, paramviews);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Blog_Update`
(
	IN paramid INT,
	IN paramuserId INT,
	IN paramtitle VARCHAR(255),
	IN paramcontent VARCHAR(32768),
	IN paramimgUrl VARCHAR(511),
	IN paramcreateDate DATETIME,
	IN paramblogCategoryId INT,
	IN paramviews INT
)
BEGIN
	UPDATE `Blog`
	SET userId = paramuserId
		,title = paramtitle
		,content = paramcontent
		,imgUrl = paramimgUrl
		,createDate = paramcreateDate
		,blogCategoryId = paramblogCategoryId
		,views = paramviews
	WHERE		`Blog`.`id` = paramid;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Blog_Delete`
(
	IN paramid INT
)
BEGIN
	DELETE FROM `Blog`
	WHERE		`Blog`.`id` = paramid;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Blog_Search`
(
	IN paramid INT,
	IN paramuserId INT,
	IN paramtitle VARCHAR(255),
	IN paramcontent VARCHAR(32768),
	IN paramimgUrl VARCHAR(511),
	IN paramcreateDate DATETIME,
	IN paramblogCategoryId INT,
	IN paramviews INT
)
BEGIN
	SELECT
		`Blog`.`id` AS `id`,
		`Blog`.`userId` AS `userId`,
		`Blog`.`title` AS `title`,
		`Blog`.`content` AS `content`,
		`Blog`.`imgUrl` AS `imgUrl`,
		`Blog`.`createDate` AS `createDate`,
		`Blog`.`blogCategoryId` AS `blogCategoryId`,
		`Blog`.`views` AS `views`
	FROM `Blog`
	WHERE
		COALESCE(Blog.`id`,0) = COALESCE(paramid,Blog.`id`,0)
		AND COALESCE(Blog.`userId`,0) = COALESCE(paramuserId,Blog.`userId`,0)
		AND COALESCE(Blog.`title`,'') = COALESCE(paramtitle,Blog.`title`,'')
		AND COALESCE(Blog.`content`,'') = COALESCE(paramcontent,Blog.`content`,'')
		AND COALESCE(Blog.`imgUrl`,'') = COALESCE(paramimgUrl,Blog.`imgUrl`,'')
		AND COALESCE(CAST(Blog.`createDate` AS DATE), CAST(NOW() AS DATE)) = COALESCE(CAST(paramcreateDate AS DATE),CAST(Blog.`createDate` AS DATE), CAST(NOW() AS DATE))
		AND COALESCE(Blog.`blogCategoryId`,0) = COALESCE(paramblogCategoryId,Blog.`blogCategoryId`,0)
		AND COALESCE(Blog.`views`,0) = COALESCE(paramviews,Blog.`views`,0);
END //
DELIMITER ;


