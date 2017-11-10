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

// Include Dependencies
JLoader::Register('MiniTheatreCMLibHtmlManagerFields', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/managerfields.php');
?>

<form action="index.php?option=com_minitheatrecm&view=genres" method="post">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render();?>
	</div>
	<div id="j-main-container" class="span10">
		
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
						<?php echo JHtml::_('grid.sort', 'JSTATUS', 'state') ;?>
					</th>
					<th width="45%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_GENRE', 'name') ;?>
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
			
				<?php foreach ($this->items as $i => $row) : $link = JRoute::_('index.php?option=com_minitheatrecm&task=genre.edit&id=' . $row->id); ?>
				<tr>
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $row->id); ?>
					</td>
					<td class="nowrap center">
						<?php echo JHtml::_('jgrid.published', $row->state, $i, 'genres.', true, 'cb'); ?>
					</td>
					<td>
						<a class="hasTooltip" href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_LEGEND_EDIT_GENRE'); ?>">
							<?php echo $row->name; ?>
						</a>
					</td>
					<td class="small nowrap">					
						<?php MiniTheatreCMLibHtmlManagerFields::getUsername($this->names, $row->author);?>
					</td>
					<td class="small nowrap hidden-phone">
						<?php MiniTheatreCMLibHtmlManagerFields::getUsername($this->names, $row->recentedit, true);?>
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
		
		<?php echo JHtml::_('form.token'); ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
	</div>
</form>