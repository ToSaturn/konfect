<?php
/*
Template Name: Курсы
*/
get_header();


$posts = get_posts( array(
    'numberposts' => 12,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'include'     => array(),
    'exclude'     => array(),
    'post_type'   => 'lesson',
    'suppress_filters' => true,
) );

//echo '<div style="background-color:white;color:#000;padding:50px 0px;">';
//echo '<pre>';
//echo 'Count of courses: '.count($posts).'<br />';
//var_dump( $posts );
//echo '</pre>';
//echo '</div>';

?>

<main class="courses">
	<h1><?php wp_title("", true); ?></h1>
	<div class="categories">
		<button class="cat_but active">БИСКВИТНЫЕ ТОРТЫ</button>
		<button class="cat_but">МУССОВЫЕ ДЕСЕРТЫ</button>
		<button class="cat_but">CANDY BAR</button>
		<button class="cat_but">ПЕСОЧНОЕ ТЕСТО</button>
		<button class="cat_but">ШОКОЛАД</button>
		<button class="cat_but">КЕКСОВОЕ ТЕСТО</button>
		<button class="cat_but">СОСТОВЛЯЮЩИЕ ДЛЯ ДЕСЕРТОВ</button>
		<button class="cat_but">ПОРЦИОННЫЕ ДЕСЕРТЫ В СТАКАНАХ</button>
		<button class="cat_but">ДЕКОР</button>
		<button class="cat_but">ПРОСТО, БЫСТРО, ВКУСНО</button>
		<button class="cat_but">ДРУГОЕ</button>
	</div><!-- /.categories -->

    <?php
        echo '<div class="course_lessons">';

        foreach ($posts as $post ) {
            $post_meta = get_post_meta($post->ID);

            $is_discounted  = get_post_meta($post->ID, 'discount', true);
            $is_free        = get_post_meta($post->ID, 'price', true);
            $is_new         = abs(round((strtotime('now')-strtotime($post->post_date))/86400));
            $duration       = intval(get_post_meta($post->ID, 'duration', true));
            $complexity     = get_post_meta($post->ID, 'complexity', true);

            $lesson_class_attr = '';
            if( intval($is_free) <= 0 ) {
                $lesson_class_attr = 'free';
            } else if( intval($is_discounted) > 0 ) {
                $lesson_class_attr = 'discount';
            } else if( intval($is_new) > 0 && intval($is_new) < 4 ) {
                $lesson_class_attr = 'new';
            }

		    echo '<div class="lesson '.$lesson_class_attr.'">';
			    echo '<div class="col">';
			        $image = array(
			                'url'=> get_the_post_thumbnail_url($post, array(300,300)),
                            'alt'=> get_the_post_thumbnail_caption($post),
                    );
				    if( isset($image['url']) && isset($image['alt']) ) {
					    echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" />';
				    }
				    echo '<div class="row">';
				        switch($complexity) {
                            case 'Начальная':   $complexity='';     break;
                            case 'Средняя':     $complexity='mid';  break;
                            case 'Повышенная':  $complexity='hard'; break;
                            default:            $complexity='';     break;
                        }

					    echo '<span class="duration">'.$duration.' ч.</span>';
					    echo '<div class="complexity" data-level="'.$complexity.'"></div>';
				    echo '</div>';
				    echo '<p>'.get_the_title($post).'</p>';
				    echo '<a href="'.get_post_permalink($post->ID).'" class="more">Узнать подробнее</a>';
			    echo '</div>';
    		echo '</div>';
        }
        echo '</div>';
    ?>

		<div class="show_more"><button>+</button></div>

		<div class="more_block">
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
					<p><?php the_field('заголовок_урока'); ?></p>
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
					<p><?php the_field('длинный_заголовок_одного_из_уроков'); ?></p>
					<a href="#" class="more">Узнать подробнее</a>
				</div>
			</div>

			<div class="lesson">
				<div class="col">
					<?php 
					$image = get_field('изображение_урока_5');
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
					$image = get_field('изображение_урока_6');
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