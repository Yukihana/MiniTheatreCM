/*
	Yuki's Notes:
	
	-ALTER TABLE and IF EXISTS don't go together
	-Procedure: Create if absent, Alter to InnoDB, Truncate(where applicable), Data insertion
	-Real world cases don't delete tables: disastrous obvious consequences like data deletion.
*/

-- Metadata
CREATE TABLE IF NOT EXISTS `#__mtcm_metadatas` (
	`id`		INT(11)			NOT NULL AUTO_INCREMENT,
	`metaname`	VARCHAR(255)	NOT NULL,
	`metadata`	TEXT			NOT NULL DEFAULT '',
	`metadesc`	TEXT			NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data: Listings, Reviews
CREATE TABLE IF NOT EXISTS `#__mtcm_listings` (
	`id`				INT(11)			NOT NULL AUTO_INCREMENT,
	`name`				VARCHAR(255)	NOT NULL,
	`content`			TEXT			NOT NULL DEFAULT '',
	`author`			INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`codec`				VARCHAR(255)	NOT NULL DEFAULT '',
	`video_res`			VARCHAR(255)	NOT NULL DEFAULT '',
	`audio`				VARCHAR(255)	NOT NULL DEFAULT '',
	`subs`				VARCHAR(255)	NOT NULL DEFAULT '',
	`item_id`			INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`request_id`		INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`created_on`		TIMESTAMP		DEFAULT CURRENT_TIMESTAMP,
	`modified_on`		DATETIME		DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_reviews` (
	`id`		INT(11)			NOT NULL AUTO_INCREMENT,
	`name`		VARCHAR(255)	NOT NULL,
	`content`	TEXT			NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Items, Franchises
CREATE TABLE IF NOT EXISTS `#__mtcm_items` (
	`id`				INT(11)			NOT NULL AUTO_INCREMENT,
	`name`				VARCHAR(255)	NOT NULL,
	`content`			TEXT			NOT NULL DEFAULT '',
	`image_id`			VARCHAR(255)	NOT NULL DEFAULT '',
	`cat_id`			INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`genres`			VARCHAR(255)	NOT NULL DEFAULT '',
	`franchise_id`		INT(11)			NOT NULL DEFAULT '0',
	`www`				VARCHAR(255)	NOT NULL DEFAULT '',
	`mal`				VARCHAR(255)	NOT NULL DEFAULT '',
	`anidb`				VARCHAR(255)	NOT NULL DEFAULT '',
	`urls`				VARCHAR(1023)	NOT NULL DEFAULT '',
	`access`			INT(10)			UNSIGNED NOT NULL DEFAULT '1',
	`state`				INT(10)			NOT NULL DEFAULT '1',
	`featured`			TINYINT(4)		UNSIGNED NOT NULL DEFAULT '0',
	`rating`			TINYINT			UNSIGNED NOT NULL DEFAULT '0',
	`hits`				INT(11)			UNSIGNED NOT NULL DEFAULT '0',
	`created_on`		TIMESTAMP		DEFAULT CURRENT_TIMESTAMP,
	`lastedit_by`		INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`modified_on`		DATETIME		DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`poll_listings`		BOOLEAN			NOT NULL DEFAULT '0',
	`poll_reviews`		BOOLEAN			NOT NULL DEFAULT '0',
	`cache_listings`	TEXT			NOT NULL DEFAULT '',
	`cache_reviews`		TEXT			NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_franchises` (
	`id`				INT(11)			NOT NULL AUTO_INCREMENT,
	`name`				VARCHAR(255)	NOT NULL,
	`content`			TEXT			NOT NULL DEFAULT '',
	`image_id`			VARCHAR(255)	NOT NULL DEFAULT '',
	`genres`			VARCHAR(255)	NOT NULL DEFAULT '',
	`franchise_id`		INT(11)			NOT NULL DEFAULT '0',
	`www`				VARCHAR(255)	NOT NULL DEFAULT '',
	`mal`				VARCHAR(255)	NOT NULL DEFAULT '',
	`anidb`				VARCHAR(255)	NOT NULL DEFAULT '',
	`urls`				VARCHAR(1023)	NOT NULL DEFAULT '',
	`access`			INT(10)			UNSIGNED NOT NULL DEFAULT '1',
	`state`				INT(10)			NOT NULL DEFAULT '1',
	`featured`			TINYINT(4)		UNSIGNED NOT NULL DEFAULT '0',
	`rating`			TINYINT			UNSIGNED NOT NULL DEFAULT '0',
	`hits`				INT(11)			UNSIGNED NOT NULL DEFAULT '0',
	`created_on`		TIMESTAMP		DEFAULT CURRENT_TIMESTAMP,
	`lastedit_by`		INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`modified_on`		DATETIME		DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`poll_items`		BOOLEAN			NOT NULL DEFAULT '0',
	`poll_reviews`		BOOLEAN			NOT NULL DEFAULT '0',
	`cache_items`		TEXT			NOT NULL DEFAULT '',
	`cache_reviews`		TEXT			NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_genres` (
	`id`		INT(11)			NOT NULL AUTO_INCREMENT,
	`name`		VARCHAR(255)	NOT NULL,
	`content`	TEXT			NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Admin: UploadWizards (+ Multiple Upgrades)
CREATE TABLE IF NOT EXISTS `#__mtcm_admin_ulwiz` (
	`id`		INT(11)			NOT NULL AUTO_INCREMENT,
	`wname`		VARCHAR(25)		NOT NULL,
	`published`	tinyint(4)		NOT NULL DEFAULT '1',
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

INSERT INTO `#__mtcm_items` (`name`,`content`) VALUES
('Watashi No Koibito Wa Monster Desu', 'Description of the item <b>Watashi No Koibito Wa Monster Desu</b> goes here.'),
('Killing Squad', 'Description of the item <b>Killing Squad</b> goes here.');
