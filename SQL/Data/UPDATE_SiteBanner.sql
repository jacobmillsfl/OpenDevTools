USE opendevtools;

-- Remove all current SiteBanner entries
DELETE FROM SiteBanner;

-- Add new SiteBanner entries


INSERT INTO SiteBanner(title,message,imgUrl)
VALUES ("Team Oriented","Software and services provided by OpenDevTools are created to support development teams of all sizes","images/groupPic3.jpeg");

INSERT INTO SiteBanner(title,message,imgUrl)
VALUES ("Security Focused","Our technology utilizes the latest security standards to ensure confidentiality and integrity of your data","images/cyberSec.jpeg");

INSERT INTO SiteBanner(title,message,imgUrl)
VALUES ("Inovative Technologies","Our team is always finding new and exciting ways to deliver services to our users","images/groupPic1.jpeg");

INSERT INTO SiteBanner(title,message,imgUrl)
VALUES ("FSU Computer Science","The OpenDevTools team consists of students and alumnus from Florida State University's Computer Science department","images/fsuCampus.jpeg");

INSERT INTO SiteBanner(title,message,imgUrl)
VALUES ("Rapid Development","Our goal is to assist development teams with producing deliverables in a timely manner","images/groupPic2.jpeg");




