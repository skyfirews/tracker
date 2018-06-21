<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Cropdetail
 * @author     mohan <mohan.god37@gmail.com>
 * @copyright  2018 mohan
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Cropdetail controller class.
 *
 * @since  1.6
 */
class CropdetailControllerCropdetail extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'cropdetails';
		parent::__construct();
	}
}
