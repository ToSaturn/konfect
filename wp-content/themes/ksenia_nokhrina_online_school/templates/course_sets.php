<?php
/*
Template Name: Наборы курсов
*/
get_header();
?>

<main class="course_sets">
	<h1><?php wp_title("", true); ?></h1>
	<div class="categories">
		<button class="cat_but active">АКТИВНАЯ КАТЕГОРИЯ</button>
		<button class="cat_but">ДРУГАЯ КАТЕГОРИЯ</button>
		<button class="cat_but">КАТЕГОРИЯ</button>
		<button class="cat_but">КАТЕГОРИЯ 23</button>
	</div><!-- /.categories -->
	<div class="course_lessons">

		<div class="lesson new">
			<div class="row">
				<?php 
				$image = get_field('изображение_урока_1');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="col">
					<div class="row">
						<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
						<span class="quantity"><?php the_field('количество_уроков'); ?></span>
					</div>
					<p><?php the_field('длинный_заголовок_одного_из_уроков'); ?></p>
					<p><?php the_field('описание_курса'); ?></p>
					<a href="#" class="more">Узнать подробнее</a>
				</div>
			</div>
		</div>

		<div class="lesson free">
			<div class="row">
				<?php 
				$image = get_field('изображение_урока_2');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="col">
					<div class="row">
						<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
						<span class="quantity"><?php the_field('количество_уроков'); ?></span>
					</div>
					<p><?php the_field('длинный_заголовок_урока'); ?></p>
					<p><?php the_field('описание_курса'); ?></p>
					<a href="#" class="more">Узнать подробнее</a>
				</div>
			</div>
		</div>

		<div class="lesson discount">
			<div class="row">
				<?php 
				$image = get_field('изображение_урока_3');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="col">
					<div class="row">
						<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
						<span class="quantity"><?php the_field('количество_уроков'); ?></span>
					</div>
					<p><?php the_field('заголовок_урока'); ?></p>
					<p><?php the_field('описание_курса'); ?></p>
					<a href="#" class="more">Узнать подробнее</a>
				</div>
			</div>
		</div>

		<div class="lesson">
			<div class="row">
				<?php 
				$image = get_field('изображение_урока_4');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="col">
					<div class="row">
						<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
						<span class="quantity"><?php the_field('количество_уроков'); ?></span>
					</div>
					<p><?php the_field('длинный_заголовок_одного_из_уроков'); ?></p>
					<p><?php the_field('описание_курса'); ?></p>
					<a href="#" class="more">Узнать подробнее</a>
				</div>
			</div>
		</div>

		<div class="lesson">
			<div class="row">
				<?php 
				$image = get_field('изображение_урока_5');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="col">
					<div class="row">
						<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
						<span class="quantity"><?php the_field('количество_уроков'); ?></span>
					</div>
					<p><?php the_field('длинный_заголовок_урока'); ?></p>
					<p><?php the_field('описание_курса'); ?></p>
					<a href="#" class="more">Узнать подробнее</a>
				</div>
			</div>
		</div>

		<div class="lesson">
			<div class="row">
				<?php 
				$image = get_field('изображение_урока_6');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="col">
					<div class="row">
						<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
						<span class="quantity"><?php the_field('количество_уроков'); ?></span>
					</div>
					<p><?php the_field('заголовок_урока'); ?></p>
					<p><?php the_field('описание_курса'); ?></p>
					<a href="#" class="more">Узнать подробнее</a>
				</div>
			</div>
		</div>
		
		<!-- + -->
		<div class="show_more"><button>+</button></div>
		
		<!-- скрытые блоки -->
		<div class="more_block">
			<div class="lesson">
				<div class="row">
					<?php 
					$image = get_field('изображение_урока_1');
					if( !empty($image) ): ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>
					<div class="col">
						<div class="row">
							<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
							<span class="quantity"><?php the_field('количество_уроков'); ?></span>
						</div>
						<p><?php the_field('длинный_заголовок_одного_из_уроков'); ?></p>
						<p><?php the_field('описание_курса'); ?></p>
						<a href="#" class="more">Узнать подробнее</a>
					</div>
				</div>
			</div>

			<div class="lesson">
				<div class="row">
					<?php 
					$image = get_field('изображение_урока_4');
					if( !empty($image) ): ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>
					<div class="col">
						<div class="row">
							<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
							<span class="quantity"><?php the_field('количество_уроков'); ?></span>
						</div>
						<p><?php the_field('длинный_заголовок_одного_из_уроков'); ?></p>
						<p><?php the_field('описание_курса'); ?></p>
						<a href="#" class="more">Узнать подробнее</a>
					</div>
				</div>
			</div>

		</div><!-- /.more_block -->
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
	</div><!-- /.course_lessons -->
</main>

<?php get_footer(); ?>