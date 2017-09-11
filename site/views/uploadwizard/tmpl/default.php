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
<h1><?php echo JText::_('COM_MINITHEATRECM_UPLOADWIZARD_HEADING'); ?></h1>
<h3><?php echo $this->msg; ?></h3>
<div class="alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
	<h4 class="alert-heading"><?php echo JText::_('COM_MINITHEATRECM_SITE_UPDATESTRING');?></h4>
	<ul class="alert-message">
		<li>This is the page for the upload/submission wizard.</li>		
		<li>Data-model for this submission form is in the planning stage.</li>
		<li>The backend/management counterpart has to be coded/designed first.</li>
		<li>After that, the design stage, selectively based on the prototype.</li>
	</ul>
</div>