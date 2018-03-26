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

/**
 * Make thing clear
 *
 * @var JForm   $tmpl             The Empty form for template
 * @var array   $forms            Array of JForm instances for render the rows
 * @var bool    $multiple         The multiple state for the form field
 * @var int     $min              Count of minimum repeating in multiple mode
 * @var int     $max              Count of maximum repeating in multiple mode
 * @var string  $fieldname        The field name
 * @var string  $control          The forms control
 * @var string  $label            The field label
 * @var string  $description      The field description
 * @var array   $buttons          Array of the buttons that will be rendered
 * @var bool    $groupByFieldset  Whether group the subform fields by it`s fieldset
 */
extract($displayData);

$form = $forms[0];
?>

<?php /* Original Data
<div class="subform-wrapper">
<?php foreach ($form->getGroup('') as $field) : ?>
	<?php echo $field->renderField(); ?>
<?php endforeach; ?>
</div> */?>

<div class="subform-wrapper accordion">
	<div class="accordion-group">
		<div class="accordion-heading">
			<strong>
				<a class="accordion-toggle" data-toggle="collapse" data-target="#ctypemetagen"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_FILES');?></a>
			</strong>
		</div>
		<div class="accordion-body" id="ctypemetagen">
			<div class="accordion-inner">
				<div class="row-fluid">
					<div class="span6">
						<?php echo $form->renderField('metafilewrap');?>
						<?php echo $form->renderField('metafilecomp');?>
					</div>
					<div class="span6">
						<?php echo $form->renderField('metafilecount');?>
						<?php echo $form->renderField('metafilesizet');?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<strong>
				<a class="accordion-toggle collapsed" data-toggle="collapse" data-target="#ctypemetavideo"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_VIDEO');?></a>
			</strong>
		</div>
		<div class="accordion-body collapse" id="ctypemetavideo" style="height: 0px;">
			<div class="accordion-inner">
				<div class="row-fluid">
					<div class="span6">
						<?php echo $form->renderField('metavideoincluded');?>
						<?php echo $form->renderField('metavideoresolution');?>
						<?php echo $form->renderField('metavideowidth');?>
						<?php echo $form->renderField('metavideoheight');?>
						<?php echo $form->renderField('metavideoscanmode');?>
					</div>
					<div class="span6">
						<?php echo $form->renderField('metavideoencoder');?>
						<?php echo $form->renderField('metavideoencother');?>
						<?php echo $form->renderField('metavideofps');?>
						<?php echo $form->renderField('metavideobitrate');?>
						<?php echo $form->renderField('metavideoparams');?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<strong>
				<a class="accordion-toggle collapsed" data-toggle="collapse" data-target="#ctypemetaaudio"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_AUDIO');?></a>
			</strong>
		</div>
		<div class="accordion-body collapse" id="ctypemetaaudio" style="height: 0px;">
			<div class="accordion-inner">
				<div class="row-fluid">
					<div class="span6">
						<?php echo $form->renderField('metaaudioincluded');?>
						<?php echo $form->renderField('metaaudiocount');?>
						<?php echo $form->renderField('metaaudiodubbed');?>
						<?php echo $form->renderField('metaaudiolang');?>
					</div>
					<div class="span6">
						<?php echo $form->renderField('metaaudioencoder');?>
						<?php echo $form->renderField('metaaudioencother');?>
						<?php echo $form->renderField('metaaudiochannels');?>
						<?php echo $form->renderField('metaaudiobitrate');?>
						<?php echo $form->renderField('metaaudioparams');?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="accordion-group">
		<div class="accordion-heading">
			<strong>
				<a class="accordion-toggle collapsed" data-toggle="collapse" data-target="#ctypemetasubs"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_SUBTITLES');?></a>
			</strong>
		</div>
		<div class="accordion-body collapse" id="ctypemetasubs" style="height: 0px;">
			<div class="accordion-inner">
				<div class="row-fluid">
					<div class="span6">
						<?php echo $form->renderField('metasubincluded');?>
						<?php echo $form->renderField('metasubcount');?>
						<?php echo $form->renderField('metasublang');?>
					</div>
					<div class="span6">
						<?php echo $form->renderField('metasubformat');?>
						<?php echo $form->renderField('metasubformatother');?>
						<?php echo $form->renderField('metasubofficial');?>
						<?php echo $form->renderField('metasubfan');?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
