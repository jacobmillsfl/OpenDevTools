/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/15/2017
Description:	Creates the Users table and respective stored procedures

*/


USE opendevtools;



--------------------------------------------------------------
-- Create table
--------------------------------------------------------------



CREATE TABLE `opendevtools`.`Users` (
id INT AUTO_INCREMENT,
username VARCHAR(255) UNIQUE,
password VARCHAR(255),
email VARCHAR(255),
bio VARCHAR(1047),
location VARCHAR(255),
imgUrl VARCHAR(511),
githubUrl VARCHAR(511),
createDate DATETIME,
CONSTRAINT pk_Users_id PRIMARY KEY (id)
);


--------------------------------------------------------------
-- Create default SCRUD sprocs for this table
--------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Users_Load`
(
	 IN paramid INT
)
BEGIN
	SELECT
		`Users`.`id` AS `id`,
		`Users`.`username` AS `username`,
		`Users`.`password` AS `password`,
		`Users`.`email` AS `email`,
		`Users`.`bio` AS `bio`,
		`Users`.`location` AS `location`,
		`Users`.`imgUrl` AS `imgUrl`,
		`Users`.`githubUrl` AS `githubUrl`,
		`Users`.`createDate` AS `createDate`
	FROM `Users`
	WHERE 		`Users`.`id` = paramid;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Users_LoadAll`()
BEGIN
	SELECT
		`Users`.`id` AS `id`,
		`Users`.`username` AS `username`,
		`Users`.`password` AS `password`,
		`Users`.`email` AS `email`,
		`Users`.`bio` AS `bio`,
		`Users`.`location` AS `location`,
		`Users`.`imgUrl` AS `imgUrl`,
		`Users`.`githubUrl` AS `githubUrl`,
		`Users`.`createDate` AS `createDate`
	FROM `Users`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Users_Add`
(
	 IN paramusername VARCHAR(255),
	 IN parampassword VARCHAR(255),
	 IN paramemail VARCHAR(255),
	 IN parambio VARCHAR(1047),
	 IN paramlocation VARCHAR(255),
	 IN paramimgUrl VARCHAR(511),
	 IN paramgithubUrl VARCHAR(511),
	 IN paramcreateDate DATETIME
)
BEGIN
	INSERT INTO `Users` (username,password,email,bio,location,imgUrl,githubUrl,createDate)
	VALUES (paramusername, parampassword, paramemail, parambio, paramlocation, paramimgUrl, paramgithubUrl, paramcreateDate);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Users_Update`
(
	IN paramid INT,
	IN paramusername VARCHAR(255),
	IN parampassword VARCHAR(255),
	IN paramemail VARCHAR(255),
	IN parambio VARCHAR(1047),
	IN paramlocation VARCHAR(255),
	IN paramimgUrl VARCHAR(511),
	IN paramgithubUrl VARCHAR(511),
	IN paramcreateDate DATETIME
)
BEGIN
	UPDATE `Users`
	SET username = paramusername
		,password = parampassword
		,email = paramemail
		,bio = parambio
		,location = paramlocation
		,imgUrl = paramimgUrl
		,githubUrl = paramgithubUrl
		,createDate = paramcreateDate
	WHERE		`Users`.`id` = paramid;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Users_Delete`
(
	IN paramid INT
)
BEGIN
	DELETE FROM `Users`
	WHERE		`Users`.`id` = paramid;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Users_Search`
(
	IN paramid INT,
	IN paramusername VARCHAR(255),
	IN parampassword VARCHAR(255),
	IN paramemail VARCHAR(255),
	IN parambio VARCHAR(1047),
	IN paramlocation VARCHAR(255),
	IN paramimgUrl VARCHAR(511),
	IN paramgithubUrl VARCHAR(511),
	IN paramcreateDate DATETIME
)
BEGIN
	SELECT
		`Users`.`id` AS `id`,
		`Users`.`username` AS `username`,
		`Users`.`password` AS `password`,
		`Users`.`email` AS `email`,
		`Users`.`bio` AS `bio`,
		`Users`.`location` AS `location`,
		`Users`.`imgUrl` AS `imgUrl`,
		`Users`.`githubUrl` AS `githubUrl`,
		`Users`.`createDate` AS `createDate`
	FROM `Users`
	WHERE
		COALESCE(Users.`id`,0) = COALESCE(paramid,Users.`id`,0)
		AND COALESCE(Users.`username`,'') = COALESCE(paramusername,Users.`username`,'')
		AND COALESCE(Users.`password`,'') = COALESCE(parampassword,Users.`password`,'')
		AND COALESCE(Users.`email`,'') = COALESCE(paramemail,Users.`email`,'')
		AND COALESCE(Users.`bio`,'') = COALESCE(parambio,Users.`bio`,'')
		AND COALESCE(Users.`location`,'') = COALESCE(paramlocation,Users.`location`,'')
		AND COALESCE(Users.`imgUrl`,'') = COALESCE(paramimgUrl,Users.`imgUrl`,'')
		AND COALESCE(Users.`githubUrl`,'') = COALESCE(paramgithubUrl,Users.`githubUrl`,'')
		AND COALESCE(CAST(Users.`createDate` AS DATE), CAST(NOW() AS DATE)) = COALESCE(CAST(paramcreateDate AS DATE),CAST(Users.`createDate` AS DATE), CAST(NOW() AS DATE));
END //
DELIMITER ;


