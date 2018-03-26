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
 * NeonViewBase Source
 *
 * @since  0.0.1
 */
class NeonViewBase extends JViewLegacy
{
	protected $ui_submenu		= null;
	protected $ui_title			= 'JADMINISTRATION';
	protected $ui_icon			= 'cogs';
	protected $addscripts		= null;
	protected $addstylesheets	= null;
	
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set up other UI elements
		if ($this->getLayout() !== 'modal')
		{
			if( $this->ui_submenu != null )
			{
				MiniTheatreCMHelper::addSubmenu($this->ui_submenu);
			}
			$this->sidebar = JHtmlSidebar::render();
			
			$this->setDocument();
			$this->addToolBar();
		}
		
		// Attach scripts and stylesheets
		$this->setAddons();
		
		// Display the template
		parent::display($tpl);
	}
	
	// Add toolbar buttons
	protected function addToolBar()
	{
		
		
	}
	
	// Set document properties
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		
		// Title
		$title = JText::_($this->ui_title);
		JToolbarHelper::title( $title, $this->ui_icon );
		$document->setTitle($title.' - '.JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE'));
	}
	
	// Addon definitions
	protected function setAddons()
	{
		$document = $this->document;
		// Scripts
		if( is_string( $this->addscripts ))
		{
			$this->addscripts = array( $this->addscripts );
		}
		if( is_array( $this->addscripts ))
		{
			foreach( $this->addscripts as $path )
			{
				if( is_string( $path ))
				{
					$document->addScript( $path );
				}
			}
		}
		
		// Stylesheets
		if( is_string( $this->addstylesheets ))
		{
			$this->addstylesheets = array( $this->addstylesheets );
		}
		if( is_array( $this->addstylesheets ))
		{
			foreach( $this->addstylesheets as $path )
			{
				if( is_string( $path ))
				{
					$document->addStyleSheet( $path );
				}
			}
		}
	}
}