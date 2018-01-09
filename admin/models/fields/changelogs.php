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
JLoader::register('NeonNfoVersionss', JPATH_COMPONENT_ADMINISTRATOR.'/lib/nfo/changelogs.php');
JFormHelper::loadFieldClass('list');

/**
 * ChangeLogs field for Planner View
 *
 * @since  0.0.1
 */
class JFormFieldChangeLogs extends JFormFieldList
{
	// Type Identifier
	protected $type = 'changelogs';

	// Method to return a list of options for input
	public function getOptions()
	{
		$options = array();
		foreach(NeonNfoVersionss::getList() as $i=>$clog)
		{
			$options[] = JHtml::_('select.option', $i, $clog);
		}
		
		$options = array_merge(parent::getOptions(), $options);
		
		return $options;
	}
}