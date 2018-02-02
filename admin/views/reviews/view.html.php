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
 * Reviews View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewReviews extends NeonViewManager
{
	protected $ui_submenu	= 'reviews';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_REVIEWS';
	protected $ui_icon		= 'comments-2';
	
	// Add toolbar buttons
	protected function addToolBar()
	{		
		JToolbarHelper::addNew('review.add');
		JToolbarHelper::editList('review.edit');
		JToolbarHelper::publish('reviews.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('reviews.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('reviews.archive');
		
		if($this->state->get('filter.published') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_REVIEWS_CONFIRMDELETE', 'reviews.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('reviews.trash');
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
}