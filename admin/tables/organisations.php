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
 * Organisations Table class
 *
 * @since  0.0.1
 */
class MiniTheatreCMTableOrganisations extends NeonTable
{
	protected $dbname = 'organisations';
	
	protected $dbalias	= array('published'=>'state', 'title'=>'name');
}