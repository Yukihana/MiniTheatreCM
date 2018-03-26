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
 * CType View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewCType extends NeonViewForm
{
	protected $ui_title	= 'COM_MINITHEATRECM_TITLE_CTYPES';

	// Add toolbar buttons
	protected function addToolBar()
	{
		$isNew = ($this->item->id == 0);
		
		JToolbarHelper::apply('ctype.apply');
		JToolbarHelper::save('ctype.save');
		JToolbarHelper::save2new('ctype.save2new');
		if(!$isNew)
			JToolbarHelper::save2copy('ctype.save2copy');
		JToolbarHelper::cancel(
			'ctype.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
		
		parent::addToolBar();
	}
}