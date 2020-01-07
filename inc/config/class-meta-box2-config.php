<?php
/**
 * Meta_Box2_Config Class File
 *
 * Methods and settings which will need for meta box2
 *
 * @package    Theme_Name_Name_Space
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
 * Class Meta_Box2_Config.
 * Methods and settings which will need for meta box2
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */
trait Meta_Box2_Config {

	/**
	 * Initial values to create meta box 1.
	 *
	 * @access public
	 * @see    https://developer.wordpress.org/reference/functions/get_post_meta/
	 * @see    https://developer.wordpress.org/reference/functions/add_meta_box/
	 * @return array It returns all of arguments that add_meta_box function needs.
	 */
	public function sample_meta_box2() {
		$initial_value = [

			'id'            => 'meta_box_2_id',
			'title'         => esc_html__( 'Meta box2 Headline', 'msn-starter-theme' ),
			'callback'      => 'render_meta_box2',
			'screens'       => null,//null - optional
			'context'       => 'side', //optional
			'priority'      => 'high', //optional
			'callback_args' => null, //optional
			'meta_key'      => '_msn_oop_starter_meta_key_2',
			'single'        => false, //the result of get_post_meta Will be an array if $single is false
			'action'        => 'oop_msn_starter_meta_box2',
			'nonce_name'    => 'oop_msn_starter_meta_box2_nonce'

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
	public function render_meta_box2( $post, $meta_key, $single, $action = null, $nonce_name = null ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( $action, $nonce_name );

		// Use get_post_meta to retrieve an existing value from the database.
		$values = get_post_meta( $post->ID, $meta_key, $single );
		if ( ! empty( $values ) ) {
			$values = array_shift( get_post_meta( $post->ID, $meta_key, $single ) );
		}

		// Display the form, using the current value.
		?>
        <div>
            <label for="meta_box2_first_input">
				<?php _e( 'first input', 'msn-starter-theme' ); ?>
            </label>
            <input type="text" id="meta_box2_first_input" name="meta_box2_first_input" value="<?php echo esc_attr( @$values['first_input'] ); ?>"
                   size="30"/>
        </div>
        <br>
        <div>
            <label for="meta_box2_second_input">
				<?php _e( 'second input', 'msn-starter-theme' ); ?>
            </label>
            <input type="text" id="meta_box2_second_input" name="meta_box2_second_input" value="<?php echo esc_attr( @$values['second_input'] ); ?>"
                   size="30"/>
        </div>

		<?php
	}

	public function save_meta_box2( $post_id, $meta_box_values, $meta_key ) {
		// Sanitize the user input.
        $meta_value['first_input'] = sanitize_text_field( $meta_box_values['meta_box2_first_input'] );
        $meta_value['second_input'] = sanitize_text_field( $meta_box_values['meta_box2_second_input'] );

		// Update the meta field.
		update_post_meta( $post_id, $meta_key, $meta_value );
	}

}
