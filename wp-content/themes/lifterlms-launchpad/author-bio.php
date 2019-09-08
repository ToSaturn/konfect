<div class="author-info">
	<h2 class="author-heading"><?php _e( 'Published by', 'lifterlms-launchpad' ); ?></h2>
	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'launchpad_author_bio_avatar_size', 56 ) ); ?>
	</div>

	<div class="author-description">
		<h3 class="author-title vcard author"><span class="fn"><?php echo get_the_author(); ?></span></h3>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s', 'lifterlms-launchpad' ), get_the_author() ); ?>
			</a>
		</p>
	</div>
</div>
