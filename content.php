<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<header class="entry-header">
		<?php the_post_thumbnail( 'large' );
		hannover_the_title( 'h2' ); ?>
		<a href="<?php the_permalink(); ?>" class="entry-date">
			<?php hannover_the_date(); ?>
		</a>
	</header>
	<div class="entry-content">
		<?php hannover_the_content(); ?>
	</div>
	<footer>
		<p><?php bornholm_entry_meta() ?></p>
	</footer>
</article>