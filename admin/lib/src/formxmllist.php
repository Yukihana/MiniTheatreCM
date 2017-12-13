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
class NeonFormXmlList extends JFormFieldList
{
	// Vars: Type Declaration, Field Xml-Name
	protected $type = null;
	protected $xmlname = null;

	// Method to get Options
	protected function getOptions()
	{
		$xml = simplexml_load_file( NeonCfgDatabase::getXmlFieldPath($this->xmlname) );
		
		$options  = array();
		
		foreach( $xml->option as $option )
		{
			$options[] = JHtml::_('select.option', $option['value'], $option);
		}
		
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}