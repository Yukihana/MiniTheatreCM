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

/* Setting the icon:
 * Set some global property
 * $document = JFactory::getDocument();
 * $document->addStyleDeclaration('.icon-helloworld {background-image: url(../media/com_helloworld/images/Tux-16x16.png);}');
 */

// Get an instance of the controller prefixed by MiniTheatreCM
$controller = JControllerLegacy::getInstance('MiniTheatreCM');

// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();