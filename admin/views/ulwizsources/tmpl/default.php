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
<form action="index.php?option=com_minitheatrecm&view=ulwizsources" method="post" id="adminForm" name="adminForm">
	<!--Yuki: Probably Unnecessary START
	<div class="row-fluid">
		<div class="span6">
			<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_FILTERS'); ?>
			-->
			<?php
				echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
			?>
			<!--Yuki: Probably Unnecessary END
		</div>
	</div>
	-->

	<?php if (empty($this->items)) : ?>
	<div class="alert alert-no-items">
		<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
	</div>

	<?php else : ?>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th width="3%">
					<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_NUM'); ?>
				</th>
				<th width="2%">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
				<th width="90%">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_TITLE', 'wname', $listDirn, $listOrder) ;?>
				</th>
				<th width="2%">
					<?php echo JHtml::_('grid.sort', 'COM_MINITHEATRECM_DICTIONARY_PUBLISHED', 'published', $listDirn, $listOrder) ;?>
				</th>
				<th width="3%">
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
					<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_MINITHEATRECM_ULWIZSOURCE_LEGEND_EDIT'); ?>">
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
	<?php endif;?>
	
	<?php echo JHtml::_('form.token'); ?>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
</form>
<div class="alert">
	<h4 class="alert-heading"><?php echo JText::_('COM_MINITHEATRECM_ADMIN_UPDATESTRING');?></h4>
	<ul class="alert-message">
		<li>This page will list the different upload wizards, each of which, can be editted to best fit the content they're uploading.</li>
		<li>These codes haven't been priorly debugged, and hence may contain errors. However, they shouldn't break the website.</li>
		<li>Inform me in case of missing translations, <i>e.g. All-caps texts like 'COM_MINITHEATRECM_SOMENAME_ETC'</i>.</li>
		<li>And in case of errors, <i>with the error message and details on how to recreate the event.</i></li>
	</ul>
</div>