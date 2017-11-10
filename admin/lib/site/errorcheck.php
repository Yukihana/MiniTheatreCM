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

// Include Dependencies
JLoader::Register('MiniTheatreCMLibHtmlMessages', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/messages.php');

abstract class MiniTheatreCMLibSiteErrorCheck
{
	public static function primaryError($errorcode = 0)
	{
		switch($errorcode)
		{
			case 1:
				// Not Logged In
				MiniTheatreCMLibHtmlMessages::showMessage('JGLOBAL_YOU_MUST_LOGIN_FIRST', false);
				return;
			case 2:
				MiniTheatreCMLibHtmlMessages::showParsedMessage( 'COM_MINITHEATRECM_MESSAGEDATA_INVALIDPAGE', true, true, false, 'warning', 'COM_MINITHEATRECM_MESSAGE_NOTHINGTOSHOW');
				return;
			default:
				return;
		}
	}
}