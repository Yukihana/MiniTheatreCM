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
 * Static Helper class for Models
 *
 * Since 0.0.12
 */
 
abstract class MiniTheatreCMSiteHelperModel
{
	public static function getUserdata( $fields = array(), $smartname = false, $userid = 0 )
	{
		// Load specified or current user
		$user = ( $userid != 0 ) ? JFactory::getUser($userid) : JFactory::getUser();
		
		// check for user id 0
		if( $user->get('id') == 0 )
		{
			return null;
		}
		
		// Else
		$result = new stdClass();
		foreach( $fields as $field )
		{
			$result->$field = $user->get($field);
		}
		
		// Return
		return $result;
	}
}