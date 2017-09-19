<?php
/**
 * @package     MiniTheatre.Administrator
 * @subpackage  com_minitheatrecm
 *
 * @copyright   CherrySoft-X 2017, MiniTheatre 2017
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link        http://fb.me/LilyflowerAngel
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
	// Table Definitions
	public function getWikiItemsTable($type = 'WikiItems', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	// Storage Vars (Array, indices loaded individually, on demand)
	protected $names;
	protected $contents;

	// Get Item Name
	public function getItemName($id=1)
	{
		if(!is_array($this->names))
		{
			$this->names = array();
		}

		if (!isset($this->names[$id]))
		{
			// Request the selected id
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');

			// Get a TableWikiItems instance
			$table = $this->getWikiItemsTable();

			// Load the message
			$table->load($id);

			// Assign the message
			$this->names[$id] = $table->name;
		}
		
		return $this->names[$id];
	}
	
	// Get Item Content
	public function getItemContent($id=1)
	{
		if(!is_array($this->contents))
		{
			$this->contents = array();
		}

		if (!isset($this->contents[$id]))
		{
			// Request the selected id
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');

			// Get a TableWikiItems instance
			$table = $this->getWikiItemsTable();

			// Load the message
			$table->load($id);

			// Assign the message
			$this->contents[$id] = $table->content;
		}
		
		return $this->contents[$id];
	}
	
}