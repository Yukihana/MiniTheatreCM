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
		JHtmlSidebar::addEntry(
			JText::_('COM_MINITHEATRECM_TITLE_OVERVIEW'),
			'index.php?option=com_minitheatrecm&view=overview',
			$submenu == 'overview'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_MINITHEATRECM_TITLE_LISTINGS'),
			'index.php?option=com_minitheatrecm&view=listings',
			$submenu == 'listings'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_MINITHEATRECM_TITLE_REVIEWS'),
			'index.php?option=com_minitheatrecm&view=reviews',
			$submenu == 'reviews'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_MINITHEATRECM_TITLE_ITEMS'),
			'index.php?option=com_minitheatrecm&view=items',
			$submenu == 'items'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_MINITHEATRECM_TITLE_FRANCHISES'),
			'index.php?option=com_minitheatrecm&view=franchises',
			$submenu == 'franchises'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_MINITHEATRECM_TITLE_GENRES'),
			'index.php?option=com_minitheatrecm&view=genres',
			$submenu == 'genres'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_MINITHEATRECM_TITLE_CONTENTTYPES'),
			'index.php?option=com_minitheatrecm&view=contenttypes',
			$submenu == 'contenttypes'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_MINITHEATRECM_TITLE_PLANNER'),
			'index.php?option=com_minitheatrecm&view=planner',
			$submenu == 'planner'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_MINITHEATRECM_TITLE_ULWIZSOURCES'),
			'index.php?option=com_minitheatrecm&view=ulwizsources',
			$submenu == 'ulwizsources'
		);
	}
}