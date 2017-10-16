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
 * HTML View class for the MiniTheatreCM_Item Component
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewItem extends JViewLegacy
{
	/**
	 * Display the Item view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Authenticate
		$this->LoggedIn = $this->get('LoggedIn');
		$this->Id = $this->get('Id');
		$this->Exists = $this->LoggedIn ? $this->get('Exists') : 0;
		
		if( $this->Exists == 1 )
		{
			$this->iName = $this->get('ItemName');
			$this->iContent = $this->get('ItemContent');
		}
		
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