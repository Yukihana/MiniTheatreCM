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
 * Item Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelItem extends JModelItem
{
	// Table Definition
	public function getTable($type = 'Items', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	// Storage Vars
	protected $loggedin;
	protected $id;
	protected $exists;
	protected $itemname;
	protected $itemcontent;
	
	// Data Authenticator and Loader
	public function popdata()
	{
		// Load and verify Logged-In status
		if( !isset( $this->loggedin ))
		{
			$this->loggedin = (JFactory::getUser()->get('id') != 0);
		}
		if( !$this->loggedin )
		{
			return;
		}
		
		// Load ID, check if record exists
		$this->id = JFactory::getApplication()->input->get('id',0,'INT');
		$table = $this->getTable();
		if ( $this->id == 0 )
		{
			$this->exists = 0;
		}
		else
		{
			$this->exists = $table->load($this->id) ? 1 : 2;
		}
		if( $this->exists != 1 )
		{
			return;
		}
		
		// Load Table Data
		$this->itemname = $table->name;
		$this->itemcontent = $table->content;
		/*
		 * Subsequently load other record data here
		 */
	}
	
	/**
	 * Get Methods:
	 * $loggedin, $id
	 * $itemname, $itemcontent
	 */
	public function getLoggedIn()
	{
		if( !isset( $this->loggedin ))
		{
			$this->popdata();
		}
		return $this->loggedin;
	}
	public function getId()
	{
		if( !isset( $this->id ))
		{
			$this->popdata();
		}
		return $this->id;
	}
	public function getExists()
	{
		if( !isset( $this->exists ))
		{
			$this->popdata();
		}
		return $this->exists;
	}
	
	// -
	public function getItemName()
	{
		if( !isset( $this->itemname ))
		{
			$this->popdata();
		}
		return $this->itemname;
	}
	
	// Get Item Content
	public function getItemContent()
	{
		if( !isset( $this->itemcontent ))
		{
			$this->popdata();
		}
		return $this->itemcontent;
	}
	
}