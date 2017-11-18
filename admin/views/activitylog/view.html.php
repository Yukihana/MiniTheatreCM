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
 * ActivityLog View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewActivityLog extends JViewLegacy
{
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		// Get data from the model
		$pretime			= microtime(true);
		$this->items		= $this->get('Items');
		$posttime			= microtime(true);
		$this->pagination	= $this->get('Pagination');
		// $this->names		= $this->get('Usernames');
		$this->querytime	= $posttime - $pretime;
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}
		
		// Set up other UI elements
		if ($this->getLayout() !== 'modal')
		{
			MiniTheatreCMHelper::addSubmenu('activitylog');
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
		// JToolbarHelper:: <Register and build task: Clear Log>
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
	
	// Set page-header and document-title
	protected function setDocument()
	{
		$title = JText::_('COM_MINITHEATRECM_TITLE_ACTIVITYLOG');
		JToolbarHelper::title( $title, 'clock' );
		JFactory::getDocument()->setTitle($title.' - '.JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE'));
	}
}