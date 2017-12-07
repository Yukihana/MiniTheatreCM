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
	
	public static function getDirectoryCfg($typestr)
	{
		$xml = simplexml_load_file(JPATH_COMPONENT_ADMINISTRATOR .'/cfg/directories.xml');
		
		foreach($xml->files as $files)
		{
			if( $files['typename'] == $typestr )
			{
				$result = new stdClass();
				$result->typestr = $files['typename'];
				if( !isset( $files['address'] ))
				{
					error_log('MTCM/DatabaseDriver/GetDirectory couldn\'t find an address field on the typestr: '.$typestr);
					return null;
				}
				$result->address	= JPATH_COMPONENT_ADMINISTRATOR.(string)$files['address'];
				$result->prefix		= isset($files['prefix'])? $files['prefix']:'';
				$result->suffix		= isset($files['suffix'])? $files['suffix']:'';
				
				return $result;
			}
		}
		error_log('MTCM/DatabaseDriver/GetDirectory couldn\'t find an index with the typestr: '.$typestr);
		return null;
	}
}