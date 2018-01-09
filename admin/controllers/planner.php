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
 * Planner Controller
 *
 * @since  0.0.1
 */
class MiniTheatreCMControllerPlanner extends JControllerAdmin
{
	const CTASKS = array('roadmap','manifest','tasks','changelog');
	const TPARAM = 'update'; 
	
	public function view()
	{
		// Initialize
		$app	= JFactory::getApplication();
		
		// Load Parameters
		$u		= $app->input->get(self::TPARAM, '', 'CMD');
		$u		= trim($u, '.');
		$u		= explode('.', $u, 2);
		
		// Validate
		if( !empty($u[0]) && in_array($u[0],self::CTASKS) )
		{
			// Save state data if applicable
			if( isset($u[1]) )
			{
				$app->setUserState( 'com_minitheatrecm.planner.'.$u[0], $u[1] );
			}
		}
		
		$app->redirect(JRoute::_('index.php?option=com_minitheatrecm&view=planner',false));
	}
}