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
 * Reviews Model-List
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelReviews extends NeonModelList
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
				
				'catalogue',		'a.catalogue',
				'catalogue_name',	't.name',
				'ctype',			't.ctype',
				'ctype_name',		'c.name',
				
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
			);
		}

		parent::__construct($config);
	}
	
	// SQL Query to load List Data
	protected function getListQuery()
	{
		// Query Config
		$this->dbtable				= 'reviews';
		$this->dbprefix				= 'a';
		
		// Query Vars: select, join
		$this->dbselect				= array('a.id', 'a.name', 'a.alias', 'a.catalogue', 'a.access', 'a.state', 'a.publish_up', 'a.publish_down', 'a.author', 'a.recentedit', 'a.created', 'a.modified');
		$this->dbleftjoins			= array(
										't.name AS catalogue_name'
											=> NeonCfgDatabase::getTableName('catalogues').' AS t ON t.id = a.catalogue',
											
										'c.id AS ctype, c.name AS ctype_name, c.color AS ctype_color'
											=> NeonCfgDatabase::getTableName('ctypes').' AS c ON c.id = t.ctype',
											
										'u1.name AS author_name, u1.username AS author_user'
											=> NeonCfgDatabase::getJoomlaDB('users').' AS u1 ON u1.id = a.author',
											
										'u2.name AS recentedit_name, u2.username AS recentedit_user'
											=> NeonCfgDatabase::getJoomlaDB('users').' AS u2 ON u2.id = a.recentedit',
											
										'gp.title AS access_name'
											=> NeonCfgDatabase::getJoomlaDB('access').' AS gp ON gp.id = a.access'
										);
		
		// Query Vars: filters, order
		$this->dbfilters_search		= array('a.name', 'a.alias');
		$this->dbfilters_core		= array('state'=>'a.state', 'access'=>'a.access');
		$this->dbfilters_multi_int	= array('author'=>'a.author', 'recentedit'=>'a.recentedit', 'catalogue'=>'a.catalogue', 'ctype'=>'c.ctype');
		
		return parent::getListQuery();
	}
}		