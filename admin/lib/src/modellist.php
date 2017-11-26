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
JLoader::Register('NeonCfgDatabase', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/database.php');

/**
 * Neons Model-List source
 *
 * @since  0.0.1
 */
class NeonModelList extends JModelList
{
	// Inherit Vars
	protected $dbtable				= null;
	protected $dbprefix				= 'a';
	
	protected $dbselect				= '*';
	protected $dbjoins				= array();
	
	protected $dbordercol			= 'a.id';
	protected $dborderdir			= 'DESC';
	protected $dbfilters_core		= array();
	protected $dbfilters_multi_int	= array();
	
	// Method to auto-populate the model state; Override Reason: Startup Fullordering Default
	protected function populateState($ordering = null, $direction = null)
	{
		if( $ordering == null )
		{
			$ordering = $this->dbordercol;
		}
		if( $direction == null )
		{
			$direction = $this->dborderdir;
		}
		
		parent::populateState($ordering,$direction);
	}
	
	// SQL Query to load List Data
	protected function getListQuery()
	{
		// Load records from the database
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select( self::buildQuerySelectString( $this->dbselect ) );
		$query->from( $db->quoteName( NeonCfgDatabase::getTableName( $this->dbtable )).' AS '.$this->dbprefix );
		
		// Add Joins: Left
		foreach($this->dbleftjoins as $joinselect=>$joinfrom)
		{
			$query->select($joinselect)->join('LEFT', $joinfrom);
		}
		
		// Filter by search
		if( isset( $this->dbfilters_core['search'] ))
		{
			$search = $this->getState('filter.search');
			if (!empty($search))
			{
				$like = $db->quote('%'.$search.'%');
				$query->where($this->dbfilters_core['search'].' LIKE '.$like);
			}
		}
		
		// Filter by published state
		if( isset( $this->dbfilters_core['state'] ))
		{
			$state = $this->getState('filter.state');
			if (is_numeric($state))
			{
				$query->where($this->dbfilters_core['state'].' = '.(int)$state);
			}
			else
			{
				$query->where($this->dbfilters_core['state'].' IN (0,1)');
			}
		}
		
		// Filter by access
		if( isset( $this->dbfilters_core['access'] ))
		{
			$access = $this->getState('filter.access');
			if(is_numeric($access))
			{
				$access = array($access);
			}
			if(count($access) != 0)
			{
				$access = ArrayHelper::toInteger($access);
				$access = implode(',', $access);
				$query->where($this->dbfilters_core['access'].' IN ('.$access.')');
			}
		}
		
		// Filter by multiselect: INT
		foreach($this->dbfilters_multi_int as $filtername=>$filterfield)
		{
			$fielddata = $this->getState('filter.'.$filtername);
			if(is_numeric($fielddata))
			{
				$fielddata = array($fielddata);
			}
			if(count($fielddata) != 0)
			{
				$fielddata = ArrayHelper::toInteger($fielddata);
				$fielddata = implode(',', $fielddata);
				$query->where($filterfield.' IN (' . $fielddata . ')');
			}
			
			unset($fielddata);
		}
		
		
		
		/*
		// Filter by author
		if( isset( $this->dbfilters['author'] ))
		{
			$author = $this->getState('filter.author');
			if(is_numeric($author))
			{
				$author = array($author);
			}
			if(count($author) != 0)
			{
				$author = ArrayHelper::toInteger($author);
				$author = implode(',', $author);
				$query->where($this->dbfilters['author'].' IN ('.$author.')');
			}
		}
		
		// Filter by recentedit
		if( isset( $this->dbfilters['recentedit'] ))
		{
			$recentedit = $this->getState('filter.recentedit');
			if(is_numeric($recentedit))
			{
				$recentedit = array($recentedit);
			}
			if(count($recentedit) != 0)
			{
				$recentedit = ArrayHelper::toInteger($recentedit);
				$recentedit = implode(',', $recentedit);
				$query->where($this->dbfilters['recentedit'].' IN ('.$recentedit.')');
			}
		}
		
		// Filter by item
		if( isset( $this->dbfilters['item'] ))
		{
			$itemid = $this->getState('filter.itemid');
			if(is_numeric($itemid))
			{
				$itemid = array($itemid);
			}
			if(count($itemid) != 0)
			{
				$itemid = ArrayHelper::toInteger($itemid);
				$itemid = implode(',', $itemid);
				$query->where($this->dbfilters['item'].' IN ('.$itemid.')');
			}
		}
		
		// Filter by franchise
		if( isset( $this->dbfilters['franchise'] ))
		{
			$itemid = $this->getState('filter.itemid');
			if(is_numeric($itemid))
			{
				$itemid = array($itemid);
			}
			if(count($itemid) != 0)
			{
				$itemid = ArrayHelper::toInteger($itemid);
				$itemid = implode(',', $itemid);
				$query->where($this->dbfilters['franchise'].' IN ('.$itemid.')');
			}
		}
		*/
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', $this->dbordercol);
		$orderDirn 	= $this->state->get('list.direction', $this->dborderdir);

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
		
		// Set the query and return
		error_log($query->__tostring());
		return $query;
	}
	
	// Secondary Data Fetching Methods
	public function getUsernames( $fields = 'author')
	{
		if( !is_array($fields) )
		{
			$fields = array( $fields );
		}
		$result = array();
		
		// Load the values of the fields into an array and make it unique
		$userids = self::getUniqueArray( $this->getItems(), $fields );
		
		// Check IDs vs User Table and load their names/usernames
		$table = JUser::getTable();
		foreach( $userids as $id )
		{
			if( $table->load( $id ))
			{
				$result[$id] = ($table->name != '') ? $table->name : $table->username;
			}
		}
		
		// Return data
		return $result;
	}
	
	public function getAccessgroups( $fields = 'access' )
	{
		if( !is_array($fields) )
		{
			$fields = array( $fields );
		}
		$result = array();
		
		// Load the values of the fields into an array and make it unique
		$ids = self::getUniqueArray( $this->getItems(), $fields );
		
		// Check IDs vs Access groups and load them on success
		foreach( $ids as $id )
		{
			$result[$id] = JAccess::getGroupTitle($id);
		}
		
		// Return data
		return $result;
	}
	
	public function getItemnames( $fields = 'item_id' )
	{
		if( !is_array($fields) )
		{
			$fields = array( $fields );
		}
		$result = array();
		
		// Load the values of the fields into an array and make it unique
		$ids = self::getUniqueArray( $this->getItems(), $fields );
		
		// Check IDs vs Items and load them on success
		$table = JTable::getInstance('Items', 'MiniTheatreCMTable', array());
		foreach( $ids as $id )
		{
			if( $table->load( $id ))
			{
				$result[$id] = $table->name;
			}
		}
		
		// Return data
		return $result;
	}
	
	public function getFranchises( $fields = 'franchise_id' )
	{
		if( !is_array($fields) )
		{
			$fields = array( $fields );
		}
		$result = array();
		
		// Load the values of the fields into an array and make it unique
		$ids = self::getUniqueArray( $this->getItems(), $fields );
		
		// Check IDs vs Items and load them on success
		$table = JTable::getInstance('Franchises', 'MiniTheatreCMTable', array());
		foreach( $ids as $id )
		{
			if( $table->load( $id ))
			{
				$result[$id] = $table->name;
			}
		}
		
		// Return data
		return $result;
	}
	
	//Kernel methods
	private static function getUniqueArray( $items, $fields )
	{
		$data = array();
		foreach( $items as $item )
		{
			foreach( $fields as $field )
			{
				if( isset( $item->$field ))
				{
					array_push( $data, $item->$field );
				}
			}
		}
		return array_unique( $data );
	}
	
	private static function buildQuerySelectString($fields)
	{
		// Analyse and Format
		if( $fields === '*' )
		{
			return '*';
		}
		elseif( is_string( $fields ))
		{
			$fields = explode( ' ', $fields );
		}
		elseif( !is_array( $fields ))
		{
			return array();
		}
		
		// Build a string for Query Select
		$result = '';
		for( $i=0;$i<count($fields);$i++)
		{
			$result.= $fields[$i];
			if($i != (count($fields)-1) )
			{
				$result.= ', ';
			}
		}
		
		return $result;
	}
}