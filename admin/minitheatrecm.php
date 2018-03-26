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

/* Setting the icon:
 * Set some global property
 * $document = JFactory::getDocument();
 * $document->addStyleDeclaration('.icon-helloworld {background-image: url(../media/com_helloworld/images/Tux-16x16.png);}');
 */
 
// Access check: is this user allowed to access the backend of this component?
if (!JFactory::getUser()->authorise('core.manage', 'com_minitheatrecm'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include Dependencies
JLoader::discover('Neon', JPATH_COMPONENT_ADMINISTRATOR . '/lib/src');
JLoader::register('MiniTheatreCMHelper', JPATH_COMPONENT_ADMINISTRATOR . '/helpers/minitheatrecm.php');
JLoader::register('NeonDataEscape', JPATH_COMPONENT_ADMINISTRATOR . '/lib/data/escape.php');

// Load the controller, execute the task, and redirect if required
$controller = JControllerLegacy::getInstance('MiniTheatreCM');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();