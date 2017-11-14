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
 * RatingListings Controller
 *
 * @since  0.0.1
 */
class MiniTheatreCMControllerRatingListings extends JControllerAdmin
{
	// Override proxy for getModel ($name: modelname, $prefix: class prefix, $config: optional configuration array)
	public function getModel($name = 'RatingListing', $prefix = 'MiniTheatreCMModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
}