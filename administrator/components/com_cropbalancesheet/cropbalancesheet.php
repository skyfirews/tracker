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

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_cropbalancesheet'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Cropbalancesheet', JPATH_COMPONENT_ADMINISTRATOR);
JLoader::register('CropbalancesheetHelper', JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'cropbalancesheet.php');

$controller = JControllerLegacy::getInstance('Cropbalancesheet');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
