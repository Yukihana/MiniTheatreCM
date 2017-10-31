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

abstract class MiniTheatreCMHelperConfig
{
	public static function getDefaultView()
	{
		$views = array('overview','listings','reviews','items','franchises','genres','contenttypes');
		return $views[JComponentHelper::getParams('com_minitheatrecm')->get('default_view')];
	}
	
	public static function getOverviewType()
	{
		return JComponentHelper::getParams('com_minitheatrecm')->get('overview_type');
	}
}