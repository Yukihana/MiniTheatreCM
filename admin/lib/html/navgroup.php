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

JFactory::getDocument()->addScript( JUri::root().'media/com_minitheatrecm/js/navgroup.js' );

abstract class MiniTheatreCMLibHtmlNavGroup
{
	public static function tabButtons($prefix = 'mtcm-', $items = array())
	{
		if( count($items) == 0 )
		{
			return;
		}

		$index = 0;
		echo '<div class="row-fluid"><div class="btn-group">';
		foreach($items as $item)
		{
			echo '<a class="btn btn-micro hasTooltip" href="javascript:void(0);" title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_'.strtoupper($item->name)).
				'" onclick="javascript:mtcmTabberNav(\''.$prefix.'\',\''.$index++.'\',\''.JText::_('COM_MINITHEATRECM_DICTIONARY_'.strtoupper($item->name)).
				'\');"><span class="icon-'.$item->icon.'"> </span></a>';
		}
		echo '</div><div id="'.$prefix.'-index" class="pull-right">'.(isset($items[0]->tag)? $items[0]->tag : JText::_('COM_MINITHEATRECM_DICTIONARY_'.strtoupper($items[0]->name))).'</div></div>';
	}
	
	public static function navButtons($prefix = 'mtcm-', $count)
	{
		echo '<div class="row-fluid"><div class="btn-group">';
		foreach(array('first', 'previous', 'next', 'last') as $navicon)
		{
			echo '<a class="btn btn-micro hasTooltip" href="javascript:void(0);" title="'.JText::_('COM_MINITHEATRECM_DICTIONARY_'.strtoupper($navicon)).
				'" onclick="javascript:mtcmPagerNav(\''.$prefix.'\',\''.$navicon.'\');"><span class="icon-'.$navicon.'"> </span></a>';
		}
		echo '</div><div id="'.$prefix.'-index" class="pull-right">'.'1 / '.$count.'</div></div>';
	}
}