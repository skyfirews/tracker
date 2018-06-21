<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Cropdetail
 * @author     mohan <mohan.god37@gmail.com>
 * @copyright  2018 mohan
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_cropdetail');

if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_cropdetail'))
{
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>

<div class="item_fields">

	<table class="table">
		

		<tr>
			<th><?php echo JText::_('COM_CROPDETAIL_FORM_LBL_CROPDETAIL_CUTTINGDATE'); ?></th>
			<td><?php echo $this->item->cuttingdate; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_CROPDETAIL_FORM_LBL_CROPDETAIL_DESCRIPTION'); ?></th>
			<td><?php echo nl2br($this->item->description); ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_CROPDETAIL_FORM_LBL_CROPDETAIL_TOTALSPENT'); ?></th>
			<td><?php echo $this->item->totalspent; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_CROPDETAIL_FORM_LBL_CROPDETAIL_TOTALGAIN'); ?></th>
			<td><?php echo $this->item->totalgain; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_CROPDETAIL_FORM_LBL_CROPDETAIL_REMARK'); ?></th>
			<td><?php echo $this->item->remark; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_CROPDETAIL_FORM_LBL_CROPDETAIL_WEIGHTAGE'); ?></th>
			<td><?php echo $this->item->weightage; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_CROPDETAIL_FORM_LBL_CROPDETAIL_SESSION'); ?></th>
			<td><?php echo $this->item->session; ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_cropdetail&task=cropdetail.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_CROPDETAIL_EDIT_ITEM"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_cropdetail.cropdetail.'.$this->item->id)) : ?>

	<a class="btn btn-danger" href="#deleteModal" role="button" data-toggle="modal">
		<?php echo JText::_("COM_CROPDETAIL_DELETE_ITEM"); ?>
	</a>

	<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3><?php echo JText::_('COM_CROPDETAIL_DELETE_ITEM'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo JText::sprintf('COM_CROPDETAIL_DELETE_CONFIRM', $this->item->id); ?></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
			<a href="<?php echo JRoute::_('index.php?option=com_cropdetail&task=cropdetail.remove&id=' . $this->item->id, false, 2); ?>" class="btn btn-danger">
				<?php echo JText::_('COM_CROPDETAIL_DELETE_ITEM'); ?>
			</a>
		</div>
	</div>

<?php endif; ?>