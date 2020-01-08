<?php
/**
 * Admin_Sub_Menu2 Class File
 *
 * This file contains Admin_Sub_Menu class. If you want create an sub menu page
 * under an admin page (inside Admin panel of WordPress), you can use from this class.
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.1
 */

namespace Theme_Name_Name_Space\Inc\Admin;

use Theme_Name_Name_Space\Inc\Config\Initial_Value;
use Theme_Name_Name_Space\Inc\Abstracts\Admin_Sub_Menu;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Admin_Sub_Menu2.
 * If you want create an sub menu page under an admin page
 * (inside Admin panel of WordPress), you can use from this class.
 *
 * @package    Plugin_Name_Name_Space
 * @author     Your_Name <youremail@nomail.com>
 * @see        wp-admin/includes/plugin.php
 * @see        https://developer.wordpress.org/reference/functions/add_submenu_page/
 */
class Admin_Sub_Menu2 extends Admin_Sub_Menu{

	/**
	 * Admin_Sub_Menu constructor.
	 * This constructor gets initial values to send to add_submenu_page function to
	 * create admin submenu.
	 *
	 * @access public
	 *
	 * @param array $initial_value Initial value to pass to add_submenu_page function.
	 */
	public function __construct( $initial_value ) {
		parent::__construct($initial_value);
	}

	/**
	 * Method sub_menu1_panel_handler in Admin_Sub_Menu Class
	 *
	 * For each admin submenu page, we must have callable function that render and
	 * handle this menu page. For each menu page, you must have its own function.
	 *
	 * @access  public
	 */
	public function sub_menu_panel_handler() {
		echo 'this  is test for admin Sub menu 2 for theme';
	}

}
