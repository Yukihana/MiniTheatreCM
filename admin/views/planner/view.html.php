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
 * Planner View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewPlanner extends JViewLegacy
{
	// Display
	function display($tpl = null)
	{
		//Add data from the model
		$this->tasks	= $this->get('Tasks');
		$this->clog		= $this->get('Changelogs');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the submenu
		MiniTheatreCMHelper::addSubmenu('planner');
		
		// Set the toolbar and number of found items
		$this->addToolBar();
		
		// Display the template
		parent::display($tpl);
	}
	
	// Header, Toolbar, and Buttons
	protected function addToolBar()
	{
		JToolbarHelper::title( JText::_('COM_MINITHEATRECM_TITLE_PLANNER'), 'calendar' );
		
		JToolbarHelper::preferences('com_minitheatrecm');		
	}
}