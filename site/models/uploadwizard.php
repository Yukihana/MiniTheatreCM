<?php
/**
 * @package     MiniTheatre.Administrator
 * @subpackage  com_minitheatrecm
 *
 * @copyright   CherrySoft-X 2017, MiniTheatre 2017
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @link        http://fb.me/LilyflowerAngel
 */
  
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * UploadWizard Model
 *
 * @since  0.0.1
 */
class MiniTheatreCMModelUploadWizard extends JModelItem
{
	/**
	 * @var string message
	 */
	protected $message;

	/**
	 * Get the message
         *
	 * @return  string  The message to be displayed to the user
	 */
	public function getMsg()
	{
		if (!isset($this->message))
		{
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('id', 1, 'INT');

			switch ($id)
			{
				case 2:
					$this->message = 'Anime Model Message Data Ver 0.0.5';
					break;
				default:
				case 1:
					$this->message = 'Selection Model Message Data Ver 0.0.5';
					break;
			}
		}

		return $this->message;
	}
}