<?php
/*
Template Name: Курс
*/
get_header();

$lesson_info = array(
    'duration'                  => intval(get_post_meta($post->ID, 'duration', true)),
    'price'                     => intval(get_post_meta($post->ID, 'price', true)),
    'category'                  => get_post_meta($post->ID, 'category', true),
    'discount'                  => intval(get_post_meta($post->ID, 'discount', true)),
    'complexity'                => get_post_meta($post->ID, 'complexity', true),
    'complexity_attr'           => 'mid',
    'media_content_name'        => get_post_meta($post->ID, 'media_content_name', true),
    'media_content_description' => get_post_meta($post->ID, 'media_content_description', true),
    'parent_course'             => intval(get_post_meta($post->ID, '_llms_parent_course', true)),
    'lessons'                   => null,
);

switch(strtolower($lesson_info['complexity'])){
    case 'средняя':     $lesson_info['complexity_attr']='mid';  break;
    case 'Повышенная':  $lesson_info['complexity_attr']='hard'; break;
    default:            $lesson_info['complexity_attr']='';     break;
}

$lesson_info['lessons'] = new WP_Query();
$lesson_info['lessons']->query(array(
    'post_type'  =>'lesson',
    'post_status'=>'published',
    'meta_query' => array(
        array(
            'key'     => '_llms_parent_course',
            'value'   => $lesson_info['parent_course'],
            'compare' => '=',
        )
    )
));

$lesson_info['lessons'] = intval($lesson_info['lessons']->post_count);
?>
    <main class="course">
        <div class="favorites"></div>
        <span class="cat"><?php echo $lesson_info['category']; ?></span>
        <h1><?php echo $post->post_title; ?></h1>
        <div class="row span_row">
            <span class="duration"><?php echo $lesson_info['duration']; ?> ч.</span>
            <span class="difficult" data-level="mid"><?php echo $lesson_info['complexity']; ?> сложность</span>
            <span class="price"><?php echo $lesson_info['price']; ?> РУБЛЕЙ</span>
            <span class="num_of_lessons"><?php echo $lesson_info['lessons']; ?> УРОКОВ</span>
        </div>

        <?php do_shortcode('[embed width="123" height="456"]http://www.youtube.com/watch?v=dQw4w9WgXcQ[/embed]'); ?>

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
                        <div class="preview">
                            <?php
                                global $wp_embed;
                                $video_url = 'https://www.youtube.com/watch?v=b7mixrO2lzA';
                                echo $wp_embed->run_shortcode( '[embed content_width="100%" content_height="100%" style="top:0;"]' . $video_url . '[/embed]' );
                            ?>
                        </div>
                        <button class="accordion_but">КУПИТЬ/СМОТРЕТЬ</button>
                    </div>
                    <div class="col">
                        <span class="header"><?php echo $lesson_info['media_content_name']; ?></span>
                        <div class="row">
                            <span class="duration"><?php echo $lesson_info['duration']; ?> ч.</span>
                        </div>
                        <p><?php echo $lesson_info['media_content_description']; ?></p>
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