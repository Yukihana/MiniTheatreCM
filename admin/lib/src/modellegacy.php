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
JLoader::Register('NeonCfgFilebase', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/filebase.php');
JLoader::Register('NeonNfoLegacy', JPATH_COMPONENT_ADMINISTRATOR . '/lib/nfo/legacy.php');

/**
 * Neons Model-List source for file-system based database
 *
 * @since  0.0.1
 */
class NeonModelLegacy extends JModelLegacy
{
	// Insecure forwarder: Not to be used for sensitive data
	protected function forwardState($context, $sourcestate, $type, $default, $postname = null, $targetstate = null, $getname = null)
	{
		$app = JFactory::getApplication();

		// Defaults
		if( $targetstate == null )
		{
			$targetstate = $sourcestate;
		}
		if( $postname == null )
		{
			$postname = $sourcestate;
		}
		if( $getname == null )
		{
			$getname = $postname;
		}
		
		// Poll data
		$state		= $app->getUserState($context.$sourcestate, (int)$default);
		$post		= $app->input->post->get($postname, -1, $type);
		$get		= $app->input->get->get($getname, -1, $type);
		
		// Analyse
		$result = ($post != -1)? $post : $state;
		$result = ($get != -1)? $get : $result;
		
		// Set the data
		$app->setUserState($context.$targetstate, $result);
	}
}