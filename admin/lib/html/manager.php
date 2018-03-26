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
JLoader::Register('MiniTheatreCMCfgGlobal', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/global.php');
JLoader::Register('NeonNfoVersions', JPATH_COMPONENT_ADMINISTRATOR . '/lib/nfo/versions.php');
JLoader::Register('NeonDataCache', JPATH_COMPONENT_ADMINISTRATOR . '/lib/data/cache.php');

abstract class NeonHtmlManager
{
	// Sections
	public static function getListFooter($resulttotal = null, $resultcount = null, $querytime = null)
	{
		// Open
		$footer = '<div class="small" style="text-align:right;">';
		
		// Results
		if($resulttotal != null && $resultcount != null)
		{
			$footer.= '<span class="nowrap disabled">'
					.JText::plural('COM_MINITHEATRECM_MESSAGE_RESULTTOTALCOUNT', $resulttotal, $resultcount)
					.'</span><span class="hidden-phone disabled"> &#8212; </span><br class="visible-phone"/>';
		}
		elseif($resulttotal != null)
		{
			$footer.= '<span class="nowrap disabled">'
					.JText::plural('COM_MINITHEATRECM_MESSAGE_RESULTTOTAL', $resulttotal)
					.'</span><span class="hidden-phone disabled"> &#8212; </span><br class="visible-phone"/>';
		}
		elseif($resultcount != null)
		{
			$footer.= '<span class="nowrap disabled">'
					.JText::plural('COM_MINITHEATRECM_MESSAGE_RESULTCOUNT', $resultcount)
					.'</span><span class="hidden-phone disabled"> &#8212; </span><br class="visible-phone"/>';
		}
		
		// QueryTime
		if($querytime != null)
		{
			$footer.= '<span class="nowrap disabled">'.JText::sprintf('COM_MINITHEATRECM_MESSAGE_QUERYTIME', $querytime).'</span>';
			
			// Conditional Split #2
			$footer.= '<span class="hidden-phone disabled"> &#8212; </span><br class="visible-phone"/>';
		}
		
		// Cache
		$cache = NeonDataCache::get('mgfootver.ini', 'INI');
		if( $cache == null || $cache['version'] != NeonNfoVersions::getCurrent() )
		{
			$vdata = NeonNfoVersions::getData();
			$cache = array( 'version'=> $vdata->version, 'date'=> $vdata->date,	'time'=> $vdata->time, 'zone'=> $vdata->zone );
			NeonDataCache::set($cache, 'mgfootver.ini', 'INI');
		}
		
		// Render
		$footer.= '<a class="nowrap hasTooltip" title="'
					.JText::sprintf('COM_MINITHEATRECM_MESSAGE_VERSIONUPDATEDON', $cache['date'], $cache['time'], $cache['zone'])
					.'" href="'.JRoute::_('index.php?option=com_minitheatrecm&view=planner&tabview=changelogs').'">'
					.JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE').' '.$cache['version']
					.'</a></div>';
		
		// Return
		return $footer;
	}
	
	// Task buttons
	public static function renderTaskButtons( $state = 1, $i = 0, $prefix = '', $enabled = true, $publish_up, $publish_down )
	{
		$r = '<div class="btn-group">';
		
		// Auto-task State Button
		$r.= JHtml::_('jgrid.published', $state, $i, $prefix, $enabled, 'cb', $publish_up, $publish_down);
		
		// Custom Buttons (TODO)
		if( !in_array( $state, array( -2 )))
		{
			$r.= JHtml::_('jgrid.action', $i, 'archive', $prefix, 'JARCHIVE', 'JARCHIVE', '', true, 'small icon-archive');
		}
		if( !in_array( $state, array( 2 )))
		{
			$r.= JHtml::_('jgrid.action', $i, 'trash', $prefix, 'JTRASH', 'JTRASH', '', true, 'small icon-trash');
		}
		/*
		 * Custom button definition:
		 *
		 * public static function action($i, $task, $prefix = '', $text = '', $active_title = '', $inactive_title = '', $tip = false, $active_class = '',
			$inactive_class = '', $enabled = true, $translate = true, $checkbox = 'cb')
		 */
		
		// Finish
		$r.= '</div>';
		
		return $r;
	}
	
	// Filter-Ordering Parser
	public static function getOrdering( $fullorder, $defkey, $deftext, $columns )
	{
		$r = new stdClass();
		
		// Get Order-Index
		$n = 1;
		foreach($columns as $text=>$keystr)
		{
			$keys = explode(',', $keystr);
			foreach($keys as $key)
			{
				$key = trim($key);
				if( strpos( $fullorder, $key ) !== false )
				{
					$r->index	= $n;
					$r->order	= $key;
					$r->text	= $text;
					
					return $r;
				}
			}
			$n++;
		}
		
		// Default
		$r->index	= 0;
		$r->order	= $defkey;
		$r->text	= $deftext;
		
		return $r;
	}
	
	// Fields: Main
	public static function renderMain($text, $link = null, $tooltip = 'COM_MINITHEATRECM_DICTIONARY_EDIT')
	{
		if( $link!=null )
		{
			return '<a class="hasTooltip" href="'.$link.'" title="'.JText::_($tooltip).'">'.$text.'</a>';
		}
		else
		{
			return '<span class="hasTooltip" title="'.JText::_($tooltip).'">'.$text.'</span>';
		}
	}
	
	public static function renderAltNames($altnames)
	{
		if( empty( $altnames ))
		{
			return '';
		}
		else
		{
			return '<span class="icon-info-circle hasPopover disabled muted" title="'
					.JText::_('COM_MINITHEATRECM_DICTIONARY_ALTERNATIVENAMES')
					.'" data-placement="top" data-content="'
					.nl2br($altnames).'"> </span>';
		}
	}
	
	public static function renderAlias($text)
	{
		if( !empty( $text ))
		{
			return '<span class="small disabled muted hasTooltip" title="'
					.JText::_('COM_MINITHEATRECM_DICTIONARY_ALIAS').'">'
					.JText::_('COM_MINITHEATRECM_DICTIONARY_ALIAS')
					.': '.$text.'</span>';
		}
		return '';
	}
	
	// Fields: Common
	public static function renderAccessCell($text, $id, $linkable = false, $ordering = 0)
	{
		if($text === null)
		{
			$result = '<div><span class="hasTooltip muted disabled" title="'
					.JText::sprintf( ($id == 0 ? 'COM_MINITHEATRECM_MESSAGE_UNASSIGNED_ACCESS' : 'COM_MINITHEATRECM_MESSAGE_MISSING_ACCESS'), $id )
					.'">'.JText::_( $id == 0 ? 'COM_MINITHEATRECM_DICTIONARY_NONE' : 'COM_MINITHEATRECM_DICTIONARY_MISSING' ).'</span></div>';
		}
		elseif( $linkable )
		{
			$result = '<div><a class="hasTooltip small" title="'
					.JText::_('COM_MINITHEATRECM_TOOLTIP_EDIT_ACCESS')
					.'" href="index.php?option=com_users&task=group.edit&id='.$id
					.'">'.$text.'</a></div>';
		}
		else
		{
			$result = '<div><span class="hasTooltip small" title="'
					.JText::sprintf('COM_MINITHEATRECM_TOOLTIP_TEXT_ACCESS', $id)
					.'">'.$text.'</span></div>';
		}
		
		// Additional display on ordering by ID
		if( $ordering == 2 )
		{
			$result.= '<div><span class="hasTooltip muted disabled italic" title="'
						.JText::_('COM_MINITHEATRECM_TOOLTIP_ORDEREDBY_ACCESSID').'">'
						.JText::sprintf('COM_MINITHEATRECM_MESSAGE_IDSTRING', $id)
						.'</span></div>';
		}
		
		return $result;
	}
	
	public static function renderEditorCell($authid, $authuser, $authname,
											$editid, $edituser, $editname,
											$linkable, $ordering)
	{
		$result = '<div><div class="nowrap">';
		
		// Author Icon
		$result.= '<span style="vertical-align:middle;" class="icon-user hasTooltip'.($ordering==1? '' : ' disabled muted')
					.'"  title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_AUTHOR').'"> </span>';
				
		// Author
		if($authuser === null)
		{
			$result.= '<span class="small disabled muted hasTooltip" title="'
						.JText::sprintf( ($authid==0? 'COM_MINITHEATRECM_MESSAGE_UNASSIGNED_USER' : 'COM_MINITHEATRECM_MESSAGE_MISSING_USER'), $authid )
						.'">'.JText::_( $authid==0? 'COM_MINITHEATRECM_DICTIONARY_NONE' : 'COM_MINITHEATRECM_DICTIONARY_MISSING' ).'</span>';
		}
		elseif($linkable)
		{
			$result.= '<a class="small hasTooltip" title="'
						.JText::_('COM_MINITHEATRE_TOOLTIP_EDIT_AUTHOR')
						.'" href="'.JRoute::_('index.php?option=com_users&task=user.edit&id='.$authid)
						.'">'.self::_udn($authuser, $authname).'</a>';
		}
		else
		{
			$result.= '<span class="small hasTooltip" title="'
						.JText::sprintf('COM_MINITHEATRECM_TOOLTIP_TEXT_AUTHOR', $authid)
						.'">'.self::_udn($authuser, $authname).'</span>';
		}
		
		$result.= '</div><div class="nowrap">';
		
		// RecentEdit Icon
		$result.= '<span style="vertical-align:middle;" class="icon-bookmark hasTooltip'.($ordering==2? '' : ' disabled muted')
					.'"  title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_MOSTRECENTEDITOR').'"> </span>';
				
		// RecentEdit
		if($edituser === null)
		{
			$result.= '<span class="small disabled muted hasTooltip" title="'
						.JText::sprintf( ($editid==0? 'COM_MINITHEATRECM_MESSAGE_UNASSIGNED_USER' : 'COM_MINITHEATRECM_MESSAGE_MISSING_USER'), $editid )
						.'">'.JText::_( $editid==0? 'COM_MINITHEATRECM_DICTIONARY_NONE' : 'COM_MINITHEATRECM_DICTIONARY_MISSING' ).'</span>';
		}
		elseif($linkable)
		{
			$result.= '<a class="small hasTooltip" title="'
						.JText::_('COM_MINITHEATRE_TOOLTIP_EDIT_RECENTEDIT')
						.'" href="'.JRoute::_('index.php?option=com_users&task=user.edit&id='.$editid)
						.'">'.self::_udn($edituser, $editname).'</a>';
		}
		else
		{
			$result.= '<span class="small hasTooltip" title="'
						.JText::sprintf('COM_MINITHEATRE_TOOLTIP_TEXT_RECENTEDIT', $editid)
						.'">'.self::_udn($edituser, $editname).'</span>';
		}
		
		$result.= '</div></div>';
		
		return $result;
	}
	
	public static function renderTimestampCell($created = '', $modified = '', $ordering = 0)
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
	
	public static function renderStatsCell($hits = '', $votes = '', $ordering = 0)
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
	
	public static function renderStarRatingCell($value = 0, $twoline = false)
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
	
	// Fields: Connected
	public static function renderFranchiseCell($text, $id, $linkable = false, $ordering = 0)
	{
		/*
		 * If Text = Null, Franchise doesn't exist.
		 * Display muted 'None' if ID=0, else 'Missing/ID=x' if missing but ID!=0
		 * Ordering: 0-default, 1-Name, 2-ID
		 */
		if($text === null)
		{
			$result = '<div><span class="hasTooltip muted disabled" title="'
					.JText::sprintf( ($id == 0 ? 'COM_MINITHEATRECM_MESSAGE_UNASSIGNED_FRANCHISE' : 'COM_MINITHEATRECM_MESSAGE_MISSING_FRANCHISE'), $id )
					.'">'.JText::_( $id == 0 ? 'COM_MINITHEATRECM_DICTIONARY_NONE' : 'COM_MINITHEATRECM_DICTIONARY_MISSING' ).'</span></div>';
		}
		elseif( $linkable )
		{
			$result = '<div><a class="hasTooltip small" title="'
					.JText::_('COM_MINITHEATRECM_TOOLTIP_EDIT_FRANCHISE')
					.'" href="index.php?option=com_minitheatrecm&task=franchise.edit&id='.$id
					.'">'.$text.'</a></div>';
		}
		else
		{
			$result = '<div><span class="hasTooltip small" title="'
					.JText::sprintf('COM_MINITHEATRECM_TOOLTIP_TEXT_FRANCHISE', $id)
					.'">'.$text.'</span></div>';
		}
		
		// Additional display on ordering by ID
		if( $ordering == 2 )
		{
			$result.= '<div><span class="hasTooltip muted disabled italic" title="'
						.JText::_('COM_MINITHEATRECM_TOOLTIP_ORDEREDBY_FRANCHISEID').'">'
						.JText::sprintf('COM_MINITHEATRECM_MESSAGE_IDSTRING', $id)
						.'</span></div>';
		}
		
		return $result;
	}
	public static function renderCatalogueCell($text, $id, $linkable = false, $ordering = 0)
	{
		/*
		 * If Text = Null, Catalogue doesn't exist.
		 * Display muted 'None' if ID=0, else 'Missing/ID=x' if missing but ID!=0
		 * Ordering: 0-default, 1-Name, 2-ID
		 */
		if($text === null)
		{
			$result = '<div><span class="hasTooltip muted disabled" title="'
					.JText::sprintf( ($id == 0 ? 'COM_MINITHEATRECM_MESSAGE_UNASSIGNED_CATALOGUE' : 'COM_MINITHEATRECM_MESSAGE_MISSING_CATALOGUE'), $id )
					.'">'.JText::_( $id == 0 ? 'COM_MINITHEATRECM_DICTIONARY_NONE' : 'COM_MINITHEATRECM_DICTIONARY_MISSING' ).'</span></div>';
		}
		elseif( $linkable )
		{
			$result = '<div><a class="hasTooltip small" title="'
					.JText::_('COM_MINITHEATRECM_TOOLTIP_EDIT_CATALOGUE')
					.'" href="index.php?option=com_minitheatrecm&task=catalogue.edit&id='.$id
					.'">'.$text.'</a></div>';
		}
		else
		{
			$result = '<div><span class="hasTooltip small" title="'
					.JText::sprintf('COM_MINITHEATRECM_TOOLTIP_TEXT_CATALOGUE', $id)
					.'">'.$text.'</span></div>';
		}
		
		// Additional display on ordering by ID
		if( $ordering == 2 )
		{
			$result.= '<div><span class="hasTooltip muted disabled italic" title="'
						.JText::_('COM_MINITHEATRECM_TOOLTIP_ORDEREDBY_CATALOGUEID').'">'
						.JText::sprintf('COM_MINITHEATRECM_MESSAGE_IDSTRING', $id)
						.'</span></div>';
		}
		
		return $result;
	}
	public static function renderCTypeIcon($text, $color = '#888888', $id = 0, $linkable = false)
	{
		if($linkable)
		{
			return '<a class="hasTooltip" title="'.$text.'" href="'
					.JRoute::_('index.php?option=com_minitheatrecm&task=ctype.edit&id='.$id)
					.'"><span class="icon-circle" style="color:'.$color.';"> </span></a>';
		}
		else
		{
			return '<span class="hasTooltip icon-circle" style="color:'.$color.';" title="'.$text.'"> </span>';
		}
	}
	
	public static function renderGenreIcons($json, $linkable = false)
	{
		return $json;
	}
	
	// Internal functions
	private static function _udn($username, $name = '')
	{
		if($name != '')
		{
			return $name;
		}
		else
		{
			return $username;
		}
	}
}