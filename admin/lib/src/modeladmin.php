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
 * Neons Model-Admin source
 *
 * @since  0.0.1
 */
class NeonModelAdmin extends JModelAdmin
{
	protected $userstatestring	= null;
	protected $formname			= null;
	protected $formxml			= null;
	
	// Method to fetch form ($array: form-data, $loadData: load existing?), return [mixed] success? form-object : false.
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm( $this->formname, $this->formxml,
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}
	
	// Method to get the data for the form
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState(
			$this->userstatestring,
			array()
		);

		if (empty($data))
		{
			$data = $this->getItem();
			
			// Recast-to-Array (Reverse getItem's unwanted Array->Object cast)
			$table = $this->getTable();
			if( method_exists( $table, 'recast' ))
			{
				$data = $table->recast( $data );
			}
		}

		return $data;
	}
}