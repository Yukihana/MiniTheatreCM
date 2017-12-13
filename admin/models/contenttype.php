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
 * ContentType Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelContentType extends JModelAdmin
{
	// Method to fetch JTable instances ($name: modelname, $prefix: class prefix, $config: optional configuration array)
	public function getTable($type = 'ContentTypes', $prefix = 'MiniTheatreCMTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	// Method to fetch form ($array: form-data, $loadData: load existing?), return [mixed] success? form-object : false.
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm(
			'com_minitheatrecm.contenttype',
			'editcontenttype',
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
			'com_minitheatrecm.edit.editcontenttype.data',
			array()
		);

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}
}