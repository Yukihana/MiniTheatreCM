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

/**
 * Dashboard View
 *
 * @since  0.0.1
 */
class MiniTheatreCMViewDashboard extends NeonViewBase
{
	protected $ui_submenu	= 'dashboard';
	protected $ui_title		= 'COM_MINITHEATRECM_TITLE_DASHBOARD';
	protected $ui_icon		= 'home';

	// Add page header and toolbar buttons
	protected function addToolBar()
	{
		JToolbarHelper::preferences('com_minitheatrecm');
	}
}