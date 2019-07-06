<?php


?>

<div class="container container--narrow page-section">
	<?php
	while ( have_posts() ) {
		the_post();
		?>
        <div class="post-item">
            <h2 class="headline headline--medium headline--post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="metabox">
                <p>Posted by <?php echo get_the_author_posts_link(); ?> on <?php the_time( 'Y-n-j ' ) ?>
                    in <?php echo get_the_category_list( ', ' ); ?></p>
            </div>
            <div class="generic-content">
				<?php the_excerpt(); ?>

            </div>
            <a href="<?php the_permalink(); ?>"><p class="btn btn--blue">Continue Reading...</p></a>
        </div>
		<?php
	}
	echo paginate_links();
	?>
</div>

