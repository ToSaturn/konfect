<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'lifterlms-launchpad' ), get_search_query() ); ?></h1>
			</header>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' );

			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'lifterlms-launchpad' ),
				'next_text'          => __( 'Next page', 'lifterlms-launchpad' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'lifterlms-launchpad' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main>
	</section>

<?php get_footer(); ?>
