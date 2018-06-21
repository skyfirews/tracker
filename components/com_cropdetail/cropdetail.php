<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Cropdetail
 * @author     mohan <mohan.god37@gmail.com>
 * @copyright  2018 mohan
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Cropdetail', JPATH_COMPONENT);
JLoader::register('CropdetailController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Cropdetail');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
