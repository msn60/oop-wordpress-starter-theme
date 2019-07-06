<?php
/**
 * The primary template file in WordPress theme
 *
 * This file is necessary to use and run your theme. if you do not have any template file
 * to use in WordPress template hierarchy, WordPress use this file to show to your user.
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
echo 'this is the first line in index file';
get_footer();