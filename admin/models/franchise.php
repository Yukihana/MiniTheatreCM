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
 * Franchise Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelFranchise extends NeonModelAdmin
{
	protected $userstatestring	= 'com_minitheatrecm.edit.editfranchise.data';
	protected $formname			= 'com_minitheatrecm.franchise';
	protected $formxml			= 'editfranchise';
	
	// Method to fetch JTable instances ($name: modelname, $prefix: class prefix, $config: optional configuration array)
	public function getTable($type = 'Franchises', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
}