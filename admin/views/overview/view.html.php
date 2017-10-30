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
 * Overview View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewOverview extends JViewLegacy
{
	/**
	 * Display the Overview view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
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
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the Layout
		if( $this->layoutmode == 1 )
		{
			$tpl = 'advanced';
		}
		
		// Set the submenu
		MiniTheatreCMHelper::addSubmenu('overview');
		
		// Set the toolbar and number of found items
		$this->addToolBar();
		
		// Display the template
		parent::display($tpl);
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
		JToolbarHelper::title(
			JText::_('COM_MINITHEATRECM_TITLE_OVERVIEW')
			.' ('
			.JText::_( ($this->layoutmode == 1) ? 'COM_MINITHEATRECM_DICTIONARY_DETAILED' : 'COM_MINITHEATRECM_DICTIONARY_BASIC' )
			.')'
			, 'chart' );
		
		JToolbarHelper::preferences('com_minitheatrecm');
		//JToolbarHelper::custom('overview.showdetails', 'refresh', 'refresh', 'Show-Hide', false);
		
	}
}