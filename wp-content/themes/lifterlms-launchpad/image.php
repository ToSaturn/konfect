<?php get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<nav id="image-navigation" class="navigation image-navigation">
						<div class="nav-links">
							<div class="nav-previous"><?php previous_image_link( false, __( 'Previous Image', 'lifterlms-launchpad' ) ); ?></div><div class="nav-next"><?php next_image_link( false, __( 'Next Image', 'lifterlms-launchpad' ) ); ?></div>
						</div>
					</nav>

					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header>

					<div class="entry-content">

						<div class="entry-attachment">
							<?php

								$image_size = apply_filters( 'launchpad_attachment_size', 'large' );

								echo wp_get_attachment_image( get_the_ID(), $image_size );
							?>

							<?php if ( has_excerpt() ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
							<?php endif; ?>

						</div>

						<?php
							the_content();
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'lifterlms-launchpad' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'lifterlms-launchpad' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );
						?>
					</div>

					<footer class="entry-footer">
						<?php launchpad_entry_meta(); ?>
						<?php edit_post_link( __( 'Edit', 'lifterlms-launchpad' ), '<span class="edit-link">', '</span>' ); ?>
					</footer>

				</article>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					// Previous/next post navigation.
					the_post_navigation( array(
						'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'lifterlms-launchpad' ),
					) );

				// End the loop.
				endwhile; ?>
		</main>
	</div>

<?php get_footer(); ?>
