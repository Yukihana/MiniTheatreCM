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

abstract class NeonHtmlList
{
	// Prints a ModTable
	public static function listModTable( $item, $fields = array('data','name','alt'), $styleclass = 'mtcm-mod-style', $name = '', $id = '', $visible = true )
	{
		// Determine what is available
		if( count( $fields ) == 0 )
		{
			return;
		}
		
		// Label for data field
		try{ $datalabel = $fields[0]; }
		catch(Exception $e){}
		
		// Return on null data array
		if( !isset( $item->$datalabel ))
		{
			return;
		}
		
		// Header
		if( isset( $fields[1] ))
		{
			$headlabel = $fields[1];
			if( isset( $item->$headlabel ))
			{
				$head = $item->$headlabel;
			}
		}
		
		// Alt
		if( isset( $fields[2] ))
		{
			$altlabel = $fields[2];
			if( isset( $item->$altlabel ))
			{
				$alt = $item->$altlabel;
			}
		}
		
		// Start Container
		echo '<div class="'.$styleclass.'"'.
			(($name != '') ? ' name="'.$name.'"' : '').
			(($id != '') ? ' id="'.$id.'"' : '').
			(($visible!=true)? ' style="display:none;"' : '').'>';
			
		// Header and Alt
		if( isset( $head ))
		{
			echo '<div>';
			if( isset( $alt ))
			{
				echo '<div class="pull-right small mtcm-margin-6h">'.$alt.'</div>';
			}
			echo '<h3 class="module-title nav-header">'.$head.'</h3></div>';
		}
		
		// List
		echo '<ul class="row-striped">';
		foreach($item->$datalabel as $line)
		{
			echo '<li class="row-fluid">'.$line.'</li>';
		}

		// End List and Container
		echo '</ul></div>';
	}
	// Prints an array of ModTables, with visibility options, much like ChangeLog tabs. Check Planner View for info on implementation.
	public static function listModTables( $items,
		$prefix = 'mtcm',
		$fields = array('data','name','alt'),
		$styleclass = 'mtcm-mod-style',
		$visibleindices = array(),
		$visibleinvert = false )
	{
		// Check if items actually exist
		if( count($items)==0 )
		{
			return;
		}
		
		$index=0;
		foreach($items as $item)
		{
			$visible = ($visibleinvert) ? !in_array($index++, $visibleindices) : in_array($index++, $visibleindices);
			self::listModTable($item, $fields, $styleclass, $prefix.'-entry', '', $visible);
		}
	}
}