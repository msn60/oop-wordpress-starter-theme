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


	public function set_theme_hooks( Main $main_object ) {
		$this->initial_theme_hooks( $main_object );
	}

	/**
	 * Init function for Control inversion
	 * This is init function to use dependency injection and you can use it for hooking your file
	 * inside it like actions or filters
	 *
	 * @access private
	 * @since  1.0.1
	 *
	 * @param  object|Main $main_object
	 *
	 * @see    https://carlalexander.ca/designing-class-wordpress-hooks/
	 * @see    http://farhadnote.ir/articles/2017/11/14/dependency-injection.html
	 */
	protected function initial_theme_hooks( Main $main_object ) {

		add_action( 'after_setup_theme', array( $main_object, 'setup' ) );
		add_action( 'wp_enqueue_scripts', array( $main_object, 'scripts' ), 10 );
		/*add_action( 'widgets_init', array( $main_object, 'widgets_init' ) );*/
		if ( is_admin() ) {
			$main_object->set_admin_menu();
			/*
			 * set meta boxes here
			 * */
			add_action( 'load-post.php', array( $main_object, 'set_meta_boxes' ) );
			add_action( 'load-post-new.php', array( $main_object, 'set_meta_boxes' ) );
		} else {
			/*
			 * Remove extra actions from your WordPress site & some conditions if your are not in admin dashboard
			 * */
			$main_object->remove_extra_actions();
			//I have disabled it for development phase
			//add_filter( 'show_admin_bar', '__return_false' );
		}
		/*
		 * show content only for login users (optional)
		 * */
		add_filter( 'Theme_name_name_space_only_show_for_login_users', [ $main_object, 'show_only_login_users' ] );
		/*
		 * disable feeds
		 * by using Utility trait
		 * */
		add_action( 'do_feed', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rdf', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rss', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rss2', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_atom', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rss2_comments', [ $main_object, 'disable_feeds' ], 1 );
		add_action( 'do_feed_atom_comments', [ $main_object, 'disable_feeds' ], 1 );
		/*
		 * Add portfolio page template in subdirectory
		 * by using Utility trait
		 * */
		add_filter( 'template_include', [ $main_object, 'portfolio_page_template' ], 99 );

		$main_object->handle_ajax_call();
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
