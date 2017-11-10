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
use Joomla\Utilities\ArrayHelper;
JLoader::Register('MiniTheatreCMLibMtModel', JPATH_COMPONENT_ADMINISTRATOR . '/lib/mt/model.php');
JLoader::Register('MiniTheatreCMMetaConfig', JPATH_COMPONENT_ADMINISTRATOR . '/meta/config.php');

/**
 * Listings Model-List
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelListings extends JModelList
{
	// Override proxy for the constructor ($config: optional configuration array)
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',			'a.id',
				'name',			'a.name',
				'state',		'a.state',
				'item_id',		'a.item_id',
				'author',		'a.author',
				'recentedit',	'a.recentedit',
				'created',		'a.created',
				'modified',		'a.modified'
			);
		}

		parent::__construct($config);
	}
	
	// Method to auto-populate the model state
	protected function populateState($ordering = 'a.id', $direction = 'desc')
	{
		/*
		 * Workaround to show sort-direction arrow on default column-header
		 * When a specific sorting order is not provided. (aka default sorting)
		 */
		parent::populateState($ordering,$direction);
	}
	
	// SQL Query to load List Data
	protected function getListQuery()
	{
		// Load records from the database
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		//$query->select('*')->
		$query->select( 'a.id, a.name, a.state, a.item_id, a.author, a.recentedit, a.created, a.modified' )->
			from($db->quoteName(MiniTheatreCMMetaConfig::getTableName('listings')).' AS a');
		
		
		// Filter: like / search
		$search = $this->getState('filter.search');
		
		if (!empty($search))
		{
			$like = $db->quote('%'.$search.'%');
			$query->where('a.name LIKE '.$like);
		}
		
		// Filter by published state
		$published = $this->getState('filter.state');

		if (is_numeric($published))
		{
			$query->where('a.state = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.state = 0 OR a.state = 1)');
		}
		
		// Filter by author
		$author = $this->getState('filter.author');
		if(is_numeric($author))
		{
			$author = array($author);
		}
		if(count($author) != 0)
		{
			$author = ArrayHelper::toInteger($author);
			$author = implode(',', $author);
			$query->where('a.author IN (' . $author . ')');
		}
		
		// Filter by item
		$itemid = $this->getState('filter.itemid');
		if(is_numeric($itemid))
		{
			$itemid = array($itemid);
		}
		if(count($itemid) != 0)
		{
			$itemid = ArrayHelper::toInteger($itemid);
			$itemid = implode(',', $itemid);
			$query->where('a.item_id IN (' . $itemid . ')');
		}
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'a.id');
		$orderDirn 	= $this->state->get('list.direction', 'DESC');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
		
		// Set the query and return
		return $query;
	}
	
	// Helper Methods
	public function getUsernames()
	{
		return MiniTheatreCMLibMtModel::getUsernames( $this->getItems(), array('author','recentedit') );
	}
	public function getItemnames()
	{
		return MiniTheatreCMLibMtModel::getItemnames( $this->getItems(), array('item_id') );
	}
}