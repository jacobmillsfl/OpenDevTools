/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			11/19/2017
Description:	Creates the roletopermission table and respective stored procedures

*/


USE opendevtools;

-- drop previous table schema and sprocs
DROP TABLE `roletopermission`;
DROP PROCEDURE IF EXISTS `usp_RoleToPermission_LoadAll`;
DROP PROCEDURE IF EXISTS `usp_RoleToPermission_Search`;
DROP PROCEDURE IF EXISTS `usp_RoleToPermission_Add`;
DROP PROCEDURE IF EXISTS `usp_RoleToPermission_Load`;
DROP PROCEDURE IF EXISTS `usp_RoleToPermission_Delete`;
DROP PROCEDURE IF EXISTS `usp_RoleToPermission_Update`;


-- ------------------------------------------------------------
-- Create table
-- ------------------------------------------------------------



CREATE TABLE `opendevtools`.`roletopermission` (
Id INT AUTO_INCREMENT,
roleId INT,
permissionId INT,
CONSTRAINT pk_roletopermission_Id PRIMARY KEY (Id)
,
CONSTRAINT fk_roletopermission_roleId_userrole_Id FOREIGN KEY (roleId) REFERENCES userrole (Id)
,
CONSTRAINT fk_roletopermission_permissionId_permission_Id FOREIGN KEY (permissionId) REFERENCES permission (Id)
);


-- ------------------------------------------------------------
-- Create default SCRUD sprocs for this table
-- ------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_RoleToPermission_Load`
(
	 IN paramId INT
)
BEGIN
	SELECT
		`roletopermission`.`Id` AS `Id`,
		`roletopermission`.`roleId` AS `roleId`,
		`roletopermission`.`permissionId` AS `permissionId`
	FROM `roletopermission`
	WHERE 		`roletopermission`.`Id` = paramId;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_RoleToPermission_LoadAll`()
BEGIN
	SELECT
		`roletopermission`.`Id` AS `Id`,
		`roletopermission`.`roleId` AS `roleId`,
		`roletopermission`.`permissionId` AS `permissionId`
	FROM `roletopermission`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_RoleToPermission_Add`
(
	 IN paramroleId INT,
	 IN parampermissionId INT
)
BEGIN
	INSERT INTO `roletopermission` (roleId,permissionId)
	VALUES (paramroleId, parampermissionId);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_RoleToPermission_Update`
(
	IN paramId INT,
	IN paramroleId INT,
	IN parampermissionId INT
)
BEGIN
	UPDATE `roletopermission`
	SET roleId = paramroleId
		,permissionId = parampermissionId
	WHERE		`roletopermission`.`Id` = paramId;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_RoleToPermission_Delete`
(
	IN paramId INT
)
BEGIN
	DELETE FROM `roletopermission`
	WHERE		`roletopermission`.`Id` = paramId;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_RoleToPermission_Search`
(
	IN paramId INT,
	IN paramroleId INT,
	IN parampermissionId INT
)
BEGIN
	SELECT
		`roletopermission`.`Id` AS `Id`,
		`roletopermission`.`roleId` AS `roleId`,
		`roletopermission`.`permissionId` AS `permissionId`
	FROM `roletopermission`
	WHERE
		COALESCE(roletopermission.`Id`,0) = COALESCE(paramId,roletopermission.`Id`,0)
		AND COALESCE(roletopermission.`roleId`,0) = COALESCE(paramroleId,roletopermission.`roleId`,0)
		AND COALESCE(roletopermission.`permissionId`,0) = COALESCE(parampermissionId,roletopermission.`permissionId`,0);
END //
DELIMITER ;


