DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Permission_CheckUserPermission`
(
	IN paramId INT,
	IN paramname VARCHAR(255)
)
BEGIN
	SELECT DISTINCT
		1 AS hasPermission
	FROM Permission AS p
	INNER JOIN RoleToPermission AS rtp ON p.id = rtp.permissionid
	INNER JOIN User AS u ON rtp.UserRoleId = u.roleId
	WHERE u.id = paramId AND p.name = paramname;
		
END //
DELIMITER ;