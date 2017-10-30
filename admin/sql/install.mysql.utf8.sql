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

-- User Data: Listings, Reviews
CREATE TABLE IF NOT EXISTS `#__mtcm_listings` (
	`id`				INT(11)			NOT NULL AUTO_INCREMENT,
	`name`				VARCHAR(255)	NOT NULL,
	`content`			TEXT			NOT NULL DEFAULT '',
	`description`		TEXT			NOT NULL DEFAULT '',
	`state`				INT(10)			NOT NULL DEFAULT '1',
	`live`				BOOLEAN			NOT NULL DEFAULT '1',
	`misc1`				VARCHAR(255)	NOT NULL DEFAULT ''		COMMENT 'codec',
	`misc2`				VARCHAR(255)	NOT NULL DEFAULT ''		COMMENT 'vid_res',
	`misc3`				VARCHAR(255)	NOT NULL DEFAULT ''		COMMENT 'audio',
	`misc4`				VARCHAR(255)	NOT NULL DEFAULT ''		COMMENT 'subs',
	`item_id`			INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`request_name`		VARCHAR(255)	NOT NULL DEFAULT '',
	`request_desc`		TEXT			NOT NULL DEFAULT '',
	`author`			INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`recentedit`		INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`created`			TIMESTAMP		DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME		DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_reviews` (
	`id`			INT(11)			NOT NULL AUTO_INCREMENT,
	`caption`		VARCHAR(255)	NOT NULL DEFAULT '',
	`content`		TEXT			NOT NULL DEFAULT '',
	`item_id`		INT(10)			NOT NULL DEFAULT '0',
	`state`			INT(10)			NOT NULL DEFAULT '1',
	`live`			BOOLEAN			NOT NULL DEFAULT '1',
	`author`		INT(10)			NOT NULL DEFAULT '0',
	`recentedit`	INT(10)			NOT NULL DEFAULT '0',
	`created`		TIMESTAMP		DEFAULT CURRENT_TIMESTAMP,
	`modified`		DATETIME		DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Community Data: Items, Franchises
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
	`rating_sum`		INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`rating_count`		INT(10)			UNSIGNED NOT NULL DEFAULT '0',
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
	`www`				VARCHAR(255)	NOT NULL DEFAULT '',
	`mal`				VARCHAR(255)	NOT NULL DEFAULT '',
	`anidb`				VARCHAR(255)	NOT NULL DEFAULT '',
	`urls`				VARCHAR(1023)	NOT NULL DEFAULT '',
	`access`			INT(10)			UNSIGNED NOT NULL DEFAULT '2',
	`state`				INT(10)			NOT NULL DEFAULT '1',
	`featured`			TINYINT(4)		UNSIGNED NOT NULL DEFAULT '0',
	`rating_sum`		INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`rating_count`		INT(10)			UNSIGNED NOT NULL DEFAULT '0',
	`hits`				INT(11)			UNSIGNED NOT NULL DEFAULT '0',
	`author`			INT(10)			NOT NULL DEFAULT '0',
	`recentedit`		INT(10)			NOT NULL DEFAULT '0',
	`created`			TIMESTAMP		DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME		DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`poll_items`		BOOLEAN			NOT NULL DEFAULT '0',
	`poll_reviews`		BOOLEAN			NOT NULL DEFAULT '0',
	`cache_items`		TEXT			NOT NULL DEFAULT '',
	`cache_reviews`		TEXT			NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Helpers: Genres
CREATE TABLE IF NOT EXISTS `#__mtcm_genres` (
	`id`			INT(11)			NOT NULL AUTO_INCREMENT,
	`name`			VARCHAR(255)	NOT NULL,
	`content`		TEXT			NOT NULL DEFAULT '',
	`state`			INT(10)			NOT NULL DEFAULT '1',
	`author`		INT(10)			NOT NULL DEFAULT '0',
	`recentedit`	INT(10)			NOT NULL DEFAULT '0',
	`created`		TIMESTAMP		DEFAULT CURRENT_TIMESTAMP,
	`modified`		DATETIME		DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ratings: Listings, Reviews, Items, Franchises
CREATE TABLE IF NOT EXISTS `#__mtcm_ratings_listings` (
	`id`			INT(11)			NOT NULL AUTO_INCREMENT,
	`user_id`		INT(10)			NOT NULL DEFAULT '0',
	`listing_id`	INT(10)			NOT NULL DEFAULT '0',
	`rating`		TINYINT			NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_ratings_reviews` (
	`id`			INT(11)			NOT NULL AUTO_INCREMENT,
	`user_id`		INT(10)			NOT NULL DEFAULT '0',
	`review_id`		INT(10)			NOT NULL DEFAULT '0',
	`vote`			TINYINT			NOT NULL DEFAULT '0' COMMENT '1 for upvote, -1 for downvote, 0 for unvoted',
	`reaction`		TINYINT			NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_ratings_items` (
	`id`			INT(11)			NOT NULL AUTO_INCREMENT,
	`user_id`		INT(10)			NOT NULL DEFAULT '0',
	`item_id`		INT(10)			NOT NULL DEFAULT '0',
	`rating`		TINYINT			NOT NULL DEFAULT '0',
	`recommend`		BOOLEAN			NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_ratings_franchises` (
	`id`			INT(11)			NOT NULL AUTO_INCREMENT,
	`user_id`		INT(10)			NOT NULL DEFAULT '0',
	`franchise_id`	INT(10)			NOT NULL DEFAULT '0',
	`rating`		TINYINT			NOT NULL DEFAULT '0',
	`recommend`		BOOLEAN			NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Admin: UploadWizards
-- Legacy Version
CREATE TABLE IF NOT EXISTS `#__mtcm_admin_ulwiz` (
	`id`		INT(11)			NOT NULL AUTO_INCREMENT,
	`wname`		VARCHAR(25)		NOT NULL,
	`published`	tinyint(4)		NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- New Version (Add content types after deciding the mechanism)
CREATE TABLE IF NOT EXISTS `#__mtcm_contenttypes` (
	`id`				INT(10)			NOT NULL AUTO_INCREMENT,
	`name`				VARCHAR(255)	NOT NULL DEFAULT '',
	`metafields`		TEXT			NOT NULL DEFAULT '',
	`state`				TINYINT(4)		NOT NULL DEFAULT '1',
	`access`			INT(10)			NOT NULL DEFAULT '2'	COMMENT 'Joomla Access User-group ID',
	`allow_request`		BOOLEAN			NOT NULL DEFAULT '1',
	`author`			INT(10)			NOT NULL DEFAULT '0',
	`recentedit`		INT(10)			NOT NULL DEFAULT '0',
	`created`			TIMESTAMP		DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME		DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Test Values, release version won't be using these.
INSERT INTO `#__mtcm_contenttypes` (`name`, `author`) VALUES
('Anime', 42),
('Movie', 43);
INSERT INTO `#__mtcm_contenttypes` (`name`) VALUES
('Manga'),
('Dorama');

INSERT INTO `#__mtcm_admin_ulwiz` (`wname`) VALUES
('Anime'),
('Movie'),
('Manga'),
('Dorama');

INSERT INTO `#__mtcm_items` (`name`,`content`) VALUES
('Watashi No Koibito Wa Monster Desu', 'Description of the item <b>Watashi No Koibito Wa Monster Desu</b> goes here.'),
('Killing Squad', 'Description of the item <b>Killing Squad</b> goes here.');

INSERT INTO `#__mtcm_listings` (`name`, `author`, `item_id`) VALUES
('Test Listing 1', 42, 1),
('Test Listing 2', 42, 2),
('Test Listing 3', 42, 1),
('Missing Item Listing 4', 42, 5),
('Test Listing 5', 45, 2),
('Test Listing 6', 45, 1),
('Test Listing 7', 49, 2),
('Test Listing 8', 49, 1),
('Test Listing 9', 49, 2),
('Missing Item Listing 10', 49, 6),
('Test Listing 11', 50, 1),
('Test Listing 10', 50, 2);

INSERT INTO `#__mtcm_listings` (`name`, `author`, `request_name`, `request_desc`) VALUES
('No Item Listing 13', 42, 'Hellsblade', 'New requested anime example'),
('No Item Listing 14', 49, 'HellsbladeMega', 'New requested anime example');

INSERT INTO `#__mtcm_reviews` (`author`, `item_id`) VALUES
(42, 1),
(43, 1),
(49, 1),
(50, 1),
(42, 2),
(43, 2),
(49, 2),
(50, 2);

INSERT INTO `#__mtcm_genres` (`name`, `author`) VALUES
('Fiction', 0),
('Horror', 42),
('Comedy', 43),
('Ecchi', 65),
('School', 49),
('Drama', 50),
('Romance', 100);

INSERT INTO `#__mtcm_franchises` (`name`, `access`, `author`, `recentedit`) VALUES
('Killing Squad Franchise', 2, 42, 49),
('Mahou Mahou', 3, 65, 43),
('Mothership Stella', 54, 49, 61),
('Tea Party', 0, 0, 0);