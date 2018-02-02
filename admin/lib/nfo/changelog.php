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
JLoader::Register('NeonCfgFilebase', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/filebase.php');
JLoader::Register('NeonDataXML', JPATH_COMPONENT_ADMINISTRATOR . '/lib/data/xml.php');

abstract class NeonNfoChangelog
{
	// Configuration Constants
	const NODE_TYPE = 'update';
	const NODE_KEY = 'version';
	
	// Get a list of available changelogs
	public static function index()
	{
		// Load File List
		$d = self::files();
		$r = array();
		
		// Scan all files for available changelog versions
		foreach($d as $f)
		{
			$r = array_merge( $r, NeonDataXML::index($f, self::NODE_TYPE, self::NODE_KEY) );
		}
		
		// Make Unique, Order Ascending and Return
		$r = array_unique($r);
		sort($r);
		return $r;
	}
	
	// Check whether a changelog for the provided/latest version exists or not
	public static function exists($version = null)
	{
		// Apply latest version
		if( $version === null )
		{
			$version = MiniTheatreCMCfgSettings::getIVersion();
		}
		
		// Load File List
		$d = self::files();
		foreach($d as $f)
		{
			// Check if changelog version exists
			$r = NeonDataXML::search($path, $version);
			if( $r !== false )
			{
				return $r;
			}
		}
		
		// If not found
		return false;
	}
	
	// Fetch changelog data for the provided/latest version
	public static function get($version = null)
	{
		// Apply latest version
		if( $version === null )
		{
			$version = MiniTheatreCMCfgSettings::getIVersion();
		}
		
		// Process using internal methods
		if( is_string( $version ))
		{
			return self::_singleget($version);
		}
		elseif( is_array( $version ))
		{
			return self::_multiget($version);
		}

		// If all else fails
		return null;
	}
	// Render changelog icon
	public static function icon($state, $icon)
	{
		$i = ($state === false || $state === null);
		$d = $i? ' disabled muted' : '';
		$t = JText::_( $i? 'COM_MINITHEATRECM_MESSAGE_CLOGMISSING' : 'COM_MINITHEATRECM_MESSAGE_CLOGAVAILABLE' );
		return '<span class="hasTooltip icon-'.$icon.$d.'" title="'.$t.'"> </span>';
	}
	
	// Render changelog data (XML/Version)
	public static function render($changelog)
	{
		// Begin + Header
		$r = '<div class="well well-small" style="border: 1pt solid #dedede; background: linear-gradient(rgba(0,0,0,0.03), rgba(0,0,0,0.07)); padding-left:0px; padding-right:0px;">'
			.'<h2 class="module-title nav-header" style="padding-left:6pt; padding-right:6pt;">'.JText::sprintf('COM_MINITHEATRECM_SPRINTF_VERSIONTEXT', $changelog->meta->version).'</h2>';
		
		// Body
		$r.= '<table class="table table-striped table-hover" style="margin-bottom:0px;border-bottom-width:1px;">'
			.'<thead style="font-size:0;display:none;"><tr><th width="1%"> </th><th width="99%"> </th></tr></thead><tbody>';
		foreach($changelog->tasks->task as $task)
		{
			$r.= '<tr><td class="center">'.self::renderTaskBadge($task['type']).'</td>'
				.'<td>'.strval($task).'</td></tr>';
		}
		
		// Footer
		$r.= '</tbody><tfoot><tr><td colspan="2" style="text-align:right; font-style:italics;" class="small disabled">';
		
		if($changelog->meta !== null)
		{
			$vdate = isset( $changelog->meta->date )? $changelog->meta->date : '0000-00-00';
			$vtime = isset( $changelog->meta->time )? $changelog->meta->time : '00:00';
			$vzone = isset( $changelog->meta->zone )? $changelog->meta->zone : 'UTC';
			$r.= JText::sprintf('COM_MINITHEATRECM_SPRINTF_CHANGELOGADDEDON', $vdate, $vtime, $vzone);
		}
		
		// Finish
		$r.= '</td></tr></tfoot></table></div>';
		
		return $r;
	}
	
	public static function renderTaskBadge($type)
	{
		$colors = array( 'manager'=>'389', 'database'=>'383', 'forms'=>'f91');
		$type = strtolower( $type );
		$color = isset( $colors[$type] )? $colors[$type] : '999';
		
		return '<span class="small badge" style="text-transform:uppercase; font-weight:bold; background-color:#'.$color.';">'.$type.'</span>';
	}
	
	// Internal ---
	// Get file-list
	protected static function files()
	{
		return NeonCfgFilebase::getList('changelogs');
	}
	protected static function _singleget($version)
	{		
		// Load File List
		$d = self::files();
		foreach($d as $f)
		{
			// Return changelog if it exists
			$r = NeonDataXML::search($f, self::NODE_TYPE, self::NODE_KEY, $version, true);
			if( $r !== false )
			{
				return $r;
			}
		}
		// Fallback
		return null;
	}
	protected static function _multiget($versions)
	{	
		// Load File List
		$d = self::files();
		
		// Cache data from the files
		$w = array();
		foreach($d as $f)
		{
			array_merge( $w, NeonDataXML::search($f, self::NODE_TYPE, self::NODE_KEY, $versions, true) );
		}
		
		// Re-arrange
		$v = self::NODE_KEY;
		$r = array();
		foreach($versions as $version)
		{
			foreach($w as $c)
			{
				if($c[$v] == $version)
				{
					$r[] = $c;
					break;
				}
			}
		}
		
		// Return result
		return $r;
	}
}