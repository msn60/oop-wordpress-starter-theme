<?php
/**
 * Action_Hook_Interface interface File
 *
 * This file contains Action_Hook_Interface_Interface. If you to use add_action and remove_action in your class,
 * you must use from this contract to implement it.
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.1
 */

namespace Theme_Name_Name_Space\Inc\Interfaces;

use Theme_Name_Name_Space\Inc\Config\Initial_Value;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Action_Hook_Interface interface File
 *
 * This file contains Action_Hook_Interface_Interface. If you to use add_action in your class,
 * you must use from this contract to implement it.
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */
interface Action_Hook_Interface {

	/**
	 * Register actions that the object needs to be subscribed to.
	 *
	 */
	public function register_action();
}