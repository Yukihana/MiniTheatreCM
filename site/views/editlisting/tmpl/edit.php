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
?>

<h3><?php echo JText::_('COM_MINITHEATRECM_EDITLISTING_HEADING'); ?></h3>

<?php if( ! $this->auth ): ?>
<div class="alert">
	<h4 class="alert-heading"><?php echo JText::_('JGLOBAL_AUTH_ACCESS_DENIED');?></h4>
	<div class="alert-message">
		<?php echo JText::_('COM_MINITHEATRECM_MESSAGE_NOPERMISSIONS')?>
		<a href="javascript:history.back();" title="<?php echo JText::_('COM_MINITHEATRECM_ACTION_GOBACK_DESC'); ?>"><?php echo JText::_('COM_MINITHEATRECM_ACTION_GOBACK'); ?></a>
	</div>
</div>

<?php else: ?>
<div>
	<p>Listing Data:</p>
	<ol>
		<li><?php echo JText::_('JID')				.': '.$this->data->id;?></li>
		<li><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_NAME')			.': '.$this->data->name;?></li>
		<li><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_CONTENT')			.': '.$this->data->content;?></li>
		<li><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_INFORMATION')		.': '.$this->data->description;?></li>
		<br/>
		<li><?php echo JText::_('JAUTHOR')										.': '.$this->user->name;?></li>
		<li><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_LASTMODIFIEDON')	.': '.$this->data->modified;?></li>
		<li><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_LIVE')			.': '.JText::_( $this->data->live ? 'JYES' : 'JNO' );
			if( $this->itemdata->state != 1 ) echo ' (N/A)';?></li>
	</ol>
	<p>Item Data:</p>
	<ol>
		<?php if($this->itemdata->state == 0): ?>
		<li>Item State: <?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_REQUESTED');?></li>
		<li>Requested Item: <?php echo $this->data->requestname;?></li>
		<li>Requested Item Description: <?php echo $this->data->requestdesc;?></li>
		
		<?php elseif($this->itemdata->state == 1): ?>
		<li>Item State: <?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_EXISTS');?></li>
		<li>Associated Item ID: <?php echo $this->itemdata->id;?></li>
		<li>Associated Item Name: <?php echo $this->itemdata->name;?></li>
		
		<?php else: ?>
		<li>Item State: <?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_MISSING');?></li>
		<li>Associated Item ID: <?php echo $this->itemdata->id;?></li>
		<?php endif;?>
	<ol>
</div>
<?php endif; ?>