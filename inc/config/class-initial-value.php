<?php
/**
 * Initial_Value Class File
 *
 * Role of this class is like RC configuration files in application. If you need
 * to initial value to start your theme or need them for each time that WordPress
 * run your theme, you can use from this class.
 *
 * @package    Theme_Name_Name_Space\Inc\Config
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.1
 */

namespace Theme_Name_Name_Space\Inc\Config;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Initial_Value.
 * If you need to initial value to start your theme or need them for
 * each time that WordPress run your theme, you can use from this class.
 *
 * @package    Theme_Name_Name_Space\Inc\Config
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */
trait Initial_Value {

	/**
	 * Initial values to create admin menu page.
	 *
	 * @access public
	 * @static
	 * @see    Inc/Admin/Admin_Menu
	 * @return array It returns all of arguments that add_menu_page function needs.
	 */
	public function sample_menu_page() {
		$initial_value = [
			'page_title'        => 'Msn Theme Option',
			'menu_title'        => 'Theme Option',
			'capability'        => 'manage_options',
			'menu_slug'         => 'theme-name-option-page-url',
			'callable_function' => 'management_panel_handler',
			'icon_url'          => 'dashicons-welcome-widgets-menus',
			'position'          => 11,
		];

		return $initial_value;
	}

	/**
	 * Initial values to create admin submenu page (submenu1).
	 *
	 * @access public
	 * @static
	 * @see    Inc/Admin/Admin_Sub_Menu
	 * @return array It returns all of arguments that add_submenu_page function needs.
	 */
	public function sample_sub_menu_page1() {
		$initial_value = [
			'parent-slug'       => 'theme-name-option-page-url',
			'page_title'        => 'Theme Submenu 1',
			'menu_title'        => 'Theme Submenu 1',
			'capability'        => 'manage_options',
			'menu_slug'         => 'theme-name-option-page-url',
			'callable_function' => 'sub_menu1_panel_handler',
		];

		return $initial_value;
	}

	/**
	 * Initial values to create admin submenu page (submenu2).
	 *
	 * @access public
	 * @static
	 * @see    Includes/Admin/Admin_Sub_Menu
	 * @return array It returns all of arguments that add_submenu_page function needs.
	 */
	public static function sample_sub_menu_page2() {
		$initial_value = [
			'parent-slug'       => 'theme-name-option-page-url',
			'page_title'        => 'Theme Submenu 2',
			'menu_title'        => 'Theme Submenu 2',
			'capability'        => 'manage_options',
			'menu_slug'         => 'theme-name-option-page-url-2',
			'callable_function' => 'sub_menu2_panel_handler',
		];

		return $initial_value;
	}

}
