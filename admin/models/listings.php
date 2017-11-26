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
use Joomla\Utilities\ArrayHelper;
JLoader::Register('NeonModelList', JPATH_COMPONENT_ADMINISTRATOR . '/lib/src/modellist.php');

/**
 * Listings Model-List
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelListings extends NeonModelList
{
	// Override proxy for the constructor ($config: optional configuration array)
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',			'a.id',
				'name',			'a.name',
				'alias',		'a.alias',
				'state',		'a.state',
				'item_id',		'a.item_id',
				'access',		'a.access',
				'author',		'a.author',
				'recentedit',	'a.recentedit',
				'created',		'a.created',
				'modified',		'a.modified',
				'hits',			'a.hits',
				'rating',		'a.rating',
				'votes',		'a.votes'
			);
		}

		parent::__construct($config);
	}
	
	// SQL Query to load List Data
	protected function getListQuery()
	{
		// Load records from the database
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select( 'a.id, a.name, a.alias, a.state, a.item_id, a.access, a.author, a.recentedit, a.created, a.modified, a.hits, a.rating, a.votes' )->
			from($db->quoteName(NeonCfgDatabase::getTableName('listings')).' AS a');
		
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
		else
		{
			$query->where('(a.state IN (0,1))');
		}
		
		// Filter by access
		$access = $this->getState('filter.access');
		if(is_numeric($access))
		{
			$access = array($access);
		}
		if(count($access) != 0)
		{
			$access = ArrayHelper::toInteger($access);
			$access = implode(',', $access);
			$query->where('a.access IN (' . $access . ')');
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
		
		// Filter by recentedit
		$recentedit = $this->getState('filter.recentedit');
		if(is_numeric($recentedit))
		{
			$recentedit = array($recentedit);
		}
		if(count($recentedit) != 0)
		{
			$recentedit = ArrayHelper::toInteger($recentedit);
			$recentedit = implode(',', $recentedit);
			$query->where('a.recentedit IN (' . $recentedit . ')');
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
	
	// Secondary Data
	public function getUsernames( $fields = array('author','recentedit') )
	{
		return parent::getUsernames( $fields );
	}
	public function getItemnames( $fields = 'item_id' )
	{
		return parent::getItemnames( $fields );
	}
	public function getAccessgroups( $fields = 'access' )
	{
		return parent::getAccessgroups( $fields );
	}
}