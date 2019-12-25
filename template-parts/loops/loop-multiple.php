<?php
/**
 * The template file to show multiple loop in WordPress
 *
 * This file contains related samples codes for multiple loop in WordPress
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */

// The Query
$args1 = [];
$query1 = new WP_Query( $args1 );

// The Loop
while ( $query1->have_posts() ) {
	$query1->the_post();
	echo '<li>' . get_the_title() . '</li>';
}

/* Restore original Post Data
 * NB: Because we are using new WP_Query we aren't stomping on the
 * original $wp_query and it does not need to be reset with
 * wp_reset_query(). We just need to set the post data back up with
 * wp_reset_postdata().
 */
wp_reset_postdata();

$args2 = [];
/* The 2nd Query (without global var) */
$query2 = new WP_Query( $args2 );

// The 2nd Loop
while ( $query2->have_posts() ) {
	$query2->the_post();
	echo '<li>' . get_the_title( $query2->post->ID ) . '</li>';
}

// Restore original Post Data
wp_reset_postdata();
