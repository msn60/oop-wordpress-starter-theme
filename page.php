<?php
/**
 * The template file to show pages in WordPress
 *
 * To show  pages in WordPress, you can use from this template file.
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */
get_header();
get_template_part('template-parts/header/header','menu');
/*
get_template_part('templates/pages/main-blog-page');
*/
echo 'This is for showing pages';
get_template_part('template-parts/footer/footer','menu');
get_footer();

