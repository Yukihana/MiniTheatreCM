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
class MiniTheatreCMModelMyListings extends JModelItem //change to JModelItem if causing problems. This is legacy code.
{
	// Joomla API Table Load Header Method
	public function getTable($type = 'Listings', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
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
	private function poplistings()
	{
		if( !isset( $this->loggeduserid ))
		{
			$this->popuser();
		}
		
		// Get a DB connection
		$db = JFactory::getDbo();
		
		// Do Query
		$query = $db->getQuery(true);
		$query->select($db->quoteName( array('id', 'name', 'author', 'item_id', 'live', 'request_name')));
		$query->from($db->quoteName('#__mtcm_listings'));
		$query->where($db->quoteName('author').'='.$this->loggeduserid);
		$db->setQuery($query);
		
		// Load results
		$this->listings = $db->loadObjectList();
	}
	
	private function popitemnames()
	{
		if( !isset( $this->listings ))
		{
			$this->poplistings();
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
	
	/**
	 * Get functions
	 * - $UserId, $LoggedIn
	 * - $Listings, $ItemNames
	 */
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
	
	public function getListings()
	{
		if( !isset( $this->listings ))
		{
			$this->poplistings();
		}
		return $this->listings;
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