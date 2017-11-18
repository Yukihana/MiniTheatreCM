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
JLoader::Register('NeonLibSiteErrorCheck', JPATH_COMPONENT_ADMINISTRATOR . '/lib/site/errorcheck.php');

// Queue Errors
NeonLibSiteErrorCheck::primaryError($this->auth);
?>

<?php if( $this->auth == 0 ):
	/*Actual layout starts here*/
?>
	<h3 class="page-header"><?php echo $this->itemdata->name; ?></h3>

	<?php echo JHtml::_('bootstrap.startTabSet', 'infoTabs', array('active' => 'synopsis')); ?>
	
	<?php echo JHtml::_('bootstrap.addTab', 'infoTabs', 'synopsis', JText::_('COM_MINITHEATRECM_DICTIONARY_SYNOPSIS')); ?>
		<div><?php echo $this->itemdata->synopsis; ?></div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	
	<?php echo JHtml::_('bootstrap.addTab', 'infoTabs', 'trailer', JText::_('COM_MINITHEATRECM_DICTIONARY_TRAILER')); ?>
		TRAILER
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	
	<?php echo JHtml::_('bootstrap.addTab', 'infoTabs', 'links', JText::_('COM_MINITHEATRECM_DICTIONARY_LINKS')); ?>
		LINKS
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.startTabSet', 'dataTabs', array('active' => 'listings')); ?>
	
	<?php echo JHtml::_('bootstrap.addTab', 'dataTabs', 'listings', JText::_('COM_MINITHEATRECM_DICTIONARY_LISTINGS')); ?>
		LISTINGS
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	
	<?php echo JHtml::_('bootstrap.addTab', 'dataTabs', 'reviews', JText::_('COM_MINITHEATRECM_DICTIONARY_REVIEWS')); ?>
		REVIEWS
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	
<?php endif;?>