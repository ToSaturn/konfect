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
    'media_content'             => get_post_meta($post->ID, '_llms_video_embed', true),
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

?>
    <main class="course">
        <div class="favorites"></div>
        <span class="cat"><?php echo $lesson_info['category']; ?></span>
        <h1><?php echo $post->post_title; ?></h1>
        <div class="row span_row">
            <span class="duration"><?php echo $lesson_info['duration']; ?> ч.</span>
            <span class="difficult" data-level="mid"><?php echo $lesson_info['complexity']; ?> сложность</span>
            <span class="price"><?php echo $lesson_info['price']; ?> РУБЛЕЙ</span>
            <span class="num_of_lessons"><?php echo intval($lesson_info['lessons']->post_count); ?> УРОКОВ</span>
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
                        <div class="preview">
                            <?php
                                echo '<div class="llms-video-wrapper">';
                                echo '<div class="center-video">';

                                $lesson = new LLMS_Lesson( $post );
                                echo $lesson->get_video();
                                global $wp_embed;
                                echo $wp_embed->run_shortcode( '[embed]' . $lesson_info['media_content']. '[/embed]' );
                                echo '</div></div>';
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
        <?php
            echo '<div class="row lesson_row">';
            $lesson_more_count = 0;
            foreach( $lesson_info['lessons']->posts as $p ) {
                if( $lesson_more_count >= 4 ) break;
                echo '<div class="lesson">';
                    echo '<div class="col">';
                        $image = array(
                            'url'=> get_the_post_thumbnail_url($p, array(300,300)),
                            'alt'=> get_the_post_thumbnail_caption($p),
                        );
                        echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'" />';
                        echo '<div class="row">';
                            echo '<span class="duration">'.intval(get_post_meta($p->ID, 'duration', true)).' ч.</span>';
                            $c=strtolower(get_post_meta($p->ID, 'complexity', true));
                            switch(mb_strtolower($c)){
                                case 'средняя':     $c='mid';  break;
                                case 'повышенная':  $c='hard'; break;
                                //default:            $complexity='';     break;
                            }
                            echo '<div class="complexity" data-level="'.$c.'"></div>';
                        echo '</div>';
                    echo '<p>'.$p->post_title.'</p>';
                    echo '<a href="'.get_post_permalink($p->ID).'" class="more">Узнать подробнее</a>';
                    echo '</div>';
                echo '</div>';
                $lesson_more_count++;
            }
            echo '</div>';
        ?>

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