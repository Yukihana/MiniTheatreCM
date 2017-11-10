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
	// Display the view ($tpl: template file)
	function display($tpl = null)
	{
		// Authenticate
		$this->auth = $this->get('Access');
		if( $this->auth == 0 )
		{
			$this->itemdata = $this->get('Itemdata');
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