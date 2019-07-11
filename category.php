<?php
/**
 * The template file to show category pages in WordPress
 *
 * To show category pages in WordPress, you can use from this template file.
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */
/*
 * Important note: Sometimes you do not need to use this file and
 * only archive.php is enough for your theme.
 * It depends on your decision.
 * In this starter theme, I have used from all of files that maybe
 * I will need in the future.
 * So you can remove this file from your theme files and only use
 * from archive.php file.
 * */
get_header();
get_template_part( 'template-parts/header/header', 'menu' );
get_template_part( 'template-parts/archives/main-archive-page' );
get_template_part( 'template-parts/footer/footer', 'menu' );
get_footer();