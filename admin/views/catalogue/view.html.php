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
 * Catalogue View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewCatalogue extends JViewLegacy
{
	protected $form;
	protected $item;
	
	// Display the template ($tpl: template file)
	 public function display($tpl = null)
	{
		// Get data from the model
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
			//$this->script = $this->get('Script');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}
		
		// Set up other UI elements
		$this->setDocument();
		$this->addToolBar();
		
		// Display the template
		return parent::display($tpl);
	}
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$isNew = ($this->item->id == 0);
		
		JToolbarHelper::apply('catalogue.apply');
		JToolbarHelper::save('catalogue.save');
		JToolbarHelper::save2new('catalogue.save2new');
		if(!$isNew)
			JToolbarHelper::save2copy('catalogue.save2copy');
		JToolbarHelper::cancel(
			'catalogue.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
	}
	
	// Set page-header and document-title 
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$title = JText::_('COM_MINITHEATRECM_TITLE_CATALOGUES')
				.': '.JText::_($this->item->id == 0 ? 'COM_MINITHEATRECM_DICTIONARY_NEW' : 'COM_MINITHEATRECM_DICTIONARY_EDIT');
		
		JToolbarHelper::title($title, 'pencil-2');
		$document->setTitle($title.' - '.JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE'));
		/*
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_minitheatrecm"
		                                  . "/views/item/submitbutton.js");
		JText::script('COM_MINITHEATRECM_ERROR_UNACCEPTABLE');
		*/
	}
}