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

class MiniTheatreCMViewMyListings extends JViewLegacy
{
	/**
	 * Display the MyListings view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Assign data to the view
		$this->iLoggedIn	= $this->get('LoggedIn');
		$this->iListings 	= $this->get('Listings');
		$this->iItemNames	= $this->get('ItemNames');
		$this->pagination	= $this->get('Pagination');
		$this->iPageTitle 	= JText::_('COM_MINITHEATRECM_MYLISTINGS_HEADING');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');

			return false;
		}

		// Display the view
		parent::display($tpl);
	}
}