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
 * CTypes View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewCTypes extends NeonViewManager
{
	protected $ui_submenu	= 'ctypes';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_CTYPES';
	protected $ui_icon		= 'basket';
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('ctype.add');
		JToolbarHelper::editList('ctype.edit');
		JToolbarHelper::publish('ctypes.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('ctypes.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('ctypes.archive');
		if($this->state->get('filter.published') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_CTYPES_CONFIRMDELETE', 'ctypes.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('ctypes.trash');
		
		if (JFactory::getUser()->authorise('core.admin', 'com_minitheatrecm'))
		{
			JToolbarHelper::preferences('com_minitheatrecm');
		}
	}
}