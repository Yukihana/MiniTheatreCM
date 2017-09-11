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
 * UlWizSources View
 *
 * @since  0.0.1
 */
 class MiniTheatreCMViewUlWizSources extends JViewLegacy
{
	/**
	 * Display the Upload Config view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Get application
		$app = JFactory::getApplication();
		$context = "minitheatrecm.list.admin.ulwizsource";
		
		// Get data from the model
		$this->items			= $this->get('Items');
		$this->pagination		= $this->get('Pagination');
		$this->state			= $this->get('State');
		$this->filter_order 	= $app->getUserStateFromRequest($context.'filter_order', 'filter_order', 'wname', 'cmd');
		$this->filter_order_Dir = $app->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the toolbar and number of found items
		$this->addToolBar();
		
		// Display the template
		parent::display($tpl);
		
		// Set the document
		$this->setDocument();
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		$title = JText::_('COM_MINITHEATRECM_MANAGER_ULWIZSOURCES_TITLE');		
		if ($this->pagination->total)
		{
			$title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
		}		
		JToolbarHelper::title($title, 'wand');
		
		JToolbarHelper::addNew('ulwizsource.add');
		JToolbarHelper::editList('ulwizsource.edit');
		JToolbarHelper::publish('ulwizsources.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('ulwizsources.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::deleteList('This would permanently delete the respective user-submission forms. Backing-up before deletion is highly recommended. Are you sure you want to delete the selected items?', 'ulwizsources.delete');
	}
	
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_MINITHEATRECM_ADMINISTRATION'));
	}
}