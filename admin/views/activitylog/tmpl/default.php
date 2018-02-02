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

<form action="index.php?option=com_minitheatrecm&view=activitylog" method="post" id="adminForm" name="adminForm" class="clearfix">
	<?php if (!empty( $this->sidebar)) : ?>
		<div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
		</div>
		<div id="j-main-container" class="span10">
	<?php else : ?>
		<div id="j-main-container">
	<?php endif; ?>
	
		<h3 class="page-header">ACTIVITY LOG SHOWN HERE</h3>
		<p class="disabled"><i>This is the pre-layout display</i></p>
		
		<?php /* echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); */ ?>
		
		<?php if (empty($this->items)) : ?>
		<div class="alert alert-no-items">
			<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
		</div>
		
		<?php else : ?>
		<div class="table table-striped table-hover">
			<?php
				foreach($this->items as $item)
				{
					echo '<p class="row-striped">Some activity done by user '.$item->user_id.' on record-id '.$item->target_id.' of type '.$item->target_type.' from the '.($item->interface ? 'administration' : 'frontend').' interface.</p>';
				}
			?>
		</div>
		<?php endif; ?>
		
		<?php echo $this->pagination->getListFooter(); ?>
	</div>
</form>
