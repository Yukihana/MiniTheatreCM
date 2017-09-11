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
<div class="alert">
	<h4 class="alert-heading">Work In Progress (Ver: 0.0.9f8) (Updated: 2017-09-06 00:02)</h4>
	<ul class="alert-message">
		<li><strike>Incomplete/Missing Targets.</strike> Refactors in progress. Links on this page <strike>will</strike> may give errors.</li>
		<li>But they're not supposed to break the website. Just un-ready/disabled functionalities.</li>
		<li>This page will list all the different upload wizards.</li>
		<li>Each wizard can be editted to best fit their respective upload requirements.</li>
	</ul>
</div>
<form action="index.php?option=com_minitheatrecm&view=ulwizconfigs" method="post" id="adminForm" name="adminForm">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th width="3%">
					<?php echo JText::_('COM_MINITHEATRECM_NUM'); ?>
				</th>
				<th width="2%">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
				<th width="90%">
					<?php echo JText::_('COM_MINITHEATRECM_ULWIZCONFIGS_NAME') ;?>
				</th>
				<th width="2%">
					<?php echo JText::_('COM_MINITHEATRECM_PUBLISHED'); ?>
				</th>
				<th width="3%">
					<?php echo JText::_('COM_MINITHEATRECM_ID'); ?>
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
			<?php if (!empty($this->items)) : ?>
			<?php foreach ($this->items as $i => $row) :
				$link = JRoute::_('index.php?option=com_minitheatrecm&task=ulwizconfig.edit&id=' . $row->id); ?>

			<tr>
				<td>
					<?php echo $this->pagination->getRowOffset($i); ?>
				</td>
				<td>
					<?php echo JHtml::_('grid.id', $i, $row->id); ?>
				</td>
				<td>
					<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_EDIT_ULWIZCONFIG'); ?>">
						<?php echo $row->wmode; ?>
					</a>
				</td>
				<td align="center">
					<?php echo JHtml::_('jgrid.published', $row->published, $i, 'ulwizconfigs.', true, 'cb'); ?>
				</td>
				<td align="center">
					<?php echo $row->id; ?>
				</td>
			</tr>
			
			<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>