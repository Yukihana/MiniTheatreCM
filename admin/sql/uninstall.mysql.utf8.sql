/*
	Yuki's Notes:
	-Delete contents of uninstall-sql once mainsite is up.
*/

-- Content
DROP TABLE IF EXISTS `#__mtcm_catalogues`;
DROP TABLE IF EXISTS `#__mtcm_franchises`;
DROP TABLE IF EXISTS `#__mtcm_genres`;
DROP TABLE IF EXISTS `#__mtcm_contenttypes`;

DROP TABLE IF EXISTS `#__mtcm_listings`;
DROP TABLE IF EXISTS `#__mtcm_reviews`;

-- Metadata
DROP TABLE IF EXISTS `#__mtcm_organisations`;
DROP TABLE IF EXISTS `#__mtcm_crewmembers`;
DROP TABLE IF EXISTS `#__mtcm_crewroles`;

-- Ratings
DROP TABLE IF EXISTS `#__mtcm_rating_reviews`;
DROP TABLE IF EXISTS `#__mtcm_rating_listings`;
DROP TABLE IF EXISTS `#__mtcm_rating_catalogues`;
DROP TABLE IF EXISTS `#__mtcm_rating_franchises`;
DROP TABLE IF EXISTS `#__mtcm_rating_genres`;

-- Relational Cache
DROP TABLE IF EXISTS `#__mtcm_catgen`;
DROP TABLE IF EXISTS `#__mtcm_catprod`;
DROP TABLE IF EXISTS `#__mtcm_catstud`;
DROP TABLE IF EXISTS `#__mtcm_catlcns`;
DROP TABLE IF EXISTS `#__mtcm_catcrew`;
DROP TABLE IF EXISTS `#__mtcm_frngen`;

-- Other
DROP TABLE IF EXISTS `#__mtcm_activitylog`;

-- SHARED
DROP TABLE IF EXISTS `#__mt_shared`;

-- LEGACY
DROP TABLE IF EXISTS `#__mtcm_admin_ulwiz`;