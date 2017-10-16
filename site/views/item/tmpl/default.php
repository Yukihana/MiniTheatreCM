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

<?php if( !$this->LoggedIn ) : ?>
<div class="alert alert-warning">
	<?php echo JText::_('JGLOBAL_YOU_MUST_LOGIN_FIRST'); ?>
</div>

<?php elseif( $this->Exists == 0 ) : ?>
<div class="alert alert-warning">
	<?php echo JText::_('COM_MINITHEATRECM_MESSAGE_ENTERVALIDID'); ?>
</div>

<?php elseif( $this->Exists != 1 ): ?>
<div class="alert alert-warning">
	<?php echo JText::_('COM_MINITHEATRECM_MESSAGE_ITEMMISSING'); ?>
</div>

<?php else : ?>
<h3><?php echo $this->iName; ?></h3>
<div><?php echo $this->iContent; ?></div>

<div class="alert alert-info">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<h4 class="alert-heading"><?php echo JText::_('COM_MINITHEATRECM_DICTIONARY_NOTE').':';?></h4>
	<ul class="alert-message">
		<li>The item's title and description (as displayed above) has been fetched from a record in the database.</li>
		<li>Layout, functionality and more data will be added to the page later on</li>
		<li>This item with its data is a dummy, and is kept only for testing purposes.</li>
		<li>This notice will be removed in the final version of the component.</li>
	</ul>
</div>
<?php endif;?>