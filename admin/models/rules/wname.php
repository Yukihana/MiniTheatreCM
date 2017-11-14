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
 * Form Rule class for the Joomla Framework.
 */
class JFormRuleWName extends JFormRule
{
	/**
	 * The regular expression.
	 *
	 * @access	protected
	 * @var		string
	 * @since	2.5
	 **
	 * JS commentary START
	 *
	 * Original regex: /^[^0-9]+$/
	 *
	 * Yuki's Regex: /^[a-zA-Z_]/ (Cannot use /^[a-z]/i because no way to use modifiers with php regex)
	 * Returns true for first character: 'a-z' or 'A-Z' or '_'
	 *
	 * Yuki's Tutorial Notes:
	 * str.test(regex) in javascript checks for matches found in 'str'-var based on the regex expression provided.
	 *
	 * Regex (Regular Expressions / Match Patterns) References:
	 * 1. https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions
	 * 2. https://www.w3schools.com/jsref/jsref_obj_regexp.asp
	 *
	 * JS commentary END
	 */
	protected $regex = '^[a-zA-Z_]';
}