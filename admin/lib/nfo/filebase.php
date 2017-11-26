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

abstract class NeonNfoFilebase
{
	/*
	 * This method nearly imitates a SQL query
	 * Compound return structure:
	 * obj->array: current data array (part array, pagination limits applied)
	 * obj->pagination: pagination object for limit details
	 */
	public static function getListQuery($src, $limitstart = 0, $prefix = '', $descending = true, $hasraw = true)
	{
		if( is_string( $src ))
		{
			$src = self::getList($src);
		}
		else if( !is_array( $src ))
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
	
	// Fallback, Not Paginated, TODO: compound config data, add extension and prefix filter
	public static function getList($typestr)
	{
		$result = array();
		$cfg	= NeonCfgDatabase::getDirectoryCfg($typestr);
		
		if($cfg == null)
		{
			return array();
		}

		foreach( array_reverse(	array_filter( glob( $cfg->address.'/'.$cfg->prefix.'*'.$cfg->suffix ), 'is_file' )) as $i=>$file )
		{
			// Split Name to get FileName ONLY
			$a			= explode('/', $file);
			
			// Init and write to stdClass object
			$b			= new stdClass();
			$b->text	= $a[count($a)-1];
			$b->path	= $file;
			$b->value	= $i;
			
			// Add to result
			array_push($result, $b);
		}
		return $result;
	}
	
	// Get an indexed file as XML
	public static function getFilePath($src, $id = 0)
	{
		// Fill Default
		if( is_string( $src ))
		{
			$src	= self::getList($src);
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