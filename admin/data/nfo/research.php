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

// Prep Data
$brodo = new stdClass();
$brodo->croda = array('crumb', 'tello', 'rakis');
$brodo->nobu = 'priori';

$myserda = new stdClass();
$myserda->arda = array( 'acro', 3, array('nobu',31, $brodo) );
$myserda->noctu = 'ravio';

// DumpReady
$d1 = var_export($myserda, true);

// Serialize
$sex = serialize($myserda);

// Encode
$enc = base64_encode($sex);

// Decode
$dec = base64_decode($enc);

// Deserialize
$dex = unserialize($dec);
$d2 = var_export($dex, true);

// Prepare Print Data
$dump = array(
			'Original'		=> $d1,
			'Serialized'	=> $sex,
			'Encoded'		=> $enc,
			'Decoded'		=> $dec,
			'Deserialized'	=> $d2
		);
?>

<h2 class="page-header">Serialization / Encode Test</h2>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<td width="1%" class="nowrap">
				Type
			</td>
			<td width="1%" class="nowrap">
				Length
			</td>
			<td width="98%" class="nowrap">
				Data
			</td>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="3" class="disabled">
				<i><b>Conclusion:</b> Serialization followed by Base64 encode can safely be used for Database storage.</i>
			</td>
		</tr>
	</tfoot>
	<tbody>
		<?php foreach($dump as $type=>$data): ?>
		<tr>
			<td class="nowrap">
				<?php echo $type;?>
			</td>
			<td>
				<span class="badge badge-warning">
					<?php echo strlen($data);?>
				</span>
			</td>
			<td class="break-word">
				<?php echo $data;?>
			</td>
		<?php endforeach;?>
	</tbody>
</table>