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
 * UlWizSource View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewUlWizSource extends JViewLegacy
{
	/**
	 * View form
	 *
	 * @var         form
	 */
	protected $form = null;

	/**
	 * Display the UlWizSource view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */ 
	public function display($tpl = null)
	{
		// Get the Data
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->script = $this->get('Script');

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
	
	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;

		// Hide Joomla Administrator Main menu
		$input->set('hidemainmenu', true);

		$isNew = ($this->item->id == 0);

		$title = JText::_('COM_MINITHEATRECM_MANAGER_ULWIZSOURCES_TITLE').': '.JText::_($isNew ? 'COM_MINITHEATRECM_DICTIONARY_NEW' : 'COM_MINITHEATRECM_DICTIONARY_EDIT');

		JToolbarHelper::title($title, 'pencil-2');
		JToolbarHelper::apply('ulwizsource.apply');
		JToolbarHelper::save('ulwizsource.save');
		JToolbarHelper::save2new('ulwizsource.save2new');
		if(!$isNew)
			JToolbarHelper::save2copy('ulwizsource.save2copy');
		JToolbarHelper::cancel(
			'ulwizsource.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
	}
	
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	 
	protected function setDocument() 
	{
		$isNew = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle(
			JText::_($isNew ? 'COM_MINITHEATRECM_ULWIZSOURCE_TITLE_NEW' : 'COM_MINITHEATRECM_ULWIZSOURCE_TITLE_EDIT').' - '.
			JText::_('JADMINISTRATION').' - '.
			JText::_('COM_MINITHEATRECM_GLOBAL_TITLE')
		);
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_minitheatrecm"
		                                  . "/views/ulwizsource/submitbutton.js");
		JText::script('COM_MINITHEATRECM_ERROR_UNACCEPTABLE');
	}	
}