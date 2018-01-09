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

abstract class MiniTheatreCMCfgSettings
{
	// Read the data from the INI file
	protected static function _data()
	{
		try{ return parse_ini_file( JPATH_COMPONENT_ADMINISTRATOR . '/cfg/settings.ini' ); }
		catch( Exception $e ){ return null; }
	}
	protected static function _single( $param )
	{
		$d = self::_data();
		return ( isset( $d[$param] )? $d[$param] : null );
	}
	protected static function _multiple( $params )
	{
		$d = self::_data();
		$r = array();
		foreach( $params as $param )
		{
			$r[$param] = isset( $d[$param] )? $d[$param] : null;
		}
		return $r;
	}
	
	// Fetcher (String for single, Array for multiple)
	public static function getConfig($param)
	{
		if( is_string( $param ))
		{
			return self::_single( $param );
		}
		elseif( is_array( $param ))
		{
			return self::_multiple( $param );
		}
		return null;
	}
	
	// Pre-configured
	public static function getIVersion()
	{
		return strval(self::_single('iversion'));
	}
}