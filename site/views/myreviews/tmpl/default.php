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

/*
JHtml::_('formbehavior.chosen', 'select');
$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);
*/
?>

<h3 class="page-header"><?php echo JText::_('COM_MINITHEATRECM_MYREVIEWS_HEADING');?></h3>

<?php if ( ! $this->loggedin ) : ?>
<div class="alert alert-warning">
	<?php echo JText::_('JGLOBAL_YOU_MUST_LOGIN_FIRST'); ?>
</div>

<?php elseif (empty($this->items)) : ?>
<div class="alert alert-no-items">
	<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
</div>

<?php else: ?>
<form action="index.php?option=com_minitheatrecm&view=myreviews" method="post" id="siteForm" name="siteForm">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th width="4%" class="nowrap center">
					<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_NUM'); ?>
				</th>
				<th width="50%" class="nowrap">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_ITEM', 'item_id'); ?>
				</th>
				<th width="20%" class="nowrap center">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_CREATED', 'created');?>
				</th>
				<th width="20%" class="nowrap center">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_MODIFIED', 'created');?>
				</th>
				<th width="1%" class="nowrap center">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_LIVE', 'live'); ?>
				</th>
				<th width="5%" class="nowrap center">
					<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_ACTIONS') ;?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		
			<?php foreach ($this->items as $i => $row) : $link = JRoute::_('index.php?option=com_minitheatrecm&task=editreview.edit&id=' . $row->id); ?>
			<tr>
				<td class="right">
					<?php echo $this->pagination->getRowOffset($i);?>
				</td>
				<td>
					<?php if( $row->item_id == 0 ): ?>
						<?php echo JText::_('COM_MINITHEATRECM_MESSAGE_INVALIDID');?>
						
					<?php elseif ( isset( $this->itemnames[$row->item_id] )): ?>
					<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_MYREVIEWS_LEGEND_EDIT'); ?>">
						<?php echo $this->itemnames[$row->item_id];?>
					</a>
					
					<?php else: ?>
						<?php echo JText::_('COM_MINITHEATRECM_MESSAGE_ITEMMISSING').' (ID: '.$row->item_id.')';?>
						
					<?php endif;?>
				</td>
				<td class="nowrap center">
					<?php echo $row->created; ?>
				</td>
				<td class="nowrap center">
					<?php echo $row->modified; ?>
				</td>
				<td class="center">
					<?php echo ( $row->item_id == 0 || !isset( $this->itemnames[$row->item_id] )) ? 'N/A' : JText::_( ($row->live) ? 'JYES' : 'JNO' );?>
				</td>
				<td class="nowrap center">
					<a href="<?php echo 'index.php?option=com_minitheatrecm&view=item&id='.$row->item_id;?>" title="<?php echo JText::_('COM_MINITHEATRECM_MESSAGE_GOTOTHISITEM');?>"><span class="icon-out-2"></span></a>
					<a href="<?php echo $link;?>" title="<?php echo JText::_('COM_MINITHEATRECM_MYREVIEWS_LEGEND_EDIT');?>"><span class="icon-pencil-2"></span></a>
					<a href="<?php echo JRoute::_('index.php?option=com_minitheatrecm&view=deletereview&id='.$row->id);?>" title="<?php echo JText::_('COM_MINITHEATRECM_MYREVIEWS_LEGEND_DELETE');?>"><span class="icon-trash"></span></a>
				</td>
			</tr>			
			<?php endforeach; ?>
			
		</tbody>
	</table>
</form>

<?php endif;?>