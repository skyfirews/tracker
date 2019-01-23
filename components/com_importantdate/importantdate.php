<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Importantdate
 * @author     mohan <mohan.god37@gmail.com>
 * @copyright  2019 mohan
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Importantdate', JPATH_COMPONENT);
JLoader::register('ImportantdateController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Importantdate');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
