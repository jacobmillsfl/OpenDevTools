DELIMITER //
CREATE PROCEDURE `opendevtools`.`usp_Blog_LoadBlogHome`
(
	IN paramcontent VARCHAR(32768),
	IN paramblogCategoryId INT,
	IN paramoffset INT
)
BEGIN
	SELECT
		`Blog`.`id` AS `id`,
		`User`.`username` AS `username`,
		`Blog`.`title` AS `title`,
		`Blog`.`content` AS `content`,
		`Blog`.`imgUrl` AS `imgUrl`,
		`Blog`.`createDate` AS `createDate`,
		`Blog`.`blogCategoryId` AS `blogCategoryId`
	FROM `Blog`
	INNER JOIN `User` ON `Blog`.`userId` = `User`.`id`
	WHERE
		(COALESCE(Blog.`content`,'') LIKE COALESCE(CONCAT('%',paramcontent,'%'),Blog.`content`,'')
		OR 
		COALESCE(Blog.`title`,'') LIKE COALESCE(CONCAT('%',paramcontent,'%'),Blog.`title`,''))
		AND COALESCE(Blog.`blogCategoryId`,0) = COALESCE(paramblogCategoryId,Blog.`blogCategoryId`,0)
	ORDER BY `Blog`.`createDate` DESC
	LIMIT 5
	OFFSET paramoffset;
END //
DELIMITER ;