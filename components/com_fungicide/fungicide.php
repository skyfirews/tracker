<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Fungicide
 * @author     mohan <mohan.god37@gmail.com>
 * @copyright  2018 mohan
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Fungicide', JPATH_COMPONENT);
JLoader::register('FungicideController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Fungicide');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
