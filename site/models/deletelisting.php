<?php
/**
 * @package     MiniTheatre.Administrator
 * @subpackage  com_minitheatrecm
 *
 * @copyright   CherrySoft-X 2017, MiniTheatre 2017
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link        http://minitheatre.org/
 */
  
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * DeleteListing Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelEditListing extends JModelItem
{
	// Initialize the delivery storage
	protected $loggeduser;
	protected $loggeduserid;
	protected $loggedusername;
	protected $loggedrealname;
	
	protected $requestid;	//Note this is the $id, not associated to table data
	protected $usermatched;
	
	protected $listingname;
	protected $itemid;
	
	
	
	
}