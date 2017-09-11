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
 * UploadWizard Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelUploadWizard extends JModelItem
{
	/**
	 * @var array messages
	 */
	protected $messages;
	/**
	 * @Since 0.0.6
	 * Yuki's Tutorial Notes:
	 *
	 * $message was changed to $messages
	 * intended for arrays as mentioned in comment above.	
	 */
	 
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'UploadWizards', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	} 
	/*
	 * @Since 0.0.6
	 * Yuki's Tutorial Notes:
	 * 
	 * I suppose this refers to the className for the admin/tables/tablename.php file
	 * prefix + type = MiniTheatreCMTableUlWizWMode	
	 * Also assuming that PHP/Joomla is
	 * using reflection to determine the className
	 */	 
	 
	/**
	 * Get the message
	 *
	 * @param   integer  $id  WMode Id
	 *
	 * @return  string        Fetched String from Table for relevant Id
	 */
	public function getMsg($id = 1)
	{
		if (!is_array($this->messages))
		{
			$this->messages = array();
		}
		
		if (!isset($this->messages[$id]))
		{
			// Request the selected id
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');
			
			// Get a TableUlWizWMode instance
			$table = $this->getTable();
			
			// Load the message
			$table->load($id);			

			// Assign the message
			$this->messages[$id] = $table->wname;			
			
			/*
			 * Old Hardcoded Messages response Model
			 * This is the actual content sent to the pages
			switch ($id)
			{
				case 2:
					$this->message = 'Anime Model Message Data Ver 0.0.5';
					break;
				default:
				case 1:
					$this->message = 'Selection Model Message Data Ver 0.0.5';
					break;
			}
			 */
		}

		return $this->messages[$id];
	}
}