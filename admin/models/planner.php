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

/**
 * Planner Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelPlanner extends JModelList
{
	public function getChangelogs()
	{
		return MiniTheatreCMHelperNfo::getChangelogs();
	}
	
	public function getTasks()
	{
		return MiniTheatreCMHelperNfo::getTasks();
	}
}