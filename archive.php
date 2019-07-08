<?php
/**
 * The template file for showing archive pages in WordPress
 *
 * To show archives pages in WordPress, you can use from this template file.
 *
 * @package
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */

get_header();
get_template_part( 'template-parts/header/header', 'menu' );

/*
 * Note 1:
 * You must consider that msn-events-sample and msn-program-sample are
 * sample post types in this example. I have always activated any
 * custom post type, from plugins. This is based on WordPress best practice.
 * Note 2:
 * I have used from several template parts for loop throw archive pages.
 * The reason is in many cases, I use from separated design for each of
 * post types and that's why that I have used from separated files.
 * */
if ( 'msn-events-sample' == get_post_type() ) {
	get_template_part( 'template-parts/archives/main-events-archive-page' );

} elseif ( 'msn-programs-sample' == get_post_type() ) {
	get_template_part( 'template-parts/archives/main-programs-archive-page' );

} else {
	get_template_part( 'template-parts/archives/main-archive-page' );
}

get_template_part( 'template-parts/footer/footer', 'menu' );
get_footer();