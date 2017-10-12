/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/5/2017
Description:	Creates the TeamMember table and respective stored procedures

*/


USE opendevtools;



--------------------------------------------------------------
-- Create table
--------------------------------------------------------------



CREATE TABLE `opendevtools`.`TeamMember` (
id INT AUTO_INCREMENT,
name VARCHAR(255),
title VARCHAR(255),
bio VARCHAR(1047),
email VARCHAR(255),
createDate DATETIME,
imgUrl VARCHAR(511),
CONSTRAINT pk_TeamMember_id PRIMARY KEY (id)
);


--------------------------------------------------------------
-- Create default SCRUD sprocs for this table
--------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_TeamMember_Load`
(
	 IN paramid INT
)
BEGIN
	SELECT
		`TeamMember`.`id` AS `id`,
		`TeamMember`.`name` AS `name`,
		`TeamMember`.`title` AS `title`,
		`TeamMember`.`bio` AS `bio`,
		`TeamMember`.`email` AS `email`,
		`TeamMember`.`createDate` AS `createDate`,
		`TeamMember`.`imgUrl` AS `imgUrl`
	FROM `TeamMember`
	WHERE 		`TeamMember`.`id` = paramid;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_TeamMember_LoadAll`()
BEGIN
	SELECT
		`TeamMember`.`id` AS `id`,
		`TeamMember`.`name` AS `name`,
		`TeamMember`.`title` AS `title`,
		`TeamMember`.`bio` AS `bio`,
		`TeamMember`.`email` AS `email`,
		`TeamMember`.`createDate` AS `createDate`,
		`TeamMember`.`imgUrl` AS `imgUrl`
	FROM `TeamMember`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_TeamMember_Add`
(
	 IN paramname VARCHAR(255),
	 IN paramtitle VARCHAR(255),
	 IN parambio VARCHAR(1047),
	 IN paramemail VARCHAR(255),
	 IN paramcreateDate DATETIME,
	 IN paramimgUrl VARCHAR(511)
)
BEGIN
	INSERT INTO `TeamMember` (name,title,bio,email,createDate,imgUrl)
	VALUES (paramname, paramtitle, parambio, paramemail, paramcreateDate, paramimgUrl);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_TeamMember_Update`
(
	IN paramid INT,
	IN paramname VARCHAR(255),
	IN paramtitle VARCHAR(255),
	IN parambio VARCHAR(1047),
	IN paramemail VARCHAR(255),
	IN paramcreateDate DATETIME,
	IN paramimgUrl VARCHAR(511)
)
BEGIN
	UPDATE `TeamMember`
	SET name = paramname
		,title = paramtitle
		,bio = parambio
		,email = paramemail
		,createDate = paramcreateDate
		,imgUrl = paramimgUrl
	WHERE		`TeamMember`.`id` = paramid;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_TeamMember_Delete`
(
	IN paramid INT
)
BEGIN
	DELETE FROM `TeamMember`
	WHERE		`TeamMember`.`id` = paramid;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_TeamMember_Search`
(
	IN paramid INT,
	IN paramname VARCHAR(255),
	IN paramtitle VARCHAR(255),
	IN parambio VARCHAR(1047),
	IN paramemail VARCHAR(255),
	IN paramcreateDate DATETIME,
	IN paramimgUrl VARCHAR(511)
)
BEGIN
	SELECT
		`TeamMember`.`id` AS `id`,
		`TeamMember`.`name` AS `name`,
		`TeamMember`.`title` AS `title`,
		`TeamMember`.`bio` AS `bio`,
		`TeamMember`.`email` AS `email`,
		`TeamMember`.`createDate` AS `createDate`,
		`TeamMember`.`imgUrl` AS `imgUrl`
	FROM `TeamMember`
	WHERE
		COALESCE(TeamMember.`id`,0) = COALESCE(paramid,TeamMember.`id`,0)
		AND COALESCE(TeamMember.`name`,'') = COALESCE(paramname,TeamMember.`name`,'')
		AND COALESCE(TeamMember.`title`,'') = COALESCE(paramtitle,TeamMember.`title`,'')
		AND COALESCE(TeamMember.`bio`,'') = COALESCE(parambio,TeamMember.`bio`,'')
		AND COALESCE(TeamMember.`email`,'') = COALESCE(paramemail,TeamMember.`email`,'')
		AND COALESCE(CAST(TeamMember.`createDate` AS DATE), CAST(GETDATE() AS DATE)) = COALESCE(CAST(paramcreateDate AS DATE),CAST(TeamMember.`createDate` AS DATE), CAST(GETDATE() AS DATE))
		AND COALESCE(TeamMember.`imgUrl`,'') = COALESCE(paramimgUrl,TeamMember.`imgUrl`,'');
END //
DELIMITER ;

