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

JHtml::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);
?>

<form action="index.php?option=com_minitheatrecm&view=ulwizsources" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
		<div class="alert">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4 class="alert-header">Legacy Manager View</h4>
			<div class="alert-message">The old manager being used for tutorial purposes. To be removed before the release version.</div>
		</div>
	
		<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
				
		<?php if (empty($this->items)) : ?>
		<div class="alert alert-no-items">
			<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
		</div>

		<?php else : ?>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="1%" class="nowrap center">
						<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_NUM'); ?>
					</th>
					<th width="2%" class="center">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th width="90%" class="no-wrap">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_TITLE', 'wname', $listDirn, $listOrder) ;?>
					</th>
					<th width="5%" class="center">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_PUBLISHED', 'published', $listDirn, $listOrder) ;?>
					</th>
					<th width="2%">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_ID', 'id', $listDirn, $listOrder) ;?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			
				<?php foreach ($this->items as $i => $row) : $link = JRoute::_('index.php?option=com_minitheatrecm&task=ulwizsource.edit&id=' . $row->id); ?>
				<tr>
					<td>
						<?php echo $this->pagination->getRowOffset($i);?>
					</td>
					<td>
						<?php echo JHtml::_('grid.id', $i, $row->id); ?>
					</td>
					<td>
						<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_ULWIZSOURCE_LEGEND_EDIT'); ?>">
							<?php echo $row->wname; ?>
						</a>
					</td>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $row->published, $i, 'ulwizsources.', true, 'cb'); ?>
					</td>
					<td class="right">
						<?php echo $row->id; ?>
					</td>
				</tr>			
				<?php endforeach; ?>
				
			</tbody>
		</table>
		<?php endif;?>
		
		<?php echo JHtml::_('form.token'); ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	</div>
</form>