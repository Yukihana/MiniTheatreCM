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
 * CrewRole View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewCrewRole extends NeonViewForm
{
	protected $ui_title	= 'COM_MINITHEATRECM_TITLE_CREWROLES';

	// Add the toolbar and title
	protected function addToolBar()
	{
		$isNew = ($this->item->id == 0);
		
		JToolbarHelper::apply('crewrole.apply');
		JToolbarHelper::save('crewrole.save');
		JToolbarHelper::save2new('crewrole.save2new');
		if(!$isNew)
			JToolbarHelper::save2copy('crewrole.save2copy');
		JToolbarHelper::cancel(
			'crewrole.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
		
		parent::addToolBar();
	}
}