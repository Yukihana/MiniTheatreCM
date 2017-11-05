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

abstract class MiniTheatreCMMetaGlobal
{
	// Admin->Default View
	public static function getDefaultView()
	{
		$id = JComponentHelper::getParams('com_minitheatrecm')->get('default_view');
		$views = array('overview','listings','reviews','items','franchises','genres','contenttypes');
		return $views[empty($id)? 0:$id];
	}
	
	// Admin->Overview Type
	public static function getOverviewType()
	{
		return JComponentHelper::getParams('com_minitheatrecm')->get('overview_type');
	}
}