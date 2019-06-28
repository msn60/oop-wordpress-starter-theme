<?php
/**
 * The main template that your theme works with it.
 *
 * This file is like a plugin for your template. All of functions and classes
 * that you want to use it in your WordPress theme, are inside in this file.
 *
 * @package
 * @version 1.0.1
 * @author  Mehdi Soltani <soltani.n.mehdi@gmail.com>
 */


use Theme_Name_Name_Space\Inc\Core\Constant;
$autoloader_path = 'inc/class-autoloader.php';
/**
 * Include autoloader class to load all of classes inside this theme
 */
require_once trailingslashit( get_theme_file_path() ) . $autoloader_path;
/*Define required constant for theme*/
Constant::define_constant();