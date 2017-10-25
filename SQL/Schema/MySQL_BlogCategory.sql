/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/15/2017
Description:	Creates the BlogCategory table and respective stored procedures

*/


USE opendevtools;



--------------------------------------------------------------
-- Create table
--------------------------------------------------------------



CREATE TABLE `opendevtools`.`BlogCategory` (
id INT AUTO_INCREMENT,
name VARCHAR(255),
description VARCHAR(255),
CONSTRAINT pk_BlogCategory_id PRIMARY KEY (id)
);


--------------------------------------------------------------
-- Create default SCRUD sprocs for this table
--------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_BlogCategory_Load`
(
	 IN paramid INT
)
BEGIN
	SELECT
		`BlogCategory`.`id` AS `id`,
		`BlogCategory`.`name` AS `name`,
		`BlogCategory`.`description` AS `description`
	FROM `BlogCategory`
	WHERE 		`BlogCategory`.`id` = paramid;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_BlogCategory_LoadAll`()
BEGIN
	SELECT
		`BlogCategory`.`id` AS `id`,
		`BlogCategory`.`name` AS `name`,
		`BlogCategory`.`description` AS `description`
	FROM `BlogCategory`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_BlogCategory_Add`
(
	 IN paramname VARCHAR(255),
	 IN paramdescription VARCHAR(255)
)
BEGIN
	INSERT INTO `BlogCategory` (name,description)
	VALUES (paramname, paramdescription);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_BlogCategory_Update`
(
	IN paramid INT,
	IN paramname VARCHAR(255),
	IN paramdescription VARCHAR(255)
)
BEGIN
	UPDATE `BlogCategory`
	SET name = paramname
		,description = paramdescription
	WHERE		`BlogCategory`.`id` = paramid;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_BlogCategory_Delete`
(
	IN paramid INT
)
BEGIN
	DELETE FROM `BlogCategory`
	WHERE		`BlogCategory`.`id` = paramid;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_BlogCategory_Search`
(
	IN paramid INT,
	IN paramname VARCHAR(255),
	IN paramdescription VARCHAR(255)
)
BEGIN
	SELECT
		`BlogCategory`.`id` AS `id`,
		`BlogCategory`.`name` AS `name`,
		`BlogCategory`.`description` AS `description`
	FROM `BlogCategory`
	WHERE
		COALESCE(BlogCategory.`id`,0) = COALESCE(paramid,BlogCategory.`id`,0)
		AND COALESCE(BlogCategory.`name`,'') = COALESCE(paramname,BlogCategory.`name`,'')
		AND COALESCE(BlogCategory.`description`,'') = COALESCE(paramdescription,BlogCategory.`description`,'');
END //
DELIMITER ;

