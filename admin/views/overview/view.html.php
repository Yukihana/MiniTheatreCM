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
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		// Include CCS & JS
		$doc = JFactory::getDocument();
		$doc->addStyleSheet( JUri::base().'components/com_minitheatrecm/views/overview/tmpl/default.css' );
		$doc->addScript( JUri::base().'components/com_minitheatrecm/views/overview/tmpl/default.js' );
		
		// Get data from the model
		$this->layoutmode	= $this->get('LayoutMode');
		$this->itemsdata	= $this->get('ItemsData');
		$this->meta			= $this->get('Version');
		$this->clog			= $this->get('Changelogs');
		$this->tasks		= $this->get('Tasks');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the Layout
		if( $this->layoutmode == 0 )
		{
			$tpl = 'detailed';
		}
		
		// Set the submenu
		MiniTheatreCMHelper::addSubmenu('overview');
		
		// Set the toolbar and number of found items
		$this->addToolBar();
		
		// Display the template
		parent::display($tpl);
	}
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::title(
			JText::_('COM_MINITHEATRECM_TITLE_OVERVIEW')
			.' ('
			.JText::_( ($this->layoutmode == 1) ? 'COM_MINITHEATRECM_DICTIONARY_BASIC' : 'COM_MINITHEATRECM_DICTIONARY_DETAILED' )
			.')'
			, 'bars' );
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
}