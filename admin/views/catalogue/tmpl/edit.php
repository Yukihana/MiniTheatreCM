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
JHtml::_('behavior.formvalidator');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');
?>

<form action="<?php echo JRoute::_('index.php?option=com_minitheatrecm&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
	
	<?php /*
	
	<fieldset class="adminform">
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('name');?></div>
			<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
		</div>
	</fieldset>

	<?php
	/**
	 * Supposedly works the same as the fieldset above but the code looks ambigious.
	 * Will keep this commented till I understand how this actually works.
	 */
	
	echo JLayoutHelper::render('joomla.edit.title_alias', $this);
	?>
	
    <div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'desc')); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'desc', JText::_('COM_MINITHEATRECM_DICTIONARY_DESCRIPTION')); ?>
		<div class="row-fluid">
			<div class="span9">
				<fieldset class="adminform">
					<?php echo $this->form->getInput('content'); ?>
				</fieldset>
			</div>
			<div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
				<hr/>
				<fieldset class="form-vertical">
					<?php echo $this->form->renderFieldset('associations'); ?>
				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'medialinks', JText::_('COM_MINITHEATRECM_DICTIONARY_MEDIAANDLINKS')); ?>
		<div class="row-fluid">
			<div class="span6">
				
			</div>
			<div class="span6">
				<?php echo $this->form->renderFieldset('websites');?>
				<?php echo $this->form->renderFieldset('videos');?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'metadata', JText::_('COM_MINITHEATRECM_DICTIONARY_METADATA')); ?>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->form->renderFieldset('metadata');?>
			</div>
			<div class="span6">
				<?php echo $this->form->renderFieldset('metatools');?>
				<div class="controls">
					<a href="#" class="btn btn-inverse"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_FETCH');?></a>
				</div>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'options', JText::_('COM_MINITHEATRECM_DICTIONARY_OPTIONS')); ?>
		<div class="row-fluid">
			<div class="span6">
				<?php echo $this->form->renderFieldset('publishing'); ?>
			</div>
			<div class="span6">
				<?php echo $this->form->renderFieldset('super'); ?>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('COM_MINITHEATRECM_DICTIONARY_PERMISSIONS')); ?>
		<div class="row-fluid">
		
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>
		
		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
    </div>
	
    <input type="hidden" name="task" value="catalogue.edit" />
    <?php echo JHtml::_('form.token'); ?>
	
</form>