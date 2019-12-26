<?php
/**
 * Meta_Box1_Config Class File
 *
 * Methods and settings which will need for meta box1
 *
 * @package    Theme_Name_Name_Space\Inc\Config
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.1
 */

namespace Theme_Name_Name_Space\Inc\Config;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Meta_Box1_Config.
 * Methods and settings which will need for meta box1
 *
 * @package    Theme_Name_Name_Space\Inc\Config
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */
trait Meta_Box1_Config {

	/**
	 * Initial values to create meta box 1.
	 *
	 * @access public
	 * @see    https://developer.wordpress.org/reference/functions/get_post_meta/
	 * @see    https://developer.wordpress.org/reference/functions/add_meta_box/
	 * @return array It returns all of arguments that add_meta_box function needs.
	 */
	public function sample_meta_box1() {
		$initial_value = [

			'id'            => 'meta_box_1_id',
			'title'         => __( 'Meta box1 Headline', 'msn-starter-theme' ),
			'callback'      => 'render_meta_box1',
			'screens'       => array( 'post', 'page' ),//null - optional
			'context'       => 'advanced', //optional
			'priority'      => 'high', //optional
			'callback_args' => null, //optional
			'meta_key'      => '_msn_oop_starter_meta_box_key_1',
			'single'        => true, //the result of get_post_meta Will be an array if $single is false
			'action'        => 'oop_msn_starter_meta_box1',
			'nonce_name'    => 'oop_msn_starter_meta_box1_nonce'

		];

		return $initial_value;
	}

	/**
	 * Render meta box 1.
	 *
	 * @access public
	 *
	 * @see    https://wpbrigade.com/what-is-wordpress-nonce-and-how-it-works/
	 *
	 * @param  object $post Current post.
	 */
	public function render_meta_box1( $post, $meta_key, $single, $action = null, $nonce_name = null ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( $action, $nonce_name );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, $meta_key, $single );


		// Display the form, using the current value.
		?>
        <label for="oop_msn_starter_new_field">
			<?php _e( 'Description for this field', 'msn-starter-theme' ); ?>
        </label>
        <input type="text" id="oop_msn_starter_new_field" name="oop_msn_starter_new_field" value="<?php echo esc_attr( $value ); ?>" size="25"/>
		<?php
	}

	public function save_meta_box1( $post_id, $meta_box_values, $meta_key ) {
		// Sanitize the user input.
		$meta_value = sanitize_text_field( $meta_box_values['oop_msn_starter_new_field'] );

		// Update the meta field.
		update_post_meta( $post_id, $meta_key, $meta_value );
	}

}
