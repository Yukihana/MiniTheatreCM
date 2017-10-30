<?php
/**
 * @package     MiniTheatre.Administrator
 * @subpackage  com_minitheatrecm
 *
 * @copyright   CherrySoft-X 2017, MiniTheatre 2017
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link        http://fb.me/LilyflowerAngel
 */
  
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Static Helper class for Models
 *
 * Since 0.0.12
 */
 
abstract class MiniTheatreCMHelperNfo
{
	public static function getVersion()
	{
		$path	= JPATH_COMPONENT_ADMINISTRATOR . '/nfo/version.x';
		$result = new stdClass();
		
		try
		{
			// Get file contents
			$lines	= file($path);
			
			// Attempt loading line by line
			$result->version = $lines[0];
			$result->updated = $lines[1];
		}
		catch(Exception $e)
		{}
		return $result;
	}
	
	public static function getChangelogs()
	{
		// Get file contents
		try
		{
			$lines = file( JPATH_COMPONENT_ADMINISTRATOR . '/nfo/changelog.x' );
		}
		catch(Exception $e)
		{
			return array();
		}
		
		$index = 0;
		$result = array();
		$temp = new stdClass();
		
		// Parse into an array of stdClass types. One stdClass represent a changelog entry each.
		foreach($lines as $line)
		{
			//Ignore empty lines
			if( strlen(trim($line)) == 0 )
			{
				continue;
			}
			
			// # denotes start of an entry
			if( $line[0] == '#' )
			{
				// Register previous entry if exists
				if( isset( $temp->version ))
				{
					array_push( $result, $temp );
				}
				
				// Init new entry
				$temp = new stdClass();
				$temp->id = $index++;
				$temp->data = array();
				
				// Parse the line
				$meta = explode( '~', $line );
				$temp->version = str_replace( '#', '', $meta[0] );
				$temp->updated = isset( $meta[1] ) ? $meta[1] : JText::_('COM_MINITHEATRECM_DICTIONARY_ACTIVE');
				if( isset( $meta[2] ))
				{
					$temp->tag = meta[2];
				}
			}
			elseif( isset( $temp->version ))
			{
				array_push( $temp->data, $line );
			}
		}
		
		//Finish the job
		if( isset( $temp->version ))
		{
			array_push( $result, $temp );
		}
		
		return $result;
	}
	
	public static function getUpcoming()
	{
		
	}
}