<?php
/**
 * Ksenia_Nokhrina_Online_School functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ksenia_Nokhrina_Online_School
 */

if ( ! function_exists( 'ksenia_nokhrina_online_school_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ksenia_nokhrina_online_school_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ksenia_Nokhrina_Online_School, use a find and replace
		 * to change 'ksenia_nokhrina_online_school' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ksenia_nokhrina_online_school', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Меню слева', 'ksenia_nokhrina_online_school' ),
		) );
		register_nav_menus( array(
			'menu-2' => esc_html__( 'Меню справа', 'ksenia_nokhrina_online_school' ),
		) );
		register_nav_menus( array(
			'menu-3' => esc_html__( 'Меню в подвале слева', 'ksenia_nokhrina_online_school' ),
		) );
		register_nav_menus( array(
			'menu-4' => esc_html__( 'Меню в подвале справа', 'ksenia_nokhrina_online_school' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ksenia_nokhrina_online_school_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
		) );
		
		
		add_theme_support( 'lifterlms-sidebars' );
	}
endif;
add_action( 'after_setup_theme', 'ksenia_nokhrina_online_school_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ksenia_nokhrina_online_school_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ksenia_nokhrina_online_school_content_width', 640 );
}
add_action( 'after_setup_theme', 'ksenia_nokhrina_online_school_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ksenia_nokhrina_online_school_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Личный кабинет', 'ksenia_nokhrina_online_school' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ksenia_nokhrina_online_school' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ksenia_nokhrina_online_school_widgets_init' );

/* Отображение LifterLMS курса и боковых панелей урока
 * на курсах и уроках вместо боковой панели, возвращенной
 * эта функция
* @param     string $ id идентификатор боковой панели по умолчанию (пустая строка)
* возвращаемая    строка
 */
function  my_llms_sidebar_function($id) {
	$my_sidebar_id  =  'sidebar-1';
	return  $my_sidebar_id;
}
add_filter ( 'llms_get_theme_default_sidebar ' , ' my_llms_sidebar_function ' );

/**
 * Enqueue scripts and styles.
 */
