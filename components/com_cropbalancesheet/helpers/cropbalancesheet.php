<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Cropbalancesheet
 * @author     mohan <mohan.god37@gmail.com>
 * @copyright  2018 mohan
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

JLoader::register('CropbalancesheetHelper', JPATH_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_cropbalancesheet' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'cropbalancesheet.php');

/**
 * Class CropbalancesheetFrontendHelper
 *
 * @since  1.6
 */
class CropbalancesheetHelpersCropbalancesheet
{
	/**
	 * Get an instance of the named model
	 *
	 * @param   string  $name  Model name
	 *
	 * @return null|object
	 */
	public static function getModel($name)
	{
		$model = null;

		// If the file exists, let's
		if (file_exists(JPATH_SITE . '/components/com_cropbalancesheet/models/' . strtolower($name) . '.php'))
		{
			require_once JPATH_SITE . '/components/com_cropbalancesheet/models/' . strtolower($name) . '.php';
			$model = JModelLegacy::getInstance($name, 'CropbalancesheetModel');
		}

		return $model;
	}

	/**
	 * Gets the files attached to an item
	 *
	 * @param   int     $pk     The item's id
	 *
	 * @param   string  $table  The table's name
	 *
	 * @param   string  $field  The field's name
	 *
	 * @return  array  The files
	 */
	public static function getFiles($pk, $table, $field)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->select($field)
			->from($table)
			->where('id = ' . (int) $pk);

		$db->setQuery($query);

		return explode(',', $db->loadResult());
	}

    /**
     * Gets the edit permission for an user
     *
     * @param   mixed  $item  The item
     *
     * @return  bool
     */
    public static function canUserEdit($item)
    {
        $permission = false;
        $user       = JFactory::getUser();

        if ($user->authorise('core.edit', 'com_cropbalancesheet'))
        {
            $permission = true;
        }
        else
        {
            if (isset($item->created_by))
            {
                if ($user->authorise('core.edit.own', 'com_cropbalancesheet') && $item->created_by == $user->id)
                {
                    $permission = true;
                }
            }
            else
            {
                $permission = true;
            }
        }

        return $permission;
    }
}
