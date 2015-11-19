<?php get_header(); ?>
	<main role="main">
		<?php if ( have_posts() ) { ?>
			<header class="page-header">
				<?php the_archive_title( '<h1 class="archive-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
			</header>
			<?php while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			}
		}
		the_posts_pagination( array( 'type' => 'list' ) ); ?>
	</main>
<?php get_sidebar();
get_footer();