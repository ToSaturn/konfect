<?php
/*
Template Name: Отдельный набор
*/
get_header();
?>

<main class="separate_set">
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
				$image = get_field('изображения_набора_1');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>
		<div>
			<?php 
			$image = get_field('изображения_набора_2');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_field('изображения_набора_3');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_field('изображения_набора_4');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_field('изображения_набора_5');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div class="discount">
			<?php 
			$image = get_field('изображения_набора_6');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>

		<div>
			<?php 
			$image = get_field('изображения_набора_7');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>
	</div><!-- /.separate_set_slider -->


	<p class="progress">КУРС ПРОЙДЕН НА <span>70%</span></p>
	<div class="progressbar"></div>

	
	<h2>Содержание курса</h2>
	<div class="viewed">
		<div class="separate_set_accordion accordion">
			<div class="viewed_right">Просмотренно</div>
			<div class="viewed_left">Просмотренно</div>
			<div class="accordion_header">
				<button>01 Название урока</button>
			</div>
			<span class="close">+</span>
			<div class="collapse">
				<div class="row">
					<div class="col">
						<div class="preview">qwe</div>
						<button href="#" class="accordion_but">СМОТРЕТЬ</button>
					</div>

					<div class="col">
						<button class="close">test1</button>

						<div class="row">
							<span class="duration">50 МИНУТ</span>
						</div>
						<p>qwe</p>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="viewed">
		<div class="separate_set_accordion accordion">
			<div class="viewed_right">Просмотренно</div>
			<div class="viewed_left">Просмотренно</div>
			<div class="accordion_header">
				<button>02 Название урока</button>
			</div>
			<span class="close">+</span>
			<div class="collapse">
				<div class="row">
					<div class="col">
						<div class="preview">Превью урока</div>
						<button class="accordion_but">СМОТРЕТЬ</button>
					</div>
					<div class="col">
						<button class="close">02 Название урока</button>
						<div class="row">
							<span class="duration">50 МИНУТ</span>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  </p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="viewed">
		<div class="separate_set_accordion accordion">
			<div class="viewed_right">Просмотренно</div>
			<div class="viewed_left">Просмотренно</div>
			<div class="accordion_header">
				<button>03 Название урока</button>
			</div>
			<span class="close">+</span>
			<div class="collapse">
				<div class="row">
					<div class="col">
						<div class="preview">Превью урока</div>
						<button class="accordion_but">СМОТРЕТЬ</button>
					</div>
					<div class="col">
						<button class="close">03 Название урока</button>
						<div class="row">
							<span class="duration">50 МИНУТ</span>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  </p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="separate_set_accordion accordion">
		<div class="accordion_header">
			<button>04 Название урока</button>
		</div>
		<span class="close">+</span>
		<div class="collapse">
			<div class="row">
				<div class="col">
					<div class="preview">Превью урока</div>
					<button class="accordion_but">СМОТРЕТЬ</button>
				</div>
				<div class="col">
					<button class="close">04 Название урока</button>
					<div class="row">
						<span class="duration">50 МИНУТ</span>
					</div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  </p>
				</div>
			</div>
		</div>
	</div>

	<div class="separate_set_accordion accordion">
		<div class="accordion_header">
			<button>05 Название урока</button>
		</div>
		<span class="close">+</span>
		<div class="collapse">
			<div class="row">
				<div class="col">
					<div class="preview">Превью урока</div>
					<button class="accordion_but">СМОТРЕТЬ</button>
				</div>
				<div class="col">
					<button class="close">05 Название урока</button>
					<div class="row">
						<span class="duration">50 МИНУТ</span>
					</div>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  </p>
				</div>
			</div>
		</div>
	</div>
	
	<div class="similar_courses">
		<h3>Похожие курсы</h3>
		<div class="row">
			<div class="similar_courses_block"></div>
			<div class="similar_courses_block"></div>
			<div class="similar_courses_block"></div>
			<div class="similar_courses_block"></div>
		</div><!-- /.similar_courses -->
	</div>

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