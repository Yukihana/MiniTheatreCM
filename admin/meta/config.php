<?php
/**
 * @package     MiniTheatre.Administrator
 * @subpackage  com_minitheatrecm
 *
 * @copyright   CherrySoft-X 2017, MiniTheatre 2017
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link        http://fb.me/LilyflowerAngel
 */
  
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

abstract class MiniTheatreCMMetaConfig
{
	// Database-Table names
	public static function getTableName($view)
	{
		$prefix = '#__mtcm_';
		switch($view)
		{
			case 'listings':			return $prefix.'listings';
			case 'reviews':				return $prefix.'reviews';
			case 'items':				return $prefix.'items';
			case 'franchises':			return $prefix.'franchises';
			case 'genres':				return $prefix.'genres';
			case 'contenttypes':		return $prefix.'contenttypes';
			case 'ratingitems':			return $prefix.'rating_items';
			case 'ratingfranchises':	return $prefix.'rating_franchises';
			case 'ratinglistings':		return $prefix.'rating_listings';
			case 'ratingreviews':		return $prefix.'rating_reviews';
			case 'metadatas':			return $prefix.'metadatas';
			case 'ulwizsources':		return $prefix.'admin_ulwiz';
			default:					return null;
		}
	}
}