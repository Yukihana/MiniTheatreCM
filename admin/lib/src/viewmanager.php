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
 * ContentTypes View
 *
 * @since  0.0.1
 */
class NeonViewManager extends JViewLegacy
{
	protected $ui_submenu	= null;
	protected $ui_title		= 'COM_MINITHEATRECM_DICTIONARY_MANAGER';
	protected $ui_icon		= 'cogs';
	
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
			if( $this->ui_submenu != null )
			{
				MiniTheatreCMHelper::addSubmenu($this->ui_submenu);
			}
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
		
		
	}
	
	// Set page-header and document-title
	protected function setDocument()
	{
		$title = JText::_($this->ui_title);
		JToolbarHelper::title( $title, $this->ui_icon );
		JFactory::getDocument()->setTitle($title.' - '.JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE'));
	}
}