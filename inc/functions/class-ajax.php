<?php
/**
 * Ajax Class File
 *
 * This file contains a class that handle all of ajax call in your site
 *
 * @package    Theme_Name_Name_Space\Inc\Functions
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.1
 */

namespace Theme_Name_Name_Space\Inc\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Ajax.
 * This file contains a class that handle all of ajax call in your site
 *
 * @package    Plugin_Name_Name_Space\Inc\Functions
 * @author     Your_Name <youremail@nomail.com>
 */
class Ajax {
	/**
	 * Data that need for wp_ajax_sample_ajax_call_1
	 *
	 * @since    1.0.1
	 * @access   protected
	 * @var      array $ajax_data1 array of ata that need for wp_ajax_sample_ajax_call.
	 */
	private $ajax_data1;


	/**
	 * Main constructor.
	 * This is constructor of Ajax class
	 *
	 * @access public
	 * @since  1.0.1
	 */
	public function __construct() {
		//hook to add your ajax request
		add_action( 'wp_ajax_sample_ajax_call_1', [ $this, 'wp_ajax_sample_ajax_call_1' ] );
		//Sample with priv and nopriv
		add_action( 'wp_ajax_sample_ajax_call_2', [ $this, 'sample_ajax_call_2' ] );
		add_action( 'wp_ajax_nopriv_sample_ajax_call_2', [ $this, 'sample_ajax_call_2' ] );
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
	public function wp_ajax_sample_ajax_call_1() {
		check_ajax_referer( 'sample_ajax_nonce', 'security' );
		echo sanitize_text_field( $_POST['msn_ajax_sample'] );
		wp_die();
	}

	/**
	 * Second method to handle ajax request
	 *
	 * This method is designed for handling ajax request in backend.
	 *
	 * @access  public
	 * @see     https://developer.wordpress.org/reference/functions/check_ajax_referer/
	 * @see     https://eric.blog/2013/06/18/how-to-add-a-wordpress-ajax-nonce/
	 * @see     https://developer.wordpress.org/reference/functions/check_ajax_referer/
	 */
	public function sample_ajax_call_2() {

		check_ajax_referer( 'sample_ajax_nonce', 'security' );
		$post_id     = intval(sanitize_text_field(( $_POST['post_id'] )));
		$currentUser = wp_get_current_user();
		if ( $post_id ) {

			$is_cookie_set = isset( $_COOKIE[ 'post-' . $post_id ] ) && intval( $_COOKIE[ 'post-' . $post_id ] ) ? true : false;
			if ( $is_cookie_set ) {
				$result = array( 'success' => false, 'count' => 0 );
				wp_die( json_encode( $result ) );
			}
			$added_count = (int)get_post_meta($post_id,'_msn_oop_starter_meta_box_key_1',true) + 1;
			update_post_meta($post_id,'_msn_oop_starter_meta_box_key_1',$added_count);

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
