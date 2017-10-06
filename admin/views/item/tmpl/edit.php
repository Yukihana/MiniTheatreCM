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
JHtml::_('behavior.formvalidator');
?>

<form action="<?php echo JRoute::_('index.php?option=com_minitheatrecm&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_MINITHEATRECM_ITEM_LEGEND'); ?></legend>
            <div class="row-fluid">
                <div class="span6">
                    <?php foreach ($this->form->getFieldset() as $field): ?>
                        <div class="control-group">
                            <div class="control-label"><?php echo $field->label; ?></div>
                            <div class="controls"><?php echo $field->input; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </fieldset>
    </div>
    <input type="hidden" name="task" value="item.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>