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
 * HTML View class for the MiniTheatreCM_EditItem Component
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewEditItem extends JViewLegacy
{
	/**
	 * Display the EditItem view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Assign data to the view
		$this->msg = JText::_('COM_MINITHEATRECM_EDITITEM_HEADING');

		// Display the view
		parent::display($tpl);
	}
}