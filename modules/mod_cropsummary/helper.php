<?php

/**
 * @copyright	Copyright (c) 2018 cropsummary. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die;

/**
 * cropsummary - Crop Summary Helper Class.
 *
 * @package		Joomla.Site
 * @subpakage	cropsummary.CropSummary
 */
class modCropSummaryHelper {

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
        $return_array['cuttingdate'] = $current_crop_cuttingdate;
        $date1 = new DateTime($current_crop_cuttingdate);
        $currentdate = date('Y-m-d');
        $date2 = new DateTime($currentdate);
        $interval = $date1->diff($date2);
        $return_array['humanreadable'] = " " . $interval->m . " months, " . $interval->d . " days ";
        $return_array['totaldays'] = $interval->days;
        return $return_array;
    }

    public static function totalspent() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
                ->select('cuttingdate,id')
                ->from($db->quoteName('#__cropdetail'))
                ->where('cropstatus=1');
        $db->setQuery($query);
        $results = $db->loadObject();
        $pk = $results->id;
        $query = $db->getQuery(true);
        $query
                ->select('SUM(amount) as totalspend')
                ->from($db->quoteName('#__cropbalancesheet_balance'))
                ->where('cid=' . $pk);
        $db->setQuery($query);
        $results = $db->loadObject();
        return $results->totalspend;
    }

    public static function spraydetials() {
        $db = JFactory::getDbo();
        $return = array();
        $query = $db->getQuery(true);
        $query
                ->select('cuttingdate,id')
                ->from($db->quoteName('#__cropdetail'))
                ->where('cropstatus=1');
        $db->setQuery($query);
        $results = $db->loadObject();
        $pk = $results->id;
        $query = $db->getQuery(true);
        $query
                ->select('*')
                ->from($db->quoteName('#__fungicide'))
                ->where('cid=' . $pk)
                ->order($db->quoteName('id') . ' desc');
        $db->setQuery($query, 0, 1);
        $obj = $db->loadObject();
        $date1 = new DateTime($obj->dateofspray);
        $currentdate = date('Y-m-d');
        $date2 = new DateTime($currentdate);
        $interval = $date1->diff($date2);
        $return['dateofspray'] = $obj->dateofspray;
        $return['ratiodescribe'] = $obj->ratiodescribe;
        $return['sprayedback'] = " " . $interval->m . " months, " . $interval->d . " days ";
        $query1 = $db->getQuery(true);
        $query1
                ->select('count(*) as totalsprays')
                ->from($db->quoteName('#__fungicide'))
                ->where('cid=' . $pk);
        $db->setQuery($query1);
        $obj1 = $db->loadObject();
        $return['totalsprays'] = $obj1->totalsprays;

        return $return;
    }

}
