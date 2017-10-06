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
class MiniTheatreCMModelMyListings extends JModelItem
{
	// Table Definitions
	public function getListingsTable($type = 'Listings', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected $loggeduserid;
	
	private function popuser()
	{
		if( !isset( $this->loggeduserid ))
		{
			$this->loggeduserid = JFactory::getUser()->get('id');
		}
	}
	
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
		if( !isset( $this->loggeduserid ))
		{
			$this->popuser();
		}
		
		// Get a db connection.
		$db = JFactory::getDbo();
		
		// Create a new query object.
		$query = $db->getQuery(true);
		
		$query->select($db->quoteName( array('id', 'name', 'author', 'item_id', 'state')));
		$query->from($db->quoteName('#__mtcm_listings'));
		$query->where($db->quoteName('author').'='.$this->loggeduserid);
		
		//Set the query object
		$db->setQuery($query);
		
		//Load results
		$results = $db->loadObjectList();
		
		return $results;
	}
}