	<h2>Похожие уроки</h2>
	<div class="row lesson_row">
		
		<?php
		$related_lessons = get_posts(array(
			'posts_per_page' => 4,
			'offset'      => 0,
			'orderby'     => 'post_date',
			'order'       => 'DESC',
			'post_type'   => 'lesson',
			'post_status'   => 'publish',
			'suppress_filters' => true,
		));
		
		foreach( $related_lessons as $lesson ){
			$lessonID = $lesson->ID;
			$img_atr = wp_get_attachment_image_src(get_post_thumbnail_id($lessonID), 'medium');
			$img_src = $img_atr[0];
			$img_alt = get_post_meta($lessonID, '_wp_attachment_image_alt', true);
		?>
		
			<div class="lesson <?php $lessonID; ?>">
				<div class="col">
					<img src="<?php echo $img_src; ?>" alt="<?php echo $img_alt; ?>">
					<div class="row">
						<span class="duration"><?php echo get_field('длительность', $lessonID); ?></span>
						<div class="complexity" data-level="<?php echo get_field('сложность', $lessonID) ?>"></div>
					</div>
					<p><?php echo $lesson->post_title; ?></p>
					<a href="<?php echo get_post_permalink($lessonID) ?>" class="more">Узнать подробнее</a>
				</div>
			</div>
		    
		<?php } ?>

	</div><!-- /.row -->