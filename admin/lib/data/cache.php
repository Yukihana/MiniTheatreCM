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
JLoader::Register('NeonDataBuilder', JPATH_COMPONENT_ADMINISTRATOR . '/lib/data/builder.php');

abstract class NeonDataCache
{
	public static function location()
	{
		return NeonCfgFilebase::getLocation('cache');
	}
	
	public static function get($filename, $type = 'RAW')
	{
		$path = self::location() . '/' . $filename;
		$type = strtoupper( $type );
		if( !file_exists( $path ))
		{
			return null;
		}
		switch( $type )
		{
			case 'RAW':
				return file_get_contents( $path );
			case 'INI':
				return parse_ini_file( $path );
			case 'XML':
				return simplexml_load_file( $path );
			case 'JSON':
				return json_decode( file_get_contents( $path ));
			case 'SER':
				return base64_decode( file_get_contents( $path ));
		}
		return file_get_contents( $path );
	}
	
	public static function set($data, $filename, $type = 'RAW')
	{
		$path = self::location() . '/' . $filename;
		$type = strtoupper( $type );
		if( file_exists( $path ))
		{
			unlink( $path );
		}
		switch( $type )
		{
			case 'RAW':
				return file_put_contents( $path, $data );
			case 'INI':
				return file_put_contents( $path, NeonDataBuilder::INI( $data ) );
			case 'XML':
				return $data->asXML($path);
		}
		return false;
	}
}