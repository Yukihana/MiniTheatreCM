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
JFormHelper::loadFieldClass('list');
JLoader::Register('NeonCfgDatabase', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/database.php');

/**
 * NeonFormFieldList source class for the MiniTheatreCM component
 *
 * @since  0.0.1
 */
class NeonFormFieldList extends JFormFieldList
{
	// Vars: Type Declaration, Select, DB-ID
	protected $type			= null;
	protected $dbname		= null;
	
	protected $valuefield	= null;
	protected $textfield	= null;
	
	// Method to get Options
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select($this->getSelectClause($db));
		$query->from($db->quoteName(NeonCfgDatabase::getTableName($this->dbname)));
		$db->setQuery((string) $query);
		$objlist = $db->loadObjectList();
		
		$options  = array();

		if ($objlist)
		{
			foreach ($objlist as $obj)
			{
				$options[] = JHtml::_('select.option', $obj->id, $obj->name);
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
	
	protected function getSelectClause(&$db)
	{
		$value = ( $this->valuefield != null )? $this->valuefield.' AS id' : 'id';
		$text = ( $this->textfield != null )? $this->textfield.' AS name' : 'name';
		
		return $value.','.$text;
	}
}