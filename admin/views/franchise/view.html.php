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
 * Franchise View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewFranchise extends NeonViewForm
{
	protected $ui_title	= 'COM_MINITHEATRECM_TITLE_FRANCHISES';

	// Add toolbar buttons
	protected function addToolBar()
	{
		$isNew = ($this->item->id == 0);
		
		JToolbarHelper::apply('franchise.apply');
		JToolbarHelper::save('franchise.save');
		JToolbarHelper::save2new('franchise.save2new');
		if(!$isNew)
			JToolbarHelper::save2copy('franchise.save2copy');
		JToolbarHelper::cancel(
			'franchise.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
		
		parent::addToolBar();
	}
}