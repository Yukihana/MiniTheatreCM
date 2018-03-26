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
JFormHelper::loadFieldClass('groupedlist');
JLoader::Register('NeonCfgDatabase', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/database.php');

/**
 * NeonFormFieldList source class for the MiniTheatreCM component
 *
 * @since  0.0.1
 */
class NeonFormXmlGroupedList extends JFormFieldGroupedList
{
	// Vars: Type Declaration, Field Xml-Name
	protected $type = null;
	protected $xmlname = null;
	protected $translate = false;

	// Method to get Options
	protected function getGroups()
	{
		$xml = simplexml_load_file( NeonCfgDatabase::getXmlFieldPath($this->xmlname) );
		
		$groups = array();
		
		foreach( $xml->group as $group )
		{
			// Generate group names
			$label		= strval( $group['label'] );
			if( $this->translate === true )
			{
				$label = JText::_( $label );
			}
			
			// Initialize and get options
			$groups[$label] = array();
			
			foreach( $group->option as $option )
			{
				$groups[$label][] = JHtml::_('select.option', $option['value'], ($this->translate === true)? JText::_($option) : $option );
			}			
		}
			
		// Merge any additional groups in the XML definition.
		$groups = array_merge(parent::getGroups(), $groups);

		return $groups;
	}
}