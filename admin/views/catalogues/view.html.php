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
 * Catalogues View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewCatalogues extends JViewLegacy
{
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		// Get data from the model
		$pretime				= microtime(true);
		$this->items			= $this->get('Items');
		$posttime				= microtime(true);
		$this->querytime		= $posttime - $pretime;
		
		$this->pagination		= $this->get('Pagination');
		$this->state			= $this->get('State');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set up other UI elements
		if ($this->getLayout() !== 'modal')
		{
			MiniTheatreCMHelper::addSubmenu('catalogues');
			$this->sidebar = JHtmlSidebar::render();
			
			$this->setDocument();
			$this->addToolBar();
		}
		
		// Display the template
		parent::display($tpl);
	}
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('catalogue.add');
		JToolbarHelper::editList('catalogue.edit');
		JToolbarHelper::publish('catalogues.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('catalogues.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('catalogues.archive');
		
		if($this->state->get('filter.published') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_CATALOGUES_CONFIRMDELETE', 'catalogues.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('catalogues.trash');
		
		if (JFactory::getUser()->authorise('core.admin', 'com_minitheatrecm'))
		{
			JToolbarHelper::preferences('com_minitheatrecm');
		}
	}
	
	// Set page-header and document-title
	protected function setDocument()
	{
		$title = JText::_('COM_MINITHEATRECM_TITLE_CATALOGUES');
		JToolbarHelper::title( $title, 'file-2' );
		JFactory::getDocument()->setTitle($title.' - '.JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE'));
	}
}