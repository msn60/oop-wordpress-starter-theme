<?php
/**
 * The main template that your theme works with it.
 *
 * This file is like a plugin for your template. All of functions and classes
 * that you want to use it in your WordPress theme, are inside in this file.
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */

use Theme_Name_Name_Space\Inc\Core\{
	Constant, Main, Hook
};
use Theme_Name_Name_Space\Inc\Admin\{
	Admin_Menu1, Admin_Sub_Menu1,Admin_Sub_Menu2
};

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
$sample_hook_object                    = new Hook();
$sample_main_object                    = Main::get_instance();
$admin_menus['sample_admin_menu']      = new Admin_Menu1( $sample_main_object ->sample_menu_page() );
$admin_menus['sample_admin_sub_menu1'] = new Admin_Sub_Menu1( $sample_main_object ->sample_sub_menu_page1() );
$admin_menus['sample_admin_sub_menu2'] = new Admin_Sub_Menu2( $sample_main_object ->sample_sub_menu_page2() );
$sample_main_object->init_theme(
	$sample_hook_object,
	$admin_menus
);






