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
 * ContentTypes Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelContentTypes extends JModelList
{
	//Storage Data
	protected $usernames;
	protected $usergroups;
	
	// SQL Query to load List Data
	protected function getListQuery()
	{
		// Load required records from the database
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*')->from($db->quoteName('#__mtcm_contenttypes'));
		$db->setQuery($query);		
		
		return $query;
	}
	
	public function getUsernames()
	{
		// Initialize Data
		$items = $this->getItems();
		if( !isset( $this->usernames ))
		{
			$this->usernames = array();
		}
		
		// Load all author and recentedit id data into a unique array
		$userids = array();
		foreach( $items as $item )
		{
			array_push( $userids, $item->author, $item->recentedit );
		}
		$userids = array_unique( $userids );
		
		// Check IDs vs User Table and load their names/usernames
		$table = JUser::getTable();
		foreach( $userids as $id )
		{
			if( $table->load( $id ))
			{
				$this->usernames[$id] = ($table->name != '') ? $table->username : $table->username;
			}
		}

		// Return data
		return $this->usernames;
	}
	
	public function getUsergroups()
	{
		// Initialize Data
		$items = $this->getItems();
		if( !isset( $this->usergroups ))
		{
			$this->usergroups = array();
		}
		
		// Check for associated user groups and fetch their names
		foreach( $items as $item )
		{
			if( $item->access != 0 && !isset( $this->usergroups[$item->access] ))
			{
				$this->usergroups[$item->access] = JAccess::getGroupTitle($item->access);
			}
		}
		return $this->usergroups;
	}
}