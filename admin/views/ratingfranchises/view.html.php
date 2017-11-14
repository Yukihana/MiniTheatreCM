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
		$pretime			= microtime(true);
		$this->items		= $this->get('Items');
		$posttime			= microtime(true);
		$this->pagination	= $this->get('Pagination');
		$this->names		= $this->get('Usernames');
		$this->franchises	= $this->get('Franchises');
		$this->querytime	= $posttime - $pretime;
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set up other UI elements
		if ($this->getLayout() !== 'modal')
		{
			MiniTheatreCMHelper::addSubmenu('ratingfranchises');
			$this->sidebar = JHtmlSidebar::render();
			
			$this->setDocument();
			$this->addToolBar();
		}
		
		// Display the template
		parent::display($tpl);
	}
	
	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::addNew('ratingfranchise.add');
		JToolbarHelper::editList('ratingfranchise.edit');
		JToolbarHelper::deleteList('COM_MINITHEATRECM_RATINGFRANCHISES_CONFIRMDELETE', 'ratingfranchises.delete', 'COM_MINITHEATRECM_DICTIONARY_DELETE');
		
		JToolbarHelper::preferences('com_minitheatrecm');
	}
	
	// Set page-header and document-title
	protected function setDocument()
	{
		$title = JText::_('COM_MINITHEATRECM_TITLE_RATINGFRANCHISES');
		JToolbarHelper::title( $title, 'heart' );
		JFactory::getDocument()->setTitle($title.' - '.JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE'));
	}
}