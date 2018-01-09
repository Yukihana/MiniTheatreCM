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
JLoader::Register('NeonNfoChangelog', JPATH_COMPONENT_ADMINISTRATOR . '/lib/nfo/changelog.php');

// Tabs: To be removed after full ajax implementation
if( empty($this->utype))
{
	JHtml::_('behavior.tabstate');
}
$deftab			= empty($this->utype)? 'roadmap' : $this->utype;

$app		= JFactory::getApplication();
$context	= 'com_minitheatrecm.planner.';

$iver			= MiniTheatreCMCfgSettings::getIVersion();
$version_str	= 'ver';
$changelog_str	= 'clog';
$changelog_id	= $app->getUserState('com_minitheatrecm.planner.changelog',0);

// Inline Javascript Declaration for AJAX-FW
JFactory::getDocument()->addScriptDeclaration('
	var '.$changelog_str.'_loader = "'.str_replace('"', '\\"', NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_PLEASEWAIT', 'COM_MINITHEATRECM_DICTIONARY_LOADING', false, 'info')).'";
	var '.$changelog_str.'_error = "'.str_replace('"', '\\"', NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_ERRORUNABLETOPROCEED', 'COM_MINITHEATRECM_DICTIONARY_ERROR', false, 'warning')).'";
	var '.$changelog_str.'_error403 = "'.str_replace('"', '\\"', NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_NOACCESS', 'COM_MINITHEATRECM_DICTIONARY_ACCESSDENIED', false, 'warning')).'";
	var '.$changelog_str.'_error404 = "'.str_replace('"', '\\"', NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_PROVIDEVALIDID', 'COM_MINITHEATRECM_MESSAGE_404', false, 'warning')).'";
	var '.$changelog_str.'_timeout =  "'.str_replace('"', '\\"', NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_TIMEDOUT', 'COM_MINITHEATRECM_DICTIONARY_TIMEOUT', false, 'error')).'";
	function listjax(srclist,linker)
	{
		var sl = document.getElementById(srclist);
		var id = sl.options[sl.selectedIndex].value;
		neonAjaxContent(unescape(linker+id.toString()), "'.$changelog_str.'_ajax", "'.$changelog_str.'_");
	}
');
?>

<form action="index.php?option=com_minitheatrecm&view=planner" method="post" name="adminForm" id="adminForm">
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
			
			<?php echo JHtml::_('bootstrap.addTab', 'mtcmplanner', 'task', JText::_('COM_MINITHEATRECM_DICTIONARY_TASKS')); ?>
				TASKS DATA
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.addTab', 'mtcmplanner', 'changelog', JText::_('COM_MINITHEATRECM_DICTIONARY_CHANGELOGS')); ?>
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
									<a href="<?php echo $link;?>" class="hasTooltip" title="<?php echo JText::_('COM_MINITHEATRECM_TOOLTIP_VIEW_CLOG');?>" onclick="javascript:neonAjaxContent('<?php echo $link.'&format=raw';?>', '<?php echo $changelog_str;?>_ajax', '<?php echo $changelog_str;?>_');">
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
						<?php echo JHtml::_('select.genericlist', $this->voptions, 'clogindex', array('onchange' => 'listjax(\'clogindex\', \'index.php?option=com_minitheatrecm&task=planner.view&format=raw&update=changelog.\');', 'class' => 'input-xlarge'), 'value', 'text', $changelog_id, 'clogindex'); ?>
					</div>
					<div id="clog_ajax" class="well">
						<?php echo ( $this->changelog != null ) ? NeonNfoChangelog::render($this->changelog) : NeonHtmlMessages::_('COM_MINITHEATRECM_MESSAGE_PROVIDEVALIDID', 'COM_MINITHEATRECM_MESSAGE_404', false, 'warning'); ?>
					</div>
				</div>
			<?php echo JHtml::_('bootstrap.endTab'); ?>
			
			<?php echo JHtml::_('bootstrap.endTabSet'); ?>
		</div>
		<div>Debug = <?php echo $deftab?></div>
	</div>
</form>