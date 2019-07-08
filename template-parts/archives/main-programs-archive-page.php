<?php
/**
 * The template part for showing programs archive page in Your theme
 *
 * To show program archive pages in your theme, you can use from this template part.
 *
 * @package
 * @version    1.0.1
 * @author     Mehdi Soltani <soltani.n.mehdi@gmail.com>
 * @link       https://wpwebmaster.ir
 */
?>

<div class="msn-container">
    <ul class="msn-ul-sample">
		<?php
		while ( have_posts() ) {
			the_post();
			?>
            <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
			<?php
		}
		echo paginate_links();
		?>
    </ul>
</div>

