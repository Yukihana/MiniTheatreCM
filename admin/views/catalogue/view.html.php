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
 * Catalogue View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewCatalogue extends NeonViewForm
{
	protected $ui_title	= 'COM_MINITHEATRECM_TITLE_CATALOGUES';

	// Add toolbar buttons
	protected function addToolBar()
	{
		$isNew = ($this->item->id == 0);
		
		JToolbarHelper::apply('catalogue.apply');
		JToolbarHelper::save('catalogue.save');
		JToolbarHelper::save2new('catalogue.save2new');
		if(!$isNew)
			JToolbarHelper::save2copy('catalogue.save2copy');
		JToolbarHelper::cancel(
			'catalogue.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
		
		parent::addToolBar();
	}
}