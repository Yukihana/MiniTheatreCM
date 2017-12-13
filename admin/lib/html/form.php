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

abstract class NeonHtmlForm
{
	public static function renderStatsDisplay( $hits = null, $ratings = null, $recommend = null, $votes = null )
	{
		/*
		$result = '';
		if($hits != null)
		{
			$result.= '<div class="col3"></div>
		}
		*/
		
		
		return '<div class="controls-group"><span class="btn-inverse">PlaceHolder-StatsDisplay</span></div>';
	}
}