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
 * Overview View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewOverview extends JViewLegacy
{
	protected $layoutmode = 'basic';
	
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		// Set the Layout
		$this->layoutmode = $this->get('LayoutMode');
		$tpl = ($this->layoutmode == 'basic')? null : $this->layoutmode;
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set up other UI elements
		if ($this->getLayout() !== 'modal')
		{
			MiniTheatreCMHelper::addSubmenu('overview');
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
		JToolbarHelper::preferences('com_minitheatrecm');
	}
	
	protected function setDocument()
	{
		JToolbarHelper::title(
			JText::_('COM_MINITHEATRECM_TITLE_OVERVIEW')
			.' ('
			.JText::_( ($this->layoutmode == 'detailed') ? 'COM_MINITHEATRECM_DICTIONARY_DETAILED' : 'COM_MINITHEATRECM_DICTIONARY_BASIC' )
			.')'
			, 'bars' );
	}
}