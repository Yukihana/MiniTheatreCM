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

// Include static helper classes
JLoader::Register('MiniTheatreCMCfgGlobal', JPATH_COMPONENT_ADMINISTRATOR . '/lib/cfg/global.php');
/**
 * MiniTheatreCM General Controller
 *
 * @since  0.0.7
 */
class MiniTheatreCMController extends JControllerLegacy
{
	/**
	 * The default view for the display method.
	 *
	 * @var string
	 * @since 12.2
	 */
	protected $default_view;
	
	public function __construct($properties)
    {
        $this->default_view = MiniTheatreCMCfgGlobal::getDefaultView();

        parent::__construct($properties);
    }
}