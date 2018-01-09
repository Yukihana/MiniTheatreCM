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

/*
 * Used for aligning field-data with their binding format or processing format based on requirement.
 */
abstract class NeonDataBinding
{
	// Array <-> Comma Separated Values (String)
	public static function CSV($data)
	{
		if( is_array( $data ))
		{
			return implode( ',', $data );
		}
		elseif( is_string( $data ))
		{
			if( empty( $data ))
			{
				return array();
			}
			else
			{
				return explode( ',', $data );
			}
		}
		elseif( is_null( $data ))
		{
			return '';
		}
		return $data;
	}
	
	// Array <-> Serialization
	public static function SAR($data)
	{
		if( is_array( $data ))
		{
			return serialize( $data );
		}
		elseif( is_string( $data ))
		{
			if( empty( $data ))
			{
				return array();
			}
			else
			{
				return unserialize( $data );
			}
		}
		elseif( is_null( $data ))
		{
			return '';
		}
		return $data;
	}
}