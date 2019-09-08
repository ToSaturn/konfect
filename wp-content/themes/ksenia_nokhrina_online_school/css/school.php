<?php
/*
Template Name: Школа
*/
get_header();
?>

<main class="school">
	<h1><?php the_field('заголовок_оранжевый'); ?><br>
		<span><?php the_field('заголовок_белый'); ?></span>
	</h1>
	<small><?php the_field('маленький_текст'); ?></small>
	<div class="school_slider">

		<div>
			<div class="white_bg"></div>
			<div class="slide_title">
				<span>Для новичков</span>
			</div>
		</div>

		<div class="soon">
			<div class="white_bg"></div>
			<div class="slide_title">
				<span>Для продвинутых</span>
			</div>
		</div>

		<div class="soon">
			<div class="white_bg"></div>
			<div class="slide_title">
				<span>Для профи</span>
			</div>
		</div>

		<div>
			<div class="white_bg"></div>
			<div class="slide_title">
				<span>Для новичков</span>
			</div>
		</div>

		<div class="soon">
			<div class="white_bg"></div>
			<div class="slide_title">
				<span>Для продвинутых</span>
			</div>
		</div>

		<div class="soon">
			<div class="white_bg"></div>
			<div class="slide_title">
				<span>Для профи</span>
			</div>
		</div>

	</div><!-- /.school-slider -->

	<h2><?php the_field('учебный_процесс'); ?></h2>
	<div class="row studying_proccess">

		<div class="first_step col">
			<p class="head"><?php the_field('первый_этап_заголовок'); ?></p>
			<p><?php the_field('первый_этап_текст'); ?></p>
		</div>

		<div class="second_step col">
			<p class="head"><?php the_field('второй_этап_заголовок'); ?></p>
			<p><?php the_field('второй_этап_текст'); ?></p>
		</div>

		<div class="third_step col">
			<p class="head"><?php the_field('третий_этап_заголовок'); ?></p>
			<p><?php the_field('третий_этап_текст'); ?></p>
		</div>
		<div class="fourth_step col">
			<p class="head"><?php the_field('четвертый_этап_заголовок'); ?></p>
			<p><?php the_field('четвертый_этап_текст'); ?></p>
		</div>
	</div>
</main>

<section class="stock">
	<p>МЕСТО ДЛЯ СПЕЦИАЛЬНОГО ПРЕДЛОЖЕНИЯ<br>
		(Например скидка на курс при покупке до какого-то числа)
	</p>
</section>

<section class="reviews">

	<h3><?php the_field('заголовок_отзывов'); ?></h3>
	<div class="reviews_slider">
		<div class="row">
			<div class="review_text">
				<span class="head"><?php the_field('заголовок_отзыва'); ?></span>
				<p><?php the_field('текст_отзыва'); ?></p>
				<span>Какой-то контакт</span><span>Дата отзыва</span>
				<button class="review_but">Курс для новичков</button>
			</div>
			<div class="review_img">Фото результатов обучения</div>
		</div>
		<div class="row">
			<div class="review_text">
				<span class="head"><?php the_field('заголовок_отзыва'); ?></span>
				<p><?php the_field('текст_отзыва'); ?></p>
				<span>Какой-то контакт</span><span>Дата отзыва</span>
				<button class="review_but">Курс для новичков</button>
			</div>
			<div class="review_img">Фото результатов обучения</div>
		</div>
	</div>
</section>

<?php
get_footer();
?>