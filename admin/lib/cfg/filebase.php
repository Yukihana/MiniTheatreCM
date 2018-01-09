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
JLoader::Register('NeonCfgDatabase', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/database.php');

/**
 * Just Making Minor Modification to this file before closing it for future needs.
 * Note that this code hasn't been tested since the code was upgraded.
 * Upgrade took place after Changelogs code was moved to their own class.
 */
abstract class NeonCfgFilebase
{
	// Returns the directory-address of a filebase
	public static function getLocation($typestr)
	{
		$o = NeonCfgDatabase::getDirectoryCfg($typestr);
		return $o->address;
	}
	// Returns an array of all files with their paths
	public static function getList($typestr, $filter = 'is_file')
	{
		// Load configuration
		$cfg	= NeonCfgDatabase::getDirectoryCfg($typestr);
		if($cfg === null)
		{
			return array();
		}
		if( !isset( $cfg->prefix )) { $cfg->prefix = ''; }
		if( !isset( $cfg->suffix )) { $cfg->suffix = ''; }
		
		// Return the path of all files matching the configuration
		return array_filter( glob( $cfg->address.'/'.$cfg->prefix.'*'.$cfg->suffix ), $filter );
	}
	
	// Mimics List-Field Source Data Type
	public static function getOptions($typestr)
	{
		$result = array();
		
		foreach( array_reverse(	$this->getList($typestr) ) as $i=>$file )
		{
			// Split Name to get FileName ONLY
			$a			= explode('/', $file);
			
			// Init and write to stdClass object
			$b			= new stdClass();
			$b->text	= $a[count($a)-1];
			$b->path	= $file;
			$b->value	= $i;
			
			// Add to result
			$result[]	= $b;
		}
		return $result;
	}
	
	// Mimics SQL Query Data
	public static function getListQuery($src, $limitstart = 0, $prefix = '', $descending = false, $hasraw = true)
	{
		if( is_string( $src ))
		{
			$src = self::getOptions($src);
		}
		elseif( !is_array( $src ))
		{
			$src = array();
		}
		
		// Init some Vars
		$result			= new stdClass();
		$total			= count($src);
		$limit			= JFactory::getApplication()->get('list_limit');
		$limitend		= (int)$limitstart + (int)$limit;
		
		// Add Raw
		if($hasraw)
		{
			$result->raw	= $src;
		}
		
		// Apply Order
		if(!$descending)
		{
			$src	= array_reverse( $src );
		}
		
		// Apply Limits
		if( $limitend < $total )
		{
			$result->data = array_slice($src, $limitstart, $limit);
		}
		elseif( $limitstart >= $total)
		{
			$result->data = array();
		}
		else
		{
			$result->data = array_slice( $src, $limitstart, ($total-$limitstart) );
		}
		
		// Pagination & rawdata
		JLoader::import('joomla.html.pagination');
		$result->pagination	= new JPagination( $total, $limitstart, $limit, $prefix );
		
		return $result;
	}
	// WIP split ListQuery and Pagination into two separate functions. Get procedure from Versions/Changelogs source class.
	
	// Get the path of an indexed file
	public static function getFilePath($src, $id = 0)
	{
		// Fill Default
		if( is_string( $src ))
		{
			$src	= self::getOptions($src);
		}
		elseif( !is_array( $src ))
		{
			$src = array();
		}
		
		// Zero-size Validation
		if( count($src) == 0 )
		{
			error_log('No file exists for the typestr');
			return null;
		}
		
		// Seek for object
		foreach($src as $file)
		{
			if( $file->value == $id )
			{
				return $file->path;
			}
		}
		
		// Couldnt be found
		error_log('File with that index doesnt exist');
		return null;
	}
}