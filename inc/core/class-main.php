<?php
/**
 * Main Class File
 *
 * This file contains main class which can manage and handle important tasks in your theme
 *
 * @package    Theme_Name_Name_Space\Inc\Core
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.0
 */

namespace Theme_Name_Name_Space\Inc\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Main
 *
 * Main class can manage and handle all of tasks that you need in your theme.
 *
 * @package    Theme_Name_Name_Space\Inc\Core
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */
class Main {

	/**
	 * Main constructor.
	 * This is constructor of Main class and you can use it for hooking your file
	 * inside it like actions or filters
	 *
	 * @access public
	 * @since  1.0.1
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		/*add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 10 );*/
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

		// Loads wp-content/languages/themes/storefront-it_IT.mo.
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
					'primary'   => __( 'Primary Menu', 'theme-name-name-space' ),
					'secondary' => __( 'Secondary Menu', 'theme-name-name-space' ),
					'footer'    => __( 'Footer Menu', 'theme-name-name-space' ),
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
		 */
		//add_editor_style( array( 'assets/css/base/gutenberg-editor.css', $this->google_fonts() ) );

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
			'name'        => __( 'Sidebar', 'storefront' ),
			'id'          => 'sidebar-1',
			'description' => '',
		);

		$sidebar_args['header'] = array(
			'name'        => __( 'Below Header', 'storefront' ),
			'id'          => 'header-1',
			'description' => __( 'Widgets added to this region will appear beneath the header and above the main content.', 'storefront' ),
		);

		$rows    = intval( apply_filters( 'storefront_footer_widget_rows', 1 ) );
		$regions = intval( apply_filters( 'storefront_footer_widget_columns', 4 ) );

		for ( $row = 1; $row <= $rows; $row ++ ) {
			for ( $region = 1; $region <= $regions; $region ++ ) {
				$footer_n = $region + $regions * ( $row - 1 ); // Defines footer sidebar ID.
				$footer   = sprintf( 'footer_%d', $footer_n );

				if ( 1 === $rows ) {
					/* translators: 1: column number */
					$footer_region_name = sprintf( __( 'Footer Column %1$d', 'storefront' ), $region );

					/* translators: 1: column number */
					$footer_region_description = sprintf( __( 'Widgets added here will appear in column %1$d of the footer.', 'storefront' ),
						$region );
				} else {
					/* translators: 1: row number, 2: column number */
					$footer_region_name = sprintf( __( 'Footer Row %1$d - Column %2$d', 'storefront' ), $row, $region );

					/* translators: 1: column number, 2: row number */
					$footer_region_description = sprintf( __( 'Widgets added here will appear in column %1$d of footer row %2$d.', 'storefront' ),
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
		global $storefront_version;

		/**
		 * Styles
		 */
		wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css', '', $storefront_version );
		wp_style_add_data( 'storefront-style', 'rtl', 'replace' );

		wp_enqueue_style( 'storefront-icons', get_template_directory_uri() . '/assets/css/base/icons.css', '', $storefront_version );
		wp_style_add_data( 'storefront-icons', 'rtl', 'replace' );

		/**
		 * Fonts
		 */
		wp_enqueue_style( 'storefront-fonts', $this->google_fonts(), array(), null );

		/**
		 * Scripts
		 */
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_enqueue_script( 'storefront-navigation', get_template_directory_uri() . '/assets/js/navigation' . $suffix . '.js', array(),
			$storefront_version, true );
		wp_enqueue_script( 'storefront-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . $suffix . '.js',
			array(), '20130115', true );

		if ( has_nav_menu( 'handheld' ) ) {
			$storefront_l10n = array(
				'expand'   => __( 'Expand child menu', 'storefront' ),
				'collapse' => __( 'Collapse child menu', 'storefront' ),
			);

			wp_localize_script( 'storefront-navigation', 'storefrontScreenReaderText', $storefront_l10n );
		}

		if ( is_page_template( 'template-homepage.php' ) && has_post_thumbnail() ) {
			wp_enqueue_script( 'storefront-homepage', get_template_directory_uri() . '/assets/js/homepage' . $suffix . '.js', array(),
				$storefront_version, true );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'jquery-pep', get_template_directory_uri() . '/assets/js/vendor/pep.min.js', array(), '0.4.3', true );
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
}


