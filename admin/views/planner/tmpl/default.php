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

// Load Layout Dependencies
JLoader::Register('NeonLibHtmlNavGroup', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/navgroup.php');
JLoader::Register('NeonLibHtmlList', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/list.php');
JLoader::Register('NeonLibIncludeStyles', JPATH_COMPONENT_ADMINISTRATOR . '/lib/include/styles.php');

NeonLibIncludeStyles::load();
?>

<form action="index.php?option=com_minitheatrecm&view=planner" method="post">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render();?>
	</div>
	
	<div id="j-main-container" class="span10">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'updates')); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'roadmap', JText::_('COM_MINITHEATRECM_DICTIONARY_ROADMAP')); ?>
			ROADMAP DATA
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'manifest', JText::_('COM_MINITHEATRECM_DICTIONARY_MANIFEST')); ?>
			MANIFEST DATA
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'updates', JText::_('COM_MINITHEATRECM_DICTIONARY_UPDATES')); ?>
			<div class="mtcm-flex">
				<div class="mtcm-flex-spread-270 mtcm-padding-3">
					<h2 class="page-header"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_TASKS');?></h2>
					<?php NeonLibHtmlNavGroup::tabButtons('mtcm-tasks', $this->tasks);?>
					<div id="mtcm-tasks-tabpanel" class="mtcm-padding-6v" activeindex="0">
						<?php NeonLibHtmlList::listModTables($this->tasks, 'mtcm-tasks', array('data', 'name'), 'mtcm-modstyle-tasks', array(0), false);?>
					</div>
				</div>
				<div class="mtcm-flex-spread-270 mtcm-padding-3">
					<h2 class="page-header"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_CHANGELOG');?></h2>
					<?php NeonLibHtmlNavGroup::navButtons('mtcm-clog', count($this->clog));?>
					<div id="mtcm-clog-pagepanel" class="mtcm-padding-6v" activeindex="0">
						<?php NeonLibHtmlList::listModTables($this->clog, 'mtcm-clog', array('data', 'version', 'updated'), 'mtcm-modstyle-clog', array(0), false);?>
					</div>
				</div>
			</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
	</div>
</form>