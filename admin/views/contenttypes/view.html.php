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
 * ContentTypes View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewContentTypes extends NeonViewManager
{
	protected $ui_submenu	= 'contenttypes';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_CONTENTTYPES';
	protected $ui_icon		= 'basket';
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('contenttype.add');
		JToolbarHelper::editList('contenttype.edit');
		JToolbarHelper::publish('contenttypes.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('contenttypes.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('contenttypes.archive');
		if($this->state->get('filter.published') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_CONTENTTYPES_CONFIRMDELETE', 'contenttypes.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('contenttypes.trash');
		
		if (JFactory::getUser()->authorise('core.admin', 'com_minitheatrecm'))
		{
			JToolbarHelper::preferences('com_minitheatrecm');
		}
	}
}