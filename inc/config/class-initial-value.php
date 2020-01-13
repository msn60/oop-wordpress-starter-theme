<?php
/**
 * Initial_Value Class File
 *
 * Role of this class is like RC configuration files in application. If you need
 * to initial value to start your theme or need them for each time that WordPress
 * run your theme, you can use from this class.
 *
 * @package    Theme_Name_Name_Space
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
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */
class Initial_Value {

	/**
	 * Initial values to create admin menu page.
	 *
	 * @access public
	 * @return array It returns all of arguments that add_menu_page function needs.
	 * @see    Inc/Admin/Admin_Menu
	 */
	public function sample_menu_page() {
		$initial_value = [
			'page_title'        => esc_html__( 'Msn Theme Option', 'msn-starter-theme' ),
			'menu_title'        => esc_html__( 'Theme Option', 'msn-starter-theme' ),
			'capability'        => 'manage_options',
			'menu_slug'         => 'theme-name-option-page-url',
			'callable_function' => 'management_panel_handler',//it can be null
			'icon_url'          => 'dashicons-welcome-widgets-menus',
			'position'          => 11,
			'identifier'        => 'sample_menu_page1'
		];

		return $initial_value;
	}

	/**
	 * Initial values to create admin submenu page (submenu1).
	 *
	 * @access public
	 * @return array It returns all of arguments that add_submenu_page function needs.
	 * @see    Inc/Admin/Admin_Sub_Menu
	 */
	public function sample_sub_menu_page1() {
		$initial_value = [
			'parent-slug'       => 'theme-name-option-page-url',
			'page_title'        => esc_html__( 'Theme Submenu 1', 'msn-starter-theme' ),
			'menu_title'        => esc_html__( 'Theme Submenu 1', 'msn-starter-theme' ),
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
	 * @return array It returns all of arguments that add_submenu_page function needs.
	 * @see    Includes/Admin/Admin_Sub_Menu
	 */
	public function sample_sub_menu_page2() {
		$initial_value = [
			'parent-slug'       => 'theme-name-option-page-url',
			'page_title'        => esc_html__( 'Theme Submenu 2', 'msn-starter-theme' ),
			'menu_title'        => esc_html__( 'Theme Submenu 2', 'msn-starter-theme' ),
			'capability'        => 'manage_options',
			'menu_slug'         => 'theme-name-option-page-url-2',
			'callable_function' => 'sub_menu2_panel_handler',
		];

		return $initial_value;
	}

	/**
	 * Initial values to create meta box 1.
	 *
	 * @access public
	 * @see    https://developer.wordpress.org/reference/functions/get_post_meta/
	 * @see    https://developer.wordpress.org/reference/functions/add_meta_box/
	 * @return array It returns all of arguments that add_meta_box function needs.
	 */
	public function sample_meta_box1() {
		$initial_value = [

			'id'            => 'meta_box_1_id',
			'title'         => esc_html__( 'Meta box1 Headline', 'msn-starter-theme' ),
			'callback'      => 'render_content',
			'screens'       => array( 'post', 'page' ),//null - optional
			'context'       => 'advanced', //optional
			'priority'      => 'high', //optional
			'callback_args' => null, //optional
			'meta_key'      => '_msn_oop_starter_meta_box_key_1',
			'single'        => true, //the result of get_post_meta Will be an array if $single is false
			'action'        => 'oop_msn_starter_meta_box1',
			'nonce_name'    => 'oop_msn_starter_meta_box1_nonce'

		];

		return $initial_value;
	}

	/**
	 * Initial values to create meta box 1.
	 *
	 * @access public
	 * @see    https://developer.wordpress.org/reference/functions/get_post_meta/
	 * @see    https://developer.wordpress.org/reference/functions/add_meta_box/
	 * @return array It returns all of arguments that add_meta_box function needs.
	 */
	public function sample_meta_box2() {
		$initial_value = [

			'id'            => 'meta_box_2_id',
			'title'         => esc_html__( 'Meta box2 Headline', 'msn-starter-theme' ),
			'callback'      => 'render_content',
			'screens'       => null,//null - optional
			'context'       => 'side', //optional
			'priority'      => 'high', //optional
			'callback_args' => null, //optional
			'meta_key'      => '_msn_oop_starter_meta_key_2',
			'single'        => false, //the result of get_post_meta Will be an array if $single is false
			'action'        => 'oop_msn_starter_meta_box2',
			'nonce_name'    => 'oop_msn_starter_meta_box2_nonce'

		];

		return $initial_value;
	}

}
