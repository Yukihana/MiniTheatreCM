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
 * Organisations View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewOrganisations extends NeonViewManager
{
	protected $ui_submenu	= 'organisations';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_ORGANISATIONS';
	protected $ui_icon		= 'tree-2';
	
	// Add toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('organisation.add');
		JToolbarHelper::editList('organisation.edit');
		JToolbarHelper::publish('organisations.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('organisations.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('organisations.archive');
		
		if($this->state->get('filter.state') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_LISTINGS_CONFIRMDELETE', 'organisations.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('organisations.trash');
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
}