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
<div class="alert">
	<h4 class="alert-heading">Work In Progress (Ver: 0.0.9r) (Updated: 2017-09-07 22:00)</h4>
	<ul class="alert-message">
		<li>Refactoring complete but might have bugs. Links on this page may still give errors.</li>
		<li>But they're not supposed to break the website. Just un-ready/disabled functionalities.</li>
		<li>This page will list all the different upload wizards.</li>
		<li>Each wizard can be editted to best fit their respective upload requirements.</li>
	</ul>
</div>
<form action="index.php?option=com_minitheatrecm&view=ulwizsources" method="post" id="adminForm" name="adminForm">
	<div class="row-fluid">
		<div class="span6">
			<?php echo JText::_('COM_MINITHEATRECM_ULWIZSOURCES_FILTER'); ?>
			<?php
				echo JLayoutHelper::render(
					'joomla.searchtools.default',
					array('view' => $this)
				);
			?>
		</div>
	</div>
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
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_ULWIZSOURCES_NAME', 'wname', $listDirn, $listOrder) ;?>
				</th>
				<th width="2%">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_PUBLISHED', 'published', $listDirn, $listOrder) ;?>
				</th>
				<th width="3%">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_ID', 'id', $listDirn, $listOrder) ;?>
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
				$link = JRoute::_('index.php?option=com_minitheatrecm&task=ulwizsource.edit&id=' . $row->id); ?>

			<tr>
				<td>
					<?php echo $this->pagination->getRowOffset($i); ?>
				</td>
				<td>
					<?php echo JHtml::_('grid.id', $i, $row->id); ?>
				</td>
				<td>
					<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_EDIT_ULWIZSOURCE'); ?>">
						<?php echo $row->wname; ?>
					</a>
				</td>
				<td align="center">
					<?php echo JHtml::_('jgrid.published', $row->published, $i, 'ulwizsources.', true, 'cb'); ?>
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
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
</form>