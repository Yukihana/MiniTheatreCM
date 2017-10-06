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
	
	protected $requestid;
	protected $usermatched;
	
	protected $listingname;
	protected $listingcontent;
	protected $listinginfo;
	protected $lastmodified;
	
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
		if( !isset( $this->loggeduser ))
		{
			$this->loggeduser = JFactory::getUser();
		}
		
		if( !isset( $this->loggeduserid ))
		{
			$this->loggeduserid = $this->loggeduser->get('id');
		}
		
		if( !isset( $this->loggedusername ))
		{
			$this->loggedusername = $this->loggeduser->get('username');
		}
		
		if( !isset( $this->loggedrealname ))
		{
			$this->loggedrealname = $this->loggeduser->get('name');
		}
		
		if( !isset( $this->requestid ))
		{
			$this->requestid = JFactory::getApplication()->input->get('id', 0, 'INT');
		}
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
		if( !isset( $this->listingname ))
		{
			$this->listingname = $table->name;
		}
		
		if( !isset( $this->listingcontent ))
		{
			$this->listingcontent = $table->content;
		}
		
		if( !isset( $this->listinginfo ))
		{
			$this->listinginfo = $table->description;
		}
		
		if( !isset( $this->lastmodified ))
		{
			$this->lastmodified = $table->modified_on;
		}
	}
		
	/**
	 * Get functions for:
	 *
	 * - $usermatched
	 * - $loggeduserid, $loggedusername, $requestid
	 * - $listingname, $listingcontent, $lastmodified
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
}