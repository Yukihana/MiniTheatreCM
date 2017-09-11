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
 * UlWizSources View
 *
 * @since  0.0.1
 */
 class MiniTheatreCMViewUlWizSources extends JViewLegacy
{
	/**
	 * Display the Upload Config view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the toolbar
		$this->addToolBar();
		
		// Display the template
		parent::display($tpl);
	}
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		JToolbarHelper::title(JText::_('COM_MINITHEATRECM_MANAGER_ULWIZSOURCES_TITLE'), 'wand');
		JToolbarHelper::addNew('ulwizsource.add');
		JToolbarHelper::editList('ulwizsource.edit');
		JToolbarHelper::publish('ulwizsources.publish', 'JTOOLBAR_PUBLISH', true);
		JToolbarHelper::unpublish('ulwizsources.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		JToolbarHelper::deleteList('This would permanently delete the respective user-submission forms. Backing-up before deletion is highly recommended. Are you sure you want to delete the selected items?', 'ulwizsources.delete');
	}
}