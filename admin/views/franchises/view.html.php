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
 * Franchises View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewFranchises extends NeonViewManager
{
	protected $ui_submenu	= 'franchises';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_FRANCHISES';
	protected $ui_icon		= 'cube';
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('franchise.add');
		JToolbarHelper::editList('franchise.edit');
		JToolbarHelper::publish('franchises.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('franchises.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('franchises.archive');
		
		if($this->state->get('filter.published') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_FRANCHISES_CONFIRMDELETE', 'franchises.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('franchises.trash');
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
}