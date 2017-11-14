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

// Include the Lib/ModelHelper Static Class
JLoader::Register('MiniTheatreCMMetaNfo', JPATH_COMPONENT_ADMINISTRATOR . '/meta/nfo.php');

/**
 * Planner Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelPlanner extends JModelList
{
	// Helper Methods
	public function getChangelogs()
	{
		return MiniTheatreCMMetaNfo::getChangelogs();
	}
	public function getTasks()
	{
		return MiniTheatreCMMetaNfo::getTasks();
	}
}