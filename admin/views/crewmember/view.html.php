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
 * CrewMember View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewCrewMember extends NeonViewForm
{
	protected $ui_title	= 'COM_MINITHEATRECM_TITLE_CREWMEMBERS';

	// Add the toolbar and title
	protected function addToolBar()
	{
		$isNew = ($this->item->id == 0);
		
		JToolbarHelper::apply('crewmember.apply');
		JToolbarHelper::save('crewmember.save');
		JToolbarHelper::save2new('crewmember.save2new');
		if(!$isNew)
			JToolbarHelper::save2copy('crewmember.save2copy');
		JToolbarHelper::cancel(
			'crewmember.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
		
		parent::addToolBar();
	}
}