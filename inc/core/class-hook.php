<?php
/**
 * Hook Class File
 *
 * This file contains Hook class which can manage and handle hooks in your theme
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
use Theme_Name_Name_Space\Inc\Core\Main;
use Theme_Name_Name_Space\Inc\Abstracts\{
	Admin_Menu, Admin_Sub_Menu
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Hook
 *
 * This file contains Hook class which can manage and handle hooks in your theme
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 *
 */
class Hook {

	/**
	 * Init function for Control inversion.
	 * This is init function to use dependency injection and you can use it for hooking your file
	 * inside it like actions or filters
	 *
	 * @access private
	 * @since  1.0.1
	 *
	 * @param \Theme_Name_Name_Space\Inc\Core\Main $main_object
	 *
	 * @see    https://carlalexander.ca/designing-class-wordpress-hooks/
	 * @see    http://farhadnote.ir/articles/2017/11/14/dependency-injection.html
	 */
	public function initial_theme_hooks( Main $main_object ) {

		add_action( 'after_setup_theme', array( $main_object, 'setup' ) );
		add_action( 'wp_enqueue_scripts', array( $main_object, 'scripts' ), 10 );
		/*add_action( 'widgets_init', array( $main_object, 'widgets_init' ) );*/
		if ( is_admin() ) {
			/*
			 * set meta boxes here
			 * */
			add_action( 'load-post.php', array( $main_object, 'set_meta_boxes' ) );
			add_action( 'load-post-new.php', array( $main_object, 'set_meta_boxes' ) );
		}


		$main_object->handle_ajax_call();
	}

	public function add_theme_filters( Main $main_object ) {
		/*
		 * Add portfolio page template in subdirectory
		 * by using Utility trait
		 * */
		add_filter( 'template_include', [ $main_object, 'portfolio_page_template' ], 99 );
		/*
		 * show content only for login users (optional)
		 * */
		add_filter( 'Theme_name_name_space_only_show_for_login_users', [ $main_object, 'show_only_login_users' ] );
		/*if ( ! is_admin() ) {
			add_filter( 'show_admin_bar', '__return_false' );
		}*/

	}


	/**
	 * Action to set admin menu page in WordPress admin panel
	 *
	 * @param Admin_Menu $admin_menu
	 */
	public function set_admin_menu_hook( Admin_Menu $admin_menu ) {
		add_action( 'admin_menu', array( $admin_menu, 'add_admin_menu_page' ) );
	}


	/**
	 * * Action to set admin sub menu page in WordPress admin panel
	 *
	 * @param Admin_Sub_Menu $admin_sub_menu
	 */
	public function set_admin_sub_menu_hook( Admin_Sub_Menu $admin_sub_menu ) {
		add_action( 'admin_menu', array( $admin_sub_menu, 'add_admin_sub_menu_page' ) );
	}


	/**
	 * Actions for disable feeds
	 *
	 * @param \Theme_Name_Name_Space\Inc\Core\Main $main_object
	 */
	public function disable_feeds( Main $main_object ) {
		add_action( 'do_feed', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rdf', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rss', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rss2', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_atom', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rss2_comments', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_atom_comments', [ $main_object, 'disable_feeds' ], 1 );
	}

	/**
	 * Remove extra actions.
	 * This method removes extra add_actions that you want to avoid from executing.
	 *
	 * @access public
	 * @since  1.0.1
	 */
	public function remove_extra_actions() {
		/*
		 * Display the links to the extra feeds such as category feeds
		 * */
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		/*
		 * Display the links to the general feeds: Post and Comment Feed
		 * */
		remove_action( 'wp_head', 'feed_links', 2 );
		/*
		 * Display the link to the Really Simple Discovery service endpoint, EditURI link
		 * */
		remove_action( 'wp_head', 'rsd_link' );
		/*
		 * Display the link to the Windows Live Writer manifest file.
		 * */
		remove_action( 'wp_head', 'wlwmanifest_link' );
		/*
		 * index link
		 * */
		remove_action( 'wp_head', 'index_rel_link' );
		/*
		 * prev link
		 * */
		remove_action( 'wp_head', 'parent_post_rel_link', 10 );
		/*
		 * start link
		 * */
		remove_action( 'wp_head', 'start_post_rel_link', 10 );
		/*
		 * Display relational links for the posts adjacent to the current post.
		 * */
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10 );
		/*
		 * Display the XHTML generator that is generated on the wp_head hook, WP version
		 * */
		remove_action( 'wp_head', 'wp_generator' );
		/*
		 * remove emojis
		 * */
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}

	/**
	 * @param $property
	 *
	 * @return mixed
	 */
	public function __get( $property ) {
		return $this->$property;
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function __set( $name, $value ) {
		$this->$name = $value;
	}


}
