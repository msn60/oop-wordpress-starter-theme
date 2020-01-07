<?php
/**
 * The template part for showing single post in Your theme
 *
 * To show main single in your theme, you can use from this template part.
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */
?>

<hr>
<div class="msn-page-banner">
    <h1 class="msn-title"><?php the_title(); ?></h1>
    <div class="msn-page-banner intro">
        <h2>This template file uses to show single post type</h2>
    </div>
</div>

<div class="msn-container">


    <div class="msn-generic-content">
		<?php the_content(); ?>
    </div>
    <hr>

    <div class="msn-metabox">
        <div>
            This is area to show meta information about this post
        </div>
        <p>
            <a class="msn-link" href="<?php echo site_url( '/blog/' ); ?>">
                Back to blog
            </a>
            <span class="msn-metabox">
                Posted by <?php echo get_the_author_posts_link(); ?> on <?php the_time( 'Y-n-j ' ) ?> in <?php echo get_the_category_list( ', ' ); ?>
            </span>
        </p>
    </div>
    <hr>
    <div>
        <?php the_terms( get_the_ID(), 'category', esc_html__('categories: ','msn-starter-theme'), ' / ' ); ?>
    </div>
    <hr>
    <!-- Show comments -->
    <?php get_template_part('template-parts/comments/comment','popup-link' ) ?>
    <!-- Show social -->
    <?php get_template_part('template-parts/other/social-links-share' ) ?>

</div>
