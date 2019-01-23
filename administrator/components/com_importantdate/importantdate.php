<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Importantdate
 * @author     mohan <mohan.god37@gmail.com>
 * @copyright  2019 mohan
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_importantdate'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Importantdate', JPATH_COMPONENT_ADMINISTRATOR);
JLoader::register('ImportantdateHelper', JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'importantdate.php');

$controller = JControllerLegacy::getInstance('Importantdate');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
