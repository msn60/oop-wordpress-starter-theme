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

use function PHPSTORM_META\type;
use Theme_Name_Name_Space\Inc\Abstracts\Admin_Menu;
use Theme_Name_Name_Space\Inc\Abstracts\Admin_Sub_Menu;
use Theme_Name_Name_Space\Inc\Admin\{
	Admin_Menu1, Admin_Sub_Menu1, Admin_Sub_Menu2, Meta_box
};
use Theme_Name_Name_Space\Inc\Config\{
	Initial_Value, Meta_Box1_Config, Meta_Box2_Config
};

use Theme_Name_Name_Space\Inc\Parts\{
	Sample_Ajax_1, Sample_Ajax_2
};

use Theme_Name_Name_Space\Inc\Functions\{Utility, Check_Type};
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
class Main {
	use Meta_Box1_Config;
	use Meta_Box2_Config;
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
	 * @var Sample_Ajax_1 $sample_ajax_1
	 */
	protected $sample_ajax_1;
	/**
	 * @var Sample_Ajax_2 $sample_ajax_2
	 */
	protected $sample_ajax_2;
	/**
	 * @var Initial_Value $initial_values An object  to keep all of initial values for theme
	 */
	protected $initial_values;

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
		Sample_Ajax_1 $sample_ajax_1 = null,
		Sample_Ajax_2 $sample_ajax_2 = null

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

		$this->hooks           = $hooks;
		$this->initial_values  = $initial_values;
		$this->admin_menus     = $this->set_array_by_type( $admin_menus, Admin_Menu::class )['valid'];
		$this->admin_sub_menus = $this->set_array_by_type( $admin_sub_menus, Admin_Sub_Menu::class )['valid'];
		$this->sample_ajax_1 = $sample_ajax_1;
		$this->sample_ajax_2 = $sample_ajax_2;

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
		$this->handle_ajax_call();
		if ( is_admin() ) {
			$this->set_admin_menus();
			/*
			 * set meta boxes here
			 * */
			add_action( 'load-post.php', array( $this, 'set_meta_boxes' ) );
			add_action( 'load-post-new.php', array( $this, 'set_meta_boxes' ) );
		} else {
			/*
			 * Remove extra actions from your WordPress site & some conditions if your are not in admin dashboard
			 * */
			$this->hooks->remove_extra_actions();
		}

	}

	/**
	 * Method to handle ajax calls in theme
	 *
	 * @access public
	 * @since  1.0.1
	 */
	public function handle_ajax_call() {
		$this->sample_ajax_1->set_add_actions();
		$this->sample_ajax_2->set_add_actions();
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


	public function set_meta_boxes() {

		$meta_box_obj1 = new Meta_box( $this->sample_meta_box1() );
		$meta_box_obj2 = new Meta_box( $this->sample_meta_box2() );
	}


}


