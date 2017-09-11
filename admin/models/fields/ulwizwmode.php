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
 * UlWizWMode Form Field class for the MiniTheatreCM component
 *
 * @since  0.0.1
 */
class JFormFieldUlWizWMode extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'UlWizWMode';
	/**
	 * @Since 0.0.6
	 * Yuki's Tutorial Notes:
	 * $type is the same as <field type=""> in views/.../tmpl/default.xml
	 *
	 * Concerns: Using underscores.
	 * - Confirmed: Not allowed.
	 * Concerns: Different Names for field 'type' and partial 'className'
	 * - Hoping it should work. Why else would it need a $type var?!
	 * - Confirmed: They need to be the same thing. Regardless of $type.
	 */
	
	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id,wname');
		$query->from('#__mtcm_admin_ulwiz');
		$db->setQuery((string) $query);
		$messages = $db->loadObjectList();
		$options  = array();

		if ($messages)
		{
			foreach ($messages as $message)
			{
				$options[] = JHtml::_('select.option', $message->id, $message->wname);
			}
		}

		$options = array_merge(parent::getOptions(), $options);
		
		return $options;
	}
}