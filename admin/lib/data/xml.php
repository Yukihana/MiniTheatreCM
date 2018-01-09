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

abstract class NeonDataXML
{
	// Scan every node in a file and index their keys
	public static function index($path, $nodetype, $nodekey)
	{
		$r = array();
		$x = new XMLReader;
		$x->open( $path );
		
		// Read to current depth
		while ($x->read() && $x->name !== $nodetype);
		
		// Index each entry
		while( $x->name == $nodetype )
		{
			$r[] = $x->getAttribute($nodekey);
			
			$x->next($nodetype);
		}
		
		// Finish and Return
		$x->close();
		return $r;
	}
	
	// Search for a node and return Exists/SimpleXMLElement object
	public static function search($path, $nodetype, $key, $value, $returnxml = false)
	{
		if( is_string( $value ))
		{
			return self::_searchsingle($path, $nodetype, $key, $value, $returnxml);
		}
		elseif( is_array( $value ))
		{
			return self::_searchmultiple($path, $nodetype, $key, $value, $returnxml);
		}
		return false;
	}
	
	protected static function _searchsingle($path, $nodetype, $key, $value, $returnxml = false)
	{
		$r = false;
		$x = new XMLReader;
		$x->open( $path );
		
		// Read to current depth
		while ($x->read() && $x->name !== $nodetype);
		
		// Process each
		while( $x->name == $nodetype )
		{
			if( $x->getAttribute($key) == $value )
			{
				// On success prepare result and break loop
				$r = ( $returnxml ) ? simplexml_load_string($x->readOuterXML()) : true;
				break;
			}
			$x->next($nodetype);
		}
		
		// Finish and Return
		$x->close();
		return $r;
	}
	
	protected static function _searchmultiple($path, $nodetype, $key, $values, $returnxml = false)
	{
		$a = array();
		$x = new XMLReader;
		$x->open( $path );
		
		// Read to current depth
		while ($x->read() && $x->name !== $nodetype);
		
		// Search and load
		while( $x->name == $nodetype )
		{
			if( in_array( $x->getAttribute($key), $values ))
			{
				// On success prepare result and break loop
				$a[$x->getAttribute($key)] = ( $returnxml ) ? simplexml_load_string($x->readOuterXML()) : true;
			}
			$x->next($nodetype);
		}
		
		// Arrange according to original array
		$r = array();
		foreach( $values as $value )
		{
			if( isset( $a[$value] ))
			{
				$r[] = $a[$value];
			}
		}
		
		// Finish and Return
		$x->close();
		return $r;
	}
}