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
?>

<form action="index.php?option=com_minitheatrecm&view=franchises" method="post">
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
					<th width="35%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_TITLE', 'name') ;?>
					</th>
					<th width="10%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ACCESS', 'access') ;?>
					</th>
					<th width="10%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'JAUTHOR', 'author') ;?>
					</th>
					<th width="10%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_RECENTEDIT', 'recentedit') ;?>
					</th>
					<th width="10%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_CREATED', 'created'); ?>
					</th>
					<th width="10%" class="nowrap">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_MODIFIED', 'modified') ;?>
					</th>
					<th width="5%" class="nowrap" style="text-align:right;">
						<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_ID', 'id'); ?>
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
			
				<?php foreach ($this->items as $i => $row) : $link = JRoute::_('index.php?option=com_minitheatrecm&task=genre.edit&id=' . $row->id); ?>
				<tr>
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $row->id); ?>
					</td>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $row->state, $i, 'franchises.', true, 'cb'); ?>
					</td>
					<td>
						<a class="hasTooltip" href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_LEGEND_EDIT_GENRE'); ?>">
							<?php echo $row->name; ?>
						</a>
					</td>
					<td class="small hidden-phone">
						<?php if( $row->access == 0 || !isset( $this->groups[$row->access] ) ): ?>
						<span class="hasTooltip" title="<?php echo JText::_('COM_MINITHEATRECM_MESSAGE_NOSUCHACCESS');?>">
							<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_ID').': '.$row->access;?>
						</span>
						
						<?php else: ?>
						<a class="hasTooltip" href="<?php echo JRoute::_('index.php?option=com_users&task=group.edit&id='.$row->access); ?>" title="<?php echo JText::_('JGRID_HEADING_ACCESS'); ?>">
							<?php echo $this->groups[$row->access]; ?>
						</a>
						
						<?php endif;?>
					</td>
					<td class="small nowrap hidden-phone">					
						<?php if( $row->author != 0 && isset( $this->names[$row->author] )): ?>
						<a class="hasTooltip" href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id='.$row->author);?>" title="<?php echo JText::_('JAUTHOR');?>">
							<?php echo $this->names[$row->author];?>
						</a>
						
						<?php else: ?>
						<span class="hasTooltip" title="<?php echo JText::_( $row->author == 0 ? 'COM_MINITHEATRECM_MESSAGE_USERZERO' : 'COM_MINITHEATRECM_MESSAGE_NOSUCHUSER' );?>">
							<?php echo $row->author == 0 ? JText::_('COM_MINITHEATRECM_DICTIONARY_NONE') : JText::_('COM_MINITHEATRECM_DICTIONARY_ID').': '.$row->author;?>
						</span>
						
						<?php endif;?>
					</td>
					<td class="small nowrap hidden-phone">
						<?php if( $row->recentedit != 0 && isset( $this->names[$row->recentedit] )): ?>
						<a class="hasTooltip" href="<?php echo JRoute::_('index.php?option=com_users&task=user.edit&id='.$row->recentedit);?>" title="<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_RECENTEDIT');?>">
							<?php echo $this->names[$row->recentedit];?>
						</a>
						
						<?php else: ?>
						<span class="hasTooltip" title="<?php echo JText::_( $row->recentedit == 0 ? 'COM_MINITHEATRECM_MESSAGE_USERZERO' : 'COM_MINITHEATRECM_MESSAGE_NOSUCHUSER' );?>">
							<?php echo $row->recentedit == 0 ? JText::_('COM_MINITHEATRECM_DICTIONARY_NONE') : JText::_('COM_MINITHEATRECM_DICTIONARY_ID').': '.$row->recentedit;?>
						</span>
						
						<?php endif;?>
					</td>
					<td class="small nowrap hidden-phone">
						<?php echo $row->created; ?>
					</td>
					<td class="small nowrap hidden-phone">
						<?php echo $row->modified; ?>
					</td>
					<td class="hidden-phone" style="text-align:right;">
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