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
 * NeonViewManager Source
 *
 * @since  0.0.1
 */
class NeonViewManager extends NeonViewBase
{
	protected $ui_title			= 'COM_MINITHEATRECM_DICTIONARY_MANAGER';
	
	// Display the template ($tpl: template file)
	function display($tpl = null)
	{
		// Get data from the model
		$pretime				= microtime(true);
		$this->items			= $this->get('Items');
		$posttime				= microtime(true);
		$this->querytime		= $posttime - $pretime;
		
		$this->pagination		= $this->get('Pagination');
		$this->state			= $this->get('State');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');
		
		// Display the template
		parent::display($tpl);
	}
}