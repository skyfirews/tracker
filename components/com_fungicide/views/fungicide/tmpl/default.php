<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Fungicide
 * @author     mohan <mohan.god37@gmail.com>
 * @copyright  2018 mohan
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_fungicide');

if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_fungicide'))
{
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>

<div class="item_fields">

	<table class="table">
		

		<tr>
			<th><?php echo JText::_('COM_FUNGICIDE_FORM_LBL_FUNGICIDE_CID'); ?></th>
			<td><?php echo $this->item->cid; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_FUNGICIDE_FORM_LBL_FUNGICIDE_DATEOFSPRAY'); ?></th>
			<td><?php echo $this->item->dateofspray; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_FUNGICIDE_FORM_LBL_FUNGICIDE_RATIODESCRIBE'); ?></th>
			<td><?php echo nl2br($this->item->ratiodescribe); ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_FUNGICIDE_FORM_LBL_FUNGICIDE_SPRAYDAYAFTERCUTTING'); ?></th>
			<td><?php echo $this->item->spraydayaftercutting; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_FUNGICIDE_FORM_LBL_FUNGICIDE_DIFFRENCEDATE'); ?></th>
			<td><?php echo $this->item->diffrencedate; ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_fungicide&task=fungicide.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_FUNGICIDE_EDIT_ITEM"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_fungicide.fungicide.'.$this->item->id)) : ?>

	<a class="btn btn-danger" href="#deleteModal" role="button" data-toggle="modal">
		<?php echo JText::_("COM_FUNGICIDE_DELETE_ITEM"); ?>
	</a>

	<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3><?php echo JText::_('COM_FUNGICIDE_DELETE_ITEM'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo JText::sprintf('COM_FUNGICIDE_DELETE_CONFIRM', $this->item->id); ?></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
			<a href="<?php echo JRoute::_('index.php?option=com_fungicide&task=fungicide.remove&id=' . $this->item->id, false, 2); ?>" class="btn btn-danger">
				<?php echo JText::_('COM_FUNGICIDE_DELETE_ITEM'); ?>
			</a>
		</div>
	</div>

<?php endif; ?>