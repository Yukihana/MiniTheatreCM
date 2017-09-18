/*
	Yuki's Notes:
	
	-ALTER TABLE and IF EXISTS don't go together
	-Procedure: Create if absent, Alter to InnoDB, Truncate(where applicable), Data insertion
	-Real world cases don't delete tables: disastrous obvious consequences like data deletion.
*/

-- Metadata (May change primary key to 'metaname' later, May also delete)
CREATE TABLE IF NOT EXISTS `#__mtcm_metadatas` (
	`id`		INT(11)		NOT NULL AUTO_INCREMENT,
	`metaname`	VARCHAR(25)	NOT NULL,
	`metadata`	TEXT		NOT NULL DEFAULT '',
	`metadesc`	TEXT		NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data: Listings, Reviews
CREATE TABLE IF NOT EXISTS `#__mtcm_data_listings` (
	`id`		INT(11)		NOT NULL AUTO_INCREMENT,
	`name`		VARCHAR(25)	NOT NULL,
	`content`	TEXT		NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_data_reviews` (
	`id`		INT(11)		NOT NULL AUTO_INCREMENT,
	`name`		VARCHAR(25)	NOT NULL,
	`content`	TEXT		NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Wiki: Franchises, Items
CREATE TABLE IF NOT EXISTS `#__mtcm_wiki_franchises` (
	`id`		INT(11)		NOT NULL AUTO_INCREMENT,
	`name`		VARCHAR(25)	NOT NULL,
	`content`	TEXT		NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_wiki_items` (
	`id`		INT(11)		NOT NULL AUTO_INCREMENT,
	`metaname`	VARCHAR(25)	NOT NULL,
	`metadata`	TEXT		NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Admin: UploadWizards (Upgrade to InnoDB)
CREATE TABLE IF NOT EXISTS `#__mtcm_admin_ulwiz` (
	`id`		INT(11)		NOT NULL AUTO_INCREMENT,
	`wname`		VARCHAR(25)	NOT NULL,
	`published`	tinyint(4)	NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `#__mtcm_admin_ulwiz` ENGINE=INNODB;
ALTER TABLE `#__mtcm_admin_ulwiz` CHARSET=utf8mb4;
ALTER TABLE `#__mtcm_admin_ulwiz` COLLATE=utf8mb4_unicode_ci;

TRUNCATE TABLE `#__mtcm_admin_ulwiz`;

-- Test Values, release version won't be using these.
INSERT INTO `#__mtcm_admin_ulwiz` (`wname`) VALUES
('Anime'),
('Movie'),
('Manga'),
('Dorama');