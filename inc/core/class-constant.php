<?php
/**
 * Constant Class File
 *
 * This file contains Constant class which defines needed constants to ease
 * your theme development processes.
 *
 * @package    Theme_Name_Name_Space\Includes\Init
 * @author     Your_Name <youremail@nomail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://yoursite.com
 * @since      1.0.0
 */

namespace Theme_Name_Name_Space\Inc\Core;

/**
 * Class Constant
 *
 * This class defines needed constants that you will use in theme development.
 *
 * @package    Theme_Name_Name_Space\Includes\Init
 * @author     Your_Name <youremail@nomail.com>
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


		/*In future maybe I want to add constants for separated upload directory inside plugin directory*/
	}
}
