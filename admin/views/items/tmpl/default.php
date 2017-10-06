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

<form action="index.php?option=com_minitheatrecm&view=items" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render();?>
	</div>
	<div id="j-main-container" class="span10">	
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
					<th width="1%" class="nowrap center">
						<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'state', $listDirn, $listOrder); ?>
					</th>
					<th width="89%" class="no-wrap">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_TITLE', 'name', $listDirn, $listOrder) ;?>
					</th>
					<th width="1%" class="nowrap center">
						<?php echo JHtml::_('searchtools.sort',  'JGRID_HEADING_ACCESS', 'access', $listDirn, $listOrder); ?>
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
			
				<?php foreach ($this->items as $i => $row) : $link = JRoute::_('index.php?option=com_minitheatrecm&task=item.edit&id=' . $row->id); ?>
				<tr>
					<td>
						<?php echo $this->pagination->getRowOffset($i);?>
					</td>
					<td>
						<?php echo JHtml::_('grid.id', $i, $row->id); ?>
					</td>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $row->state, $i, 'items.', true, 'cb'); ?>
					</td>					
					<td>
						<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_ITEM_LEGEND_EDIT'); ?>">
							<?php echo $row->name; ?>
						</a>
					</td>
					<td class="center">
						<?php echo $this->escape($row->access); ?>
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