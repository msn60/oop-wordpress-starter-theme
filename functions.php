<?php
/**
 * The main template that your theme works with it.
 *
 * This file is like a plugin for your template. All of functions and classes
 * that you want to use it in your WordPress theme, are inside in this file.
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */

use Theme_Name_Name_Space\Inc\Core\{
	Constant, Main, Hook
};
use Theme_Name_Name_Space\Inc\Admin\{
	Admin_Menu1, Admin_Sub_Menu1, Admin_Sub_Menu2
};

use Theme_Name_Name_Space\Inc\Config\Initial_Value;


/*
 * Using Main class to prepare your theme
 * */


/**
 * Class Theme_Name_Theme
 *
 * This class is primary file of theme which is used from
 * singleton design pattern.
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */
final class Theme_Name_Theme {
	/**
	 * Instance property of Plugin_Name_Plugin Class.
	 * This is a property in your plugin primary class. You will use to create
	 * one object from Plugin_Name_Plugin class in whole of program execution.
	 *
	 * @access private
	 * @var    Plugin_Name_Plugin $instance create only one instance from plugin primary class
	 * @static
	 */
	private static $instance;
	/**
	 * @var Initial_Value $initial_values An object  to keep all of initial values for theme
	 */
	protected $initial_values;
	/**
	 * @var Main $main_object An object to keep Main class for theme.
	 */
	private $main_object;

	/**
	 * Plugin_Name_Plugin constructor.
	 * It defines related constant, include autoloader class, register activation hook,
	 * deactivation hook and uninstall hook and call Core class to run dependencies for plugin
	 *
	 * @access private
	 */
	private function __construct() {
		$autoloader_path = 'inc/class-autoloader.php';
		/**
		 * Include autoloader class to load all of classes inside this theme
		 */
		require_once trailingslashit( get_theme_file_path() ) . $autoloader_path;

		/*
		 * Define required constant for theme
		 * */
		Constant::define_constant();

	}

	/**
	 * Create an instance from Theme_Name_Theme class.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return Theme_Name_Theme
	 */
	public static function instance() {
		if ( is_null( ( self::$instance ) ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * init theme with dependency injections
	 *
	 * @access public
	 * @since  1.0.0
	 */
	public function init_theme() {
		$this->initial_values                        = new Initial_Value();
		$this->main_object                           = new Main(
			new Hook(),
			$this->initial_values,
			new Admin_Menu1( $this->initial_values->sample_menu_page() ),
			new Admin_Sub_Menu1($this->initial_values->sample_sub_menu_page1()),
			new Admin_Sub_Menu2($this->initial_values->sample_sub_menu_page2())
		);
		$this->main_object->init_main();
	}

}

$theme_name_theme_object = Theme_Name_Theme::instance();
$theme_name_theme_object->init_theme();









