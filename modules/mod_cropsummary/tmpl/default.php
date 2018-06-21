<?php
/**
 * @copyright	Copyright (c) 2018 cropsummary. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die;

$dayscont_array = modCropSummaryHelper::getcurentdaycount();
$totalspent = modCropSummaryHelper::totalspent();
$spraydetials = modCropSummaryHelper::spraydetials();
?>
<div class="">
    <table class="table">
        <tr>
            <th><?php echo JText::_('Total sprays as of now'); ?></th>
            <td><?php echo $spraydetials['totalsprays'] ?></td>
        </tr>
        <tr>
            <th><?php echo JText::_('Cutting Date'); ?></th>
            <td><?php echo $dayscont_array['cuttingdate'] ?></td>
        </tr>
        <tr>
            <th><?php echo JText::_('Number of days after cutting'); ?></th>
            <td><?php echo $dayscont_array['totaldays'] . " Total Days | " . $dayscont_array['humanreadable']; ?></td>
        </tr>

        <tr>
            <th><?php echo JText::_('Total Spend as of now'); ?></th>
            <td><?php echo $totalspent; ?></td>
        </tr>

        <tr>
            <th><?php echo JText::_('Last Spray on '); ?></th>
            <td><?php echo "Sprayed on " . $spraydetials['dateofspray'] . " /" . $spraydetials['sprayedback'] . " Back on " . $spraydetials['ratiodescribe']; ?></td>
        </tr>

    </table>

</div>