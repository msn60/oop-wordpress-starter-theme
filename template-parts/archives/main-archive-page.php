<?php
/**
 * The template part for showing main archive page in Your theme
 *
 * To show main archive pages in your theme, you can use from this template part.
 *
 * @package    Theme_Name_Name_Space
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */
?>
<?php if ( have_posts() ) : ?>

    <!-- pagination here -->

    <!-- the loop -->
	<?php while ( have_posts() ) : the_post(); ?>
        <div class="msn-post-item">
            <h2>
                <a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
                </a>
            </h2>
            <div class="msn-metabox">
                <p>Posted by <?php echo get_the_author_posts_link(); ?> on <?php the_time( 'Y-n-j ' ) ?>
                    in <?php echo get_the_category_list( ', ' ); ?></p>
            </div>
            <div>
				<?php the_excerpt(); ?>
            </div>
            <div>
                <a href="<?php the_permalink(); ?>"><p class="msn-btn">Continue Reading...</p></a>
            </div>
        </div>
        <!-- Start of sample section for ajax call -->
        <?php
            $post_meta1 = (int)get_post_meta(get_the_ID(),'_msn_oop_starter_meta_box_key_1',true);
        ?>
        <div class="top-left-social"><a href="#" >Test for: sample_ajax_call_1</a></div>
        <div class="msn-sample-vote" data-pid="<?php echo get_the_ID(); ?>">
            <a href="#" >Test for: sample_ajax_call_2</a>
            <div class="msn-sample-count"  >
                <?php echo $post_meta1;?>
            </div>
        </div>
        <!-- End of sample section for ajax call -->
		<?php echo '<hr>'; ?>
	<?php endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->

	<?php echo paginate_links(); ?>
    <!-- If you want to use another loop here, you must use it -->
	<?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>



