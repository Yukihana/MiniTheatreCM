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

abstract class MiniTheatreCMLibHtmlManagerFields
{
	public static function getUsername($usernames = array(), $id = 0, $isrecentedit = false)
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
	
	public static function getFranchise($a = array(), $id = 0)
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
	
	public static function getItem($a = array(), $id = 0)
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
	
	public static function getAccess($a = array(), $id = 0)
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