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
class MiniTheatreCMViewPlanner extends NeonViewBase
{
	protected $ui_submenu	= 'planner';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_PLANNER';
	protected $ui_icon		= 'calendar';
	
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		// Get data from the model
		$this->state		= $this->get('State');
		$this->utype		= $this->get('UpdateType');
		
		// Versions and Changelog
		$this->vlist		= $this->get('VList');			// ChangeLogs list data
		$this->vpagination	= $this->get('VPagination');
		$this->voptions		= $this->get('VOptions');		// Data for the phone version of the list
		$this->changelog	= $this->get('Changelog');		// Initial Data and Non-Ajax Fallback
		
		// Add Scripts and StyleSheets
		$this->addscripts = JUri::root().'media/com_minitheatrecm/js/neonace.js';
		
		// Display the template
		parent::display($tpl);
	}
	
	// Header, Toolbar, and Buttons
	protected function addToolBar()
	{
		JToolbarHelper::preferences('com_minitheatrecm');		
	}
}