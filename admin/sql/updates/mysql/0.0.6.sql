DROP TABLE IF EXISTS `#__mtcm_admin_ulwiz`;

CREATE TABLE `#__mtcm_admin_ulwiz` (
	`id`		INT(11)		NOT NULL AUTO_INCREMENT,
	`wname`		VARCHAR(25)	NOT NULL,
	`published`	tinyint(4)	NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)

	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
	
INSERT INTO `#__mtcm_admin_ulwiz` (`wname`) VALUES
('Selection'),
('Anime');