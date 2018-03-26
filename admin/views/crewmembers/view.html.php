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
 * Crew-Members View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewCrewMembers extends NeonViewManager
{
	protected $ui_submenu	= 'crewmembers';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_CREWMEMBERS';
	protected $ui_icon		= 'users';
	
	// Add toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('crewmember.add');
		JToolbarHelper::editList('crewmember.edit');
		JToolbarHelper::publish('crewmembers.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('crewmembers.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('crewmembers.archive');
		
		if($this->state->get('filter.state') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_CREWMEMBERS_CONFIRMDELETE', 'crewmembers.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('crewmembers.trash');
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
}