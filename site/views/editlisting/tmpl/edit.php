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

<h3><?php echo JText::_('COM_MINITHEATRECM_EDITLISTING_HEADING'); ?></h3>

<?php if( ! $this->iAuthorized ): ?>
<div class="alert">
	<h4 class="alert-heading"><?php echo JText::_('JGLOBAL_AUTH_ACCESS_DENIED');?></h4>
	<div class="alert-message">
		<?php echo JText::_('COM_MINITHEATRECM_MESSAGE_NOPERMISSIONS')?>
		<a href="javascript:history.back();" title="<?php echo JText::_('COM_MINITHEATRECM_ACTION_GOBACK_DESC'); ?>"><?php echo JText::_('COM_MINITHEATRECM_ACTION_GOBACK'); ?></a>
	</div>
</div>

<?php else: ?>
<div>
	Listing Edit form to be loaded here. Available Data:
	<ol>
		<li>Name: <?php echo $this->iListingName;?></li>
		<li>Content: <?php echo $this->iListingContent;?></li>
		<li>Information: <?php echo $this->iListingInfo;?></li>
		<li>Last Modified On: <?php echo $this->iLastModified;?></li>
		<li>Listing ID: <?php echo $this->iListingId;?></li>
		<li>Live: <?php echo JText::_( $this->iUserLive ? 'JYES' : 'JNO' ); if($this->iItemState != 1) echo ' (N/A)';?></li>
		<li>Author Name: <?php echo $this->iLoggedRealName;?></li>
		
		<?php if($this->iItemState == 0): ?>
		<li>Item State: <?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_REQUESTED');?></li>
		<li>Requested Item: <?php echo $this->iRequestName;?></li>
		<li>Requested Item Description: <?php echo $this->iRequestDesc;?></li>
		
		<?php elseif($this->iItemState == 1): ?>
		<li>Item State: <?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_EXISTS');?></li>
		<li>Associated Item ID: <?php echo $this->iItemId;?></li>
		<li>Associated Item Name: <?php echo $this->iItemName;?></li>
		
		<?php else: ?>
		<li>Item State: <?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_MISSING');?></li>
		<li>Associated Item ID: <?php echo $this->iItemId;?></li>
		<?php endif;?>
	<ol>
</div>
<?php endif; ?>