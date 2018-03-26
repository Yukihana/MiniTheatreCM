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
JLoader::Register('NeonHtmlForm', JPATH_COMPONENT_ADMINISTRATOR . '/lib/html/form.php');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
JHtml::_('formbehavior.chosen', '.multipleGenres',			null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTGENRE')));
JHtml::_('formbehavior.chosen', '.multipleStudios',			null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTSTUDIO')));
JHtml::_('formbehavior.chosen', '.multipleProducers',		null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTPRODUCER')));
JHtml::_('formbehavior.chosen', '.multipleLicensors',		null, array('placeholder_text_multiple' => JText::_('COM_MINITHEATRECM_HINT_SELECTLICENSOR')));
JHtml::_('formbehavior.chosen', 'select');
?>

<form action="<?php echo JRoute::_('index.php?option=com_minitheatrecm&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate clearfix">
	
	<?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
	
    <div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTabset', array('active' => 'desc')); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTabset', 'desc', JText::_('COM_MINITHEATRECM_DICTIONARY_DESCRIPTION')); ?>
		<div class="row-fluid">
			<div class="span9">
				<fieldset class="adminform">
					<?php echo $this->form->getInput('content'); ?>
				</fieldset>
			</div>
			<div class="span3">
				<?php echo $this->form->renderFieldset('metaglobal', array('class'=>'form-vertical')); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTabset', 'details', JText::_('COM_MINITHEATRECM_DICTIONARY_DETAILS')); ?>
		<div class="row-fluid">
			<div class="span9">
				<?php echo $this->form->getInput('specifics'); ?>
			</div>
			<div class="span3">
				<?php echo $this->form->renderFieldset('airing', array('class'=>'form-vertical')); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTabset', 'production', JText::_('COM_MINITHEATRECM_DICTIONARY_PRODUCTION')); ?>
		<div class="row-fluid">
			<div class="span9">
				<?php echo $this->form->getInput('crew'); ?>
			</div>
			<div class="span3">
				<?php echo $this->form->renderFieldset('categorisation', array('class'=>'form-vertical')); ?>
				<?php echo $this->form->renderFieldset('production', array('class'=>'form-vertical')); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTabset', 'medialinks', JText::_('COM_MINITHEATRECM_DICTIONARY_MEDIA')); ?>
		<div class="row-fluid">
			<div class="span6">
				<!--Media here-->
			</div>
			<div class="span6">
				<?php echo $this->form->renderFieldset('links');?>
				<?php echo $this->form->renderFieldset('videos'); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTabset', 'publishing', JText::_('COM_MINITHEATRECM_DICTIONARY_PUBLISHING')); ?>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->form->renderFieldset('publishing'); ?>
				<?php echo $this->form->renderField('id'); ?>
			</div>
			<div class="span6">
				<?php echo NeonHtmlForm::renderStatsDisplay($this->item->hits, $this->item->votes, $this->item->rating, $this->item->recommends); ?>
				<?php echo $this->form->renderFieldset('pubtools'); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTabset', 'options', JText::_('COM_MINITHEATRECM_DICTIONARY_OPTIONS')); ?>
		<div class="row-fluid">
			<div class="span6">
			</div>
			<div class="span6">
				<?php echo $this->form->getInput('metatools'); ?>
				<div class="controls">
					<a href="#" class="btn btn-inverse"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_FETCH');?></a>
				</div>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTabset', 'permissions', JText::_('COM_MINITHEATRECM_DICTIONARY_PERMISSIONS')); ?>
		<div class="row-fluid">
			<?php echo $this->form->getInput('rules'); ?>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
    </div>
	
    <input type="hidden" name="task" value="catalogue.edit" />
    <?php echo JHtml::_('form.token'); ?>
	
</form>