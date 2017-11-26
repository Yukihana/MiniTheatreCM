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
JLoader::Register('NeonLibHtmlNavGroup', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/navgroup.php');
JLoader::Register('NeonLibHtmlList', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/list.php');
JLoader::Register('NeonLibIncludeStyles', JPATH_COMPONENT_ADMINISTRATOR . '/lib/include/styles.php');

NeonLibIncludeStyles::load();

$app		= JFactory::getApplication();
$context	= 'com_minitheatrecm.planner.';
$tabview	= $app->getUserState($context.'tabview', 'roadmap');
?>

<form action="index.php?option=com_minitheatrecm&view=planner" method="post" name="adminForm" id="adminForm">
	<?php if (!empty( $this->sidebar)) : ?>
		<div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
		</div>
		<div id="j-main-container" class="span10">
	<?php else : ?>
		<div id="j-main-container">
	<?php endif; ?>
	
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => $this->escape($tabview))); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'roadmap', JText::_('COM_MINITHEATRECM_DICTIONARY_ROADMAP')); ?>
			ROADMAP DATA
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'manifest', JText::_('COM_MINITHEATRECM_DICTIONARY_MANIFEST')); ?>
			MANIFEST DATA
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'tasks', JText::_('COM_MINITHEATRECM_DICTIONARY_TASKS')); ?>
			<div class="span6">
			</div>
			<div class="span6">
				<?php NeonLibHtmlNavGroup::tabButtons('mtcm-tasks', $this->tasks);?>
				<div id="mtcm-tasks-tabpanel" class="mtcm-padding-6v" activeindex="0">
					<?php NeonLibHtmlList::listModTables($this->tasks, 'mtcm-tasks', array('data', 'name'), 'mtcm-modstyle-tasks', array(0), false);?>
				</div>
			</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'changelogs', JText::_('COM_MINITHEATRECM_DICTIONARY_CHANGELOGS')); ?>
			<div class="span4 jmoddiv hidden-phone">
				<table class="table table-striped table-hover">
					<thead>
						<th width="99%">
							<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_UPDATE');?>
						</th>
						<th width="1%">
							<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_NUM');?>
						</th>
					</thead>
					<tfoot>
						<tr>
							<td colspan="2">
								<?php echo $this->cloglist->pagination->getListFooter();?>
							</td>
						</tr>
					</tfoot>
					<tbody>
						<?php foreach($this->cloglist->data as $row): $link=JRoute::_('index.php?option=com_minitheatrecm&view=planner&tabview=changelogs&clogindex='.$row->value);?>
						<tr>
							<td class="nowrap">
								<a href="<?php echo $link;?>" class="hasTooltip" title="<?php echo JText::_('COM_MINITHEATRECM_TOOLTIP_VIEW_CLOG');?>">
									<?php echo $row->text;?>
								</a>
							</td>
							<td style="text-align:right;">
								<?php echo $row->value;?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
			<div class="span8">
				<div class="visible-phone">
					<?php echo JHtml::_('select.genericlist', $this->cloglist->raw, 'clogindex', array('onchange' => 'this.form.submit()', 'class' => 'input-xlarge'), 'value', 'text', $this->clogindex, 'clogindex'); ?>
				</div>
				<?php echo $this->clogdata;?>
			</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
	</div>
</form>