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
		AND COALESCE(Blog.`views`,0) = COALESCE(paramviews,Blog.`views`,0)
	ORDER BY `Blog`.`createDate` DESC;
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
	FROM `Blog`
	ORDER BY `Blog`.`createDate` DESC;
END //
DELIMITER ;