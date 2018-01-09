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

/**
 * Catalogue Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelCatalogue extends NeonModelAdmin
{
	protected $userstatestring	= 'com_minitheatrecm.edit.editcatalogue.data';
	protected $formname			= 'com_minitheatrecm.catalogue';
	protected $formxml			= 'editcatalogue';
	
	// Method to fetch JTable instances ($name: modelname, $prefix: class prefix, $config: optional configuration array)
	public function getTable($type = 'Catalogues', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
}