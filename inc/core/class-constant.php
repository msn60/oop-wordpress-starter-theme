<?php
/**
 * Constant Class File
 *
 * This file contains Constant class which defines needed constants to ease
 * your theme development processes.
 *
 * @package    Theme_Name_Name_Space\Includes\Init
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
 * Class Constant
 *
 * This class defines needed constants that you will use in theme development.
 *
 * @package    Theme_Name_Name_Space\Inc\Core
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */
class Constant {

	/**
	 * Define define_constant method in Constant class
	 *
	 * It defines all of constants that you need
	 *
	 * @access  public
	 * @static
	 */
	public static function define_constant() {

		/**
		 * Theme_Name_PATH constant.
		 * It is used to specify plugin path
		 */
		if ( ! defined( 'THEME_NAME_PATH' ) ) {
			define( 'THEME_NAME_PATH', trailingslashit( get_theme_file_path() ) );
		}

		/**
		 * Theme_Name_URL constant.
		 * It is used to specify plugin urls
		 */
		if ( ! defined( 'THEME_NAME_URL' ) ) {
			define( 'THEME_NAME_URL', trailingslashit( get_theme_file_uri() ) );
		}

		/**
		 * THEME_NAME_CSS constant.
		 * It is used to specify css urls inside assets directory. It's used in front end and
		 * using to  load related CSS files for front end user.
		 */
		if ( ! defined( 'THEME_NAME_CSS' ) ) {
			define( 'THEME_NAME_CSS', trailingslashit( THEME_NAME_URL ) . 'assets/css/' );
		}

		/**
		 * THEME_NAME_JS constant.
		 * It is used to specify JavaScript urls inside assets directory. It's used in front end and
		 * using to load related JS files for front end user.
		 */
		if ( ! defined( 'THEME_NAME_JS' ) ) {
			define( 'THEME_NAME_JS', trailingslashit( THEME_NAME_URL ) . 'assets/js/' );
		}

		/**
		 * THEME_NAME_IMG constant.
		 * It is used to specify image urls inside assets directory. It's used in front end and
		 * using to load related image files for front end user.
		 */
		if ( ! defined( 'THEME_NAME_IMG' ) ) {
			define( 'THEME_NAME_IMG', trailingslashit( THEME_NAME_URL ) . 'assets/images/' );
		}

		/**
		 * THEME_NAME_TPL constant.
		 * It is used to specify template path inside templates directory.
		 */
		if ( ! defined( 'THEME_NAME_TPL' ) ) {
			define( 'THEME_NAME_TPL', trailingslashit( THEME_NAME_PATH . 'template-parts' ) );
		}

		/**
		 * THEME_NAME_ADMIN_TPL constant.
		 * It is used to specify template path inside templates directory.
		 */
		if ( ! defined( 'THEME_NAME_ADMIN_TPL' ) ) {
			define( 'THEME_NAME_ADMIN_TPL', trailingslashit( THEME_NAME_PATH . 'template-parts/admin/' ) );
		}

		/**
		 * THEME_NAME_INC constant.
		 * It is used to specify include path inside includes directory.
		 */
		if ( ! defined( 'THEME_NAME_INC' ) ) {
			define( 'THEME_NAME_INC', trailingslashit( THEME_NAME_PATH . 'inc' ) );
		}

		/**
		 * THEME_NAME_LANG constant.
		 * It is used to specify language path inside languages directory.
		 */
		if ( ! defined( 'THEME_NAME_LANG' ) ) {
			define( 'THEME_NAME_LANG', trailingslashit( THEME_NAME_PATH . 'languages' ) );
		}

		/**
		 * THEME_NAME_CSS_VERSION constant.
		 * You can use from this constant to apply on main CSS file when you have changed it.
		 */
		if ( ! defined( 'THEME_NAME_CSS_VERSION' ) ) {
			define( 'THEME_NAME_CSS_VERSION', '1.1' );
		}
		/**
		 * THEME_NAME_JS_VERSION constant.
		 * You can use from this constant to apply on main JS file when you have changed it.
		 */
		if ( ! defined( 'THEME_NAME_JS_VERSION' ) ) {
			define( 'THEME_NAME_JS_VERSION', '1.1' );
		}

		/*In future maybe I want to add constants for separated upload directory inside plugin directory*/
	}


	/*In future maybe I want to add constants for separated upload directory inside plugin directory*/

}