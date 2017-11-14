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

// Include the Lib/ModelHelper Static Class
JLoader::Register('MiniTheatreCMSiteHelperModel', JPATH_COMPONENT . '/helpers/model.php');

/**
 * EditListing Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelEditListing extends JModelItem
{
	// Cache data
	protected $cache;
	
	// Table Definition
	public function getTable($type = 'Listings', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	// Get Authorization & Load into cache
	public function getAuthorisation()
	{
		$id 	= JFactory::getApplication()->input->get('id', 0, 'INT');
		$userid = JFactory::getUser()->get('id');
		$table	= $this->getTable();
		
		if( ! $table->load($id) )
		{
			return false;
		}
		
		if( $table->author != $userid )
		{
			return false;
		}
		
		$this->cache = $table;
		return true;
	}
	
	public function getListing()
	{
		if( !isset( $this->cache ))
		{
			throw new Exception(JText::_('COM_MINITHEATRECM_MESSAGE_CHECKFORAUTHFIRST'), 403);
		}
		
		$data = new stdClass();
		
		$data->id 			= $this->cache->id;
		$data->live			= $this->cache->live;
		$data->item_id		= $this->cache->item_id;
		
		$data->name 		= $this->cache->name;
		$data->content 		= $this->cache->content;
		$data->description	= $this->cache->description;
		
		$data->modified		= $this->cache->modified;
		$data->requestname	= $this->cache->request_name;
		$data->requestdesc	= $this->cache->request_desc;
		
		return $data;
	}
	
	public function getItemdata()
	{
		if( !isset( $this->cache ))
		{
			throw new Exception(JText::_('COM_MINITHEATRECM_MESSAGE_CHECKFORAUTHFIRST'), 403);
		}
		
		$table = $this->getTable( 'Items', 'MiniTheatreCMTable', array() );
		
		$data 				= new stdClass();
		$data->id 			= $this->cache->item_id;
		$data->state 		= $table->load( $this->cache->item_id ) ? 1 : -1;
		
		if( $data->id == 0 )
		{
			$data->state = 0;
		}
		
		if( $data->state == 1 )
		{
			$data->name = $table->name;
		}
		
		return $data;
	}
	
	public function getUserdata()
	{
		/**
		 * Format:
		 * Fields you want
		 * Add SmartName
		 * Optional User ID: 0 or Null defaults to current user id
		 */
		return MiniTheatreCMSiteHelperModel::getUserdata( array('id', 'name', 'username' ), true, null );
	}
}