<?php
/**
 * The template part for showing events archive page in Your theme
 *
 * To show events archive pages in your theme, you can use from this template part.
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
        <div class="msn-event">
            <div class="msn-event-summary">
                <h3 class="msn-event-summary-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p>
					<?php
					if ( has_excerpt() ) {
						echo get_the_excerpt();
					} else {
						echo wp_trim_words( get_the_content(), 18 );
					}
					?>
                    <a href="<?php the_permalink(); ?>" class="msn-btn-gray">Learn more</a>
                </p>
            </div>
        </div>
		<?php
	}
	echo paginate_links();
	?>
    <p class="msn-text-center">
        <a href="<?php echo site_url( '/past-events/' ); ?>" class="msn-btn-blue">
            View Past Events
        </a>
    </p>
</div>

