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
JLoader::Register('MiniTheatreCMHelperNfo', JPATH_COMPONENT_ADMINISTRATOR . '/helpers/nfo.php');
JLoader::Register('MiniTheatreCMHelperConfig', JPATH_COMPONENT_ADMINISTRATOR . '/helpers/config.php');

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
		return MiniTheatreCMHelperConfig::getOverviewType();
	}
	
	// Methods to get 'Items' Data
	public function getItemsData()
	{
		//Init
		$db = JFactory::getDbo();
		$data = array();
		
		// Query - All
		$query = $db->getQuery(true);
		$query->select('COUNT(*)')->from($db->quoteName('#__mtcm_items'));
		$db->setQuery($query);
		$data["count"] = $db->loadResult();
		
		return $data;
	}
	
	// Methods to load nfo data
	public function getVersion()
	{
		return MiniTheatreCMHelperNfo::getVersion();
	}
	
	public function getChangelogs()
	{
		return MiniTheatreCMHelperNfo::getChangelogs();
	}
	
	public function getTasks()
	{
		return MiniTheatreCMHelperNfo::getTasks();
	}
}