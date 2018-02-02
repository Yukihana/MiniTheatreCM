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
			$r.= '<div class="row-fluid">'.htmlspecialchars( $line ).'</div>';
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
			// Prepare
			if( strpos( strtolower($line), '(-active-)' ) !== false )
			{
				$i = '<span class="icon-clock hasTooltip" title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_ACTIVE').'"> </span>';
				$line = str_ireplace( '(-active-)', '', $line );
			}
			elseif( strpos(  strtolower($line), '(-trashed-)' ) !== false )
			{
				$i = '<span class="icon-trash hasTooltip" title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_TRASHED').'"> </span>';
				$line = str_ireplace( '(-trashed-)', '', $line );
			}
			else
			{
				$i = '';
			}
			
			// Text + Icon
			$r.= '<div class="row-fluid"><div class="span1 nowrap center">'.$i.'</div><div class="span11">'.htmlspecialchars( $line ).'</div></div>';
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