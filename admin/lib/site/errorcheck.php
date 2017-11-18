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
JLoader::Register('NeonLibHtmlMessages', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/messages.php');

abstract class NeonLibSiteErrorCheck
{
	public static function primaryError($errorcode = 0)
	{
		switch($errorcode)
		{
			case 1:
				// Not Logged In
				NeonLibHtmlMessages::showMessage('JGLOBAL_YOU_MUST_LOGIN_FIRST', false);
				return;
			case 2:
				NeonLibHtmlMessages::showParsedMessage( 'COM_MINITHEATRECM_MESSAGEDATA_INVALIDPAGE', true, true, false, 'warning', 'COM_MINITHEATRECM_MESSAGE_NOTHINGTOSHOW');
				return;
			default:
				return;
		}
	}
}