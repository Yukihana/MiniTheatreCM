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
JLoader::Register('MiniTheatreCMCfgSettings', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/settings.php');
JLoader::Register('NeonNfoChangelog', JPATH_COMPONENT_ADMINISTRATOR . '/lib/nfo/changelog.php');
JLoader::Register('NeonDataXML', JPATH_COMPONENT_ADMINISTRATOR . '/lib/data/xml.php');

abstract class NeonNfoVersions
{
	// Configuration Constants
	const NODE_TYPE = 'update';
	const NODE_KEY = 'version';
	
	// Returns the location of the XML store
	public static function location()
	{
		return JPATH_COMPONENT_ADMINISTRATOR . '/data/nfo/versions.xml';
	}
	
	// Returns a list of versions
	public static function getList()
	{
		return array_unique( NeonDataXML::index( self::location(), self::NODE_TYPE, self::NODE_KEY ) );
	}
	
	// Alias/Proxy for Settings:IVersion
	public static function getCurrent()
	{
		return MiniTheatreCMCfgSettings::getIVersion();
	}
	
	// Full-sized source object (Deprecated)
	public static function getSource($path = null)
	{
		if( $path === null )
		{
			$path = self::location();
		}
		return simplexml_load_file( $path );
	}
	
	// Get Field-List data source
	public static function getOptions($list = null)
	{
		// Index data from the file
		if( $list === null )
		{
			$list = self::getList();
		}
		$r = array();
		
		// Load versions and generate list-data
		foreach( array_reverse($list) as $v )
		{
			$a			= new stdClass();
			$a->text	= JText::sprintf( (($v!=self::getCurrent())?'COM_MINITHEATRECM_SPRINTF_VERSIONTEXT':'COM_MINITHEATRECM_SPRINTF_VERSIONTEXT_CURRENT'), $v );
			$a->value	= $v;
			
			$r[]		= $a;
		}
		
		// Return the array
		return $r;
	}
	
	// Get stdClass object(s) for version data
	public static function getData($version = null, $changelog = null)
	{		
		// If default null, give it the current version string
		if( $version === null )
		{
			$version = self::getCurrent();
		}
		
		// If string, fetch xml object
		if( is_string( $version ))
		{
			return self::_singleData($version, $changelog);
		}
		
		// If array / multiple
		if( is_array( $version ))
		{
			return self::_multipleData($version, $changelog);
		}
		
		// If all else fails
		return null;
	}
	
	// Mimics: List Query WIP Finish Coding
	public static function getListQuery( $list = null, $limitstart = 0, $changelogs = null, $desc = true, $prefix = '', $limit = null )
	{
		// Index data from the file
		if( $list === null )
		{
			$list = self::getList();
		}
		
		// Order
		if($desc)
		{
			$list = array_reverse($list);
		}
		
		// Prepare
		if( $limit === null )
		{
			$limit		= JFactory::getApplication()->get('list_limit');
		}
		$w			= array();
		$total		= count($list);
		$limitend	= (int)$limitstart + (int)$limit;
		
		// Apply Limits
		if( $limitend < $total )
		{
			$w	= array_slice($list, $limitstart, $limit);
		}
		elseif( $limitstart >= $total)
		{
			$w = array();
		}
		else
		{
			$w = array_slice($list, $limitstart, ($total-$limitstart) );
		}
		
		// Fetch objects based on the name-list and return
		return self::getData( $w, $changelogs );
	}
	
	// Internal
	// Fetch a single version-data
	protected static function _singleData($version, $changelog = null)
	{
		// Load data from XML
		$x = NeonDataXML::search( self::location(), self::NODE_TYPE, self::NODE_KEY, $version, true );
		
		// Validate and convert to stdClass
		if( $x === false )
		{
			return null;
		}
		$r = self::_XmlToObj( $x );
		
		// Validate and attach changelog
		if( $changelog !== null && $r !== null )
		{
			$r->changelog = $changelog? NeonNfoChangelog::get($version) : NeonNfoChangelog::exists($version);
		}
		
		// Safe return
		return isset($r)? $r : null;
	}
	// Fetch a multiple version-data
	protected static function _multipleData($versions, $changelog = null)
	{
		// Load data from XML
		$a = NeonDataXML::search( self::location(), self::NODE_TYPE, self::NODE_KEY, $versions, true );
		
		// Convert to stdClass
		$r = array();
		foreach($a as $x)
		{
			$r[] = self::_XmlToObj( $x );
		}
		
		// Validate
		if( count($r) == 0 || $changelog === null )
		{
			return $r;
		}
		
		// Attach changelog
		$v = self::NODE_KEY;
		$c = ($changelog)? NeonNfoChangelog::get($versions) : NeonNfoChangelog::index();
		for($i=0;$i<count($r);$i++)
		{
			if( $changelog )
			{
				foreach($c as $h)
				{
					if( $r[$i]->$v == $h[$v] )
					{
						$r[$i]->changelog = $h;
						break;
					}
				}
			}
			else
			{
				$r[$i]->changelog = in_array( $r[$i]->$v, $c );
			}
		}
	
		// Safe return
		return $r;
	}
	// Convert XML object to stdClass
	protected static function _XmlToObj($xml, $moreparams = array())
	{
		$r = new stdClass();
				
		// Add standard content with default values
		$r->version	= isset($xml['version'])?	strval($xml['version'])	: '0.0.0.0';
		$r->date	= isset($xml['date'])?		strval($xml['date'])	: '00-00-0000';
		$r->time	= isset($xml['time'])?		strval($xml['time'])	: '00:00';
		$r->zone	= isset($xml['zone'])?		strval($xml['zone'])	: 'UTC';
		
		// Add bonus parameters
		foreach($moreparams as $param => $value)
		{
			$r->$param = $value;
		}
		
		// Return the data
		return $r;
	}
}