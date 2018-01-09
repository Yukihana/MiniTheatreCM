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
				'catalogue',	'a.catalogue',
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
		// Query Config
		$this->dbtable				= 'listings';
		$this->dbprefix				= 'a';
		
		// Query Vars: select, join
		$this->dbselect				= array('a.id', 'a.name', 'a.alias', 'a.state', 'a.catalogue', 'a.access', 'a.author', 'a.recentedit', 'a.created', 'a.modified', 'a.hits', 'a.rating', 'a.votes');
		$this->dbleftjoins			= array(
										'c.ctype as ctype'
											=> NeonCfgDatabase::getTableName('catalogues').' AS c ON c.id = a.catalogue',
										't.name as ctype_name'
											=> NeonCfgDatabase::getTableName('contenttypes').' AS t ON t.id = c.ctype'
										);
		
		// Query Vars: filters, order
		$this->dbfilters_search		= array('a.name', 'a.alias');
		$this->dbfilters_core		= array('state'=>'a.state', 'access'=>'a.access');
		$this->dbfilters_multi_int	= array('author'=>'a.author', 'recentedit'=>'a.recentedit', 'contenttype'=>'c.ctype');
		
		return parent::getListQuery();
	}
}