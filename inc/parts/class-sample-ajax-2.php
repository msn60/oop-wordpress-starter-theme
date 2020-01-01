<?php
/**
 * Sample_Ajax_2 Class File
 *
 * This file contains a class that handle all of Sample_Ajax_2 call in your site
 *
 * @package    Theme_Name_Name_Space
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
 * Class Sample_Ajax_2.
 * This file contains a class that handle all of Sample_Ajax_2 call in your site
 *
 * @package    Plugin_Name_Name_Space
 * @author     Your_Name <youremail@nomail.com>
 */
class Sample_Ajax_2 extends Ajax {

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
		$post_id     = intval( sanitize_text_field( ( $_POST['post_id'] ) ) );
		$currentUser = wp_get_current_user();
		if ( $post_id ) {

			$is_cookie_set = isset( $_COOKIE[ 'post-' . $post_id ] ) && intval( $_COOKIE[ 'post-' . $post_id ] ) ? true : false;
			if ( $is_cookie_set ) {
				$result = array( 'success' => false, 'count' => 0 );
				wp_die( json_encode( $result ) );
			}
			$added_count = (int) get_post_meta( $post_id, '_msn_oop_starter_meta_box_key_1', true ) + 1;
			update_post_meta( $post_id, '_msn_oop_starter_meta_box_key_1', $added_count );

			if ( $added_count ) {
				$result = array( 'success' => true, 'count' => $added_count );
				setcookie( 'post-' . $post_id, 1, time() + ( 30 * 86400 ), '/' );
			} else {
				$result = array( 'success' => false, 'count' => 0 );
			}
			wp_die( json_encode( $result ) );
		}
	}


}
