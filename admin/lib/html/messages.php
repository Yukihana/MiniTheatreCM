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

abstract class MiniTheatreCMLibHtmlMessages
{
	public static function showMessage($message, $close = true, $level = 'warning', $caption = '')
	{
		// Translate
		if( $caption != '')
		{
			$caption = JText::_($caption);
		}
		$message = JText::_($message);
		
		// Open Container
		echo '<div class="alert alert-'.$level.'">';
		
		// Close button
		if( $close )
		{
			echo '<button type="button" class="close" data-dismiss="alert">×</button>';
		}
		
		// Header
		if( $caption != '' )
		{
			echo '<h4 class="alert-heading">'.$caption.'</h4>';
		}
		
		// Content
		echo '<div class="alert-message">'.$message.'</div>';
		
		// Close container
		echo '</div>';
	}
	public static function showParsedMessage($message, $pre = false, $post = false, $close = true, $level = 'warning', $caption = '', $delimiter = '~')
	{
		$r = self::formatCompound($message, $pre, $post, $delimiter);
		self::showMessage($r, $close, $level, $caption);
	}
	public static function formatCompound($message, $pre = false, $post = false, $delimiter = '~')
	{
		$r = '';
		$b = array();
		$i = 0;
		
		// Analyse, Translate, Disintegrate
		if( is_array( $message ))
		{
			// If array
			$a = array();
			foreach($message as $s)
			{
				array_push($a, JText::_($s));
			}
		}
		else
		{
			// If compound string
			$message = JText::_($message);
			$a = explode($delimiter, $message);
		}
		
		// Parse
		$n = count($a);
		foreach($a as $s)
		{
			if($i==0 && $n>1 && $pre)
			{
				$head =	$s;
			}
			else if($i==$n-1 && $n>2 && $post)
			{
				$foot = $s;
			}
			else
			{
				array_push($b, $s);
			}
			$i++;
		}
		
		// Format, Reconstruct
		if( isset( $head ))
		{
			$r .= '<p>'.$head.'</p>';
		}
		$r .= '<ul>';
		foreach($b as $s)
		{
			$r .= '<li>'.$s.'</li>';
		}
		$r .= '</ul>';
		if( isset( $foot ))
		{
			$r .= '<p>'.$foot.'</p>';
		}
		
		// Return Data
		return $r;
	}
}