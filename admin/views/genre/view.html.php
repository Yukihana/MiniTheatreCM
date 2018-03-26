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
 * Genre View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewGenre extends NeonViewForm
{
	protected $ui_title	= 'COM_MINITHEATRECM_TITLE_GENRES';

	// Add toolbar buttons
	protected function addToolBar()
	{
		$isNew = ($this->item->id == 0);
		
		JToolbarHelper::apply('genre.apply');
		JToolbarHelper::save('genre.save');
		JToolbarHelper::save2new('genre.save2new');
		if(!$isNew)
			JToolbarHelper::save2copy('genre.save2copy');
		JToolbarHelper::cancel(
			'genre.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
		
		parent::addToolBar();
	}
}