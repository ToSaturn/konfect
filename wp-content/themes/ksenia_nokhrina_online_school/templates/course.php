<?php
/*
Template Name: Курс
*/
get_header();
?>
<main class="course">
	<div class="favorites"></div>
	<span class="cat">Категория</span>
	<h1>ДЛИННЫЙ ЗАГОЛОВОК ОДНОГО ИЗ НАБОРОВ</h1>
	<div class="row span_row">
		<span class="duration">4 ЧАСА</span>
		<span class="difficult">СРЕДНЯЯ СЛОЖНОСТЬ</span>
		<span class="price">15 000 РУБЛЕЙ</span>
		<span class="num_of_lessons">14 УРОКОВ</span>
	</div>

	<div class="separate_set_slider">

		<div>
			<?php 
			$image = get_field('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_field('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_field('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_field('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div class="new">
			<?php 
			$image = get_field('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_field('изображение_одного_из_наборов');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>
	</div><!-- /.separate_set_slider -->

	<div class="accordion_block">
		<div class="collapse">
			<div class="row">
				<div class="col">
					<div class="preview">Превью урока</div>
					<button class="accordion_but">КУПИТЬ/СМОТРЕТЬ</button>
				</div>
				<div class="col">
					<span class="header">Название урока</span>
					<div class="row">
						<span class="duration">50 МИНУТ</span>
					</div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
				</div>
			</div>
		</div>
	</div><!-- /.accordion_block -->

	<h2>Похожие уроки</h2>
	<div class="row lesson_row">
		<div class="lesson">
			<div class="col">
				<?php 
				$image = get_field('изображение_урока_1');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="row">
					<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
					<div class="complexity"></div>
				</div>
				<p><?php the_field('длинный_заголовок_одного_из_уроков'); ?></p>
				<a href="#" class="more">Узнать подробнее</a>
			</div>
		</div>

		<div class="lesson">
			<div class="col">
				<?php 
				$image = get_field('изображение_урока_2');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="row">
					<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
					<div class="complexity"></div>
				</div>
				<p><?php the_field('длинный_заголовок_урока'); ?></p>
				<a href="#" class="more">Узнать подробнее</a>
			</div>
		</div>

		<div class="lesson">
			<div class="col">
				<?php 
				$image = get_field('изображение_урока_3');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="row">
					<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
					<div class="complexity"></div>
				</div>
				<p><?php the_field('длинный_заголовок_урока'); ?></p>
				<a href="#" class="more">Узнать подробнее</a>
			</div>
		</div>

		<div class="lesson">
			<div class="col">
				<?php 
				$image = get_field('изображение_урока_4');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="row">
					<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
					<div class="complexity"></div>
				</div>
				<p><?php the_field('длинный_заголовок_урока'); ?></p>
				<a href="#" class="more">Узнать подробнее</a>
			</div>
		</div>

	</div><!-- /.row -->
	
	<div class="partners_slider">
		<div>Баннер про кулинарную школу <br>
			+<br>
			Баннер про подарочный купон<br>
		</div>
		<div>Баннер про кулинарную школу <br>
			+ <br>
			Баннер про подарочный купон <br>
		</div>
	</div><!-- /.partners_slider -->
</main>

<?php
get_footer();
?>