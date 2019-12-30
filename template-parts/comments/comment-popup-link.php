<?php
/**
 * The template part for showing comments on your posts.
 *
 * To show comments in your theme, you can use from this template part.
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */
?>
<?php if ( comments_open() ) : ?>
    <div class="msn-metabox">
    <span class="msn-comments">
        <?php
        comments_popup_link( __( 'Leave a comment', 'msn-starter-theme' ), __( '1 Comment', 'msn-starter-theme' ),
	        __( '% Comments', 'msn-starter-theme' ) );
        ?>
    </span>
    </div>
    <hr>
<?php endif; ?>