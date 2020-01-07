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
use Theme_Name_Name_Space\Inc\Admin\{
	Admin_Menu, Admin_Sub_Menu, Meta_box
};
use Theme_Name_Name_Space\Inc\Config\{
	Initial_Value, Meta_Box1_Config, Meta_Box2_Config
};

use Theme_Name_Name_Space\Inc\Parts\{
	Sample_Ajax_1, Sample_Ajax_2
};

use Theme_Name_Name_Space\Inc\Functions\Utility;
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

	use Initial_Value;
	use Meta_Box1_Config;
	use Meta_Box2_Config;
	use Utility;
	/**
	 * The unique instance of the theme.
	 *
	 * @var Main
	 */
	protected static $instance;
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
	 * Main constructor.
	 * This is constructor of Main class
	 *
	 * @access private
	 * @since  1.0.1
	 */
	protected function __construct() {

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

	}

	/**
	 * Init_theme_method
	 *
	 * @access public
	 * @since  1.0.1
	 *
	 * @param  object|Hook $main_object
	 *
	 * @see    https://carlalexander.ca/designing-class-wordpress-hooks/
	 * @see    http://farhadnote.ir/articles/2017/11/14/dependency-injection.html
	 */
	public function init_theme( Hook $hook_object ) {

		$hook_object->set_theme_hooks($this);
	}

	/**
	 * Init function for Control inversion
	 * This is init function to use dependency injection and you can use it for hooking your file
	 * inside it like actions or filters
	 *
	 * @access private
	 * @since  1.0.1
	 *
	 * @see    https://carlalexander.ca/designing-class-wordpress-hooks/
	 * @see    http://farhadnote.ir/articles/2017/11/14/dependency-injection.html
	 */
	public static function init() {
		$self_main = Main::get_instance();
		add_action( 'after_setup_theme', array( $self_main, 'setup' ) );
		add_action( 'wp_enqueue_scripts', array( $self_main, 'scripts' ), 10 );
		/*add_action( 'widgets_init', array( $self_main, 'widgets_init' ) );*/
		if ( is_admin() ) {
			$self_main->set_admin_menu();
			/*
			 * set meta boxes here
			 * */
			add_action( 'load-post.php', array( $self_main, 'set_meta_boxes' ) );
			add_action( 'load-post-new.php', array( $self_main, 'set_meta_boxes' ) );
		} else {
			/*
			 * Remove extra actions from your WordPress site & some conditions if your are not in admin dashboard
			 * */
			$self_main->remove_extra_actions();
			//I have disabled it for development phase
			//add_filter( 'show_admin_bar', '__return_false' );
		}
		/*
		 * show content only for login users (optional)
		 * */
		add_filter( 'Theme_name_name_space_only_show_for_login_users', [ $self_main, 'show_only_login_users' ] );
		/*
		 * disable feeds
		 * by using Utility trait
		 * */
		add_action( 'do_feed', [ $self_main, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rdf', [ $self_main, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rss', [ $self_main, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rss2', [ $self_main, 'disable_feeds' ], 1 );
		add_action( 'do_feed_atom', [ $self_main, 'disable_feeds' ], 1 );
		add_action( 'do_feed_rss2_comments', [ $self_main, 'disable_feeds' ], 1 );
		add_action( 'do_feed_atom_comments', [ $self_main, 'disable_feeds' ], 1 );
		/*
		 * Add portfolio page template in subdirectory
		 * by using Utility trait
		 * */
		add_filter( 'template_include', [ $self_main, 'portfolio_page_template' ], 99 );

		$self_main->handle_ajax_call();
	}

	/**
	 * Define admin menu for your theme
	 *
	 * If you need some admin menus in WordPress admin panel, you can use
	 * from this method.
	 *
	 * @since    1.0.1
	 * @access   public
	 * @see      \Theme_Name_Name_Space\Inc\Config\Admin_Menu
	 * @see      \Theme_Name_Name_Space\Inc\Config\Initial_Value
	 */
	public function set_admin_menu() {
		$theme_name_sample_admin_menu = new Admin_Menu( $this->sample_menu_page() );
		add_action( 'admin_menu', array( $theme_name_sample_admin_menu, 'add_admin_menu_page' ) );

		$theme_name_sample_admin_sub_menu1 = new Admin_Sub_Menu( $this->sample_sub_menu_page1() );
		add_action( 'admin_menu', array( $theme_name_sample_admin_sub_menu1, 'add_admin_sub_menu_page' ) );

		$theme_name_sample_admin_sub_menu2 = new Admin_Sub_Menu( $this->sample_sub_menu_page2() );
		add_action( 'admin_menu', array( $theme_name_sample_admin_sub_menu2, 'add_admin_sub_menu_page' ) );
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

	public function handle_ajax_call() {

		$ajax_call_obj_1 = new Sample_Ajax_1( 'sample_ajax_call_1' );
		$ajax_call_obj_2 = new Sample_Ajax_2( 'sample_ajax_call_2' );
	}

	/**
	 * Gets an instance of  theme.
	 *
	 * @return Main
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
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

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @access public
	 */
	public function setup() {
		/*
		 * Load Localisation files.
		 *
		 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
		 */

		// Loads wp-content/themes/child-theme-name/languages/theme_name_fa_IR.mo.
		load_theme_textdomain( 'theme-name-name-space', get_stylesheet_directory() . '/languages' );

		// Loads wp-content/themes/msn-oop-starter/languages/heme_name_fa_IR.mo.
		load_theme_textdomain( 'theme-name-name-space', THEME_NAME_LANG );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable support for site logo.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-logo
		 */
		add_theme_support(
			'custom-logo', apply_filters(
				'theme_name_name_space_logo_args', array(
					'height'      => 100,
					'width'       => 400,
					'flex-width'  => true,
					'flex-height' => true,
				)
			)
		);

		/**
		 * Register menu locations.
		 *
		 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
		 */
		register_nav_menus(
			apply_filters(
				'theme_name_name_space_nav_menus', array(
					'primary'   => esc_html__( 'Primary Menu', 'theme-name-name-space' ),
					'secondary' => esc_html__( 'Secondary Menu', 'theme-name-name-space' ),
					'footer'    => esc_html__( 'Footer Menu', 'theme-name-name-space' ),
				)
			)
		);

		/*
		 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
		 * to output valid HTML5.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
		 */
		add_theme_support(
			'html5', apply_filters(
				'theme_name_name_space_html5_args', array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'widgets',
				)
			)
		);

		/**
		 * Setup the WordPress core custom background feature.
		 *
		 * @link  https://developer.wordpress.org/reference/functions/add_theme_support/#custom-background
		 */
		add_theme_support(
			'custom-background', apply_filters(
				'theme_name_name_space_custom_background_args', array(
					'default-color' => apply_filters( 'theme_name_name_space_default_background_color', 'ffffff' ),
					'default-image' => '',
				)
			)
		);

		/**
		 * Setup the WordPress core custom header feature.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-header
		 */
		add_theme_support(
			'custom-header', apply_filters(
				'theme_name_name_space_custom_header_args', array(
					'default-image' => '',
					'header-text'   => false,
					'width'         => 1950,
					'height'        => 500,
					'flex-width'    => true,
					'flex-height'   => true,
				)
			)
		);

		/**
		 * Declare support for title theme feature.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Declare support for selective refreshing of widgets.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for Block Styles.
		 */
		add_theme_support( 'wp-block-styles' );

		/**
		 * Add support for full and wide align images.
		 */
		add_theme_support( 'align-wide' );

		/**
		 * Add support for editor styles.
		 */
		add_theme_support( 'editor-styles' );

		/**
		 * Enqueue editor styles.
		 * If you need to enqueue editor style, you can use it.
		 *
		 * @link: https://richtabor.com/add-wordpress-theme-styles-to-gutenberg/
		 */
		add_editor_style( THEME_NAME_CSS . 'admin/gutenberg-editor.css' );

		/**
		 * Enqueue editor styles.
		 */
		//add_editor_style( array( 'assets/css/base/gutenberg-editor.css', $this->google_fonts() ) );

		// Editor color palette for gutenberg.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Primary', $this->theme_name ),
					'slug'  => 'primary',
					'color' => '#bb0000',
				),
				array(
					'name'  => esc_html__( 'Secondary', $this->theme_name ),
					'slug'  => 'secondary',
					'color' => '#00bb00',
				),
				array(
					'name'  => esc_html__( 'Dark Gray', $this->theme_name ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => esc_html__( 'Light Gray', $this->theme_name ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => esc_html__( 'White', $this->theme_name ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		/**
		 * Add support for responsive embedded content.
		 */
		add_theme_support( 'responsive-embeds' );

		/**
		 * Add image size for your theme
		 */
		add_image_size( 'theme-name-name-space-landscape', 400, 260, true );
		add_image_size( 'theme-name-name-space-portrait', 480, 650, true );
	}

	/**
	 * Register widget area.
	 *
	 * @link  https://codex.wordpress.org/Function_Reference/register_sidebar
	 * @since 1.0.1
	 */
	public function widgets_init() {
		$sidebar_args['sidebar'] = array(
			'name'        => esc_html__( 'Sidebar', 'storefront' ),
			'id'          => 'sidebar-1',
			'description' => '',
		);

		$sidebar_args['header'] = array(
			'name'        => esc_html__( 'Below Header', 'storefront' ),
			'id'          => 'header-1',
			'description' => esc_html__( 'Widgets added to this region will appear beneath the header and above the main content.', 'storefront' ),
		);

		$rows    = intval( apply_filters( 'storefront_footer_widget_rows', 1 ) );
		$regions = intval( apply_filters( 'storefront_footer_widget_columns', 4 ) );

		for ( $row = 1; $row <= $rows; $row ++ ) {
			for ( $region = 1; $region <= $regions; $region ++ ) {
				$footer_n = $region + $regions * ( $row - 1 ); // Defines footer sidebar ID.
				$footer   = sprintf( 'footer_%d', $footer_n );

				if ( 1 === $rows ) {
					/* translators: 1: column number */
					$footer_region_name = sprintf( esc_html__( 'Footer Column %1$d', 'storefront' ), $region );

					/* translators: 1: column number */
					$footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of the footer.', 'storefront' ),
						$region );
				} else {
					/* translators: 1: row number, 2: column number */
					$footer_region_name = sprintf( esc_html__( 'Footer Row %1$d - Column %2$d', 'storefront' ), $row, $region );

					/* translators: 1: column number, 2: row number */
					$footer_region_description = sprintf( esc_html__( 'Widgets added here will appear in column %1$d of footer row %2$d.', 'storefront' ),
						$region, $row );
				}

				$sidebar_args[ $footer ] = array(
					'name'        => $footer_region_name,
					'id'          => sprintf( 'footer-%d', $footer_n ),
					'description' => $footer_region_description,
				);
			}
		}

		$sidebar_args = apply_filters( 'storefront_sidebar_args', $sidebar_args );

		foreach ( $sidebar_args as $sidebar => $args ) {
			$widget_tags = array(
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<span class="gamma widget-title">',
				'after_title'   => '</span>',
			);

			/**
			 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
			 *
			 * 'storefront_header_widget_tags'
			 * 'storefront_sidebar_widget_tags'
			 *
			 * 'storefront_footer_1_widget_tags'
			 * 'storefront_footer_2_widget_tags'
			 * 'storefront_footer_3_widget_tags'
			 * 'storefront_footer_4_widget_tags'
			 */
			$filter_hook = sprintf( 'storefront_%s_widget_tags', $sidebar );
			$widget_tags = apply_filters( $filter_hook, $widget_tags );

			if ( is_array( $widget_tags ) ) {
				register_sidebar( $args + $widget_tags );
			}
		}
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since  1.0.1
	 */
	public function scripts() {

		/**
		 * Add theme style to your WordPress site
		 *
		 * With this function, you can add your style for front-end of your website
		 */

		wp_enqueue_style(
			MSN_THEME_NAME . '-style',
			THEME_NAME_CSS . 'theme-name-ver-' . THEME_NAME_CSS_VERSION . '.css',
			array(),
			null,
			'all'
		);
		wp_style_add_data(
			$this->theme_name . '-style',
			'rtl',
			'replace'
		);

		/**
		 * Add theme JavaScript file to your WordPress site
		 *
		 * With this function, you can add your js file for front-end of your website
		 */
		wp_enqueue_script(
			MSN_THEME_NAME . '-script',
			THEME_NAME_JS . 'theme-name-ver-' . THEME_NAME_JS_VERSION . '.js',
			array( 'jquery' ),
			null,
			true
		);
		/*
		 * localize script to handle ajax call
		 * */
		//wp_localize_script( MSN_THEME_NAME. '-script', 'data', $this->sample_ajax_data1() );


	}

	public function set_meta_boxes() {

		$meta_box_obj1 = new Meta_box( $this->sample_meta_box1() );
		$meta_box_obj2 = new Meta_box( $this->sample_meta_box2() );
	}


}


