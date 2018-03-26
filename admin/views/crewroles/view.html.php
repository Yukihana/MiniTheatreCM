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
 * Crew-Roles View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewCrewRoles extends NeonViewManager
{
	protected $ui_submenu	= 'crewroles';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_CREWROLES';
	protected $ui_icon		= 'signup';
	
	// Add toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('crewrole.add');
		JToolbarHelper::editList('crewrole.edit');
		JToolbarHelper::publish('crewroles.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('crewroles.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('crewroles.archive');
		
		if($this->state->get('filter.state') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_CREWROLES_CONFIRMDELETE', 'crewroles.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('crewroles.trash');
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
}