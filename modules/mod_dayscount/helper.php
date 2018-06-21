<?php

/**
 * @copyright	Copyright (c) 2018 costom. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die;

/**
 * costom - days count after cutting Helper Class.
 *
 * @package		Joomla.Site
 * @subpakage	dayscount.dayscount
 */
class moddayscountHelper {

    public static function getcurentdaycount() {
        $return_array = array();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query  
                ->select('cuttingdate,id')
                ->from($db->quoteName('#__cropdetail'))
                ->where('cropstatus=1');
        $db->setQuery($query);
        $results = $db->loadObject();
        $current_crop_cuttingdate = $results->cuttingdate;
        $date1 = new DateTime($current_crop_cuttingdate);
        $currentdate = date('Y-m-d');
        $date2 = new DateTime($currentdate);
        $interval = $date1->diff($date2);
        $return_array['humanreadable'] =" " .$interval->m . " months, " . $interval->d . " days ";
        $return_array['totaldays'] = $interval->days;
        return $return_array;
    }

}
