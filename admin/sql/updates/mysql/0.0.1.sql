/*
 * Community Content
 * 
 * - Catalogues, Franchises
 * - Genres
 */
CREATE TABLE IF NOT EXISTS `#__mtcm_catalogues` (
	`id`				INT UNSIGNED		NOT NULL AUTO_INCREMENT,
	`asset_id`			INT UNSIGNED		NOT NULL DEFAULT '0',
	`name`				VARCHAR(255)		NOT NULL,
	`alias`				VARCHAR(255)		NOT NULL DEFAULT ''		COMMENT 'SEF URI',
	
	`content`			TEXT				NOT NULL DEFAULT ''		COMMENT 'The Synopsis, Summary or Description',
	`altnames`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Alternate Titles',
	`trivia`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Any trivia related to this title',
	`editnote`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Editorial notes (Not to be displayed)',
	
	`specifics`			TEXT				NOT NULL DEFAULT ''		COMMENT 'Serialized: PartType, Index, Title, Synopsis',
	`duration`			INT	UNSIGNED		NOT NULL DEFAULT '0'	COMMENT 'Stored in seconds',
	`count`				INT	UNSIGNED		NOT NULL DEFAULT '0'	COMMENT 'Episode count, Chapter count, etc.',
	`agerating`			TINYINT UNSIGNED	NOT NULL DEFAULT '0'	COMMENT 'Index from XML-source: agerating.xml',
	`airtype`			TINYINT UNSIGNED	NOT NULL DEFAULT '0'	COMMENT 'Index from XML-source: airtype.xml',
	`airstatus`			TINYINT UNSIGNED	NOT NULL DEFAULT '0'	COMMENT 'Index from XML-source: airstatus.xml',
	`airfrom`			DATE										COMMENT 'The date airing starts/started',
	`airtill`			DATE										COMMENT 'The date airing stops/stopped',
	
	`crew`				VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Serialized: crew-personnel, crew-roles',
	`ctype`				INT	UNSIGNED		NOT NULL DEFAULT '1'	COMMENT 'Associated Content-type: Anime, Manga, Specials, Movie, Drama',
	`franchise`			INT	UNSIGNED		NOT NULL DEFAULT '0'	COMMENT 'A group of related titles(catalogues) based on storyline',
	`genres`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Multi-choice: Comma delimited indices',
	`producers`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Multi-choice: Comma delimited indices',
	`licensors`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Multi-choice: Comma delimited indices',
	`studios`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Multi-choice: Comma delimited indices',
	
	`offweb`			VARCHAR(127)		NOT NULL DEFAULT ''		COMMENT 'Official website',
	`malurl`			VARCHAR(127)		NOT NULL DEFAULT ''		COMMENT 'My-Anime-List url',
	`anidburl`			VARCHAR(127)		NOT NULL DEFAULT ''		COMMENT 'AniDB url',
	`annurl`			VARCHAR(127)		NOT NULL DEFAULT ''		COMMENT 'Anime News Network url',
	`rellinks`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Related links (Newline delimited)',
	`trailers`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Trailer links (Newline delimited)',
	`relvids`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Related videos (Newline delimited)',
	
	`access`			INT UNSIGNED		NOT NULL DEFAULT '2',
	`state`				TINYINT				NOT NULL DEFAULT '1',
	`publish_up`		DATETIME			NOT NULL,
	`publish_down`		DATETIME			NOT NULL,
	
	`author`			INT UNSIGNED		NOT NULL DEFAULT '0',
	`recentedit`		INT UNSIGNED		NOT NULL DEFAULT '0',
	`created`			TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME			NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	`hits`				INT UNSIGNED		NOT NULL DEFAULT '0',
	`cache_ticks`		INT UNSIGNED		NOT NULL DEFAULT '0'	COMMENT 'Ticks since last cache update',
	`rating`			TINYINT UNSIGNED	NOT NULL DEFAULT '0'	COMMENT 'Cache',
	`recommends`		INT UNSIGNED		NOT NULL DEFAULT '0'	COMMENT 'Cache',
	`votes`				INT UNSIGNED		NOT NULL DEFAULT '0'	COMMENT 'Cache',
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_franchises` (
	`id`				INT(10)				NOT NULL AUTO_INCREMENT,
	`asset_id`			INT(10)				NOT NULL DEFAULT '0',
	`name`				VARCHAR(255)		NOT NULL,
	`alias`				VARCHAR(400)		NOT NULL DEFAULT ''		COMMENT 'SEF URI',
	
	`content`			TEXT				NOT NULL DEFAULT '',
	`altnames`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Alternate Titles',
	`trivia`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Any trivia related to this title',
	`editnote`			VARCHAR(1023)		NOT NULL DEFAULT ''		COMMENT 'Editorial notes (Not to be displayed)',
	
	`website`			VARCHAR(255)		NOT NULL DEFAULT '',
	`urls`				VARCHAR(1023)		NOT NULL DEFAULT '',
	`misc1`				VARCHAR(255)		NOT NULL DEFAULT '',
	
	`genres`			VARCHAR(1023)		NOT NULL DEFAULT '',
	
	`access`			INT(10)	UNSIGNED	NOT NULL DEFAULT '2',
	`state`				TINYINT(3)			NOT NULL DEFAULT '1',
	`publish_up`		DATETIME			NOT NULL,
	`publish_down`		DATETIME			NOT NULL,
	
	`author`			INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`		INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`created`			TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	`hits`				INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`cache_ticks`		INT(10) UNSIGNED	NOT NULL DEFAULT '0'	COMMENT 'Ticks since last cache update',
	`rating`			INT(4) UNSIGNED		NOT NULL DEFAULT '0'	COMMENT 'Cache value',
	`votes`				INT(10) UNSIGNED	NOT NULL DEFAULT '0'	COMMENT 'Cache value',
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Categorisation: Genres, Content-types
CREATE TABLE IF NOT EXISTS `#__mtcm_genres` (
	`id`				INT(10)				NOT NULL AUTO_INCREMENT,
	`asset_id`			INT(10)				NOT NULL DEFAULT '0',
	`name`				VARCHAR(255)		NOT NULL,
	`alias`				VARCHAR(400)		NOT NULL DEFAULT ''			COMMENT 'SEF URI',
	
	`content`			TEXT				NOT NULL DEFAULT ''			COMMENT 'Genre details',
	`color`				VARCHAR(63)			NOT NULL DEFAULT '#888888'	COMMENT 'Default Representation Color',
	`icon`				VARCHAR(63)			NOT NULL DEFAULT 'tag-2'	COMMENT 'Default Representation Icon',
	
	`access`			INT(10)	UNSIGNED	NOT NULL DEFAULT '2',
	`state`				TINYINT(3)			NOT NULL DEFAULT '1',
	`publish_up`		DATETIME			NOT NULL,
	`publish_down`		DATETIME			NOT NULL,
	
	`author`			INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`		INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`created`			TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	`hits`				INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`cache_ticks`		INT(10) UNSIGNED	NOT NULL DEFAULT '0'		COMMENT 'Ticks since last cache update',
	`rating`			INT(4) UNSIGNED		NOT NULL DEFAULT '0'		COMMENT 'Cache value',
	`votes`				INT(10) UNSIGNED	NOT NULL DEFAULT '0'		COMMENT 'Cache value',
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_contenttypes` (
	`id`				INT(10)				NOT NULL AUTO_INCREMENT,
	`asset_id`			INT(10)				NOT NULL DEFAULT '0',
	`name`				VARCHAR(255)		NOT NULL,
	`alias`				VARCHAR(400)		NOT NULL DEFAULT ''			COMMENT 'SEF URI',
	
	`content`			TEXT				NOT NULL DEFAULT ''			COMMENT 'Text Instruction Variations',
	`metafields`		TEXT				NOT NULL DEFAULT ''			COMMENT 'Misc# Field Definitions',
	`color`				VARCHAR(63)			NOT NULL DEFAULT '#888888'	COMMENT 'Default Representation Color',
	`icon`				VARCHAR(63)			NOT NULL DEFAULT 'circle'	COMMENT 'Default Representation Icon',
	`enabled`			BOOLEAN				NOT NULL DEFAULT '1'		COMMENT 'Whether uploading is allowed',
	
	`access`			INT(10)	UNSIGNED	NOT NULL DEFAULT '2'		COMMENT 'Usergroup allowed to access the Upload-page',
	`state`				TINYINT(3)			NOT NULL DEFAULT '1'		COMMENT 'Whether Item-pages of this type are accessible',
	`publish_up`		DATETIME			NOT NULL,
	`publish_down`		DATETIME			NOT NULL,
	
	`author`			INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`created`			TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*
 * Production:
 *
 * - Crew-Members, Crew-Roles, Organisations
 */
CREATE TABLE IF NOT EXISTS `#__mtcm_crewmembers` (
	`id`				INT(10)				NOT NULL AUTO_INCREMENT,
	`alias`				VARCHAR(400)		NOT NULL DEFAULT ''			COMMENT 'SEF URI',
	
	`firstname`			VARCHAR(255)		NOT NULL					COMMENT 'Roman/English Primary',
	`middlename`		VARCHAR(255)		NOT NULL,
	`lastname`			VARCHAR(255)		NOT NULL,
	
	`firstnative`		VARCHAR(255)		NOT NULL					COMMENT 'Native Unicode',
	`middlenative`		VARCHAR(255)		NOT NULL,
	`lastnative`		VARCHAR(255)		NOT NULL,
	
	`firstalt`			VARCHAR(255)		NOT NULL					COMMENT 'Alt Unicode (i.e. Hiragana)',
	`middlealt`			VARCHAR(255)		NOT NULL,
	`lastalt`			VARCHAR(255)		NOT NULL,
	
	`searchstrings`		VARCHAR(1023)		NOT NULL					COMMENT 'Additional names to help in search',
	
	`author`			INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`created`			TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_crewroles` (
	`id`				INT(10)				NOT NULL AUTO_INCREMENT,
	`name`				VARCHAR(255)		NOT NULL,
	`alias`				VARCHAR(400)		NOT NULL DEFAULT ''			COMMENT 'SEF URI',
	
	`author`			INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`created`			TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_organisations` (
	`id`				INT(10)				NOT NULL AUTO_INCREMENT,
	`name`				VARCHAR(255)		NOT NULL,
	`alias`				VARCHAR(400)		NOT NULL DEFAULT ''			COMMENT 'SEF URI',
	
	`author`			INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`created`			TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*
 * User content
 * 
 * - Listings, Reviews
 */
CREATE TABLE IF NOT EXISTS `#__mtcm_listings` (
	`id`				INT(10)				NOT NULL AUTO_INCREMENT,
	`asset_id`			INT(10)				NOT NULL DEFAULT '0',
	`name`				VARCHAR(255)		NOT NULL,
	`alias`				VARCHAR(400)		NOT NULL DEFAULT ''		COMMENT 'SEF URI',
	
	`content`			TEXT				NOT NULL DEFAULT '',
	`description`		TEXT				NOT NULL DEFAULT '',
	`misc1`				VARCHAR(255)		NOT NULL DEFAULT ''		COMMENT 'codec, etc',
	`misc2`				VARCHAR(255)		NOT NULL DEFAULT ''		COMMENT 'vid_res, etc',
	`misc3`				VARCHAR(255)		NOT NULL DEFAULT ''		COMMENT 'audio, etc',
	`misc4`				VARCHAR(255)		NOT NULL DEFAULT ''		COMMENT 'subs, etc',
	
	`catalogue`			INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`request_name`		VARCHAR(255)		NOT NULL DEFAULT '',
	`request_msg`		TEXT				NOT NULL DEFAULT '',
	
	`access`			INT(10)	UNSIGNED	NOT NULL DEFAULT '2',
	`state`				TINYINT(3)			NOT NULL DEFAULT '1',
	`publish_up`		DATETIME			NOT NULL,
	`publish_down`		DATETIME			NOT NULL,
	`live`				BOOLEAN				NOT NULL DEFAULT '1',
	
	`author`			INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`		INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`created`			TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME			NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	`hits`				INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`cache_ticks`		INT(10) UNSIGNED	NOT NULL DEFAULT '0'	COMMENT 'Ticks since last cache update',
	`rating`			INT(4) UNSIGNED		NOT NULL DEFAULT '0'	COMMENT 'Cache',
	`votes`				INT(10) UNSIGNED	NOT NULL DEFAULT '0'	COMMENT 'Cache',
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_reviews` (
	`id`				INT(10)				NOT NULL AUTO_INCREMENT,
	`asset_id`			INT(10)				NOT NULL DEFAULT '0',
	`name`				VARCHAR(255)		NOT NULL,
	`alias`				VARCHAR(400)		NOT NULL DEFAULT ''		COMMENT 'SEF URI',
	
	`content`			TEXT				NOT NULL DEFAULT '',
	
	`catalogue`			INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	
	`access`			INT(10)	UNSIGNED	NOT NULL DEFAULT '2',
	`state`				TINYINT(3)			NOT NULL DEFAULT '1',
	`publish_up`		DATETIME			NOT NULL,
	`publish_down`		DATETIME			NOT NULL,
	`live`				BOOLEAN				NOT NULL DEFAULT '1',
	
	`author`			INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`		INT(10)	UNSIGNED	NOT NULL DEFAULT '0',
	`created`			TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`			DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*
 * Ratings
 * 
 * - Catalogues, Franchises, Genres
 * - Listings, Reviews
 */
CREATE TABLE IF NOT EXISTS `#__mtcm_rating_catalogues` (
	`id`			INT(10)				NOT NULL AUTO_INCREMENT,
	`catalogue`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	
	`recommend`		BOOLEAN				NOT NULL DEFAULT '0',
	`rating`		VARCHAR(255)		NOT NULL DEFAULT '0'	COMMENT 'Decide on expanding this',
	`note`			VARCHAR(255)		NOT NULL DEFAULT '',
	
	`access`		INT(10)	UNSIGNED	NOT NULL DEFAULT '2',
	`state`			TINYINT(3)			NOT NULL DEFAULT '1',
	`publish_up`	DATETIME			NOT NULL,
	`publish_down`	DATETIME			NOT NULL,
	
	`author`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`	INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`created`		TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`		DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_rating_listings` (
	`id`			INT(10)				NOT NULL AUTO_INCREMENT,
	`listing`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	
	`liked`			BOOLEAN				NOT NULL DEFAULT '0'	COMMENT 'Like / Dislike',
	`note`			VARCHAR(255)		NOT NULL DEFAULT '',
	
	`access`		INT(10)	UNSIGNED	NOT NULL DEFAULT '2',
	`state`			TINYINT(3)			NOT NULL DEFAULT '1',
	`publish_up`	DATETIME			NOT NULL,
	`publish_down`	DATETIME			NOT NULL,
	
	`author`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`	INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`created`		TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`		DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_rating_reviews` (
	`id`			INT(10)				NOT NULL AUTO_INCREMENT,
	`review`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	
	`note`			VARCHAR(255)		NOT NULL DEFAULT '',
	
	`access`		INT(10)	UNSIGNED	NOT NULL DEFAULT '2',
	`state`			TINYINT(3)			NOT NULL DEFAULT '1',
	`publish_up`	DATETIME			NOT NULL,
	`publish_down`	DATETIME			NOT NULL,
	
	`author`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`	INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`created`		TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`		DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_rating_franchises` (
	`id`			INT(10)				NOT NULL AUTO_INCREMENT,
	`target_id`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	
	`note`			VARCHAR(255)		NOT NULL DEFAULT '',
	
	`access`		INT(10)	UNSIGNED	NOT NULL DEFAULT '2',
	`state`			TINYINT(3)			NOT NULL DEFAULT '1',
	`publish_up`	DATETIME			NOT NULL,
	`publish_down`	DATETIME			NOT NULL,
	
	`author`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`	INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`created`		TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`		DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_rating_genres` (
	`id`			INT(10)				NOT NULL AUTO_INCREMENT,
	`target_id`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	
	`note`			VARCHAR(255)		NOT NULL DEFAULT '',
	
	`access`		INT(10)	UNSIGNED	NOT NULL DEFAULT '2',
	`state`			TINYINT(3)			NOT NULL DEFAULT '1',
	`publish_up`	DATETIME			NOT NULL,
	`publish_down`	DATETIME			NOT NULL,
	
	`author`		INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`recentedit`	INT(10) UNSIGNED	NOT NULL DEFAULT '0',
	`created`		TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`		DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Relational Cache
CREATE TABLE IF NOT EXISTS `#__mtcm_genre_catalogues` (
	`id`			INT(10)				NOT NULL AUTO_INCREMENT,
	
	`genre_id`		INT(10)				NOT NULL DEFAULT '0',
	`target_id`		INT(10)				NOT NULL DEFAULT '0',
	
	`created`		TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`		DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_genre_franchises` (
	`id`			INT(10)				NOT NULL AUTO_INCREMENT,
	
	`genre_id`		INT(10)				NOT NULL DEFAULT '0',
	`target_id`		INT(10)				NOT NULL DEFAULT '0',
	
	`created`		TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	`modified`		DATETIME			DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- History: Activity Log
CREATE TABLE IF NOT EXISTS `#__mtcm_activitylog` (
	`id`				INT(10)				NOT NULL AUTO_INCREMENT,
	`user_id`			INT(10)				NOT NULL DEFAULT '0'	COMMENT 'The user that invoked the activity',
	`interface`			BOOLEAN				NOT NULL DEFAULT '0'	COMMENT 'Frontend(0), Administration(1)',
	
	`action`			TINYINT(4)			NOT NULL DEFAULT '0'	COMMENT 'The type of activity done by the user',
	`target_type`		TINYINT(4)			NOT NULL DEFAULT '0'	COMMENT 'The primary type of record associated to the activity',
	`target_id`			INT(10)				NOT NULL DEFAULT '0'	COMMENT 'The ID of the record primarily associated',
	
	`ip`				VARBINARY(16)		NOT NULL DEFAULT '0'	COMMENT 'IPv4/v6 address of the user (remote)',
	`hostname`			VARCHAR(255)		NOT NULL DEFAULT ''		COMMENT 'The address used by the user to access this site',
	`timestamp`			TIMESTAMP			DEFAULT CURRENT_TIMESTAMP,
	
	PRIMARY KEY(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Other: Shared, Meta, Legacy
CREATE TABLE IF NOT EXISTS `#__mt_shared` (
	`id`				INT(11)			NOT NULL AUTO_INCREMENT,
	`name`				VARCHAR(255)	NOT NULL,
	`content`			TEXT			NOT NULL DEFAULT '',
	`description`		TEXT			NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__mtcm_admin_ulwiz` (
	`id`		INT(10)			NOT NULL AUTO_INCREMENT,
	`wname`		VARCHAR(25)		NOT NULL,
	`published`	tinyint(3)		NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*
 * Test Values
 *
 * - Only for debug versions
 * - To be removed in release editions
 */
INSERT INTO `#__mtcm_listings` (`name`, `author`, `catalogue`, `rating`, `alias`) VALUES
('Test Listing 1', 42, 1, 4, 'test-listing-1'),
('Test Listing 2', 42, 2, 3, 'test-listing-2'),
('Test Listing 3', 42, 1, 7, 'test-listing-3'),
('Item Listing 4', 42, 5, 8, 'test-listing-4'),
('Test Listing 5', 45, 2, 1, 'test-listing-5'),
('Test Listing 6', 45, 1, 0, 'test-listing-6'),
('Test Listing 7', 49, 2, 3, 'test-listing-7'),
('Test Listing 8', 49, 1, 10, 'test-listing-8'),
('Test Listing 9', 49, 2, 8, 'test-listing-9'),
('Missing Item Listing 10', 49, 6, 2, 'test-listing-10'),
('Test Listing 11', 50, 1, 8, 'test-listing-11'),
('Test Listing 12', 50, 2, 2, 'test-listing-12'),
('Test Listing 13', 45, 3, 6, 'test-listing-13'),
('Test Listing 14', 45, 4, 3, 'test-listing-14'),
('Test Listing 15', 42, 1, 5, 'test-listing-15'),
('Test Listing 16', 42, 2, 8, 'test-listing-16'),
('Test Listing 17', 42, 3, 9, 'test-listing-17'),
('Test Listing 18', 42, 4, 2, 'test-listing-18'),
('Test Listing 19', 42, 5, 5, 'test-listing-19'),
('Test Listing 20', 42, 6, 4, 'test-listing-20');

INSERT INTO `#__mtcm_listings` (`name`, `author`, `state`, `request_name`, `request_msg`) VALUES
('No Item Listing 21', 42, 0, 'Hellsblade', 'New requested anime example'),
('No Item Listing 22', 49, 0, 'HellsbladeMega', 'New requested anime example');

INSERT INTO `#__mtcm_reviews` (`name`, `author`, `catalogue`) VALUES
('Loving it!', 42, 1),
('Must watch. Very Under-rated!', 43, 1),
('Almost amazing', 49, 1),
('On my top five', 50, 1),
('Avoid it like plague', 42, 2),
('Dropped it at the first episode', 43, 2),
('No plot and characters suck', 49, 2),
('Give me back my time!', 50, 2);

INSERT INTO `#__mtcm_catalogues` (`name`,`content`,`alias`,`franchise`) VALUES
('Akuma ni kisuosareta', 'Description of the item <b>I was Kissed by the Devil</b> goes here.', 'akuma-ni-kisuosareta', 0),
('Killing Squad', 'Description of the item <b>Killing Squad</b> goes here.', 'killing-squad', 1),
('A Deck of Ten', '', 'a-deck-of-ten', 2),
('Shinigami Usagi', '', 'shinigami-usagi', 10),
('Mori no Mura', '', 'mori-no-mura', 20);

INSERT INTO `#__mtcm_franchises` (`name`, `access`, `author`, `recentedit`) VALUES
('Killing Squad Franchise', 2, 42, 49),
('Mahou Mahou', 3, 65, 43),
('Mothership Stella', 54, 49, 61),
('Tea Party', 0, 0, 0);

INSERT INTO `#__mtcm_genres` (`name`, `author`) VALUES
('Fiction', 0),
('Horror', 42),
('Comedy', 43),
('Ecchi', 65),
('School', 49),
('Drama', 50),
('Romance', 100);

INSERT INTO `#__mtcm_contenttypes` (`name`, `author`) VALUES
('Anime', 42),
('Movie', 43),
('Manga', 46),
('Dorama', 0);

INSERT INTO `#__mtcm_admin_ulwiz` (`wname`) VALUES
('Anime'),
('Movie'),
('Manga'),
('Dorama');

INSERT INTO `#__mtcm_rating_catalogues` (`rating`, `author`, `catalogue`) VALUES
(11, 42, 1),
(46, 43, 0),
(45, 49, 2),
(31, 50, 3),
(78, 42, 9),
(84, 43, 5),
(68, 49, 2),
(32, 50, 1);

INSERT INTO `#__mtcm_rating_listings` (`liked`, `author`, `listing`) VALUES
(1, 42, 1),
(1, 43, 0),
(0, 49, 42),
(1, 50, 3),
(0, 42, 9),
(0, 43, 32),
(1, 49, 14),
(0, 50, 1);

INSERT INTO `#__mtcm_activitylog` (`user_id`, `target_type`, `target_id`, `interface`) VALUES
(42, 1, 2, 0),
(43, 6, 3, 0),
(46, 2, 5, 1),
(45, 1, 7, 1),
(42, 3, 2, 0),
(43, 5, 6, 1),
(42, 4, 2, 1),
(47, 2, 4, 0),
(43, 5, 4, 1),
(50, 4, 2, 1),
(49, 3, 3, 0),
(63, 5, 2, 1),
(61, 4, 8, 0);

INSERT INTO `#__mtcm_organisations` (`name`) VALUES
('AkibaNix'),
('AH1'),
('PAM'),
('Endox'),
('Krayzon'),
('SkyPer'),
('Actua USA'),
('Kray NA'),
('AniKix');

INSERT INTO `#__mtcm_crewmembers` (`firstname`, `lastname`) VALUES
('Minori', 'Tachibana'),
('Kana', 'Uehara'),
('Hitoshi', 'Akabane');

INSERT INTO `#__mtcm_crewroles` (`name`) VALUES
('Main Actor'),
('Supporting Actress'),
('Direction');