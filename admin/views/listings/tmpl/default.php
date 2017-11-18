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
JLoader::Register('NeonLibHtmlManager', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/manager.php');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', '.multipleAccessLevels', null, array('placeholder_text_multiple' => JText::_('JOPTION_SELECT_ACCESS')));
JHtml::_('formbehavior.chosen', '.multipleAuthors', null, array('placeholder_text_multiple' => JText::_('JOPTION_SELECT_AUTHOR')));
JHtml::_('formbehavior.chosen', '.multipleRecentEditors', null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_FILTER_RECENTEDITOR')));
JHtml::_('formbehavior.chosen', '.multipleItems', null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_FILTER_ITEM')));
JHtml::_('formbehavior.chosen', 'select');

$listOrder		= $this->escape($this->state->get('list.ordering'));
$listDirn		= $this->escape($this->state->get('list.direction'));

$timestamporder = NeonLibHtmlManager::getTimestampOrder($listOrder);
$editororder	= NeonLibHtmlManager::getEditorOrder($listOrder);
$statsorder		= NeonLibHtmlManager::getStatsOrder($listOrder);
?>

<form action="index.php?option=com_minitheatrecm&view=listings" method="post" id="adminForm" name="adminForm">
	<?php if (!empty( $this->sidebar)) : ?>
		<div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
		</div>
		<div id="j-main-container" class="span10">
	<?php else : ?>
		<div id="j-main-container">
	<?php endif; ?>
		<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
		
		<?php if (empty($this->items)) : ?>
		<div class="alert alert-no-items">
			<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
		</div>
		
		<?php else : ?>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="1%" class="center">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th width="1%" class="nowrap center">
						<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder) ;?>
					</th>
					<th width="45%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_COLUMNHEADER_LISTINGNAME', 'a.name', $listDirn, $listOrder) ;?>
					</th>
					<th width="20%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_DICTIONARY_ITEM', 'a.item_id', $listDirn, $listOrder) ;?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_DICTIONARY_ACCESS', 'a.access', $listDirn, $listOrder) ;?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', NeonLibHtmlManager::getEditorHeader($editororder), (($editororder==2)?'a.recentedit':'a.author'), $listDirn, $listOrder);?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', NeonLibHtmlManager::getTimestampHeader($timestamporder), (($timestamporder==2)?'a.modified':'a.created'), $listDirn, $listOrder);?>
					</th>
					<th width="1%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', NeonLibHtmlManager::getStatsHeader($statsorder), (($statsorder==2)?'a.votes':'a.hits'), $listDirn, $listOrder);?>
					</th>
					<th width="1%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_DICTIONARY_RATING', 'a.rating', $listDirn, $listOrder) ;?>
					</th>
					<th width="1%" class="nowrap" style="text-align:right;">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_DICTIONARY_ID', 'a.id', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="10">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			
				<?php foreach ($this->items as $i => $row) : $link = JRoute::_('index.php?option=com_minitheatrecm&task=listing.edit&id=' . $row->id); ?>
				<tr>
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $row->id); ?>
					</td>
					<td class="nowrap center">
						<div class="btn-group">
							<?php echo JHtml::_('jgrid.published', $row->state, $i, 'listings.', true, 'cb'); ?>
						</div>
					</td>
					<td>
						<div class="pull-left">
							<a class="hasTooltip" href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_TOOLTIP_EDIT_LISTING'); ?>">
								<?php echo $this->escape($row->name); ?>
							</a>
							<div class="small disabled muted hasTooltip" title="<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_ALIAS');?>">
								<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_ALIAS').': '.$this->escape($row->alias);?>
							</div>
						</div>
					</td>
					<td class="small hidden-phone">
						<?php NeonLibHtmlManager::getItemField($this->itemnames, $row->item_id);?>
					</td>
					<td class="small nowrap hidden-phone">
						<?php NeonLibHtmlManager::getAccessField($this->groups, $row->access);?>
					</td>
					<td class="hidden-phone">					
						<?php echo NeonLibHtmlManager::getEditorCell($this->names, $row->author, $row->recentedit, $editororder);?>
					</td>
					<td class="hidden-phone">
						<?php echo NeonLibHtmlManager::getTimestampCell($row->created, $row->modified, $timestamporder); ?>
					</td>
					<td class="<?php echo ($statsorder!=0)?'center':'';?> hidden-phone">
						<?php echo NeonLibHtmlManager::getStatsCell($row->hits, $row->votes, $statsorder); ?>
					</td>
					<td class="center hidden-phone">
						<?php echo NeonLibHtmlManager::getStarRatingCell($row->rating, true);?>
					</td>
					<td class="nowrap" style="text-align:right;">
						<?php echo $row->id; ?>
					</td>
				</tr>			
				<?php endforeach; ?>
				
			</tbody>
		</table>
		<?php endif;?>
		
		<?php echo NeonLibHtmlManager::getListFooter($this->pagination->total, $this->querytime);?>
		
		<?php echo JHtml::_('form.token'); ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
	</div>	
</form>
