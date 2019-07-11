<?php
/**
 * The template part for showing program single post in Your theme
 *
 * To show program single post in your theme, you can use from this template part.
 * Note: in this starter theme, we imagine that we already activated program custom post type
 * by a plugin that's related to this theme.
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */
?>
<hr>
<div class="msn-container">

    <div class="msn-page-banner">
        <h1 class="msn-title"><?php the_title(); ?></h1>
        <div class="msn-page-banner intro">
            <h2>This template file uses to show program custom post type</h2>
        </div>
    </div>

    <div class="msn-generic">
		<?php the_content(); ?>
    </div>

    <div class="msn-metabox">
        <div>
            This is area to show meta information about this post
        </div>
        <p>
            <a class="msn-link" href="<?php echo site_url( '/programs/' ); ?>">
                Back to programs
            </a>
            <span class="msn-metabox">
                Posted by <?php echo get_the_author_posts_link(); ?> on <?php the_time( 'Y-n-j ' ) ?>
            </span>
        </p>
    </div>
    <hr>

</div>


