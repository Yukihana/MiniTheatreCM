DROP TABLE IF EXISTS `#__mtcmopt_ulwiz_wmodes`;

CREATE TABLE `#__mtcmopt_ulwiz_wmodes` (
	`id`		INT(11)		NOT NULL AUTO_INCREMENT,
	`wmode`		VARCHAR(25)	NOT NULL,
	`published`	tinyint(4)	NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)

	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
	
INSERT INTO `#__mtcmopt_ulwiz_wmodes` (`wmode`) VALUES
('Selection'),
('Anime');