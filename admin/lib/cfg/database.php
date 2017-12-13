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

abstract class NeonCfgDatabase
{
	// Component Database-Table names
	public static function getTableName($typestr)
	{
		$xml = simplexml_load_file(JPATH_COMPONENT_ADMINISTRATOR .'/cfg/tables.xml');
		
		foreach($xml->table as $table)
		{
			if( $table['typename'] == $typestr )
			{
				return (string)$table['address'];
			}
		}
		return null;
	}
	
	// Joomla Database-Table names
	public static function getJoomlaDB($typestr)
	{
		$xml = simplexml_load_file(JPATH_COMPONENT_ADMINISTRATOR .'/cfg/joomdb.xml');
		
		foreach($xml->table as $table)
		{
			if( $table['typename'] == $typestr )
			{
				return (string)$table['address'];
			}
		}
		return null;
	}
	
	// Component XML-Field File Location
	public static function getXmlFieldPath($typestr)
	{
		$xml = simplexml_load_file(JPATH_COMPONENT_ADMINISTRATOR .'/cfg/xmlfields.xml');
		
		foreach($xml->field as $field)
		{
			if( $field['typename'] == $typestr )
			{
				return JPATH_COMPONENT_ADMINISTRATOR . $field['address'];
			}
		}
		return null;
	}
	
	// Component Fileset Configuration
	public static function getDirectoryCfg($typestr)
	{
		$xml = simplexml_load_file(JPATH_COMPONENT_ADMINISTRATOR .'/cfg/directories.xml');
		
		foreach($xml->filebase as $filebase)
		{
			if( $filebase['typename'] == $typestr )
			{
				$result = new stdClass();
				$result->typestr = $filebase['typename'];
				if( !isset( $filebase['address'] ))
				{
					error_log('MTCM/DatabaseDriver/GetDirectory couldn\'t find an address field on the typestr: '.$typestr);
					return null;
				}
				$result->address	= JPATH_COMPONENT_ADMINISTRATOR.(string)$filebase['address'];
				$result->prefix		= isset($filebase['prefix'])? $filebase['prefix']:'';
				$result->suffix		= isset($filebase['suffix'])? $filebase['suffix']:'';
				
				return $result;
			}
		}
		error_log('MTCM/DatabaseDriver/GetDirectory couldn\'t find an index with the typestr: '.$typestr);
		return null;
	}
}