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
 * MyListings Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelMyListings extends JModelList
{
	// Joomla API Table Load Header Method
	public function getTable($type = 'Listings', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	// Load Storage Data
	protected $loggeduserid;
	protected $listings;
	protected $itemnames;
	
	// Method to load user details
	private function popuser()
	{
		if( !isset( $this->loggeduserid ))
		{
			$this->loggeduserid = JFactory::getUser()->get('id');
		}
	}
	
	// Method to load listings
	protected function getListQuery()
	{
		if( !isset( $this->loggeduserid ))
		{
			$this->popuser();
		}
		
		// Load required records from the database
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select($db->quoteName( array('id', 'name', 'author', 'item_id', 'live', 'request_name')));
		$query->from($db->quoteName('#__mtcm_listings'));
		$query->where($db->quoteName('author').'='.$this->loggeduserid);
		$db->setQuery($query);
		
		// Store and return results
		$this->listings = $db->loadObjectList();
		return $query;
	}
	
	//Method to load Associated Item Names
	protected function popitemnames()
	{
		if( !isset( $this->listings ))
		{
			$this->getListQuery();
		}
		if( !is_array( $this->itemnames ))
		{
			$this->itemnames = array();
		}
		
		// Database connection
		$table = $this->getTable('Items', 'MiniTheatreCMTable', array());
		
		foreach( $this->listings as $row )
		{
			$id = $row->item_id;
			
			// Check if a record exists for the item_id
			if( $table->load( $id ))
			{
				if( !isset( $this->itemnames[$id] ))
				{
					$this->itemnames[$id] = $table->name;
				}
			}
		}
	}
	
	// Get functions for $UserId, $LoggedIn, $ItemNames
	public function getUserId()
	{
		if( !isset( $this->loggeduserid ))
		{
			$this->popuser();
		}
		return $this->loggeduserid;
	}
	public function getLoggedIn()
	{
		if( !isset( $this->loggeduserid ))
		{
			$this->popuser();
		}
		return ($this->loggeduserid != 0);
	}
	public function getItemNames()
	{
		if( !isset( $this->itemnames ))
		{
			$this->popitemnames();
		}
		return $this->itemnames;
	}
}