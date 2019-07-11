<?php
/**
 * The template file to show single posts in WordPress
 *
 * To show single pages in WordPress, you can use from this template file.
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */

get_header();
get_template_part( 'template-parts/header/header', 'menu' );

while ( have_posts() ) {
	the_post();
	if ( 'msn-events' == get_post_type() ) {
		get_template_part( 'template-parts/post-types/event-single-post' );
	} elseif ( 'msn-programs' == get_post_type() ) {
		get_template_part( 'template-parts/post-types/program-single-post' );
	} else {
		get_template_part( 'template-parts/post-types/single-post' );
	}
}

get_template_part( 'template-parts/footer/footer', 'menu' );
get_footer();