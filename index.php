<?php
/**
 * Main template file
 *
 * @version 1.0.7
 */
get_header(); ?>
	<main role="main">
		<?php if ( have_posts() ) {
			if ( is_home() && ! is_front_page() ) { ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php }
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			}
		} else {
			get_template_part( 'template-parts/content', 'none' );
		}
		the_posts_pagination( array( 'type' => 'list' ) ); ?>
	</main>
<?php get_sidebar();
get_footer();