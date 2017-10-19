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
 * MyReviews View
 *
 * @since  0.0.1
 */
 class MiniTheatreCMViewMyReviews extends JViewLegacy
{
	/**
	 * Display the MyReviews view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	 function display($tpl = null)
	{
		
		
		// Assign data
		$this->loggedin			= $this->get('LoggedIn');
		$this->itemnames		= $this->get('ItemNames');
		$this->items			= $this->get('Items');
		$this->pagination		= $this->get('Pagination');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}
		
		// Display the template
		parent::display($tpl);
	}
}