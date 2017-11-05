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

// Include Dependencies
JLoader::Register('MiniTheatreCMHelperModel', JPATH_COMPONENT_ADMINISTRATOR . '/helpers/model.php');
JLoader::Register('MiniTheatreCMMetaConfig', JPATH_COMPONENT_ADMINISTRATOR . '/meta/config.php');

/**
 * Franchises Model-List
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelFranchises extends JModelList
{
	// SQL Query to load List Data
	protected function getListQuery()
	{
		// Load records from the database
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*')->from($db->quoteName(MiniTheatreCMMetaConfig::getTableName('franchises')));
		$db->setQuery($query);		
		
		return $query;
	}
	
	// Helper Methods
	public function getUsernames()
	{
		return MiniTheatreCMHelperModel::getUsernames( $this->getItems(), array('author','recentedit') );
	}
	public function getUsergroups()
	{
		return MiniTheatreCMHelperModel::getUsergroups( $this->getItems(), array('access') );
	}
}