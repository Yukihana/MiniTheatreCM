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
JLoader::Register('NeonCfgDatabase', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/database.php');

/**
 * UploadWizards Table class
 *
 * @since  0.0.1
 */
class MiniTheatreCMTableUploadWizards extends JTable
{
	// Constructor ($db: database connector object)
	function __construct(&$db)
	{
		parent::__construct(NeonCfgDatabase::getTableName('ulwizsources'), 'id', $db);
	}
}