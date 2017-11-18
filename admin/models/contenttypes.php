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
JLoader::Register('NeonLibMtModel', JPATH_COMPONENT_ADMINISTRATOR . '/lib/mt/model.php');
JLoader::Register('MiniTheatreCMMetaDatabase', JPATH_COMPONENT_ADMINISTRATOR . '/meta/database.php');

/**
 * ContentTypes Model-List
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelContentTypes extends JModelList
{
	// SQL Query to load List Data
	protected function getListQuery()
	{
		// Load records from the database
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*')->from($db->quoteName(MiniTheatreCMMetaDatabase::getTableName('contenttypes')));
		$db->setQuery($query);		
		
		return $query;
	}
	
	// Helper methods
	public function getUsernames()
	{
		return NeonLibMtModel::getUsernames( $this->getItems(), array('author','recentedit') );
	}
	public function getUsergroups()
	{
		return NeonLibMtModel::getUsergroups( $this->getItems(), array('access') );
	}
}