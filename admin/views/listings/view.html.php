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
 * Listings View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewListings extends JViewLegacy
{
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		// Get application
		$app		= JFactory::getApplication();
		$context	= 'com_minitheatrecm.listings.list.';
		
		// Get data from the model
		$pretime				= microtime(true);
		$this->items			= $this->get('Items');
		$posttime				= microtime(true);
		$this->pagination		= $this->get('Pagination');
		$this->state			= $this->get('State');
		$this->names			= $this->get('Usernames');
		$this->itemnames		= $this->get('Itemnames');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');
		$this->querytime		= $posttime - $pretime;
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		// Set up other UI elements
		if ($this->getLayout() !== 'modal')
		{
			MiniTheatreCMHelper::addSubmenu('listings');
			$this->sidebar = JHtmlSidebar::render();
			
			$this->setDocument();
			$this->addToolBar();
		}
		
		// Display the template
		return parent::display($tpl);
	}
	
	// Add toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('listing.add');
		JToolbarHelper::editList('listing.edit');
		JToolbarHelper::publish('listings.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('listings.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('listings.archive');
		
		if($this->state->get('filter.state') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_LISTINGS_CONFIRMDELETE', 'listings.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('listings.trash');
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
	
	// Set page-header and document-title
	protected function setDocument()
	{
		$title = JText::_('COM_MINITHEATRECM_TITLE_LISTINGS');
		JToolbarHelper::title( $title, 'play-2' );
		JFactory::getDocument()->setTitle($title.' - '.JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE'));
	}
}