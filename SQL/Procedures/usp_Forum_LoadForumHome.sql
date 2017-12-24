DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Forum_LoadForumHome`
(
	IN paramcontent VARCHAR(32768),
	IN paramforumCategoryId INT,
	IN paramoffset INT
)
BEGIN
	SELECT
		`Forum`.`id` AS `id`,
		`User`.`username` AS `username`,
		`Forum`.`title` AS `title`,
		`Forum`.`content` AS `content`,
		`Forum`.`createDate` AS `createDate`,
		`Forum`.`forumCategoryId` AS `forumCategoryId`
	FROM `Forum`
	INNER JOIN `User` ON `Forum`.`createdByUserId` = `User`.`id`
	WHERE
		(COALESCE(Forum.`content`,'') LIKE COALESCE(CONCAT('%',paramcontent,'%'),Forum.`content`,'')
		OR
		COALESCE(Forum.`title`,'') LIKE COALESCE(CONCAT('%',paramcontent,'%'),Forum.`title`,''))
		AND COALESCE(Forum.`forumCategoryId`,0) = COALESCE(paramforumCategoryId,Forum.`forumCategoryId`,0)
	ORDER BY `Forum`.`createDate` DESC
	LIMIT 5
	OFFSET paramoffset;
END //
DELIMITER ;