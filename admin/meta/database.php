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

abstract class MiniTheatreCMMetaDatabase
{
	// Database-Table names
	public static function getTableName($id)
	{
		$xml = simplexml_load_file(JPATH_COMPONENT_ADMINISTRATOR .'/meta/tables.xml');
		
		foreach($xml->table as $table)
		{
			if( $table['id'] == $id )
			{
				return (string)$table['address'];
			}
		}
		return null;
	}
}