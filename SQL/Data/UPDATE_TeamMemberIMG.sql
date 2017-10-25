
/*
	This Script is used to update the team pictures to black and white
*/
USE opendevtools;

UPDATE TeamMember SET imgUrl = 'images/jacob_bw.jpg' WHERE id = 1; 
UPDATE TeamMember SET imgUrl = 'images/carla_bw.jpg' WHERE id = 2; 
UPDATE TeamMember SET imgUrl = 'images/rob_bw.jpg' WHERE id = 3; 
UPDATE TeamMember SET imgUrl = 'images/annie_bw.jpg' WHERE id = 4; 
UPDATE TeamMember SET imgUrl = 'images/carlo_bw.jpg' WHERE id = 5; 
