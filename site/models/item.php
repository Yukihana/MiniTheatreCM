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
 * Item Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelItem extends JModelItem
{
	// Table Definition
	public function getTable($type = 'Items', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	// Storage Vars
	protected $itemdata;
	
	// Primary Loader (-1: not logged, 0: doesn't exist, 1: AOK) 
	public function getAccess()
	{
		// User check
		$user = JFactory::getUser()->get('id');
		if($user == 0)
		{
			return 1;
		}
		
		// Input check
		$id = JFactory::getApplication()->input->get('id',0,'INT');
		if($id == 0)
		{
			return 2;
		}
		
		// Record check
		$table = $this->getTable();
		if( ! $table->load($id) )
		{
			return 2;
		}
		
		// Check other status info (published)
		if( $table->state != 1 )
		{
			return 2;
		}
		
		// Assuming it's all good to go, load data
		$this->itemdata = new stdClass();
		$this->itemdata->id = $id;
		$this->itemdata->name = $table->name;
		$this->itemdata->synopsis = $table->content;
		$this->itemdata->modified = $table->modified;
		
		return 0;
	}
	
	public function getItemdata()
	{
		// Initiate loader
		if( !isset( $this->itemdata ))
		{
			$auth = $this->getAuthorisation();
			if( $auth != 1)
			{
				return new stdClass();
			}
		}
		
		return $this->itemdata;
	}
}