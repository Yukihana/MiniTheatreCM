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
 * NeonViewForm Source
 *
 * @since  0.0.1
 */
class NeonViewForm extends JViewLegacy
{
	// Vars
	protected $form				= null;
	protected $ui_title			= 'COM_MINITHEATRECM_DICTIONARY_FORM';
	
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

		// Set the document
		$this->setDocument();
		$this->setAddons();
		
		// Display the template
		parent::display($tpl);
	}
	
	// Add toolbar buttons
	protected function addToolBar()
	{
		// Hide Joomla Administrator Main menu
		JFactory::getApplication()->input->set('hidemainmenu', true);
	}
	
	// Set document properties
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		
		$task = JText::_( ($this->item->id == 0)? 'COM_MINITHEATRECM_DICTIONARY_NEW' : 'COM_MINITHEATRECM_DICTIONARY_EDIT');
		$title = JText::_($this->ui_title);

		JToolbarHelper::title($title.': '.$task, 'pencil-2');
		$document->setTitle($title.'::'.$task.' - '.JText::_('JADMINISTRATION').' - '.JText::_('COM_MINITHEATRECM_GLOBAL_TITLE'));
	}
	
	protected function setAddons()
	{
		/*
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_minitheatrecm"
		                                  . "/views/ulwizsource/submitbutton.js");
		JText::script('COM_MINITHEATRECM_ERROR_UNACCEPTABLE');
		*/
	}
}