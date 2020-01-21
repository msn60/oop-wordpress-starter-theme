<?php
/**
 * Main Class File
 *
 * This file contains main class which can manage and handle important tasks in your theme
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.0
 */

namespace Theme_Name_Name_Space\Inc\Core;

/*
 * Define your namespaces here by use keyword
 * */

use Theme_Name_Name_Space\Inc\Abstracts\{
	Admin_Menu, Admin_Sub_Menu, Ajax, Meta_box
};

use Theme_Name_Name_Space\Inc\Interfaces\{
	Action_Hook_Interface, Filter_Hook_Interface
};
use Theme_Name_Name_Space\Inc\Admin\{
	Admin_Menu1, Admin_Sub_Menu1, Admin_Sub_Menu2
};
use Theme_Name_Name_Space\Inc\Config\{
	Initial_Value
};

use Theme_Name_Name_Space\Inc\Parts\{
	Sample_Ajax_1, Sample_Ajax_2
};

use Theme_Name_Name_Space\Inc\Functions\{
	Utility, Check_Type
};
use Theme_Name_Name_Space\Inc\Core\Hook;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Main
 *
 * Main class can manage and handle all of tasks that you need in your theme.
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */
class Main implements Action_Hook_Interface {
	use Utility;
	use Check_Type;
	/**
	 * The unique identifier of this theme.
	 *
	 * @since    1.0.1
	 * @access   protected
	 * @var      string $theme_name The string used to uniquely identify this theme.
	 */
	protected $theme_name;
	/**
	 * The current version of the theme.
	 *
	 * @since    1.0.1
	 * @access   protected
	 * @var      string $theme_version The current version of the theme.
	 */
	protected $theme_version;
	/**
	 * @var Hook $hook_object Object  to keep all of hooks in your theme
	 */
	protected $hooks;
	/**
	 * @var Admin_Menu[] $admin_menus
	 */
	protected $admin_menus;
	/**
	 * @var Admin_Sub_Menu[] $admin_sub_menus
	 */
	protected $admin_sub_menus;
	/**
	 * @var Ajax[] $ajax_calls
	 */
	protected $ajax_calls;
	/**
	 * @var Initial_Value $initial_values An object  to keep all of initial values for theme
	 */
	protected $initial_values;
	/**
	 * @var Meta_box[] $meta_boxes
	 */
	protected $meta_boxes;

	/**
	 * Main constructor.
	 * This is constructor of Main class
	 *
	 * @access private
	 *
	 * @param Hook  $hooks
	 * @param array $admin_menus
	 *
	 * @since  1.0.1
	 *
	 */
	public function __construct(
		Hook $hooks,
		Initial_Value $initial_values,
		array $admin_menus = null,
		array $admin_sub_menus = null,
		array $meta_boxes = null,
		array $ajax_calls = null

	) {

		if ( defined( THEME_NAME_VERSION ) ) {
			$this->theme_version = THEME_NAME_VERSION;
		} else {
			$this->theme_version = '1.0.1';
		}
		if ( defined( 'MSN_THEME_NAME' ) ) {
			$this->theme_version = MSN_THEME_NAME;
		} else {
			$this->theme_version = 'msn-oop-starter';
		}

		$this->hooks          = $hooks;
		$this->initial_values = $initial_values;
		/*
		 * Checking for valid types
		 * */
		$this->admin_menus     = $this->set_array_by_parent_type( $admin_menus, Admin_Menu::class )['valid'];
		$this->admin_sub_menus = $this->set_array_by_parent_type( $admin_sub_menus, Admin_Sub_Menu::class )['valid'];
		$this->meta_boxes      = $this->set_array_by_parent_type( $meta_boxes, Meta_box::class )['valid'];;
		$this->ajax_calls      = $this->set_array_by_parent_type( $ajax_calls, Ajax::class )['valid'];;


	}


	/**
	 * Init_theme_method
	 *
	 * @access public
	 * @since  1.0.1
	 *
	 *
	 * @see    https://carlalexander.ca/designing-class-wordpress-hooks/
	 * @see    http://farhadnote.ir/articles/2017/11/14/dependency-injection.html
	 */
	public function init_main() {

		$this->hooks->theme_add_actions();
		$this->hooks->theme_add_filters();
		$this->hooks->disable_feeds();
		//if you need to get post metas in response of WP REST API for posts
		$this->hooks->add_meta_rest_field();

		/*		if ( is_admin() ) {
					add_action( 'load-post.php', array( $this, 'set_meta_boxes' ) );
					add_action( 'load-post-new.php', array( $this, 'set_meta_boxes' ) );
				} */
		$this->register_action();

	}

	public function register_action() {
		if ( is_admin() ) {
			$this->set_admin_menus();
			$this->set_meta_boxes();
		} else {
			/*
			 * Remove extra actions from your WordPress site & some conditions if your are not in admin dashboard
			 * */
			$this->hooks->remove_extra_actions();
		}
		$this->handle_ajax_call();

	}

	/**
	 * Method to set all of needed admin menus and sub menus
	 *
	 * @access private
	 * @since  1.0.1
	 */
	private function set_admin_menus() {
		foreach ( $this->admin_menus as $admin_menu ) {
			$admin_menu->register_action();
		}
		foreach ( $this->admin_sub_menus as $admin_sub_menu ) {
			$admin_sub_menu->register_action();
		}
	}

	/*
	 * Method to set actions for meta boxes in theme
	 * */
	public function set_meta_boxes() {
		foreach ( $this->meta_boxes as $meta_box ) {
			$meta_box->register_action();
		}
	}

	/**
	 * Method to handle ajax calls in theme
	 *
	 * @access public
	 * @since  1.0.1
	 */
	private function handle_ajax_call() {
		foreach ( $this->ajax_calls as $ajax_call ) {
			$ajax_call->register_action();
		}
	}

	/**
	 * theme_name getter method
	 *
	 * @access public
	 * @return string
	 */
	public function get_theme_name(): string {
		return $this->theme_name;
	}

	/**
	 * theme_name setter method
	 *
	 * @param string $theme_name
	 *
	 * @access public
	 * @return void
	 */
	public function set_theme_name( string $theme_name ): void {
		$this->theme_name = $theme_name;
	}

	/**
	 * theme_version getter method
	 *
	 * @access public
	 * @return string
	 *
	 */
	public function get_theme_version(): string {
		return $this->theme_version;
	}

	/**
	 * theme_version setter method
	 *
	 * @param string $theme_name
	 *
	 * @access public
	 * @return void
	 *
	 */
	public function set_theme_version( string $theme_version ): void {
		$this->theme_version = $theme_version;
	}


}


