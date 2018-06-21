<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Cropbalancesheet
 * @author     mohan <mohan.god37@gmail.com>
 * @copyright  2018 mohan
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Cropbalancesheet records.
 *
 * @since  1.6
 */
class CropbalancesheetModelBalances extends JModelList
{
/**
	* Constructor.
	*
	* @param   array  $config  An optional associative array of configuration settings.
	*
	* @see        JController
	* @since      1.6
	*/
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.`id`',
				'ordering', 'a.`ordering`',
				'state', 'a.`state`',
				'created_by', 'a.`created_by`',
				'modified_by', 'a.`modified_by`',
				'expencedate', 'a.`expencedate`',
				'cid', 'a.`cid`',
				'amount', 'a.`amount`',
				'expencetype', 'a.`expencetype`',
				'description', 'a.`description`',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   Elements order
	 * @param   string  $direction  Order direction
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);
		// Filtering cid
		$this->setState('filter.cid', $app->getUserStateFromRequest($this->context.'.filter.cid', 'filter_cid', '', 'string'));

		// Filtering expencetype
		$this->setState('filter.expencetype', $app->getUserStateFromRequest($this->context.'.filter.expencetype', 'filter_expencetype', '', 'string'));


		// Load the parameters.
		$params = JComponentHelper::getParams('com_cropbalancesheet');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.cid', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return   string A store id.
	 *
	 * @since    1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.state');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return   JDatabaseQuery
	 *
	 * @since    1.6
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select', 'DISTINCT a.*'
			)
		);
		$query->from('`#__cropbalancesheet_balance` AS a');

		// Join over the users for the checked out user
		$query->select("uc.name AS uEditor");
		$query->join("LEFT", "#__users AS uc ON uc.id=a.checked_out");

		// Join over the user field 'created_by'
		$query->select('`created_by`.name AS `created_by`');
		$query->join('LEFT', '#__users AS `created_by` ON `created_by`.id = a.`created_by`');

		// Join over the user field 'modified_by'
		$query->select('`modified_by`.name AS `modified_by`');
		$query->join('LEFT', '#__users AS `modified_by` ON `modified_by`.id = a.`modified_by`');
		// Join over the foreign key 'cid'
		$query->select('`#__cropdetail_2984575`.`id` AS #__cropdetail_fk_value_2984575');
		$query->join('LEFT', '#__cropdetail AS #__cropdetail_2984575 ON #__cropdetail_2984575.`id` = a.`cid`');
		// Join over the foreign key 'expencetype'
		$query->select('`#__expencetype_2984577`.`name` AS #__expencetype_fk_value_2984577');
		$query->join('LEFT', '#__expencetype AS #__expencetype_2984577 ON #__expencetype_2984577.`id` = a.`expencetype`');

		// Filter by published state
		$published = $this->getState('filter.state');

		if (is_numeric($published))
		{
			$query->where('a.state = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.state IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where('(#__cropdetail_2984575.id LIKE ' . $search . ' )');
			}
		}


		// Filtering cid
		$filter_cid = $this->state->get("filter.cid");

		if ($filter_cid !== null && !empty($filter_cid))
		{
			$query->where("a.`cid` = '".$db->escape($filter_cid)."'");
		}

		// Filtering expencetype
		$filter_expencetype = $this->state->get("filter.expencetype");

		if ($filter_expencetype !== null && !empty($filter_expencetype))
		{
			$query->where("a.`expencetype` = '".$db->escape($filter_expencetype)."'");
		}
		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');

		if ($orderCol && $orderDirn)
		{
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}

		return $query;
	}

	/**
	 * Get an array of data items
	 *
	 * @return mixed Array of data items on success, false on failure.
	 */
	public function getItems()
	{
		$items = parent::getItems();

		foreach ($items as $oneItem)
		{

			if (isset($oneItem->cid))
			{
				$values    = explode(',', $oneItem->cid);
				$textValue = array();

				foreach ($values as $value)
				{
					$db    = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
						->select('`#__cropdetail_2984575`.`id`')
						->from($db->quoteName('#__cropdetail', '#__cropdetail_2984575'))
						->where($db->quoteName('id') . ' = '. $db->quote($db->escape($value)));

					$db->setQuery($query);
					$results = $db->loadObject();

					if ($results)
					{
						$textValue[] = $results->id;
					}
				}

				$oneItem->cid = !empty($textValue) ? implode(', ', $textValue) : $oneItem->cid;
			}

			if (isset($oneItem->expencetype))
			{
				$values    = explode(',', $oneItem->expencetype);
				$textValue = array();

				foreach ($values as $value)
				{
					$db    = JFactory::getDbo();
					$query = $db->getQuery(true);
					$query
						->select('`#__expencetype_2984577`.`name`')
						->from($db->quoteName('#__expencetype', '#__expencetype_2984577'))
						->where($db->quoteName('id') . ' = '. $db->quote($db->escape($value)));

					$db->setQuery($query);
					$results = $db->loadObject();

					if ($results)
					{
						$textValue[] = $results->name;
					}
				}

				$oneItem->expencetype = !empty($textValue) ? implode(', ', $textValue) : $oneItem->expencetype;
			}
		}

		return $items;
	}
}
