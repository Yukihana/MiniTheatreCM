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

<form action="index.php?option=com_minitheatrecm&view=mylistings" method="post" id="browseForm" name="browseForm">
	
	<div id="searchWrapper">
		<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
	</div>
	<div id="mainContainer">
	
	
	</div>
</form>