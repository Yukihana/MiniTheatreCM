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

// Include Static Helper Classes
JLoader::Register('MiniTheatreCMLibMtNfo', JPATH_COMPONENT_ADMINISTRATOR . '/lib/mt/nfo.php');
JLoader::Register('MiniTheatreCMMetaGlobal', JPATH_COMPONENT_ADMINISTRATOR . '/meta/global.php');
JLoader::Register('MiniTheatreCMMetaConfig', JPATH_COMPONENT_ADMINISTRATOR . '/meta/config.php');

/**
 * Overview Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelOverview extends JModelList
{
	// Method to check if Basic or Advanced
	public function getLayoutMode()
	{
		return MiniTheatreCMMetaGlobal::getOverviewType();
	}
	
	// Methods to get 'Items' Data (update code for this. Use arrays and foreach, individual is pain)
	public function getItemsData()
	{
		//Init
		$db = JFactory::getDbo();
		$data = array();
		
		// Query - All
		$query = $db->getQuery(true);
		$query->select('COUNT(*)')->from($db->quoteName(MiniTheatreCMMetaConfig::getTableName('items')));
		$db->setQuery($query);
		$data["count"] = $db->loadResult();
		
		return $data;
	}
	
	// Helper Methods
	public function getVersion()
	{
		return MiniTheatreCMLibMtNfo::getVersion();
	}
	public function getChangelogs()
	{
		return MiniTheatreCMLibMtNfo::getChangelogs();
	}
	public function getTasks()
	{
		return MiniTheatreCMLibMtNfo::getTasks();
	}
}