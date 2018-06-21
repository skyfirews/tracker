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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_fungicide') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'fungicideform.xml');
$canEdit = $user->authorise('core.edit', 'com_fungicide') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'fungicideform.xml');
$canCheckin = $user->authorise('core.manage', 'com_fungicide');
$canChange = $user->authorise('core.edit.state', 'com_fungicide');
$canDelete = $user->authorise('core.delete', 'com_fungicide');
?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post"
      name="adminForm" id="adminForm">

    <?php if ($canCreate) : ?>
        <a href="<?php echo JRoute::_('index.php?option=com_fungicide&task=fungicideform.edit&id=0', false, 0); ?>"
           class="btn btn-primary btn-small"><i
                class="icon-plus"></i>
            <?php echo JText::_('COM_FUNGICIDE_ADD_ITEM'); ?></a>
        <?php endif; ?>
    <table class="table table-striped" id="fungicideList">
        <thead>
            <tr>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'Ratio Describe', 'a.ratiodescribe'); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'DAYS', 'a.spraydayaftercutting', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'Spray Date', 'a.dateofspray'); ?>
                </th>

                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_FUNGICIDE_FUNGICIDES_SPRAYDAYAFTERCUTTING', 'a.', $listDirn, $listOrder); ?>
                </th>




                <?php if ($canEdit || $canDelete): ?>
                    <th class="center">
                        <?php echo JText::_('COM_FUNGICIDE_FUNGICIDES_ACTIONS'); ?>
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
                <?php $canEdit = $user->authorise('core.edit', 'com_fungicide'); ?>

                <?php if (!$canEdit && $user->authorise('core.edit.own', 'com_fungicide')): ?>
                    <?php $canEdit = JFactory::getUser()->id == $item->created_by; ?>
                <?php endif; ?>

                <tr class="row<?php echo $i % 2; ?>">
                    <td>

                        <?php echo $item->ratiodescribe; ?>
                    </td>

                    <td>

                        <?php echo $item->spraydayaftercutting; ?>
                    </td>
                    <td>

                        <?php echo $item->dateofspray; ?>
                    </td>




                    <td>
                        <?php if (isset($item->checked_out) && $item->checked_out) : ?>
                            <?php echo JHtml::_('jgrid.checkedout', $i, $item->uEditor, $item->checked_out_time, 'fungicides.', $canCheckin); ?>
                        <?php endif; ?>
                        <a href="<?php echo JRoute::_('index.php?option=com_fungicide&view=fungicide&id=' . (int) $item->id); ?>">
                            <?php echo $this->escape($item->diffrencedate); ?></a>
                    </td>


                    <?php if ($canEdit || $canDelete): ?>
                        <td class="center">
                            <?php if ($canEdit): ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_fungicide&task=fungicideform.edit&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-edit" ></i></a>
                            <?php endif; ?>
                            <?php if ($canDelete): ?>
                                <a href="<?php echo JRoute::_('index.php?option=com_fungicide&task=fungicideform.remove&id=' . $item->id, false, 2); ?>" class="btn btn-mini delete-button" type="button"><i class="icon-trash" ></i></a>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



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

            if (!confirm("<?php echo JText::_('COM_FUNGICIDE_DELETE_MESSAGE'); ?>")) {
                return false;
            }
        }
    </script>
<?php endif; ?>
