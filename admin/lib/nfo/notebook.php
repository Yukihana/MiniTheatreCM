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

abstract class NeonNfoNotebook
{
	public static function renderTodo($start = 0, $limit = null)
	{
		$lines = file( JPATH_COMPONENT_ADMINISTRATOR . '/data/nfo/todo.x', FILE_IGNORE_NEW_LINES );
		
		// Begin + Header
		$r = '<div class="well" style="border: 1pt solid #dedede; background: linear-gradient(rgba(0,0,0,0.03), rgba(0,0,0,0.07)); padding-left:0px; padding-right:0px;">'
			.'<h2 class="module-title nav-header" style="padding-left:6pt; padding-right:6pt;">'.JText::_('COM_MINITHEATRECM_DICTIONARY_TODO').'</h2>';
		
		// Body
		$r.= '<div class="row-striped">';
		foreach( $lines as $line )
		{
			$c = ( strpos( strtolower($line), '(-done-)' ) !== false )? '' : ' invisible';
			$d = empty($c)? ' class="disabled muted"' : '';
			$line = str_ireplace( '(-done-)', '', $line );
			
			$r.= '<div class="row-fluid"><div class="pull-right'.$c
				.'"><span class="icon-checkmark-2 hasTooltip" style="color:#0b0;" title="'
				.JText::_('COM_MINITHEATRECM_DICTIONARY_DONE').'"> </span></div><span'
				.$d.'>'.htmlspecialchars( $line ).'</span></div>';
		}
		$r.= "</div>";
		
		// Footer + End
		$r.= '</div>';
		
		return $r;
	}
	
	public static function renderIdeas($start = 0, $limit = null)
	{
		$lines = file( JPATH_COMPONENT_ADMINISTRATOR . '/data/nfo/ideabucket.x', FILE_IGNORE_NEW_LINES );
		
		// Begin + Header
		$r = '<div class="well" style="border: 1pt solid #dedede; background: linear-gradient(rgba(0,0,0,0.03), rgba(0,0,0,0.07)); padding-left:0px; padding-right:0px;">'
			.'<h2 class="module-title nav-header" style="padding-left:6pt; padding-right:6pt;">'.JText::_('COM_MINITHEATRECM_DICTIONARY_IDEABUCKET').'</h2>';
		
		// Body
		$r.= '<div class="row-striped">';
		foreach( $lines as $line )
		{
			$c = ( strpos( strtolower($line), '(-trashed-)' ) !== false )? '' : ' invisible';
			$d = empty($c)? ' class="disabled muted"' : '';
			$line = str_ireplace( '(-trashed-)', '', $line );
			
			$r.= '<div class="row-fluid"><div class="pull-right'.$c
				.'"><span class="icon-delete hasTooltip" style="color:#b00;" title="'
				.JText::_('COM_MINITHEATRECM_DICTIONARY_TRASHED').'"> </span></div><span'
				.$d.'>'.htmlspecialchars( $line ).'</span></div>';
		}
		$r.= "</div>";
		
		// Footer + End
		$r.= '</div>';
		
		return $r;
	}
	
	public static function renderResearch($start = 0, $limit = null)
	{
		$lines = file( JPATH_COMPONENT_ADMINISTRATOR . '/data/nfo/research.x' , FILE_IGNORE_NEW_LINES );
		
		// Begin + Header
		$r = '<div class="well" style="border: 1pt solid #dedede; background: linear-gradient(rgba(0,0,0,0.03), rgba(0,0,0,0.07)); padding-left:0px; padding-right:0px;">'
			.'<h2 class="module-title nav-header" style="padding-left:6pt; padding-right:6pt;">'.JText::_('COM_MINITHEATRECM_DICTIONARY_RESEARCH').'</h2>';
		
		// Body
		$r.= '<div class="row-striped">';
		foreach( $lines as $line )
		{
			$r.= '<div class="row-fluid">'.htmlspecialchars( $line ).'</div>';
		}
		$r.= "</div>";
		
		// Footer + End
		$r.= '</div>';
		
		return $r;
	}
	
	public static function renderNotes($start = 0, $limit = null)
	{
		$lines = file( JPATH_COMPONENT_ADMINISTRATOR . '/data/nfo/notes.x' , FILE_IGNORE_NEW_LINES );
		
		// Begin + Header
		$r = '<div class="well" style="border: 1pt solid #dedede; background: linear-gradient(rgba(0,0,0,0.03), rgba(0,0,0,0.07)); padding-left:0px; padding-right:0px;">'
			.'<h2 class="module-title nav-header" style="padding-left:6pt; padding-right:6pt;">'.JText::_('COM_MINITHEATRECM_DICTIONARY_NOTES').'</h2>';
		
		// Body
		$r.= '<div class="row-striped">';
		foreach( $lines as $line )
		{
			$r.= '<div class="row-fluid">'.htmlspecialchars( $line ).'</div>';
		}
		$r.= "</div>";
		
		// Footer + End
		$r.= '</div>';
		
		return $r;
	}
}