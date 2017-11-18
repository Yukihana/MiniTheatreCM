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
class MiniTheatreCMViewFranchise extends JViewLegacy
{
	// Vars
	protected $form = null;

	// Display the view ($tpl = tmpl file to use, defaults to default.php)
	public function display($tpl = null)
	{
		// Get the Data
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		//$this->script = $this->get('Script');

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
		
		// Set the document
		$this->setDocument();
	}
	
	// Add the toolbar and title
	protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;

		// Hide Joomla Administrator Main menu
		$input->set('hidemainmenu', true);

		$isNew = ($this->item->id == 0);

		$title = JText::_('COM_MINITHEATRECM_TITLE_FRANCHISE').': '.JText::_($isNew ? 'COM_MINITHEATRECM_DICTIONARY_NEW' : 'COM_MINITHEATRECM_DICTIONARY_EDIT');

		JToolbarHelper::title($title, 'pencil-2');
		JToolbarHelper::apply('franchise.apply');
		JToolbarHelper::save('franchise.save');
		JToolbarHelper::save2new('franchise.save2new');
		if(!$isNew)
			JToolbarHelper::save2copy('franchise.save2copy');
		JToolbarHelper::cancel(
			'franchise.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
	}
	
	// Document Properties
	protected function setDocument() 
	{
		$isNew = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle(
			JText::_('COM_MINITHEATRECM_TITLE_FRANCHISE').'::'.
			JText::_($isNew ? 'COM_MINITHEATRECM_DICTIONARY_NEW' : 'COM_MINITHEATRECM_DICTIONARY_EDIT').' - '.
			JText::_('JADMINISTRATION').' - '.
			JText::_('COM_MINITHEATRECM_GLOBAL_TITLE')
		);
		/*
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_minitheatrecm"
		                                  . "/views/ulwizsource/submitbutton.js");
		JText::script('COM_MINITHEATRECM_ERROR_UNACCEPTABLE');
		*/
	}
}