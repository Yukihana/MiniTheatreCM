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
 * Genres View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewGenres extends NeonViewManager
{
	protected $ui_submenu	= 'genres';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_GENRES';
	protected $ui_icon		= 'smiley-2';
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('genre.add');
		JToolbarHelper::editList('genre.edit');
		JToolbarHelper::publish('genres.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('genres.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('genres.archive');
		if($this->state->get('filter.published') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_GENRES_CONFIRMDELETE', 'genres.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('genres.trash');
		
		if (JFactory::getUser()->authorise('core.admin', 'com_minitheatrecm'))
		{
			JToolbarHelper::preferences('com_minitheatrecm');
		}
	}
}