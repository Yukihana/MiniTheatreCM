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
 * Listing View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewListing extends NeonViewForm
{
	protected $ui_title	= 'COM_MINITHEATRECM_TITLE_LISTINGS';

	// Add toolbar buttons
	protected function addToolBar()
	{
		$isNew = ($this->item->id == 0);
		
		JToolbarHelper::apply('listing.apply');
		JToolbarHelper::save('listing.save');
		JToolbarHelper::save2new('listing.save2new');
		if(!$isNew)
			JToolbarHelper::save2copy('listing.save2copy');
		JToolbarHelper::cancel(
			'listing.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
		
		parent::addToolBar();
	}
}