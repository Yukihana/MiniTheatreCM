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
		
		// Check for all user-ids in author and recentedit fields
		foreach( $items as $item )
		{
			if( $item->author != 0 && !isset( $this->usernames[$item->author] ))
			{
				$this->usernames[$item->author] = JFactory::getUser($item->author)->get('name');
			}
			if( $item->recentedit != 0 && !isset( $this->usernames[$item->recentedit] ))
			{
				$this->usernames[$item->recentedit] = JFactory::getUser($item->recentedit)->get('name');
			}
		}
		return $this->usernames;
	}
}