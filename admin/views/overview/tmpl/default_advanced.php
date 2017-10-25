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
		<div class="alert">
			<button type="button" class="close" data-dismiss="alert">Å~</button>
			<h4 class="alert-heading"><?php echo JText::_('COM_MINITHEATRECM_ADMIN_UPDATESTRING');?></h4>
			<ul class="alert-message">
				<li>These codes haven't been priorly debugged, and hence may contain errors. However, they shouldn't break the website.</li>
				<li>Inform me in case of missing translations, <i>e.g. All-caps texts like 'COM_MINITHEATRECM_SOMENAME_ETC'</i>.</li>
				<li>And in case of errors, <i>with the error message and details on how to recreate the event.</i></li>
			</ul>
		</div>
	</div>
</form>