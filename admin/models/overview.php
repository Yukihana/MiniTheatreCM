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

// Include Static Helper Classes
JLoader::Register('NeonModelLegacy', JPATH_COMPONENT_ADMINISTRATOR . '/lib/src/modellegacy.php');
JLoader::Register('MiniTheatreCMCfgGlobal', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/global.php');

/**
 * Overview Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelOverview extends NeonModelLegacy
{
	// Method to get the Overview Type
	public function getLayoutMode()
	{
		if( !isset( $this->layoutmode ))
		{
			$this->layoutmode = MiniTheatreCMCfgGlobal::getOverviewType();
		}
		$layouts = array('basic','detailed');
		return $layouts[$this->layoutmode];
	}
}