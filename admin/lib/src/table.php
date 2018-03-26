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
JLoader::Register('NeonCfgDatabase', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/database.php');
JLoader::Register('NeonDataBinding', JPATH_COMPONENT_ADMINISTRATOR . '/lib/data/binding.php');

/**
 * Neon Table source class
 *
 * @since  0.0.1
 */
abstract class NeonTable extends JTable
{
	protected $dbname	= null;
	protected $dbprkey	= 'id';
	protected $dbalias	= array();
	protected $dbconcat	= array();
	
	// Constructor ($db: database connector object)
	function __construct(&$db)
	{
		// Base
		parent::__construct( NeonCfgDatabase::getTableName($this->dbname), $this->dbprkey, $db );
		
		// Apply Aliasing
		foreach( $this->dbalias as $colkey => $colval )
		{
			$this->setColumnAlias( $colkey, $colval );
		}
	}
	public function bind($array, $ignore = '') 
    {
		// Run Data Conversion
		foreach( $this->dbconcat as $conkey => $contype )
		{
			if( $contype == strtolower( 'csv' ))
			{
				$array[$conkey] = NeonDataBinding::CSV( $array[$conkey] );
			}
			elseif( $contype == strtolower( 'sar' ))
			{
				$array[$conkey] = NeonDataBinding::SAR( $array[$conkey] );
			}
			elseif( $contype == strtolower( 's64' ))
			{
				$array[$conkey] = NeonDataBinding::S64( $array[$conkey] );
			}
		}
		
		// Base
		return parent::bind($array, $ignore);
    }
	
	// Required to reverse getItem's unwanted Array->Object cast (Call from ModelAdmin->loadFormData after getItem)
	public function recast($data)
	{
		foreach( $this->dbconcat as $conkey => $contype )
		{
			if( strpos( 'csv sar s64', $contype ) !== false )
			{
				$data->$conkey = (array) $data->$conkey;
			}
		}
		
		return $data;
	}
}	
		
		
