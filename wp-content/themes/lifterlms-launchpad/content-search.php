<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php launchpad_post_thumbnail(); ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<?php if ( 'post' == get_post_type() ) : ?>

		<footer class="entry-footer">
			<?php launchpad_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'lifterlms-launchpad' ), '<span class="edit-link">', '</span>' ); ?>
		</footer>

	<?php else : ?>

		<?php edit_post_link( __( 'Edit', 'lifterlms-launchpad' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>

	<?php endif; ?>

</article>
