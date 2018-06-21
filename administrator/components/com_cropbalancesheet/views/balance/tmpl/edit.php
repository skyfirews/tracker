<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Cropbalancesheet
 * @author     mohan <mohan.god37@gmail.com>
 * @copyright  2018 mohan
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::root() . 'media/com_cropbalancesheet/css/form.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
		
	js('input:hidden.cid').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('cidhidden')){
			js('#jform_cid option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_cid").trigger("liszt:updated");
	js('input:hidden.expencetype').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('expencetypehidden')){
			js('#jform_expencetype option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_expencetype").trigger("liszt:updated");
	});

	Joomla.submitbutton = function (task) {
		if (task == 'balance.cancel') {
			Joomla.submitform(task, document.getElementById('balance-form'));
		}
		else {
			
			if (task != 'balance.cancel' && document.formvalidator.isValid(document.id('balance-form'))) {
				
				Joomla.submitform(task, document.getElementById('balance-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_cropbalancesheet&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="balance-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_CROPBALANCESHEET_TITLE_BALANCE', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

									<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
				<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
				<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
				<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />

				<?php echo $this->form->renderField('created_by'); ?>
				<?php echo $this->form->renderField('modified_by'); ?>				<?php echo $this->form->renderField('expencedate'); ?>
				<?php echo $this->form->renderField('cid'); ?>

			<?php
				foreach((array)$this->item->cid as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="cid" name="jform[cidhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('amount'); ?>
				<?php echo $this->form->renderField('expencetype'); ?>

			<?php
				foreach((array)$this->item->expencetype as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="expencetype" name="jform[expencetypehidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('description'); ?>


					<?php if ($this->state->params->get('save_history', 1)) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
					</div>
					<?php endif; ?>
				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>

	</div>
</form>
