<?php
/**
 * @package     MiniTheatre.Administrator
 * @subpackage  com_minitheatrecm
 *
 * @copyright   CherrySoft-X 2017, MiniTheatre 2017
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link        http://fb.me/LilyflowerAngel
 */
  
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * RatingFranchises View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewRatingFranchises extends JViewLegacy
{
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->names		= $this->get('Usernames');
		$this->franchises	= $this->get('Franchises');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the submenu
		MiniTheatreCMHelper::addSubmenu('ratingfranchises');
		
		// Set the toolbar and number of found items
		$this->addToolBar();
		
		// Display the template
		parent::display($tpl);
	}
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::title( JText::_('COM_MINITHEATRECM_TITLE_RATINGFRANCHISES'), 'heart');
				
		JToolbarHelper::addNew('ratingfranchise.add');
		JToolbarHelper::editList('ratingfranchise.edit');
		JToolbarHelper::deleteList('COM_MINITHEATRECM_RATINGFRANCHISES_CONFIRMDELETE', 'ratingfranchises.delete', 'COM_MINITHEATRECM_DICTIONARY_DELETE');
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
}