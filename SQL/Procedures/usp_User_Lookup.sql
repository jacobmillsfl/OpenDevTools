DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_User_Lookup`
(
	IN paramusername VARCHAR(255)
)
BEGIN
	SELECT
		`User`.`id` AS `id`,
		`User`.`username` AS `username`,
		`User`.`password` AS `password`,
		`User`.`email` AS `email`,
		`User`.`bio` AS `bio`,
		`User`.`location` AS `location`,
		`User`.`imgUrl` AS `imgUrl`,
		`User`.`githubUrl` AS `githubUrl`,
		`User`.`createDate` AS `createDate`,
		`User`.`roleId` AS `roleId`
	FROM `User`
	WHERE User.`username` = paramusername;
END //
DELIMITER ;