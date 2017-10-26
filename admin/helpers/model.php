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

/**
 * Static Helper class for Models
 *
 * Since 0.0.12
 */
 
abstract class MiniTheatreCMHelperModel
{
	public static function getUsernames( $items, $fields )
	{
		$result = array();
		
		// Load all author and recentedit id data into a unique array
		$userids = array();
		foreach( $items as $item )
		{
			foreach( $fields as $field )
			{
				if( isset( $item->$field ))
				{
					array_push( $userids, $item->$field );
				}
			}
		}
		$userids = array_unique( $userids );
		
		// Check IDs vs User Table and load their names/usernames
		$table = JUser::getTable();
		foreach( $userids as $id )
		{
			if( $table->load( $id ))
			{
				$result[$id] = ($table->name != '') ? $table->name : $table->username;
			}
		}
		
		// Return data
		return $result;
	}
	
	public static function getUsergroups( $items, $fields )
	{
		$result = array();
		
		// Load the values of the fields into an array and make it unique
		$ids = array();
		foreach( $items as $item )
		{
			foreach( $fields as $field )
			{
				if( isset( $item->$field ))
				{
					array_push( $ids, $item->$field );
				}
			}
		}
		$ids = array_unique( $ids );
		
		// Check IDs vs User Table and load their names/usernames
		foreach( $ids as $id )
		{
			$result[$id] = JAccess::getGroupTitle($id);
		}
		
		// Return data
		return $result;
	}
}
 