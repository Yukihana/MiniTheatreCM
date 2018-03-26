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
JLoader::Register('NeonHtmlMessages', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/messages.php');

abstract class NeonHtmlAjax
{
	public static function renderBasic()
	{
		$loader = '<svg height="48pt" width="48pt" viewBox="0 0 48 48">'
				.'<circle cx="24" cy="24" fill="none" stroke="#3071A9" stroke-width="4" r="20" transform="rotate(29.9993 24 24)" stroke-dasharray="96" stroke-linecap="round">'
				.'<animateTransform attributeName="transform" type="rotate" calcMode="linear" values="0 24 24;360 24 24" keyTimes="0;1" dur="2s" begin="0s" repeatCount="indefinite">'
				.'</animateTransform></circle>'
				.'<circle cx="24" cy="24" fill="none" stroke="#3071A9" stroke-width="3" r="14" transform="rotate(330.001 24 24)" stroke-dasharray="64" stroke-linecap="round" opacity="0.5">'
				.'<animateTransform attributeName="transform" type="rotate" calcMode="linear" values="360 24 24;0 24 24" keyTimes="0;1" dur="2s" begin="0s" repeatCount="indefinite">'
				.'</animateTransform></circle></svg>';
	
		$r = '{ error: "'.str_replace('"', '\\"', NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_ERRORUNABLETOPROCEED', 'COM_MINITHEATRECM_DICTIONARY_ERROR', false, 'warning')).'",
		error403: "'.str_replace('"', '\\"', NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_NOACCESS', 'COM_MINITHEATRECM_DICTIONARY_ACCESSDENIED', false, 'warning')).'",
		error404: "'.str_replace('"', '\\"', NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_PROVIDEVALIDID', 'COM_MINITHEATRECM_MESSAGE_404', false, 'warning')).'",
		timeout:  "'.str_replace('"', '\\"', NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_TIMEDOUT', 'COM_MINITHEATRECM_DICTIONARY_TIMEOUT', false, 'error')).'",
		loader: "'.str_replace('"', '\\"', $loader).'" }';
		
		return $r;
	}
}