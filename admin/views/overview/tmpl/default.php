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

<form action="index.php?option=com_minitheatrecm&view=overview" method="post">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render();?>
	</div>
	
	<div id="j-main-container" class="span10">
		<div class="small text-right">
			<div class="hasTooltip mtcm-inline" title="<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_UPDATED').': '.$this->meta->updated;?>">
				<?php echo JText::_('COM_MINITHEATRECM_GLOBAL_LONGTITLE').' '.$this->meta->version;?>
			</div>
		</div>
		
		<div class="alert">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<h4 class="alert-heading"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_WIP');?></h4>
			<ul class="alert-message">
				<li>These codes haven't been properly debugged, and hence may contain errors. However, they shouldn't break the website.</li>
				<li>Inform me in case of missing translations, <i>e.g. All-caps texts like 'COM_MINITHEATRECM_SOMENAME_ETC'</i>.</li>
				<li>And in case of errors, <i>with the error message and details on how to recreate the event.</i></li>
			</ul>
		</div>
		
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'roadmap')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'storage', JText::_('COM_MINITHEATRECM_DICTIONARY_STORAGE')); ?>
			Storage Data here
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'meta', JText::_('COM_MINITHEATRECM_DICTIONARY_META')); ?>
			Meta Info Here
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'roadmap', JText::_('COM_MINITHEATRECM_DICTIONARY_ROADMAP')); ?>
			<div class="mtcm-flex">
				<div id="mtcm-clog-left" class="mtcm-flex-spread">
					<h2 class="page-header"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_CHANGELOG');?></h2>
				</div>
				
				<div id="mtcm-clog-right" class="mtcm-flex-spread">
					<h2 class="page-header"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_CHANGELOG');?></h2>
					<?php foreach($this->clog as $clog): ?>
					<div class="mtcm-clog mtcm-margin-3" id="mtcm-clog-<?php echo $clog->id;?>">
						<div>
							<div class="pull-right small mtcm-clog-timestamp"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_UPDATED').': '.$clog->updated;?></div>
							<h3 class="module-title nav-header"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_VERSION').' '.$clog->version;?></h3>
						</div>
						<ul class="row-striped"><?php foreach($clog->data as $data) echo '<li class="row-fluid">'.$data.'</li>';?></ul>
					</div>
					<?php endforeach;?>
				</div>
				
			</div>
		
		<?php echo JHtml::_('bootstrap.endTab'); ?>
	</div>
</form>