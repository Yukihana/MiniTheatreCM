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
	/*
	 * Method to update State parameters
	 *
	 * @adstr		State-parameter address as string
	 * @default		The default value to be used
	 * @filter		The formatting filter to be used when retrieving get/post data
	 * @param		(Optional) Specify Get/Post parameter string separately
	 * @options		wd: Write default if state doesn't exist & get/post wasn't provided
	 *				od: Overwrite with default if get/post wasn't provided
	 */
	protected function updateState($stateaddress, $default, $filter, $param = null, $options = '')
	{
		// Validate and Prepare
		if( !is_string($stateaddress) || $stateaddress == '' )
		{
			return null;
		}
		if( !is_string($param) || $param == '' )
		{
			$address = explode('.', $stateaddress);
			$param = $address[ (count($address)-1) ];
		}
		
		// Retrieve and Compare
		$app = JFactory::getApplication();
		$s = $app->getUserState($stateaddress, $default);
		
		if( strpos( $options, 'wd' ) && $s == $default )
		{
			$r = $default;
		}
		if( $app->input->exists($param) )
		{
			$r = $app->input->get( $param, $default, $filter );
		}
		elseif( strpos( $options, 'od' ))
		{
			$r = $default;
		}
		
		// Update and Return
		if( isset( $r ))
		{
			$app->setUserState($stateaddress, $r);
			return $r;
		}
		return $s;
	}
}