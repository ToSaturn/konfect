<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php launchpad_post_thumbnail(); ?>

	<header class="entry-header">
		<?php
			if ( is_singular() && 'yes' !== get_post_meta( get_the_ID(), 'launchpad_hide_page_title', true ) ):
				the_title( '<h1 class="entry-title">', '</h1>' );
			elseif ( ! is_single() ) :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'lifterlms-launchpad' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

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

	<?php
		// Author bio.
		if ( is_single() && ( function_exists( 'is_lifterlms' ) && ! is_lifterlms() ) && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">
		<?php launchpad_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'lifterlms-launchpad' ), '<span class="edit-link">', '</span>' ); ?>
	</footer>

</article>
