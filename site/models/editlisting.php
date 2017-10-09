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
 * EditListing Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelEditListing extends JModelItem
{
	/**
	 * @var listing
	 */
	protected $loggeduser;
	protected $loggeduserid;
	protected $loggedusername;
	protected $loggedrealname;
	
	protected $requestid;	//Note this is the $id, not associated to table data
	protected $usermatched;
	
	protected $listingname;
	protected $listingcontent;
	protected $listinginfo;
	protected $lastmodified;
	protected $userlive;
	protected $requestname;
	protected $requestdesc;
	protected $itemid;
	
	protected $itemstate;
	protected $itemname;

	
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'Listings', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	// Method for loading User Id/Name and Request Id
	private function popuser()
	{
		$this->loggeduser = JFactory::getUser();		
		$this->loggeduserid = $this->loggeduser->get('id');
		$this->loggedusername = $this->loggeduser->get('username');
		$this->loggedrealname = $this->loggeduser->get('name');
		
		$this->requestid = JFactory::getApplication()->input->get('id', 0, 'INT');
	}
	
	// Method for checking if the record exists and if the logged user matches the author
	private function authenticate()
	{
		// Check if Userdata has been loaded
		if( !isset( $this->loggeduserid ))
		{
			$this->popuser();
		}
		
		// Check if a record exists for the given Listing ID
		$table = $this->getTable();
		$recordexists = $table->load($this->requestid);
		
		// Exit method if record doesn't exist
		if( !$recordexists )
		{
			$this->usermatched = false;
			return;
		}
		
		// Else check if Logged User matches Author
		$this->usermatched = ( $this->loggeduserid == $table->author );
	}
	
	// Listing Data Access Authorisation Subfunction
	private function checkAccess()
	{
		// Check if authentication data has been loaded
		if( !isset( $this->usermatched ))
		{
			$this->authenticate();
		}
		return $this->usermatched;
	}
	
	// Method for loading the remaining data
	private function popdata()
	{
		// Check Access
		if( !$this->checkAccess() )
		{
			return;
		}
		
		// Else, load a table instance for populating other data requirements
		$table = $this->getTable();
		$table->load($this->requestid);
		
		// Assign data to global variables
		$this->listingname = $table->name;
		$this->listingcontent = $table->content;
		$this->listinginfo = $table->description;
		$this->lastmodified = $table->modified_on;
		$this->userlive = $table->live;
		$this->itemid = $table->item_id;
		$this->requestname = $table->request_name;
		$this->requestdesc = $table->request_desc;
	}
	
	// Method for loading item data
	private function popitem()
	{
		// Check Access
		if( !$this->checkAccess() )
		{
			return;
		}
		
		// Else check if popdata has been run
		if( !isset( $this->itemid ))
		{
			$this->popdata();
		}
		
		// Finally, load the items table instance
		$nametable = $this->getTable('Items', 'MiniTheatreCMTable', array());
		
		// Assign data
		if( $this->itemid == 0 )
		{
			$this->itemstate = 0;
		}
		else
		{
			$this->itemstate = ( $nametable->load($this->itemid) ) ? 1 : 2;
		}
		$this->itemname = ( $this->itemstate == 1 ) ? $nametable->name : '';
	}
		
	/**
	 * Get functions for:
	 *
	 * - $usermatched
	 * - $loggeduserid, $loggedusername, $requestid
	 * - $listingname, $listingcontent, $listinginfo, $lastmodified, $userlive, $itemid, $requestname, $requestdesc
	 * - $itemexists, $itemname
	 */
	public function getUserMatched()
	{
		if( !isset( $this->usermatched ))
		{
			$this->authenticate();
		}
		return $this->usermatched;
	}
	
	// -
	public function getLoggedUserId()
	{
		if( !isset( $this->loggeduserid ))
		{
			$this->popuser();
		}
		return $this->loggeduserid;
	}
	public function getLoggedUserName()
	{
		if( !isset( $this->loggedusername ))
		{
			$this->popuser();
		}
		return $this->loggedusername;
	}
	public function getLoggedRealName()
	{
		if( !isset( $this->loggedrealname ))
		{
			$this->popuser();
		}
		return ( $this->loggedrealname != '' ) ? $this->loggedrealname : $this->loggedusername;
	}
	public function getRequestId()
	{
		if( !isset( $this->requestid ))
		{
			$this->popuser();
		}
		return $this->requestid;
	}
	
	// -
	public function getListingName()
	{
		// Verify Access
		if( ! $this->checkAccess() )
		{
			return JText::_('COM_MINITHEATRECM_MESSAGE_UNAUTHORIZED_RECORD_ACCESS');
		}
		
		// Else (if authorized)
		if( !isset( $this->listingname ))
		{
			$this->popdata();
		}
		return $this->listingname;
	}
	public function getListingContent()
	{
		// Verify Access
		if( ! $this->checkAccess() )
		{
			return JText::_('COM_MINITHEATRECM_MESSAGE_UNAUTHORIZED_RECORD_ACCESS');
		}
		
		// Else (if authorized)
		if( !isset( $this->listingcontent ))
		{
			$this->popdata();
		}
		return $this->listingcontent;
	}
	public function getListingInfo()
	{
		// Verify Access
		if( ! $this->checkAccess() )
		{
			return JText::_('COM_MINITHEATRECM_MESSAGE_UNAUTHORIZED_RECORD_ACCESS');
		}
		
		// Else (if authorized)
		if( !isset( $this->listinginfo ))
		{
			$this->popdata();
		}
		return $this->listinginfo;
	}
	public function getLastModified()
	{
		// Verify Access
		if( ! $this->checkAccess() )
		{
			return JText::_('COM_MINITHEATRECM_MESSAGE_UNAUTHORIZED_RECORD_ACCESS');
		}
		
		// Else (if authorized)
		if( !isset( $this->lastmodified ))
		{
			$this->popdata();
		}
		return $this->lastmodified;
	}
	public function getUserLive()
	{
		// Verify Access
		if( ! $this->checkAccess() )
		{
			return JText::_('COM_MINITHEATRECM_MESSAGE_UNAUTHORIZED_RECORD_ACCESS');
		}
		
		// Else (if authorized)
		if( !isset( $this->userlive ))
		{
			$this->popdata();
		}
		return $this->userlive;
	}
	public function getItemId()
	{
		// Verify Access
		if( ! $this->checkAccess() )
		{
			return JText::_('COM_MINITHEATRECM_MESSAGE_UNAUTHORIZED_RECORD_ACCESS');
		}
		
		// Else (if authorized)
		if( !isset( $this->itemid ))
		{
			$this->popdata();
		}
		return $this->itemid;
	}
	public function getRequestName()
	{
		// Verify Access
		if( ! $this->checkAccess() )
		{
			return JText::_('COM_MINITHEATRECM_MESSAGE_UNAUTHORIZED_RECORD_ACCESS');
		}
		
		// Else (if authorized)
		if( !isset( $this->requestname ))
		{
			$this->popdata();
		}
		return $this->requestname;
	}
	public function getRequestDesc()
	{
		// Verify Access
		if( ! $this->checkAccess() )
		{
			return JText::_('COM_MINITHEATRECM_MESSAGE_UNAUTHORIZED_RECORD_ACCESS');
		}
		
		// Else (if authorized)
		if( !isset( $this->requestdesc ))
		{
			$this->popdata();
		}
		return $this->requestdesc;
	}
	
	// -
	public function getItemState()
	{
		// Verify Access
		if( ! $this->checkAccess() )
		{
			return false;
		}
		// Else (if authorized)
		if( !isset( $this->itemstate ))
		{
			$this->popitem();
		}
		return $this->itemstate;
	}
	public function getItemName()
	{
		// Verify Access
		if( ! $this->checkAccess() )
		{
			return JText::_('COM_MINITHEATRECM_MESSAGE_UNAUTHORIZED_RECORD_ACCESS');
		}
		
		// Else (if authorized)
		if( !isset( $this->itemname ))
		{
			$this->popitem();
		}
		return $this->itemname;
	}

}