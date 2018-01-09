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

abstract class NeonHtmlMessages
{
	public static function _($message = null, $caption = null, $close = true, $level = 'warning')
	{
		// Open Container
		$r = '<div class="alert alert-'.$level.'">';
		
		// Close button
		if( $close )
		{
			$r.= '<button type="button" class="close" data-dismiss="alert">×</button>';
		}
		
		// Header
		if( is_string( $caption ))
		{
			$r.= '<h4 class="alert-heading">'.$caption.'</h4>';
		}
		
		// Message
		if( is_string( $message ))
		{
			$r.= '<div class="alert-message">'.$message.'</div>';
		}

		// Close container
		$r.= '</div>';
		
		// Return
		return $r;
	}
	public static function showParsedMessage($message, $pre = false, $post = false, $close = true, $level = 'warning', $caption = '', $delimiter = '~')
	{
		$r = self::formatCompound($message, $pre, $post, $delimiter);
		return self::_($r, $close, $level, $caption);
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
				$a[] = JText::_($s);
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
			elseif($i==$n-1 && $n>2 && $post)
			{
				$foot = $s;
			}
			else
			{
				$b[] = $s;
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