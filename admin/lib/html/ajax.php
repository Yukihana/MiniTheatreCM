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

abstract class NeonHtmlAjax
{
	public static function renderLoader()
	{
		return '- Loading -';
	}
	public static function renderError()
	{
		return '- Error: Couldn\'t load -';
	}
	public static function renderTimeout()
	{
		return '- Timeout: Couldn\'t load -';
	}
}