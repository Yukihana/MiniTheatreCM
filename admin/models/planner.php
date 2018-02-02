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
JLoader::Register('NeonNfoVersions', JPATH_COMPONENT_ADMINISTRATOR . '/lib/nfo/versions.php');
JLoader::Register('NeonNfoChangelog', JPATH_COMPONENT_ADMINISTRATOR . '/lib/nfo/changelog.php');

/**
 * Planner Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelPlanner extends NeonModelLegacy
{
	protected $versions_list;
	protected $version_marker = 'ver';
	
	public function populateState()
	{
		$this->updateState('com_minitheatrecm.planner.'.$this->version_marker.'.limitstart', 0, 'INT', $this->version_marker.'limitstart' );
		
		parent::populateState();
	}
	
	// TabState Intuitive
	public function getUpdateType()
	{
		$app = JFactory::getApplication();
		$u = $app->input->get('update', '', 'CMD');
		trim($u, '.');
		$u = explode('.', $u, 2);			
		if( !empty($u[0]) )
		{
			if( in_array($u[0],array('roadmap','manifest','tasks','changelog')) && isset($u[1]) )
			{
				$app->setUserState( 'com_minitheatrecm.planner.'.$u[0], $u[1] );
			}
			return $u[0];
		}
		return null;
	}
	
	// Versions
	protected function initializeVData()
	{
		if( !isset( $this->versions_list ))
		{
			$this->versions_list = NeonNfoVersions::getList();
		}
	}
	public function getVOptions()
	{
		$this->initializeVData();
		return NeonNfoVersions::getOptions($this->versions_list);
	}
	public function getVList()
	{
		$this->initializeVData();
		$limitstart = JFactory::getApplication()->getUserState('com_minitheatrecm.planner.'.$this->version_marker.'.limitstart', 0);
		return NeonNfoVersions::getListQuery($this->versions_list, $limitstart, false);
	}
	public function getVPagination()
	{
		// Initialise
		$this->initializeVData();
		JLoader::import('joomla.html.pagination');
		
		// Prepare data
		$app		= JFactory::getApplication();
		$limitstart	= $app->getUserState('com_minitheatrecm.planner.'.$this->version_marker.'.limitstart', 0);
		$limit		= $app->get('list_limit');
		$total		= count( $this->versions_list );
		
		// Build and return
		return new JPagination( $total, $limitstart, $limit, $this->version_marker );
	}
	
	// Data: Changelog
	public function getChangelog()
	{
		$id = JFactory::getApplication()->getUserState('com_minitheatrecm.planner.changelog', null);
		$clog = new stdClass();
		$clog->meta = NeonNfoVersions::getData($id);
		$clog->tasks = NeonNfoChangelog::get($id);
		
		return $clog;
	}
}