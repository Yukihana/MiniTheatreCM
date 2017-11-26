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
 * Items Model-List
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelItems extends NeonModelList
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
				'franchise_id',	'a.franchise_id',
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
	
	// Override proxy for the getListQuery method
	protected function getListQuery()
	{
		// Query Config
		$this->dbtable				= 'items';
		$this->dbprefix				= 'a';
		
		// Query Vars: select, join
		$this->dbselect				= array('a.id', 'a.name', 'a.alias', 'a.state', 'a.franchise_id', 'a.access', 'a.author', 'a.recentedit', 'a.created', 'a.modified', 'a.hits', 'a.rating', 'a.votes');
		$this->dbleftjoins			= array(
										'b.name AS ctype_name'=> NeonCfgDatabase::getTableName('contenttypes').' AS b ON b.id = a.ctype_id',
										'c.name AS franchise_name'=>NeonCfgDatabase::getTableName('franchises').' AS c ON c.id = a.franchise_id'
										);
										
		// Query Vars: filters, order
		$this->dbfilters_core		= array('search'=>'a.name', 'state'=>'a.state', 'access'=>'a.access');
		$this->dbfilters_multi_int	= array ('author'=>'a.author', 'recentedit'=>'a.recentedit');
		
		return parent::getListQuery();
	}
	
	// Secondary Data (Legacy, to be removed)
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