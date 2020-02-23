<?php
/**
 * Meta_Box2 Class File
 *
 * Methods and settings which will need for meta box1
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.1
 */

namespace Theme_Name_Name_Space\Inc\Admin;

use Theme_Name_Name_Space\Inc\Abstracts\Meta_box;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Meta_Box2.
 * Methods and settings which will need for meta box1
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */
class Meta_Box2 extends Meta_box {

	/**
	 * Meta_box constructor.
	 * This constructor gets initial values to send to add_meta_box function to
	 * create admin menu.
	 *
	 * @access public
	 *
	 * @param array $initial_value Initial value to pass to add_meta_box  function.
	 */
	public function __construct( $initial_values ) {
		parent::__construct( $initial_values );
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
	public function render_content( $post ) {
		// Add an nonce field so we can check for it later.
		wp_nonce_field( $this->action, $this->nonce_name );

		// Use get_post_meta to retrieve an existing value from the database.
		$values = get_post_meta( $post->ID, $this->meta_key, $this->single );
		if ( ! empty( $values ) ) {
		    $values = get_post_meta( $post->ID, $this->meta_key, $this->single );
			$values = array_shift( $values );
		}

		// Display the form, using the current value.
		?>
        <div>
            <label for="meta_box2_first_input">
				<?php _e( 'first input', MSN_TEXT_DOMAIN_NAME ); ?>
            </label>
            <input type="text" id="meta_box2_first_input" name="meta_box2_first_input" value="<?php echo esc_attr( @$values['first_input'] ); ?>"
                   size="30"/>
        </div>
        <br>
        <div>
            <label for="meta_box2_second_input">
				<?php _e( 'second input', MSN_TEXT_DOMAIN_NAME ); ?>
            </label>
            <input type="text" id="meta_box2_second_input" name="meta_box2_second_input" value="<?php echo esc_attr( @$values['second_input'] ); ?>"
                   size="30"/>
        </div>

		<?php
	}

	public function save_meta_box( $post_id ) {
		// Sanitize the user input.
		$meta_value['first_input']  = sanitize_text_field( $_POST['meta_box2_first_input'] );
		$meta_value['second_input'] = sanitize_text_field( $_POST['meta_box2_second_input'] );

		// Update the meta field.
		update_post_meta( $post_id, $this->meta_key, $meta_value );
	}

}
