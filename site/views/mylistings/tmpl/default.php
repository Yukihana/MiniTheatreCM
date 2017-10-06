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
$rowindex=0;
?>

<h3 class="page-header"><?php echo $this->iPageTitle; ?></h3>

<?php if ( ! $this->iLoggedIn ) : ?>
<div class="alert alert-warning">
	<?php echo JText::_('JGLOBAL_YOU_MUST_LOGIN_FIRST'); ?>
</div>

<?php elseif (empty($this->iListings)) : ?>
<div class="alert alert-no-items">
	<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
</div>

<?php else : ?>
<form action="index.php?option=com_minitheatrecm&view=mylistings" method="post" id="listingsForm" name="listingsForm">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th width="4%" class="nowrap center">
					<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_NUM'); ?>
				</th>
				<th width="50%" class="no-wrap">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_TITLE', 'name'); ?>
				</th>
				<th width="40%" class="nowrap">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_ITEM', 'item_id'); ?>
				</th>
				<th width="1%" class="nowrap center">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_PUBLISHED', 'published'); ?>
				</th>
				<th width="5%" class="nowrap center">
					<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_ACTIONS') ;?>
				</th>
		</thead>
		<tbody>
			<?php foreach ($this->iListings as $i => $row) : $link = JRoute::_('index.php?option=com_minitheatrecm&task=listingedit.edit&id=' . $row->id); ?>
			<tr>
				<td class="right">
					<?php echo $rowindex++;?>
				</td>					
				<td>
					<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_MYLISTINGS_LEGEND_EDIT'); ?>">
						<?php echo $row->name; ?>
					</a>
				</td>
				<td>
					<a href="<?php echo 'index.php?option=com_minitheatrecm&view=item&id='.$row->item_id;?>" title="Insert Item Name Here">
						<?php echo 'Insert Item Name Here-('.$row->item_id.')'; ?>
					</a>
				</td>
				<td class="center">
					<?php echo JHtml::_('jgrid.published', $row->state, $i, 'mylistings.', true, 'cb'); ?>
				</td>
				<td class="center" nowrap>
					<a href="<?php echo 'index.php?option=com_minitheatrecm&view=editlisting&id='.$row->id; ?>">Edit</a>
					<a href="<?php echo 'index.php?option=com_minitheatrecm&view=deletelisting&id='.$row->id; ?>">Delete</a>
				</td>
			</tr>			
			<?php endforeach; ?>
		</tbody>
	</table>
</form>
<?php endif;?>
<? /* php/iList should contain the rows as data */ ?>
