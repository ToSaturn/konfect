
<div class="accordion_block">
	<div class="collapse">
		<div class="row">
			<div class="col">
				<div class="preview">
					<?php 
					$lessonID = get_the_ID();
					$thumbID = get_post_thumbnail_id($lessonID);
					if ($thumbID) {
						$img_atr = wp_get_attachment_image_src($thumbID, 'medium');
						$img_src = $img_atr[0];
						$img_alt = get_post_meta($lessonID, '_wp_attachment_image_alt', true); ?>
						
						<img src="<?php echo $img_src; ?>" alt="<?php echo $img_alt; ?>">
						
					<?php } else { ?>
						Превью урока
					<?php } ?>
				</div>
				<button class="accordion_but">КУПИТЬ</button>
			</div>
			<div class="col">
				<span class="header"><?php the_title(); ?></span>
				<div class="row">
					<span class="duration"><?php echo get_field('длительность'); ?></span>
				</div>
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</div><!-- /.accordion_block -->
