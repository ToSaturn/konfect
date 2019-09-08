<?php
/*
Template Name: Главная страница
*/
get_header();
?>

<main class="main">
	<span class="hashtag"><?php the_field('хэштег'); ?></span>
	<div class="adv">
		<div class="row">
			<div class="adv_item">
				<span class="number number-more"><?php the_field('преимущество_1_число'); ?></span>
				<span class="adv_text"><?php the_field('преимущество_1'); ?></span>
			</div>
			<div class="adv_item">
				<span class="number number-more"><?php the_field('преимущество_2_число'); ?></span>
				<span class="adv_text"><?php the_field('преимущество_2'); ?></span>
			</div>
			<div class="adv_item">
				<span class="number"><?php the_field('преимущество_3_число'); ?></span>
				<span class="adv_text"><?php the_field('преимущество_3'); ?></span>
			</div>
			<div class="adv_item">
				<span class="number number-more"><?php the_field('преимущество_4_число'); ?></span>
				<span class="adv_text"><?php the_field('преимущество_4'); ?></span>
			</div>
		</div>
	</div><!-- /.adv -->
</main>

<!-- Добро пожаловать -->
<section class="wellcome">
	<div class="container_80vw row">
		<div class="img_i">
			<?php 
			$image = get_field('фото_ксении');
			if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
		</div>
		<div class="wellcome_text">
			<h1><?php the_field('заголовок_добро_пожаловать'); ?></h1>
			<p><?php the_field('текст_добро_пожаловать'); ?></p>
			<a href="#" class="more"><?php the_field('узнать_больше'); ?></a>
		</div>
	</div>
</section>

<!-- Карусель с уроками -->
<section class="lessons_carousel">

	<div class="row">
		<button class="button cat_but active">ПОПУЛЯРНОЕ</button>
		<button class="button cat_but">НОВЫЕ УРОКИ</button>
		<button class="button cat_but">БЕСПЛАТНЫЕ УРОКИ</button>
	</div>
	<div class="lessons">
	<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
		<?php /*dynamic_sidebar();*/ ?>
	<?php } } else { ?>
		<p>Записей нет.</p>
	<?php } ?>
		<div class="lesson">
			<div class="col">
				<?php 
				$image = get_field('изображения_урока_1');
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
				$image = get_field('изображения_урока_2');
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
				$image = get_field('изображения_урока_3');
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
				$image = get_field('изображения_урока_4');
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
				$image = get_field('изображения_урока_5');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="row">
					<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
					<div class="complexity"></div>
				</div>
				<p><?php the_field('заголовок_урока'); ?></p>
				<a href="#" class="more">Узнать подробнее</a>
			</div>
		</div>

		<div class="lesson">
			<div class="col">
				<?php 
				$image = get_field('изображения_урока_6');
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
				$image = get_field('изображения_урока_1');
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
				$image = get_field('изображения_урока_2');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="row">
					<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
					<div class="complexity"></div>
				</div>
				<p><?php the_field('заголовок_урока'); ?></p>
				<a href="#" class="more">Узнать подробнее</a>
			</div>
		</div>

		<div class="lesson">
			<div class="col">
				<?php 
				$image = get_field('изображения_урока_3');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>
				<div class="row">
					<span class="duration"><?php the_field('продолжительность_урока'); ?></span>
					<div class="complexity"></div>
				</div>
				<p><?php the_field('заголовок_урока'); ?></p>
				<a href="#" class="more">Узнать подробнее</a>
			</div>
		</div>

		<div class="lesson">
			<div class="col">
				<?php 
				$image = get_field('изображения_урока_4');
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
				$image = get_field('изображения_урока_5');
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
				$image = get_field('изображения_урока_6');
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
	</div><!-- /.lessons -->
</section>

<!-- Онлайн школа лого -->
<section class="logo_school">
	<div class="col">
		<div class="logo"></div>
		<h2><span class="orange">ОНЛАЙН ШКОЛА</span><br>
		<span class="white">КСЕНИИ НОХРИНОЙ</span></h2>
		<a href="#" class="button">ХОЧУ УЧИТЬСЯ!</a>
	</div>
</section>

<!-- Наши партнеры -->
<section class="partners">
	<h3>НАШИ ПАРТНЕРЫ</h3>
	<div class="partners_slider">
		<div>
			<div class="row">
				<?php 
				$image = get_field('изображение_техники');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>

				<div class="col">
					<div class="logo_coocking_chef"></div>
					<span class="header"><?php the_field('название_техники'); ?></span>
					<p><?php the_field('описание_техники'); ?></p>
					<a href="#" class="button">ПОЛУЧИТЬ СКИДКУ</a>
				</div>
			</div>
		</div>
		
		<div>
			<div class="row">
				<?php 
				$image = get_field('изображение_техники');
				if( !empty($image) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
				<?php endif; ?>

				<div class="col">
					<div class="logo_coocking_chef"></div>
					<span class="header"><?php the_field('название_техники'); ?></span>
					<p><?php the_field('описание_техники'); ?></p>
					<a href="#" class="button">ПОЛУЧИТЬ СКИДКУ</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
?>