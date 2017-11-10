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

abstract class MiniTheatreCMLibModelListData
{
	public static function getUsernames( $userids )
	{
		$result = array();
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
	
	public static function getUsergroups( $accessids )
	{
		$result = array();
				
		// Check IDs vs Access groups and load them on success
		foreach( $accessids as $id )
		{
			$result[$id] = JAccess::getGroupTitle($id);
		}
		
		// Return data
		return $result;
	}
	
	public static function getCustom( $tablename, $search, $targetfield, $sourcefield = 'id', $alt_targetfield = '')
	{
		$result = array();
		if(is_array($search))
		{
			$search = implode(',', $search);
		}
		
		// Load records from the database
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		$query->select( $db->quoteName($targetfield) );
		$query->from( $db->quoteName($tablename) );
		$query->where( dbQuoteName($sourcefield).' IN ('.$search.')' );
		
		$db->setQuery($query);
		
		$result = $db->loadObjectList();
	}
}