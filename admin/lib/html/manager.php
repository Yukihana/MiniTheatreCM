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

// Include Dependencies
JLoader::Register('MiniTheatreCMMetaNfo', JPATH_COMPONENT_ADMINISTRATOR . '/meta/nfo.php');

abstract class MiniTheatreCMLibHtmlManager
{
	// Sections
	public static function getListFooter($resultcount = null, $querytime = null)
	{
		// Open
		$footer = '<div class="small" style="text-align:right;">';
		
		// ResultCount & QueryTime
		if($resultcount != null)
		{
			$footer.= '<span class="nowrap disabled">'.JText::plural('COM_MINITHEATRECM_MESSAGE_RESULTCOUNT', $resultcount).'</span>';
			
			// Conditional Split #1
			$footer.= '<span class="hidden-phone disabled"> &#8212; </span><br class="visible-phone"/>';
		}
		if($querytime != null)
		{
			$footer.= '<span class="nowrap disabled">'.JText::sprintf('COM_MINITHEATRECM_MESSAGE_QUERYTIME', $querytime).'</span>';
			
			// Conditional Split #2
			$footer.= '<span class="hidden-phone disabled"> &#8212; </span><br class="visible-phone"/>';
		}
		
		// Branding
		$meta		= MiniTheatreCMMetaNfo::getVersionData();
		$version	= isset($meta['version'])	? ' '.$meta['version']	: '';
		$date		= isset($meta['date'])		? $meta['date']			: '0000-00-00';
		$time		= isset($meta['time'])		? $meta['time']			: '00:00:00';
		$timezone	= isset($meta['timezone'])	? $meta['timezone']		: 'UTC';
		$link		= JRoute::_('index.php?option=com_minitheatrecm&view=planner&tabview=updates');
		
		$tooltip = JText::sprintf('COM_MINITHEATRECM_MESSAGE_VERSIONUPDATEDON', $date, $time, $timezone);
				
		//Branding
		$footer.= '<a class="nowrap hasTooltip" title="'.$tooltip.'" href="'.$link.'">';
		$footer.= JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE').$version;
		
		// Close the containers & Return
		$footer.= '</a></div>';
		return $footer;
	}
	
	// Fields
	public static function getUsernameField($usernames = array(), $id = 0, $isrecentedit = false)
	{
		if( $id != 0 && isset( $usernames[$id] ))
		{
			echo '<a class="hasTooltip" href="'.JRoute::_('index.php?option=com_users&task=user.edit&id='.$id).'" title="'.JText::_($isrecentedit?'COM_MINITHEATRECM_DICTIONARY_MOSTRECENTEDITOR':'JAUTHOR').'">'.$usernames[$id].'</a>';
		}
		else
		{	
			echo '<span class="hasTooltip" title="'.JText::_( $id == 0 ? 'COM_MINITHEATRECM_MESSAGE_USERZERO' : 'COM_MINITHEATRECM_MESSAGE_NOSUCHUSER' ).'">';
			echo $id == 0 ? JText::_('COM_MINITHEATRECM_DICTIONARY_NONE') : (JText::_('COM_MINITHEATRECM_DICTIONARY_ID').': '.$id);
			echo '</span>';
		}
	}
	
	public static function getFranchiseField($a = array(), $id = 0)
	{
		if( $id != 0 && isset( $a[$id] ))
		{
			echo '<a class="hasTooltip" href="'.JRoute::_('index.php?option=com_minitheatrecm&task=franchise.edit&id='.$id).'" title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_FRANCHISE').'">'.$a[$id].'</a>';
		}
		else
		{	
			echo '<span class="hasTooltip" title="'.JText::_( $id == 0 ? 'COM_MINITHEATRECM_MESSAGE_FRANCHISEZERO' : 'COM_MINITHEATRECM_MESSAGE_NOSUCHFRANCHISE' ).'">';
			echo $id == 0 ? JText::_('COM_MINITHEATRECM_DICTIONARY_NONE') : (JText::_('COM_MINITHEATRECM_DICTIONARY_ID').': '.$id);
			echo '</span>';
		}
	}
	
	public static function getItemField($a = array(), $id = 0)
	{
		if( $id != 0 && isset( $a[$id] ))
		{
			echo '<a class="hasTooltip" href="'.JRoute::_('index.php?option=com_minitheatrecm&task=item.edit&id='.$id).'" title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_ITEM').'">'.$a[$id].'</a>';
		}
		else
		{	
			echo '<span class="hasTooltip" title="'.JText::_( $id == 0 ? 'COM_MINITHEATRECM_MESSAGE_ITEMZERO' : 'COM_MINITHEATRECM_MESSAGE_NOSUCHITEM' ).'">';
			echo $id == 0 ? JText::_('COM_MINITHEATRECM_DICTIONARY_NONE') : (JText::_('COM_MINITHEATRECM_DICTIONARY_ID').': '.$id);
			echo '</span>';
		}
	}
	
	public static function getAccessField($a = array(), $id = 0)
	{
		if( $id != 0 && isset( $a[$id] ))
		{
			echo '<a class="hasTooltip" href="'.JRoute::_('index.php?option=com_users&task=group.edit&id='.$id).'" title="'.JText::_('JGRID_HEADING_ACCESS').'">'.$a[$id].'</a>';
		}
		else
		{	
			echo '<span class="hasTooltip" title="'.JText::_( $id == 0 ? 'COM_MINITHEATRECM_MESSAGE_ACCESSZERO' : 'COM_MINITHEATRECM_MESSAGE_NOSUCHACCESS' ).'">';
			echo $id == 0 ? JText::_('COM_MINITHEATRECM_DICTIONARY_NONE') : (JText::_('COM_MINITHEATRECM_DICTIONARY_ID').': '.$id);
			echo '</span>';
		}
	}
}