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
	protected $dbfilters_search		= null;
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
		$query->select( $this->buildQuerySelectString( $this->dbselect ) );
		$query->from( $db->quoteName( NeonCfgDatabase::getTableName( $this->dbtable )).' AS '.$this->dbprefix );
		
		// Add Joins: Left
		foreach($this->dbleftjoins as $joinselect=>$joinfrom)
		{
			$query->select($joinselect)->join('LEFT', $joinfrom);
		}
		
		// Filter by search
		if( $this->dbfilters_search != null )
		{
			$search = $this->getState('filter.search');
			if (!empty($search))
			{
				$like = $db->quote('%'.$search.'%');
				$query->where( $this->buildQueryLikeString($like, $this->dbfilters_search) );
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
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', $this->dbordercol);
		$orderDirn 	= $this->state->get('list.direction', $this->dborderdir);

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
		
		// Set the query and return
		return $query;
	}
	
	// Internal
	protected function buildQuerySelectString($fields)
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
	
	protected function buildQueryLikeString($like, $fields)
	{
		if( is_string( $fields ))
		{
			$fields = array( $fields );
		}
		if( is_array( $fields ))
		{
			$result = null;
			foreach( $fields as $field )
			{
				if( $result != null )
				{
					$result.= ' OR '.$field.' LIKE '.$like;
				}
				else
				{
					$result = $field.' LIKE '.$like;
				}
			}
			return ($result != null)? '('.$result.')' : '';
		}
		return '';
	}
}