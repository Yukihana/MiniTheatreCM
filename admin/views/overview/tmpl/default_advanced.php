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
		
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'updates')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'storage', JText::_('COM_MINITHEATRECM_DICTIONARY_STORAGE')); ?>
			Storage Data here
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'meta', JText::_('COM_MINITHEATRECM_DICTIONARY_META')); ?>
			Meta Info Here
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'roadmap', JText::_('COM_MINITHEATRECM_DICTIONARY_ROADMAP')); ?>
			Meta Info Here
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'updates', JText::_('COM_MINITHEATRECM_DICTIONARY_UPDATES')); ?>
			<div class="mtcm-flex">
				<div id="mtcm-clog-left" class="mtcm-flex-spread-270 mtcm-padding-3">
					<h2 class="page-header"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_UPCOMINGTASKS');?></h2>
					<div class="row-fluid">
						<div class="btn-group">
							<?php $taberindex=0; foreach( array( 'active'=>'lightning', 'pending'=>'clock', 'postponed'=>'flag') as $navtab => $navicon ): ?>
								<a class="btn btn-micro hasTooltip" href="javascript:void(0);" onclick="javascript:mtcmTaberNav('mtcm-tasks-','<?php echo $navtab;?>');"
									title="<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_'.strtoupper($navtab));?>">
									<span class="icon-<?php echo $navicon;?>"> </span>
								</a>
							<?php $taberindex++; endforeach;?>
						</div>
						<div id="mtcm-tasks-index" class="pull-right">Active</div>
					</div>
					<div id="mtcm-tasks-taber" class="mtcm-padding-6v">
						<div class="row-fluid mtcm-rmap-active">
							<h3 class="module-title nav-header"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_ACTIVE');?></h3>
							<ul class="row-striped">
								<li class="row-fluid">sometext</li>
								<li class="row-fluid">sometext</li>
								<li class="row-fluid">sometext</li>
							</ul>
						</div>
					</div>
				</div>
				
				<div id="mtcm-clog-right" class="mtcm-flex-spread-270 mtcm-padding-3">
					<h2 class="page-header"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_CHANGELOG');?></h2>
					<div class="row-fluid">
						<div class="btn-group">
							<?php foreach(array('first', 'previous', 'next', 'last') as $navicon): ?>
								<a class="btn btn-micro hasTooltip" id="clog-paging-<?php echo $navicon;?>" href="javascript:void(0);" 
									onclick="javascript:mtcmPagerNav('mtcm-clog-','<?php echo $navicon;?>');" title="<?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_'.strtoupper($navicon));?>">
									<span class="icon-<?php echo $navicon;?>"> </span>
								</a>
							<?php endforeach;?>
						</div>
						<div id="mtcm-clog-index" class="pull-right">Latest</div>
					</div>
					<div id="mtcm-clog-pager" class="mtcm-padding-6v" activeindex="0">
						<?php foreach($this->clog as $clog): ?>
						<div class="mtcm-clog" <?php if($clog->id!=0) echo 'style="display:none;"';?> name="mtcm-clog-entry">
							<div>
								<div class="pull-right small mtcm-margin-6h"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_UPDATED').': '.$clog->updated;?></div>
								<h3 class="module-title nav-header"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_VERSION').' '.$clog->version;?></h3>
							</div>
							<ul class="row-striped"><?php foreach($clog->data as $data) echo '<li class="row-fluid">'.$data.'</li>';?></ul>
						</div>
						<?php endforeach;?>
					</div>
				</div>
				
			</div>
		
		<?php echo JHtml::_('bootstrap.endTab'); ?>
	</div>
</form>