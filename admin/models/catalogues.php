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
 * Catalogues Model-List
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelCatalogues extends NeonModelList
{
	// Override proxy for the constructor ($config: optional configuration array)
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',				'a.id',
				'name',				'a.name',
				'alias',			'a.alias',
				
				'ctype_name',		'c.name',
				'ctype',			'a.ctype',
				'franchise_name',	'f.name',
				'franchise',		'a.franchise',
				
				'genres',			'a.genres',			'genres_json',
				
				'state',			'a.state',
				'access_name', 		'gp.title',
				'access',			'a.access',
				
				'author_name',		'u1.name',
				'author_user',		'u1.username',
				'author',			'a.author',
				'recentedit_name',	'u2.name',
				'recentedit_user',	'u2.username',
				'recentedit',		'a.recentedit',
				
				'created',			'a.created',
				'modified',			'a.modified',
				
				'hits',				'a.hits',
				'rating',			'a.rating',
				'votes',			'a.votes'
			);
		}
		
		parent::__construct($config);
	}
	
	// Override proxy for the getListQuery method
	protected function getListQuery()
	{
		// Query Config
		$this->dbtable				= 'catalogues';
		$this->dbprefix				= 'a';
		
		// Query Vars: select, join
		$this->dbselect				= array('a.id', 'a.name', 'a.altnames', 'a.alias', 'a.franchise', 'a.ctype', 'a.genres', 'a.genres AS genres_json', 'a.access', 'a.state', 'a.publish_up', 'a.publish_down', 'a.author', 'a.recentedit', 'a.created', 'a.modified', 'a.hits', 'a.rating', 'a.votes');
		$this->dbleftjoins			= array(
										'c.name AS ctype_name, c.color AS ctype_color'
											=> NeonCfgDatabase::getTableName('contenttypes').' AS c ON c.id = a.ctype',
											
										'f.name AS franchise_name'
											=> NeonCfgDatabase::getTableName('franchises').' AS f ON f.id = a.franchise',
											
										'u1.name AS author_name, u1.username AS author_user'
											=> NeonCfgDatabase::getJoomlaDB('users').' AS u1 ON u1.id = a.author',
											
										'u2.name AS recentedit_name, u2.username AS recentedit_user'
											=> NeonCfgDatabase::getJoomlaDB('users').' AS u2 ON u2.id = a.recentedit',
											
										'gp.title AS access_name'
											=> NeonCfgDatabase::getJoomlaDB('access').' AS gp ON gp.id = a.access'
										);
								
		// Query Vars: filters, order
		$this->dbfilters_search		= array('a.name', 'a.alias', 'a.altnames');
		$this->dbfilters_core		= array('state'=>'a.state', 'access'=>'a.access');
		$this->dbfilters_multi_int	= array('author'=>'a.author', 'recentedit'=>'a.recentedit', 'franchise'=>'a.franchise', 'contenttype'=>'a.ctype');
		
		return parent::getListQuery();
	}
}