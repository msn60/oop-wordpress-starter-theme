<?php
/**
 * Useful WP Functions  File
 *
 * @package    Theme_Name_Name_Space
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.1
 */

namespace Theme_Name_Name_Space\Inc\Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * get post counts
 * */
echo '<div>count of posts that is published: '.wp_count_posts()->publish.'</div>';

/*
 * get custom post counts
 * */
if (post_type_exists('msn-events')) {
	echo '<div>count of Events that is published: '.wp_count_posts('msn-events')->publish.'</div>';
}

/*
 * get users counts
 * */
echo '<div>count of Users in this site: '.count_users()['total_users'].'</div>';

/*
 * get comments counts
 * */
echo '<div>count of Users in this site: '.wp_count_comments()->total_comments.'</div>';



