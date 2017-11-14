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

abstract class MiniTheatreCMLibIncludeStyles
{
	public static function load( $styleset = 'default' )
	{
		call_user_func( array( static::class, 'load'.ucfirst($styleset) ));
	}
	
	private static function loadDefault()
	{
		$doc = JFactory::getDocument();
		$doc->addStyleSheet( JUri::root().'media/com_minitheatrecm/css/layout.css' );
		$doc->addStyleSheet( JUri::root().'media/com_minitheatrecm/css/metrics.css' );
		$doc->addStyleSheet( JUri::root().'media/com_minitheatrecm/css/mod.css' );
	}
}