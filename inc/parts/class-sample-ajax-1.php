<?php
/**
 * Sample_Ajax_1 Class File
 *
 * This file contains a class that handle all of Sample_Ajax_1 call in your site
 *
 * @package    Theme_Name_Name_Space\Inc\Parts
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.1
 */

namespace Theme_Name_Name_Space\Inc\Parts;

use Theme_Name_Name_Space\Inc\Abstracts\Ajax;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Sample_Ajax_1.
 * This file contains a class that handle all of Sample_Ajax_1 call in your site
 *
 * @package    Plugin_Name_Name_Space\Inc\Functions
 * @author     Your_Name <youremail@nomail.com>
 */
class Sample_Ajax_1 extends Ajax {

	/**
	 * Main constructor.
	 * This is constructor of Ajax class
	 *
	 * @access public
	 * @since  1.0.1
	 *
	 * @param string $action Action name for ajax call
	 */
	public function __construct( $action ) {
		parent::__construct( $action );
	}


	/**
	 * First method to handle ajax request
	 *
	 * This method is designed for handling ajax request in backend.
	 *
	 * @access  public
	 * @see     https://developer.wordpress.org/reference/functions/check_ajax_referer/
	 * @see     https://eric.blog/2013/06/18/how-to-add-a-wordpress-ajax-nonce/
	 * @see     https://developer.wordpress.org/reference/functions/check_ajax_referer/
	 */
	public function handle() {
		check_ajax_referer( 'sample_ajax_nonce', 'security' );
		echo sanitize_text_field( $_POST['msn_ajax_sample'] );
		wp_die();
	}


}
