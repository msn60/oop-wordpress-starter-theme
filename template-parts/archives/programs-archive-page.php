<?php
/**
 * The template part for showing programs archive page in Your theme
 *
 * To show program archive pages in your theme, you can use from this template part.
 * Note: in this starter theme, we imagine that we already activated program custom post type
 * by a plugin that's related to this theme.
 *
 * @package    Theme_Name_Name_Space
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

