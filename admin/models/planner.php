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
JLoader::Register('NeonModelLegacy', JPATH_COMPONENT_ADMINISTRATOR . '/lib/src/modellegacy.php');
JLoader::Register('NeonNfoFilebase', JPATH_COMPONENT_ADMINISTRATOR . '/lib/nfo/filebase.php');
JLoader::Register('NeonNfoTasks', JPATH_COMPONENT_ADMINISTRATOR . '/lib/nfo/tasks.php');

/**
 * Planner Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelPlanner extends NeonModelLegacy
{
	protected $cloglist;
	
	public function populateState()
	{
		$this->forwardState('com_minitheatrecm.planner.', 'tabview', 'CMD', 'roadmap');
		// Clog
		$this->forwardState('com_minitheatrecm.planner.clog.', 'index', 'INT', 0, 'clogindex' );
		$this->forwardState('com_minitheatrecm.planner.clog.', 'limitstart', 'INT', 0, 'cloglimitstart' );
		
		parent::populateState();
	}
	
	// ChangeLogs
	public function getChangeLogList()
	{
		if( !isset( $this->cloglist ))
		{
			$this->cloglist = NeonNfoFilebase::getList('changelogs');
		}
		
		$limitstart = JFactory::getApplication()->getUserState('com_minitheatrecm.planner.clog.limitstart', 0);
		return NeonNfoFilebase::getListQuery($this->cloglist, (int)$limitstart, 'clog');
	}
	
	public function getChangeLog()
	{
		if( !isset( $this->cloglist ))
		{
			$this->cloglist = NeonNfoFilebase::getList('changelogs');
		}
		
		$id = JFactory::getApplication()->getUserState('com_minitheatrecm.planner.clog.index', 0);
		return NeonNfoTasks::renderChangeLog( NeonNfoFilebase::getFilePath($this->cloglist, $id) );
	}
	

}