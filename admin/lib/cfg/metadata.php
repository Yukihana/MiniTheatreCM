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

abstract class MiniTheatreCMCfgMetadata
{
	public static function getVersionData()
	{
		$path	= JPATH_COMPONENT_ADMINISTRATOR . '/cfg/version.ini';
		
		try{ $params = parse_ini_file($path); }
		catch(Exception $e){ return null; }
		
		/*
		 * Defaults
		 * PHP < 7 Short-hand: $bar = @$bar ?: 'default_val';
		 * PHP = 7 Short-hand: $bar = $bar ?? 'default_val';
		 */
		if( !isset( $params['version'] ))	{	$params['version']	= '0.0.0.0';	}
		if( !isset( $params['date'] ))		{	$params['date']		= '00-00-0000';	}
		if( !isset( $params['time'] ))		{	$params['time']		= '00:00';		}
		if( !isset( $params['zone'] ))		{	$params['zone']		= 'UTC';		}
		
		// On success
		return $params;
	}
}