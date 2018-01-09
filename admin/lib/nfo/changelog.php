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
	public static function render($xml)
	{
		$result = '<h4>'.$xml['version'].'</h4>';
		foreach($xml->task as $task)
		{
			$result.= '<div>'.$task.'</div>';
		}
		return $result;
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