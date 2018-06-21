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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_cropdetail') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'cropdetailform.xml');
$canEdit = $user->authorise('core.edit', 'com_cropdetail') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'cropdetailform.xml');
$canCheckin = $user->authorise('core.manage', 'com_cropdetail');
$canChange = $user->authorise('core.edit.state', 'com_cropdetail');
$canDelete = $user->authorise('core.delete', 'com_cropdetail');
?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post"
      name="adminForm" id="adminForm">


    <table class="table table-striped" id="cropdetailList">
        <thead>
            <tr>
                <?php if (isset($this->items[0]->state)): ?>

                <?php endif; ?>

                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_CROPDETAIL_CROPDETAILS_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_CROPDETAIL_CROPDETAILS_CUTTINGDATE', 'a.cuttingdate', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_CROPDETAIL_CROPDETAILS_TOTALSPENT', 'a.totalspent', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_CROPDETAIL_CROPDETAILS_TOTALGAIN', 'a.totalgain', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_CROPDETAIL_CROPDETAILS_WEIGHTAGE', 'a.weightage', $listDirn, $listOrder); ?>
                </th>


                <?php if ($canEdit || $canDelete): ?>
                    <th class="center">
                        <?php echo JText::_('COM_CROPDETAIL_CROPDETAILS_ACTIONS'); ?>
                    </th>
                <?php endif; ?>

            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
                    <?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($this->items as $i => $item) : ?>
                <?php $canEdit = $user->authorise('core.edit', 'com_cropdetail'); ?>

                <?php if (!$canEdit && $user->authorise('core.edit.own', 'com_cropdetail')): ?>
                    <?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
                <?php endif; ?>

                <tr class="row<?php echo $i % 2; ?>">

                    <?php if (isset($this->items[0]->state)) : ?>
                        <?php $class = ($canChange) ? 'active' : 'disabled'; ?>

                    <?php endif; ?>

                    <td>

                        <?php echo $item->id; ?>
                    </td>
                    <td>

                        <?php echo $item->cuttingdate; ?>
                    </td>
                    <td>

                        <?php echo $item->totalspent; ?>
                    </td>
                    <td>

                        <?php echo $item->totalgain; ?>
                    </td>
                    <td>

                        <?php echo $item->weightage; ?>
                    </td>


                    <?php if ($canEdit || $canDelete): ?>
                        <td class="center">
                            <?php if ($canEdit): ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_cropdetail&task=cropdetailform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
                            <?php endif; ?>
                            <?php if ($canDelete): ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_cropdetail&task=cropdetailform.remove&id=' . $item->id, false, 2); ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></a>
                            <?php
                            endif;

                            if ($item->cropstatus == 1) {
                                ?>

                                <a href="<?php echo JRoute::_('index.php?option=com_cropdetail&task=cropdetailform.totalsum&id=' . $item->id, false, 2); ?>" class="btn btn-mini" data-toggle="tooltip" data-placement="right" title="Sums all Total Spend">   <i class="fa fa-plus" aria-hidden="true"></i></a>

                        <?php } ?>
                        </td>
    <?php endif; ?>

                </tr>
<?php endforeach; ?>
        </tbody>
    </table>

<?php if ($canCreate) : ?>
        <a href="<?php echo JRoute::_('index.php?option=com_cropdetail&task=cropdetailform.edit&id=0', false, 0); ?>"
           class="btn btn-success btn-small"><i
                class="icon-plus"></i>
            <?php echo JText::_('COM_CROPDETAIL_ADD_ITEM'); ?></a>
<?php endif; ?>

    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
<?php echo JHtml::_('form.token'); ?>
</form>

<?php if ($canDelete) : ?>
    <script type="text/javascript">

        jQuery(document).ready(function () {
            jQuery('.delete-button').click(deleteItem);
        });

        function deleteItem() {

            if (!confirm("<?php echo JText::_('COM_CROPDETAIL_DELETE_MESSAGE'); ?>")) {
                return false;
            }
        }
    </script>
<?php endif; ?>
