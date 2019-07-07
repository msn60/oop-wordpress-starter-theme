<?php
/**
 * The file is front page for your theme
 *
 * You can use from this file as front-page file in your theme
 *
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://wpwebmaster.ir
 * @since      1.0.1
 */



get_header();
get_template_part('template-parts/header/header','menu');
get_template_part('template-parts/pages/site-main-page');

get_template_part('template-parts/footer/footer','menu');
get_footer();
