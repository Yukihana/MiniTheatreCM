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
JLoader::Register('NeonHtmlManager', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/manager.php');
?>

<form action="index.php?option=com_minitheatrecm&view=ratinglistings" method="post">
	<?php if (!empty( $this->sidebar)) : ?>
		<div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
		</div>
		<div id="j-main-container" class="span10">
	<?php else : ?>
		<div id="j-main-container">
	<?php endif; ?>
		
		<?php if (empty($this->items)) : ?>
		<div class="alert alert-no-items">
			<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
		</div>
		
		<?php else : ?>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="5%" class="center">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th width="30%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_RATING', 'rating') ;?>
					</th>
					<th width="20%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_ITEM', 'target_id') ;?>
					</th>
					<th width="10%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'JAUTHOR', 'author') ;?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_RECENTEDIT', 'recentedit') ;?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_CREATED', 'created'); ?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_MODIFIED', 'modified') ;?>
					</th>
					<th width="5%" class="nowrap hidden-phone" style="text-align:right;">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_ID', 'id'); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="8">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			
				<?php foreach ($this->items as $i => $row) : $link = JRoute::_('index.php?option=com_minitheatrecm&task=ratinglisting.edit&id=' . $row->id); ?>
				<tr>
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $row->id); ?>
					</td>
					<td>
						<a class="hasTooltip" href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_LEGEND_EDIT_RATING'); ?>">
							<?php echo $row->rating; /*replace this raw value with respective rating widgets later*/?>
						</a>
					</td>
					<td class="small nowrap">
						<?php NeonHtmlManager::getItemField($this->itemnames, $row->target_id);?>
					</td>
					<td class="small nowrap">
						<?php NeonHtmlManager::getUsernameField($this->names, $row->author);?>
					</td>
					<td class="small nowrap hidden-phone">
						<?php NeonHtmlManager::getUsernameField($this->names, $row->recentedit, true);?>
					</td>
					<td class="small nowrap hidden-phone">
						<?php echo $row->created; ?>
					</td>
					<td class="small nowrap hidden-phone">
						<?php echo $row->modified; ?>
					</td>
					<td class="nowrap hidden-phone" style="text-align:right;">
						<?php echo $row->id; ?>
					</td>
				</tr>			
				<?php endforeach; ?>
				
			</tbody>
		</table>
		<?php endif;?>
		
		<?php echo NeonHtmlManager::getListFooter($this->pagination->total, $this->querytime);?>
		
		<?php echo JHtml::_('form.token'); ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
	</div>
</form>