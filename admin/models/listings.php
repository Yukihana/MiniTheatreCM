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

// Include the Lib/ModelHelper Static Class
JLoader::Register('MiniTheatreCMHelperModel', JPATH_COMPONENT_ADMINISTRATOR . '/helpers/model.php');

/**
 * Listings Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelListings extends JModelList
{
	// SQL Query to load List Data
	protected function getListQuery()
	{
		// Load required records from the database
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*')->from($db->quoteName('#__mtcm_listings'));
		$db->setQuery($query);		
		
		return $query;
	}
	
	public function getUsernames()
	{
		return MiniTheatreCMHelperModel::getUsernames( $this->getItems(), array('author','recentedit') );
	}
	
	public function getUsergroups()
	{
		return MiniTheatreCMHelperModel::getUsergroups( $this->getItems(), array('access') );
	}
	
	public function getItemnames()
	{
		return MiniTheatreCMHelperModel::getItemnames( $this->getItems(), array('item_id') );
	}
}