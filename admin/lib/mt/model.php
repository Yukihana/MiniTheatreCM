<?php
/**
 * @package     MiniTheatre.Administrator
 * @subpackage  com_minitheatrecm
 *
 * @copyright   CherrySoft-X 2017, MiniTheatre 2017
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link        http://minitheatre.org/
 */
  
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
abstract class MiniTheatreCMLibMtModel
{
	public static function getUsernames( $items, $fields )
	{
		$result = array();
		
		// Load the values of the fields into an array and make it unique
		$userids = self::getUniqueArray( $items, $fields );
		
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
		$ids = self::getUniqueArray( $items, $fields );
		
		// Check IDs vs Access groups and load them on success
		foreach( $ids as $id )
		{
			$result[$id] = JAccess::getGroupTitle($id);
		}
		
		// Return data
		return $result;
	}
	
	public static function getItemnames( $items, $fields )
	{
		$result = array();
		
		// Load the values of the fields into an array and make it unique
		$ids = self::getUniqueArray( $items, $fields );
		
		// Check IDs vs Items and load them on success
		$table = JTable::getInstance('Items', 'MiniTheatreCMTable', array());
		foreach( $ids as $id )
		{
			if( $table->load( $id ))
			{
				$result[$id] = $table->name;
			}
		}
		
		// Return data
		return $result;
	}
	
	public static function getFranchises( $items, $fields )
	{
		$result = array();
		
		// Load the values of the fields into an array and make it unique
		$ids = self::getUniqueArray( $items, $fields );
		
		// Check IDs vs Items and load them on success
		$table = JTable::getInstance('Franchises', 'MiniTheatreCMTable', array());
		foreach( $ids as $id )
		{
			if( $table->load( $id ))
			{
				$result[$id] = $table->name;
			}
		}
		
		// Return data
		return $result;
	}
	
	//Kernel methods
	private static function getUniqueArray( $items, $fields )
	{
		$data = array();
		foreach( $items as $item )
		{
			foreach( $fields as $field )
			{
				if( isset( $item->$field ))
				{
					array_push( $data, $item->$field );
				}
			}
		}
		return array_unique( $data );
	}
}
 