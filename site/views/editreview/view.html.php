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
 * HTML View class for the MiniTheatreCM_EditReview Component
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewEditReview extends JViewLegacy
{
	/**
	 * Display the EditReview view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Assign data to the view
		$this->msg = JText::_('COM_MINITHEATRECM_EDITREVIEW_HEADING');

		// Display the view
		parent::display($tpl);
	}
}