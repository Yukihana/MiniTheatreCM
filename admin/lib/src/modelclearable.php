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
JLoader::Register('NeonModelList', JPATH_COMPONENT_ADMINISTRATOR . '/lib/src/modellist.php');

/**
 * Neons Model-List source with clearable task.
 * Separated from base class to avoid accidental/security risks.
 * To be used only for non-critical data.
 *
 * @since  0.0.1
 */
class NeonModelClearable extends NeonModelList
{
	public function clearAll()
	{
	}
}