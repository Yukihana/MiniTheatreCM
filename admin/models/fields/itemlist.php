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

JFormHelper::loadFieldClass('list');

/**
 * ItemList Form Field class for the MiniTheatreCM component
 *
 * @since  0.0.1
 */
class JFormFieldItemList extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'ItemList';

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
		$query->from('#__mtcm_wiki_items');
		$db->setQuery((string) $query);
		$objlist = $db->loadObjectList();
		
		$options  = array();

		if ($objlist)
		{
			foreach ($objlist as $obj)
			{
				$options[] = JHtml::_('select.option', $obj->id, $obj->name."(catid_implement_pending)");
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}