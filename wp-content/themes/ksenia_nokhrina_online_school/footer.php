<footer>
	<h4>INSTAGRAM</h4>
	<div class="row">
		<div class="inst_img">
			<?php 
			$image = get_acf_img_default_value('фото_инстаграмм_1');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div><!-- /.inst_img -->
		<div class="inst_img">
			<?php 
			$image = get_acf_img_default_value('фото_инстаграмм_2');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div><!-- /.inst_img -->
		<div class="inst_img">
			<?php 
			$image = get_acf_img_default_value('фото_инстаграмм_3');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div><!-- /.inst_img -->
		<div class="inst_img">
			<?php 
			$image = get_acf_img_default_value('фото_инстаграмм_4');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div><!-- /.inst_img -->
		<div class="inst_img">
			<?php 
			$image = get_acf_img_default_value('фото_инстаграмм_5');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div><!-- /.inst_img -->
		<div class="inst_img">
			<?php 
			$image = get_acf_img_default_value('фото_инстаграмм_6');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div><!-- /.inst_img -->
	</div><!-- /.row -->
	<div class="row">
		<!-- левое меню -->
		<?php wp_nav_menu(array(
			'container'				=>		'nav',
			'theme_location'  	=> 	'Меню в подвале слева',
			'container_class' 	=> 	'left_menu_footer',
			'menu'            	=> 	'Меню слева в подвале', 
		)); ?>
		<div class="logo_footer">
			<?php
			$image = get_acf_img_default_value('логотип_в_подвале');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>
		<!-- правое меню -->
		<?php wp_nav_menu(array(
			'container'				=>		'nav',
			'theme_location'  	=> 	'Меню в подвале справа',
			'container_class' 	=> 	'right_menu_footer',
			'menu'            	=> 	'Меню справа в подвале', 
		)); ?>
	</div><!-- /.row -->

	<div class="copyright">
		<p><?php the_field('копирайт'); ?></p>
	</div>


<?php wp_footer(); ?>
</footer>
</body>
</html>
