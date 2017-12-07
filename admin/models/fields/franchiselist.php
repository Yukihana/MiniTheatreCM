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
 * FranchiseList Form Field class for the MiniTheatreCM component
 *
 * @since  0.0.1
 */
class JFormFieldFranchiseList extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'FranchiseList';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,name');
		$query->from($db->quoteName(NeonCfgDatabase::getTableName('franchises')));
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
}