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
 * MiniTheatreCM component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */ 
abstract class MiniTheatreCMHelper extends JHelperContent
{
	
	/**
	 * Configure the Linkbar.
	 *
	 * @return Bool
	 */	 
	public static function addSubmenu($submenu) 
	{
		// Load xml
		$xml = simplexml_load_file( JPATH_COMPONENT_ADMINISTRATOR . '/cfg/sidebar.xml' );
		
		// Add menu items
		foreach( $xml->menuitem as $menuitem )
		{
			$link = 'index.php?';
			
			// Parse attribs as $_GET vars
			foreach( $menuitem->attributes() as $key=>$value )
			{
				if($key != 'label' && $key != 'matchstr')
				{
					$link.= NeonDataEscape::generic($key).'='.NeonDataEscape::generic($value).'&';
				}
			}
			if( substr($link,-1) == '&' )
			{
				$link = substr( $link, 0, -1 );
			}
			
			JHtmlSidebar::addEntry(
				JText::_( $menuitem['label']), $link, $submenu == $menuitem['matchstr']
			);
		}
	}
}