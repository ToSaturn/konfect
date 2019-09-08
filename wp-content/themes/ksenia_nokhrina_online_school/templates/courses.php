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
    'post_type'   => 'course',
    'suppress_filters' => true,
) );

echo '<div style="background-color:white;color:#000;padding:50px 0px;">';
echo '<pre>';
echo 'Count of courses: '.count($posts).'<br />';
var_dump( $posts );
echo '</pre>';
echo '</div>';

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
            $discount  = get_post_meta($post->ID, 'discount', true);
            $price = get_post_meta($post->ID, 'price', true);
            $created = date_diff( strtotime("now")) $post_meta['post_date'];
            var_dump($price);

            $current_date = date_create(date('d-m-Y', strtotime("now")));
            $created_date = date_create(date('d-m-Y', strtotime($post_meta['post_date'])));
            $announce = date_diff($created_date, $current_date);
            echo 'days: '.$announce->format("%a");
            //var_dump($post);

            //if( isset($post_meta['discount']) ) echo $post_meta['discount'][0];

            $lesson_class_attr = '';
            if( intval($price) <= 0 ) {
                $lesson_class_attr = 'free';

            } else if( intval($discount) > 0 ) {
                $lesson_class_attr = 'discount';

            } else if( isset($post_meta['post_modified']) ) {

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
				        $duration = '0';
				        $complexity = '';

				        if( isset($post_meta['duration']) ) $duration = intval($post_meta['duration']);
				        if( isset($post_meta['complexity']) ) {
				            switch( $post_meta['complexity']) {
                                case 'Начальная':   $complexity='';     break;
                                case 'Средняя':     $complexity='mid';  break;
                                case 'Повышенная':  $complexity='hard'; break;
                                default:            $complexity='mid';  break;
                            }
                        }
					    echo '<span class="duration">'.$duration.' ч.</span>';
					    echo '<div class="complexity" data-level="'.$complexity.'"></div>';
				    echo '</div>';
				    echo '<p>'.get_the_title($post).'</p>';
				    echo '<a href="#" class="more">Узнать подробнее</a>';
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