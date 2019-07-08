<?php
/**
 * The template part for showing main archive page in Your theme
 *
 * To show main archive pages in your theme, you can use from this template part.
 *
 * @package
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */
?>

<div class="msn-container">
	<?php
	while ( have_posts() ) {
		the_post();
		?>
        <div class="msn-post-item">
            <h2 class="msn-headline">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="msn-metabox">
                <p>Posted by <?php echo get_the_author_posts_link(); ?> on <?php the_time( 'Y-n-j ' ) ?>
                    in <?php echo get_the_category_list( ', ' ); ?></p>
            </div>
            <div class="msn-generic-content">
				<?php the_excerpt(); ?>

            </div>
            <a href="<?php the_permalink(); ?>"><p class="msn-btn">Continue Reading...</p></a>
        </div>
		<?php
	}
	echo paginate_links();
	?>
</div>

