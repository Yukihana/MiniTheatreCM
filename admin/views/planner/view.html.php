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
		$app				= JFactory::getApplication();
		$context			= 'com_minitheatrecm.planner.';
		
		//Add data from the model
		$this->state		= $this->get('State');
		
		$this->cloglist		= $this->get('ChangeLogList');			// ChangeLogs list data
		$this->clogdata		= $this->get('ChangeLog');				// active-clog: future, merge index with it.
		$this->clogindex	= $app->getUserState($context.'clog.index',0);
		
		
		
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
	}
}