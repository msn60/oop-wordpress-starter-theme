<?php
/**
 * The main template that your theme works with it.
 *
 * This file is like a plugin for your template. All of functions and classes
 * that you want to use it in your WordPress theme, are inside in this file.
 *
 * @package
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */

use Theme_Name_Name_Space\Inc\Core\Constant;
use Theme_Name_Name_Space\Inc\Core\Main;

$autoloader_path = 'inc/class-autoloader.php';
/**
 * Include autoloader class to load all of classes inside this theme
 */
require_once trailingslashit( get_theme_file_path() ) . $autoloader_path;

/*
 * Define required constant for theme
 * */
Constant::define_constant();

/*
 * Using Main class to prepare your theme
 * */
$msn_theme_name_name_space_object = new Main();

/*
 * Remove extra actions from your WordPress site & some conditions if your are not in admin dashboard
 * */
if ( ! is_admin() ) {
	$msn_theme_name_name_space_object->remove_extra_actions();
	add_filter('show_admin_bar', '__return_false');
}

