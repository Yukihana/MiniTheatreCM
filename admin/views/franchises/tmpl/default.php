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
JLoader::Register('MiniTheatreCMCfgGlobal', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/global.php');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', '.multipleGenres',			null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTGENRE')));
JHtml::_('formbehavior.chosen', '.multipleAuthors',			null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTAUTHOR')));
JHtml::_('formbehavior.chosen', '.multipleAccesses',		null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTACCESS')));
JHtml::_('formbehavior.chosen', '.multipleRecentEditors',	null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTRECENTEDITOR')));
JHtml::_('formbehavior.chosen', 'select');

$listOrder		= $this->escape($this->state->get('list.ordering'));
$listDirn		= $this->escape($this->state->get('list.direction'));

$accesslink		= MiniTheatreCMCfgGlobal::getManagerLinkable('access');
$userlink		= MiniTheatreCMCfgGlobal::getManagerLinkable('user');
$genrelink		= MiniTheatreCMCfgGlobal::getManagerLinkable('genre');

$access_col		= NeonHtmlManager::getOrdering($listOrder, 'gp.title', 'COM_MINITHEATRECM_DICTIONARY_ACCESS',
					array('COM_MINITHEATRECM_DICTIONARY_ACCESSGROUP'=>'gp.title', 'COM_MINITHEATRECM_DICTIONARY_ACCESSID'=>'a.access'));
$editor_col		= NeonHtmlManager::getOrdering($listOrder, 'a.author', 'COM_MINITHEATRECM_DICTIONARY_EDITORS',
					array('COM_MINITHEATRECM_DICTIONARY_AUTHOR'=>'a.author, u1.name', 'COM_MINITHEATRECM_DICTIONARY_RECENTEDIT'=>'a.recentedit, u2.name'));
$timestamp_col	= NeonHtmlManager::getOrdering($listOrder, 'a.created', 'COM_MINITHEATRECM_DICTIONARY_TIMESTAMPS',
					array('COM_MINITHEATRECM_DICTIONARY_CREATED'=>'a.created', 'COM_MINITHEATRECM_DICTIONARY_RECENTEDIT'=>'a.modified'));
$stats_col		= NeonHtmlManager::getOrdering($listOrder, 'a.hits', 'COM_MINITHEATRECM_DICTIONARY_STATS',
					array('COM_MINITHEATRECM_DICTIONARY_HITS'=>'a.hits', 'COM_MINITHEATRECM_DICTIONARY_VOTES'=>'a.votes'));
?>

<form action="index.php?option=com_minitheatrecm&view=franchises" method="post" id="adminForm" name="adminForm" class="clearfix">
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
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_DICTIONARY_STATUS', 'a.state', $listDirn, $listOrder) ;?>
					</th>
					<th width="45%" class="nowrap">
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_MAINCOLUMN_CATALOGUE', 'a.name', $listDirn, $listOrder) ;?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', $access_col->text, $access_col->order, $listDirn, $listOrder) ;?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', $editor_col->text, $editor_col->order, $listDirn, $listOrder);?>
					</th>
					<th width="10%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', $timestamp_col->text, $timestamp_col->order, $listDirn, $listOrder);?>
					</th>
					<th width="1%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', $stats_col->text, $stats_col->order, $listDirn, $listOrder);?>
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
					<td colspan="9">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			
				<?php foreach ($this->items as $i => $row) : $link = JRoute::_('index.php?option=com_minitheatrecm&task=franchise.edit&id=' . $row->id); ?>
				<tr>
					<td class="center">
						<?php echo JHtml::_('grid.id', $i, $row->id); ?>
					</td>
					<td class="nowrap center">
						<?php echo NeonHtmlManager::renderTaskButtons( $row->state, $i, 'franchises.', true, $row->publish_up, $row->publish_down );?>
					</td>
					<td>
						<div class="pull-left">
							<div>
								<?php echo NeonHtmlManager::renderMain($this->escape($row->name), $link, 'COM_MINITHEATRECM_TOOLTIP_EDIT_FRANCHISE')
											.' '.NeonHtmlManager::renderAltNames($this->escape($row->altnames));?>
							</div>
							<div class="hidden-phone">
								<?php echo NeonHtmlManager::renderAlias($this->escape($row->alias))
											.' '.NeonHtmlManager::renderGenreIcons($row->genres_json, $genrelink);?>
							</div>
						</div>
					</td>
					<td class="small nowrap hidden-phone">
						<?php echo NeonHtmlManager::renderAccessCell($row->access_name, $row->access, $accesslink, $access_col->index);?>
					</td>
					<td class="hidden-phone">					
						<?php echo NeonHtmlManager::renderEditorCell(
							$row->author,		$row->author_user,		$row->author_name,
							$row->recentedit,	$row->recentedit_user,	$row->recentedit_name,
							$userlink, $editor_col->index);?>
					</td>
					<td class="hidden-phone">
						<?php echo NeonHtmlManager::renderTimestampCell($row->created, $row->modified, $timestamp_col->index); ?>
					</td>
					<td class="<?php echo ($stats_col->index!=0)?'center':'';?> hidden-phone">
						<?php echo NeonHtmlManager::renderStatsCell($row->hits, $row->votes, $stats_col->index); ?>
					</td>
					<td class="center hidden-phone">
						<?php echo NeonHtmlManager::renderStarRatingCell($row->rating, true);?>
					</td>
					<td class="nowrap" style="text-align:right;">
						<?php echo $row->id; ?>
					</td>
				</tr>			
				<?php endforeach; ?>
				
			</tbody>
		</table>
		<?php endif;?>
		
		<?php echo NeonHtmlManager::getListFooter($this->pagination->total, count($this->items), $this->querytime);?>
		
		<?php echo JHtml::_('form.token'); ?>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
	</div>
</form>