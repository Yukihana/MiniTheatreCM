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
 * Franchises View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewFranchises extends JViewLegacy
{
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->names		= $this->get('Usernames');
		$this->groups		= $this->get('Usergroups');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the submenu
		MiniTheatreCMHelper::addSubmenu('franchises');
		
		// Set the toolbar and number of found items
		$this->addToolBar();
		
		// Display the template
		parent::display($tpl);
	}
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::title( JText::_('COM_MINITHEATRECM_TITLE_FRANCHISES'), 'cube');
				
		JToolbarHelper::addNew('franchise.add');
		JToolbarHelper::editList('franchise.edit');
		JToolbarHelper::publish('franchises.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('franchises.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('franchises.archive');
		/*
		if($this->state->get('filter.published') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_GENRES_CONFIRMDELETE', 'franchises.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('franchises.trash');
		*/
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
}