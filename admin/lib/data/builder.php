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

abstract class NeonDataBuilder
{	
	public static function INI( $data )
	{
		$r = array();
		foreach( $data as $section => $content )
		{
			if( is_array( $content ))
			{
				$r[] = '['.$section.']';
				foreach( $content as $key => $value )
				{
					$r[] = $key.'='.$value;
				}
			}
			else
			{
				$r[] = $section.'='.$content;
			}
		}
		return implode( PHP_EOL, $r );
	}
}

