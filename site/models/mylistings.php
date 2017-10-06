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
	
	protected $currentuser;
	protected $currentuserid;
	protected $currentusername;	
	
	private function popuser()
	{
		if( !isset( $this->currentuser ))
		{
			$this->currentuser = JFactory::getUser();
		}
		if( !isset( $this->currentuserid ))
		{
			$this->currentuserid = $this->currentuser->get('id');
		}
		if( !isset( $this->currentusername ))
		{
			$this->currentusername = $this->currentuser->get('username');
		}
	}
	
	public function getUserId()
	{
		if( !isset( $this->currentuserid ))
		{
			$this->popuser();
		}
		return $this->currentuserid;
	}
	
	public function getUserName()
	{
		if( !isset( $this->currentusername ))
		{
			$this->popuser();
		}
		return $this->currentusername;
	}
	
	public function getListings()
	{
		if( !isset( $this->currentuserid ))
		{
			$this->popuser();
		}
		
		// Get a db connection.
		$db = JFactory::getDbo();
		
		// Create a new query object.
		$query = $db->getQuery(true);
		
		$query->select($db->quoteName( array('id', 'name', 'author', 'item_id', 'state')));
		$query->from($db->quoteName('#__mtcm_listings'));
		$query->where($db->quoteName('author').'='.$this->currentuserid);
		
		//Set the query object
		$db->setQuery($query);
		
		//Load results
		$results = $db->loadObjectList();
		
		return $results;
	}
}