<?php
/**
 * The template file to show pages in WordPress
 *
 * To show  pages in WordPress, you can use from this template file.
 *
 * @package
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */
get_header();
get_template_part('template-parts/header/header','menu');
/*
get_template_part('templates/pages/main-blog-page');

get_template_part('templates/footer-section');*/
echo 'this is the first line';
get_footer();

