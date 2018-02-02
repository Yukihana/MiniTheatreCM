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
JHtml::_('formbehavior.chosen', '.multipleItems',			null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTITEM')));
JHtml::_('formbehavior.chosen', '.multipleAuthors',			null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTAUTHOR')));
JHtml::_('formbehavior.chosen', '.multipleAccesses',		null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTACCESS')));
JHtml::_('formbehavior.chosen', '.multipleCatalogues',		null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTCATALOGUE')));
JHtml::_('formbehavior.chosen', '.multipleRecentEditors',	null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTRECENTEDITOR')));
JHtml::_('formbehavior.chosen', 'select');

$listOrder		= $this->escape($this->state->get('list.ordering'));
$listDirn		= $this->escape($this->state->get('list.direction'));

$accesslink		= MiniTheatreCMCfgGlobal::getManagerLinkable('access');
$userlink		= MiniTheatreCMCfgGlobal::getManagerLinkable('user');
$genrelink		= MiniTheatreCMCfgGlobal::getManagerLinkable('genre');
$cataloguelink	= MiniTheatreCMCfgGlobal::getManagerLinkable('catalogue');
$ctypelink		= MiniTheatreCMCfgGlobal::getManagerLinkable('contenttype');

$catalogue_col	= NeonHtmlManager::getOrdering($listOrder, 't.name', 'COM_MINITHEATRECM_DICTIONARY_CATALOGUE',
					array('t.name'=>'COM_MINITHEATRECM_DICTIONARY_CATALOGUENAME','a.catalogue'=>'COM_MINITHEATRECM_DICTIONARY_CATALOGUEID'));
$access_col		= NeonHtmlManager::getOrdering($listOrder, 'gp.title', 'COM_MINITHEATRECM_DICTIONARY_ACCESS',
					array('gp.title'=>'COM_MINITHEATRECM_DICTIONARY_ACCESSGROUP','a.access'=>'COM_MINITHEATRECM_DICTIONARY_ACCESSID'));
$editor_col		= NeonHtmlManager::getOrdering($listOrder, 'a.author', 'COM_MINITHEATRECM_DICTIONARY_EDITORS',
					array('a.author'=>'COM_MINITHEATRECM_DICTIONARY_AUTHOR', 'a.recentedit'=>'COM_MINITHEATRECM_DICTIONARY_RECENTEDIT'));
$timestamp_col	= NeonHtmlManager::getOrdering($listOrder, 'a.created', 'COM_MINITHEATRECM_DICTIONARY_TIMESTAMPS',
					array('a.created'=>'COM_MINITHEATRECM_DICTIONARY_CREATED', 'a.modified'=>'COM_MINITHEATRECM_DICTIONARY_RECENTEDIT'));
$stats_col		= NeonHtmlManager::getOrdering($listOrder, 'a.hits', 'COM_MINITHEATRECM_DICTIONARY_STATS',
					array('a.hits'=>'COM_MINITHEATRECM_DICTIONARY_HITS', 'a.votes'=>'COM_MINITHEATRECM_DICTIONARY_VOTES'));
?>

<form action="index.php?option=com_minitheatrecm&view=listings" method="post" id="adminForm" name="adminForm" class="clearfix">
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
						<?php echo JHtml::_('searchtools.sort', 'COM_MINITHEATRECM_MAINCOLUMN_LISTING', 'a.name', $listDirn, $listOrder) ;?>
					</th>
					<th width="20%" class="nowrap hidden-phone">
						<?php echo JHtml::_('searchtools.sort', $catalogue_col->text, $catalogue_col->order, $listDirn, $listOrder) ;?>
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
							<?php echo JHtml::_('jgrid.published', $row->state, $i, 'listings.', true, 'cb', $row->publish_up, $row->publish_down); ?>
						</div>
					</td>
					<td>
						<div class="pull-left">
							<div>
								<?php echo NeonHtmlManager::renderCTypeIcon($row->ctype_name, $row->ctype_color, $row->ctype, $ctypelink)
											.' '.NeonHtmlManager::renderMain($this->escape($row->name), $link, 'COM_MINITHEATRECM_TOOLTIP_EDIT_LISTING'); ?>
							</div>
							<div class="hidden-phone">
								<?php echo NeonHtmlManager::renderAlias($this->escape($row->alias));?>
							</div>
						</div>
					</td>
					<td class="small hidden-phone">
						<?php echo NeonHtmlManager::renderCatalogueCell($row->catalogue_name, $row->catalogue, $cataloguelink, $catalogue_col->index);?>
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