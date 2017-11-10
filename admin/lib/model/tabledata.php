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

abstract class MiniTheatreCMLibModelTableData
{
	public static getFieldDataArray($records, $fields, $unique = true)
	{
		// Force uniformity on the request
		if(!is_array($records))
		{
			$records = array($records);
		}
		if(!is_array($fields))
		{
			$fields = array($fields);
		}
		
		// Scan for and add data to a result array
		$data = array();
		foreach( $records as $record )
		{
			foreach( $fields as $field )
			{
				if( isset( $record->$field ))
				{
					array_push( $data, $record->$field );
				}
			}
		}
		
		// Return/unique based on request
		return $unique? array_unique( $data ) : $data;
	}
	
	
}