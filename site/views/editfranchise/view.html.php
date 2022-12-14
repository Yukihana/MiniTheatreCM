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
 * HTML View class for the MiniTheatreCM_EditFranchise Component
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewEditFranchise extends JViewLegacy
{
	/**
	 * Display the EditFranchise view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Assign data to the view
		$this->msg = JText::_('COM_MINITHEATRECM_EDITFRANCHISE_HEADING');

		// Display the view
		parent::display($tpl);
	}
}