<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ksenia_Nokhrina_Online_School
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- START Maybe add condition of lesson/course -->
	<div class="favorites"></div>
	<span class="cat"><?php the_field('категория'); ?></span>
	<div class="entry-header">
		<?php
		if ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				ksenia_nokhrina_online_school_posted_on();
				ksenia_nokhrina_online_school_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</div><!-- .entry-header -->
	
	<div class="row span_row lesson-summary course-summary">
		<?php
			$duration = get_field('длительность');
			if ($duration) { ?>
				<span class="duration"><?php echo $duration ?></span>
		<?php } ?>
		<?php
			$difficult = get_field('сложность');
			if ($difficult) { ?>
				<span class="difficult <?php echo $difficult; ?>" data-level="<?php echo $difficult; ?>"><?php echo $difficult ?> СЛОЖНОСТЬ</span>
		<?php } ?>
		<?php
			$price = get_field('стоимость');
			if ($price) { ?>
				<span class="price"><?php echo number_format($price, 0, ',', ' '); ?> РУБЛЕЙ</span>
		<?php } ?>
		<?php if ( 'course' === get_post_type() ) { ?>
			<span class="num_of_lessons"><?php echo my_get_lesson_count( get_the_ID() ); ?> УРОКОВ</span>
		<?php } ?>
	</div>
	
	<div class="separate_set_slider">
		<div>
			<?php 
			$image = get_acf_img_default_value('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_acf_img_default_value('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_acf_img_default_value('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_acf_img_default_value('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div class="new">
			<?php 
			$image = get_acf_img_default_value('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_acf_img_default_value('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>
	</div><!-- /.separate_set_slider -->

	<?php /*ksenia_nokhrina_online_school_post_thumbnail();*/ ?>

	<div class="entry-content">
		<?php if ( 'lesson' === get_post_type() )  {
			
//			if (lesson bought == true) {
				the_content();
//			} else {
//				get_template_part( 'template-parts/content-lesson-preview');
//				do_action( 'custom_lifterlms_single_lesson_after_summary' );
//			}
			
		} else {
			
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ksenia_nokhrina_online_school' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
	
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ksenia_nokhrina_online_school' ),
				'after'  => '</div>',
			) );
		} ?>
	</div><!-- .entry-content -->

	<div class="entry-footer">
		<?php ksenia_nokhrina_online_school_entry_footer(); ?>
	</div><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
