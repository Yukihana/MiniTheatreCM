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
JLoader::Register('MiniTheatreCMLibHtmlManager', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/manager.php');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', '.multipleAuthors', null, array('placeholder_text_multiple' => JText::_('JOPTION_SELECT_AUTHOR')));
JHtml::_('formbehavior.chosen', '.multipleItems', null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_FILTER_ITEM')));
JHtml::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->state->get('list.ordering'));
$listDirn      = $this->escape($this->state->get('list.direction'));
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
					<th width="3%" class="center">
						<?php echo JHtml::_('grid.checkall'); ?>
					</th>
					<th width="7%" class="nowrap center">
						<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder) ;?>
					</th>
					<th width="25%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_COLUMNHEADER_LISTINGNAME', 'a.name', $listDirn, $listOrder) ;?>
					</th>
					<th width="20%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_DICTIONARY_ITEM', 'a.item_id', $listDirn, $listOrder) ;?>
					</th>
					<th width="10%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort', 'JAUTHOR', 'a.author', $listDirn, $listOrder) ;?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_DICTIONARY_RECENTEDIT', 'a.recentedit', $listDirn, $listOrder) ;?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_DICTIONARY_CREATED', 'a.created', $listDirn, $listOrder); ?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_DICTIONARY_MODIFIED', 'a.modified', $listDirn, $listOrder) ;?>
					</th>
					<th width="5%" class="nowrap hidden-phone" style="text-align:right;">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_DICTIONARY_ID', 'a.id', $listDirn, $listOrder); ?>
					</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="9">
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
						<a class="hasTooltip" href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_LEGEND_EDIT_LISTING'); ?>">
							<?php echo $row->name; ?>
						</a>
					</td>
					<td class="small">
						<?php MiniTheatreCMLibHtmlManager::getItemField($this->itemnames, $row->item_id);?>
					</td>
					<td class="small nowrap">					
						<?php MiniTheatreCMLibHtmlManager::getUsernameField($this->names, $row->author);?>
					</td>
					<td class="small nowrap hidden-phone">
						<?php MiniTheatreCMLibHtmlManager::getUsernameField($this->names, $row->recentedit, true);?>
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
		
		<?php echo MiniTheatreCMLibHtmlManager::getListFooter($this->pagination->total, $this->querytime);?>
		
		<?php echo JHtml::_('form.token'); ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
	</div>	
</form>
