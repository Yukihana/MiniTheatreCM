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

abstract class MiniTheatreCMCfgGlobal
{
	// Admin->Default View
	public static function getDefaultView($default = 'dashboard')
	{
		$res = JComponentHelper::getParams('com_minitheatrecm')->get('default_view');
		return (empty($res)? $default : $res);
	}

	// Manager Cell Links
	public static function getManagerLinkable($id, $default = false)
	{
		$res = JComponentHelper::getParams('com_minitheatrecm')->get('links_'.$id);
		return ( empty($res)? $default : ($res=='link') );
	}
}