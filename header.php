<?php
/**
 * The template file to use header in WordPress
 *
 * If you want to separate header part in your site, you can use from this template file.
 *
 * @package     Theme_Name_Name_Space
 * @version     1.0.1
 * @author      Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link        https://wpwebmaster.ir
 */
?><!doctype html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>