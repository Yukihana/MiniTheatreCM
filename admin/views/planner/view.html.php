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
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		$app				= JFactory::getApplication();
		$context			= 'com_minitheatrecm.planner.';
		
		// Get data from the model
		$this->state		= $this->get('State');
		$this->utype		= $this->get('UpdateType');
		
		// Versions and Changelog
		$this->vlist		= $this->get('VList');			// ChangeLogs list data
		$this->vpagination	= $this->get('VPagination');
		$this->voptions		= $this->get('VOptions');		// Data for the phone version of the list
		$this->changelog	= $this->get('Changelog');		// Initial Data and Non-Ajax Fallback
		
		// Legacy
		$this->tasks		= $this->get('Tasks');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set up other UI elements
		if ($this->getLayout() !== 'modal')
		{
			MiniTheatreCMHelper::addSubmenu('planner');
			$this->sidebar = JHtmlSidebar::render();
			
			$this->setDocument();
			$this->addToolBar();
		}
		
		// Add scripts
		
		
		// Display the template
		parent::display($tpl);
	}
	
	// Header, Toolbar, and Buttons
	protected function addToolBar()
	{
		JToolbarHelper::title( JText::_('COM_MINITHEATRECM_TITLE_PLANNER'), 'calendar' );
		
		JToolbarHelper::preferences('com_minitheatrecm');		
	}
	
	protected function setDocument()
	{
		JFactory::getDocument()->addScript( JUri::root().'media/com_minitheatrecm/js/ajaxgeneric.js' );
	}
}