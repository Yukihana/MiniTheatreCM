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
 * Catalogues View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewCatalogues extends NeonViewManager
{
	protected $ui_submenu	= 'catalogues';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_CATALOGUES';
	protected $ui_icon		= 'file-2';
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('catalogue.add');
		JToolbarHelper::editList('catalogue.edit');
		JToolbarHelper::publish('catalogues.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('catalogues.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('catalogues.archive');
		
		if($this->state->get('filter.published') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_CATALOGUES_CONFIRMDELETE', 'catalogues.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('catalogues.trash');
		
		if (JFactory::getUser()->authorise('core.admin', 'com_minitheatrecm'))
		{
			JToolbarHelper::preferences('com_minitheatrecm');
		}
	}
}