function ksenia_nokhrina_online_school_scripts() {
	wp_enqueue_style( 'ksenia_nokhrina_online_school-style', get_stylesheet_uri() );

	wp_enqueue_style('account', get_template_directory_uri() . '/css/account.css', array() );
	wp_enqueue_style('contacts', get_template_directory_uri() . '/css/contacts.css', array() );
	wp_enqueue_style('courses', get_template_directory_uri() . '/css/courses.css', array() );
	wp_enqueue_style('course', get_template_directory_uri() . '/css/course.css', array() );
	wp_enqueue_style('course_sets', get_template_directory_uri() . '/css/course_sets.css', array() );
	wp_enqueue_style('about_us', get_template_directory_uri() . '/css/about.css', array() );
	wp_enqueue_style('school', get_template_directory_uri() . '/css/school.css', array() );
	wp_enqueue_style('school_separate_direction', get_template_directory_uri() . '/css/school_separate_direction.css', array() );
	wp_enqueue_style('separate_set', get_template_directory_uri() . '/css/separate_set.css', array() );
	wp_enqueue_script( 'ksenia_nokhrina_online_school-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ksenia_nokhrina_online_school-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js',  true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'ksenia_nokhrina_online_school_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/**
 * Get number of lessons attached to a course
 * @param    int   $course_id  WP Post ID of a course
 * @return   int
 */
function my_get_lesson_count( $course_id ) {
	
	$course = new LLMS_Course( $course_id );
	return count( $course->get_children_lessons() );
}


/*SET default values for acf*/

// add default image setting to ACF image fields
// let's you select a defualt image
// this is simply taking advantage of a field setting that already exists

add_action('acf/render_field_settings/type=image', 'add_default_value_to_image_field');
function add_default_value_to_image_field($field) {
	acf_render_field_setting( $field, array(
		'label'			=> 'Default Image',
		'instructions'		=> 'Appears when creating a new post',
		'type'			=> 'image',
		'name'			=> 'default_value',
	));
}


function load_acf_text_value($value, $post_id, $field) {
    $value = get_acf_text_default_value($field["name"]);
    return $value;
}

function load_acf_img_value($value, $post_id, $field) {
    $value = get_acf_img_default_value($field["name"]);
    return $value;
}

function get_acf_text_default_value($field_name)
{
    global $wpdb;
    $acf_info = $wpdb->get_var("SELECT post_content FROM `wp_posts` WHERE post_excerpt = '" . $field_name . "' AND post_type = 'acf-field'");
    if (preg_match('/(?<="default_value";s:\d.:")(.)*?(?=";)/', $acf_info, $output_array) !== false) { // check any match found or not
    	return $output_array[0];
    }
    return null;
}

function get_acf_img_default_value($field_name)
{
//	return array('url' => '1', 'alt' => '2');
	
	global $wpdb;
    $acf_info = $wpdb->get_var("SELECT post_content FROM `wp_posts` WHERE post_excerpt = '" . $field_name . "' AND post_type = 'acf-field' ORDER BY ID DESC LIMIT 1");
    if (preg_match('/(?<="default_value";i:)\d+/', $acf_info, $output_array) !== false) { // check any match found or not
    	$value = $output_array[0];
    	
    	$url = wp_get_attachment_image_url($value, "medium");
    	$alt = get_post_meta($value, '_wp_attachment_image_alt', TRUE);
	    return array('url' => $url, 'alt' => $alt);
    }
    return null;
}

function gm_get_progress_bar_html($html, $percentage) {

	
	$test = '<p class="progress">КУРС ПРОЙДЕН НА <span>'.$percentage.'</span></p>
		<div class="llms-progress">
		<div class="llms-progress-bar">
			<div class="progress-bar-complete progressbar" data-progress="' . $percentage . '"  style="width:' . $percentage . '"></div>
		</div></div>';

		
	return $test;

}



add_filter('acf/load_value/name=копирайт', load_acf_text_value, 10, 3);
add_filter('acf/load_value/name=логотип_в_подвале', load_acf_img_value, 10, 3);
add_filter('acf/load_value/name=фото_инстаграмм_1', load_acf_img_value, 10, 3);
add_filter('acf/load_value/name=фото_инстаграмм_2', load_acf_img_value, 10, 3);
add_filter('acf/load_value/name=фото_инстаграмм_3', load_acf_img_value, 10, 3);
add_filter('acf/load_value/name=фото_инстаграмм_4', load_acf_img_value, 10, 3);
add_filter('acf/load_value/name=фото_инстаграмм_5', load_acf_img_value, 10, 3);
add_filter('acf/load_value/name=фото_инстаграмм_6', load_acf_img_value, 10, 3);
add_filter('llms_get_progress_bar_html', 'gm_get_progress_bar_html', 10, 2);



/*LifterLMS actions*/

/***********************************************************************
 *
 * Single Lesson
 *
 ***********************************************************************/
 function pre_footer_banner () {
 	return get_template_part('template-parts/pre-footer-banner');
 }
 
  function related_lessons () {
 	return get_template_part('template-parts/related-lessons');
 }
 
 
//add_action( 'lifterlms_single_lesson_before_summary', 'lifterlms_template_single_parent_course', 10 );
// add_action( 'custom_lifterlms_single_lesson_before_summary', 'lifterlms_template_single_lesson_video',  20 );
// add_action( 'custom_lifterlms_single_lesson_before_summary', 'lifterlms_template_single_lesson_audio',  20 );

 add_action( 'custom_lifterlms_single_lesson_after_summary', 'related_lessons',  10 );
 add_action( 'custom_lifterlms_single_lesson_after_summary', 'pre_footer_banner',  20 );


