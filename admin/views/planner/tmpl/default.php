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
JLoader::Register('MiniTheatreCMCfgSettings', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/settings.php');
JLoader::Register('NeonHtmlMessages', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/messages.php');
JLoader::Register('NeonHtmlAjax', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/ajax.php');
JLoader::Register('NeonNfoChangelog', JPATH_COMPONENT_ADMINISTRATOR . '/lib/nfo/changelog.php');
JLoader::Register('NeonNfoNotebook', JPATH_COMPONENT_ADMINISTRATOR . '/lib/nfo/notebook.php');

// Tabs: To be removed after full ajax implementation
if( empty($this->utype))
{
	JHtml::_('behavior.tabstate');
}
$deftab		= empty($this->utype)? 'roadmap' : $this->utype;

$app		= JFactory::getApplication();
$context	= 'com_minitheatrecm.planner.';

$iver		= MiniTheatreCMCfgSettings::getIVersion();
$cprefix	= 'clog_';
$cid		= $app->getUserState('com_minitheatrecm.planner.changelog',0);
$c404		= ( $this->changelog->tasks == null );

// Inline Javascript Declaration for AJAX-FW (Try to add a php-renderer for the store)
JFactory::getDocument()->addScriptDeclaration('
	var '.$cprefix.'store = '.NeonHtmlAjax::renderBasic().';
	function listjax(srclist,linker)
	{
		var sl = document.getElementById(srclist);
		var id = sl.options[sl.selectedIndex].value;
		neonAce(unescape(linker+id.toString()), "'.$cprefix.'");
	}
');
?>

<form action="index.php?option=com_minitheatrecm&view=planner" method="post" id="adminForm" name="adminForm" class="clearfix">
	<?php if (!empty( $this->sidebar)) : ?>
		<div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
		</div>
		<div id="j-main-container" class="span10">
	<?php else : ?>
		<div id="j-main-container">
	<?php endif; ?>
		<div id="planner-tabset" class="clearfix">
			<?php echo JHtml::_('bootstrap.startTabSet', 'mtcmplanner', array('active' => $deftab)); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'mtcmplanner', 'roadmap', JText::_('COM_MINITHEATRECM_DICTIONARY_ROADMAP')); ?>
				ROADMAP DATA
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'mtcmplanner', 'manifest', JText::_('COM_MINITHEATRECM_DICTIONARY_MANIFEST')); ?>
				MANIFEST DATA
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'mtcmplanner', 'labs', JText::_('COM_MINITHEATRECM_DICTIONARY_LABS'));
				$rchpath = JPATH_COMPONENT_ADMINISTRATOR . '/data/nfo/research.php';
				if( file_exists( $rchpath )) { include( $rchpath ); }
				echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'mtcmplanner', 'notebook', JText::_('COM_MINITHEATRECM_DICTIONARY_NOTEBOOK')); ?>
				<div class="span6">
					<?php echo NeonNfoNotebook::renderTodo(); ?>
				</div>
				<div class="span6">
					<?php echo NeonNfoNotebook::renderIdeas(); ?>
					<?php echo NeonNfoNotebook::renderResearch(); ?>
					<?php echo NeonNfoNotebook::renderNotes(); ?>
				</div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'mtcmplanner', 'versions', JText::_('COM_MINITHEATRECM_DICTIONARY_VERSIONS')); ?>
				<div class="span6 jmoddiv hidden-phone">
					<table class="table table-striped table-hover">
						<thead>
							<th width="1%" style="text-align:right;">
								<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_NUM');?>
							</th>
							<th width="96%">
								<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_VERSION');?>
							</th>
							<th width="1%">
								<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_DATE');?>
							</th>
							<th width="1%">
								<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_TIME');?>
							</th>
							<th width="1%">
								<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_ZONE');?>
							</th>
						</thead>
						<tfoot>
							<tr>
								<td colspan="5">
									<?php echo $this->vpagination->getListFooter();?>
								</td>
							</tr>
						</tfoot>
						<tbody>
							<?php foreach($this->vlist as $row): $link=JRoute::_('index.php?option=com_minitheatrecm&task=planner.view&update=changelog.'.$row->version);?>
							<tr>
								<td style="text-align:right;">
									<?php echo NeonNfoChangelog::icon($row->changelog, 'bubble-quote');?>
								</td>
								<td class="nowrap">
									<a href="<?php echo $link;?>" class="hasTooltip" title="<?php echo JText::_('COM_MINITHEATRECM_TOOLTIP_VIEW_CLOG');?>" onclick="<?php echo "javascript:neonAce( '".$link."&format=raw', '".$cprefix."' );";?>">
										<?php echo $row->version;?>
									</a>
									<?php if($iver == $row->version){ echo '<span class="muted disabled">('.JText::_('COM_MINITHEATRECM_DICTIONARY_LATESTVERSION').')</span>'; }?>
								</td>
								<td class="nowrap" style="text-align:right;">
									<?php echo $row->date;?>
								</td>
								<td class="nowrap" style="text-align:right;">
									<?php echo $row->time;?>
								</td>
								<td class="nowrap" style="text-align:right;">
									<?php echo $row->zone;?>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
				<div class="span6">
					<div class="visible-phone">
						<?php echo JHtml::_('select.genericlist', $this->voptions, 'clogindex', array('onchange' => 'listjax(\'clogindex\', \'index.php?option=com_minitheatrecm&task=planner.view&format=raw&update=changelog.\');', 'class' => 'input-xlarge'), 'value', 'text', $cid, 'clogindex'); ?>
					</div>
					<div id="clog_container" style="position:relative;">
						<div id="clog_ajax" <?php if($c404 == true) echo 'style="filter:blur(3pt);pointer-events:none;"';?>>
							<?php if($c404 != true) echo NeonNfoChangelog::render($this->changelog);?>
						</div>
						<div id="clog_overlay" style="position:absolute;top:0%;left:50%;<?php if($c404 != true) echo 'visibility:hidden;';?>">
							<div id="clog_msgbox" class="well" style="margin: 20pt 50% auto -50%;background:white;border:1px solid #dedede;box-shadow:1pt 3pt 10pt rgba(0,0,0,0.3);">
								<?php echo NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_PROVIDEVALIDID', 'COM_MINITHEATRECM_MESSAGE_404', false, 'warning');?>
							</div>
						</div>
					</div>
				</div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.endTabSet'); ?>
		</div>
		<div>Debug = <?php echo $deftab;?></div>
	</div>
</form>