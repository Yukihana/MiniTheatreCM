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
 * ContentTypes View
 *
 * @since  0.0.1
 */
 class MiniTheatreCMViewContentTypes extends JViewLegacy
{
	// Display the template where $tpl = template file and return void
	function display($tpl = null)
	{
		// Get application
		//$app = JFactory::getApplication();
		//$context = "minitheatrecm.list.admin.contenttype";
		
		// Get data from the model here
		$this->items			= $this->get('Items');
		$this->pagination		= $this->get('Pagination');
		$this->state			= $this->get('State');
		$this->names			= $this->get('Usernames');
		$this->groups			= $this->get('Usergroups');
		
		//DebugData
		$this->itemcount = count($this->items);
		
		// Queue Errors
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		
		// Set the submenu
		MiniTheatreCMHelper::addSubmenu('contenttypes');
		
		// Set the toolbar and number of found items
		$this->addToolBar();
		
		// Display the template
		parent::display($tpl);
		
		// Set the document
		//$this->setDocument();
	}
	
	protected function addToolBar()
	{	
		JToolbarHelper::title(JText::_('COM_MINITHEATRECM_TITLE_CONTENTTYPES'), 'basket');
		
		JToolbarHelper::addNew('contenttype.add');
		JToolbarHelper::editList('contenttype.edit');
		JToolbarHelper::publish('contenttypes.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('contenttypes.unpublish', 'JTOOLBAR_UNPUBLISH', true);		
		JToolbarHelper::archiveList('contenttypes.archive');
		if($this->state->get('filter.published') == -2)
			JToolbarHelper::deleteList('COM_MINITHEATRECM_ULWIZSOURCES_CONFIRMDELETE', 'contenttypes.delete', 'COM_MINITHEATRECM_DICTIONARY_PURGE');
		else
			JToolbarHelper::trash('contenttypes.trash');
	}	
}