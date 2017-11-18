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

abstract class NeonLibHtmlManager
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
		
		// Branding & Version
		$meta		= MiniTheatreCMMetaNfo::getVersionData();
		
		$footer.= '<a class="nowrap hasTooltip" title="'
				.JText::sprintf('COM_MINITHEATRECM_MESSAGE_VERSIONUPDATEDON', $meta['date'], $meta['time'], $meta['zone'])
				.'" href="'.JRoute::_('index.php?option=com_minitheatrecm&view=planner&tabview=updates').'">'
				.JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE').' '.$meta['version']
				.'</a></div>';
				
		return $footer;
	}
	// Parsing Helpers
	public static function getEditorOrder($ordering = '')
	{
		if( strpos($ordering, 'author') !== false )
		{
			return 1;
		}
		elseif( strpos($ordering, 'recentedit') !== false )
		{
			return 2;
		}
		else return 0;
	}
	public static function getTimestampOrder($ordering = '')
	{
		if( strpos($ordering, 'created') !== false )
		{
			return 1;
		}
		elseif( strpos($ordering, 'modified') !== false )
		{
			return 2;
		}
		else return 0;
	}
	public static function getStatsOrder($ordering = '')
	{
		if( strpos($ordering, 'hits') !== false )
		{
			return 1;
		}
		elseif( strpos($ordering, 'votes') !== false )
		{
			return 2;
		}
		else return 0;
	}
	
	// Headers
	public static function getEditorHeader($ordering = 0)
	{
		switch($ordering)
		{
			case 1: return 'JAUTHOR';
			case 2: return 'COM_MINITHEATRECM_DICTIONARY_RECENTEDIT';
			default: return 'COM_MINITHEATRECM_DICTIONARY_EDITORS';
		}
	}
	public static function getTimestampHeader($ordering = 0)
	{
		switch($ordering)
		{
			case 1: return 'COM_MINITHEATRECM_DICTIONARY_CREATED';
			case 2: return 'COM_MINITHEATRECM_DICTIONARY_MODIFIED';
			default: return 'COM_MINITHEATRECM_DICTIONARY_TIMESTAMPS';
		}
	}
	public static function getStatsHeader($ordering = 0)
	{
		switch($ordering)
		{
			case 1: return 'JGLOBAL_HITS';
			case 2: return 'JGLOBAL_VOTES';
			default: return 'COM_MINITHEATRECM_DICTIONARY_STATS';
		}
	}
	
	// Fields: Double
	public static function getEditorCell($usernames = array(), $author = 0, $recent = 0, $ordering = 0)
	{
		return '<div>'
				.'<div class="nowrap">'
				.'<span class="icon-user'.($ordering==1?'':' disabled muted').'" style="vertical-align:middle;"> </span>'
				.self::getUserCell($usernames, $author, false, true, $ordering!=1)
				.'</div><div class="nowrap">'
				.'<span class="icon-bookmark'.($ordering==2?'':' disabled muted').'" style="vertical-align:middle;"> </span>'
				.self::getUserCell($usernames, $recent, true, true, $ordering!=2)
				.'</div></div>';
	}
	public static function getTimestampCell($created = '', $modified = '', $ordering = 0)
	{
		return '<div>'
				.'<div class="nowrap hasTooltip" title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_CREATED').'">'
				.'<span class="icon-plus-2'.($ordering==1?'':' disabled muted').'" style="vertical-align:middle;"> </span>'
				.'<span class="small">'.$created.'</span></div>'
				.'<div class="nowrap hasTooltip" title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_MODIFIED').'">'
				.'<span class="icon-pencil-2'.($ordering==2?'':' disabled muted').'" style="vertical-align:middle;"> </span>'
				.'<span class="small">'.$modified.'</span></div>'
				.'</div>';
	}
	public static function getStatsCell($hits = '', $votes = '', $ordering = 0)
	{
		if($ordering == 1 || $ordering == 2)
		{
			return '<span class="badge badge-'.($ordering==1?'info':'success').'">'.(int)($ordering==1? $hits:$votes).'</span>';
		}
		else
		{
			return '<div>'
				.'<div class="nowrap hasTooltip" title="'.JText::_('JGLOBAL_HITS').'">'
				.'<span class="icon-chart" style="vertical-align:middle;color:green;opacity:0.5;"> </span>'
				.'<span class="small">'.$hits.'</span></div>'
				.'<div class="nowrap hasTooltip" title="'.JText::_('JGLOBAL_VOTES').'">'
				.'<span class="icon-heart" style="vertical-align:middle;color:red;opacity:0.5;"> </span>'
				.'<span class="small">'.$votes.'</span></div>'
				.'</div>';
		}
	}
	// Fields: Single
	public static function getUserCell($usernames = array(), $id = 0, $isrecentedit = false, $smallstyle = false, $disabled = false)
	{
		if( $id != 0 && isset( $usernames[$id] ))
		{
			return '<a class="hasTooltip'.($smallstyle?' small':'').'" title="'
					.JText::_($isrecentedit?'COM_MINITHEATRECM_DICTIONARY_MOSTRECENTEDITOR':'JAUTHOR')
					.'" href="'.JRoute::_('index.php?option=com_users&task=user.edit&id='.$id).'">'
					.$usernames[$id].'</a>';
		}else{
			return '<span class="hasTooltip'.($smallstyle?' small':'').($disabled?' disabled muted':'').'" title="'
					.JText::_($isrecentedit?'COM_MINITHEATRECM_DICTIONARY_MOSTRECENTEDITOR':'JAUTHOR').': '
					.JText::_( $id == 0 ? 'COM_MINITHEATRECM_MESSAGE_USERZERO' : 'COM_MINITHEATRECM_MESSAGE_NOSUCHUSER' ).'">'
					.( $id == 0 ? JText::_('COM_MINITHEATRECM_DICTIONARY_NONE') : (JText::_('COM_MINITHEATRECM_DICTIONARY_ID').': '.$id) )
					.'</span>';
		}
	}
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
	
	public static function getStarRatingCell($value = 0, $twoline = false)
	{
		if($value<0) $value=0;
		if($value>10) $value=10;
		
		$stars = '<div class="nowrap hasTooltip" style="color:orange;" title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_RATING').'">';
		for($i=0;$i<(int)($value/2);$i++)
		{
			$stars.='<span class="icon-star" style="margin-right:0;"></span>';
		}
		if($value%2 == 1)
		{
			$stars.='<span class="icon-star-2" style="margin-right:0;"></span>';
		}
		for($i=0;$i<(int)((10-$value)/2);$i++)
		{
			$stars.='<span class="icon-star-empty" style="margin-right:0;"></span>';
		}
		if($twoline)
		{
			$stars.='</div><div class="small disabled muted">'.$value.'/10';
		}
		
		return $stars.'</div>';
	}
}