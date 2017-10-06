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
 * HTML View class for the MiniTheatreCM_EditListing Component
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewEditListing extends JViewLegacy
{
	/**
	 * Display the EditListing view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Assign data to the view
		$this->iAuthorized		= $this->get('UserMatched');
		
		if( $this->iAuthorized )
		{
			$this->iLoggedUserId	= $this->get('LoggedUserId');
			$this->iLoggedUserName	= $this->get('LoggedUserName');
			$this->iLoggedRealName	= $this->get('LoggedRealName');
			
			$this->iListingId		= $this->get('RequestId');
			$this->iListingName		= $this->get('ListingName');
			$this->iListingContent	= $this->get('ListingContent');
			$this->iListingInfo		= $this->get('ListingInfo');
			$this->iLastModified	= $this->get('LastModified');
		}

		// Display the view
		parent::display($tpl);
	}
}