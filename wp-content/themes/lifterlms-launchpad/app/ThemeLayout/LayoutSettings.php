<?php

namespace LaunchPad\ThemeLayout;

use SkyLab\Config\Configuration;
use LaunchPad\Metaboxes\Layout;

/**
 * Layout
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 * @version 2.2.2
 */
class LayoutSettings
{
    /**
     * Instance of Configuration class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private $config;

    /**
     * Layout constructor.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;

        $this->load_layout_settings();

        return $this;
    }

    /**
     * Load Layout Settings
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    private function load_layout_settings()
    {
        new ContentLayout($this->config, $this);
        new SidebarLayout($this->config, $this);
    }

    /**
     * Get Options
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param bool $text_only
     * @return mixed
     */
    public static function get_options($text_only = false)
    {
        if ($text_only)
        {
            return apply_filters('launchpad_layout_options_text_only',
                [
                    'content_sidebar' => 'Content, Sidebar',
                    'sidebar_content' => 'Sidebar, Content',
                    'sidebar_content_sidebar' => 'Sidebar, Content, Sidebar',
                    'content' => 'Content'
                ]
            );
        }
        else
        {
            return apply_filters('launchpad_layout_options',
                [
                    'content_sidebar' => '<span><img src="' . get_stylesheet_directory_uri() . '/images/content_sidebar.png" /></span',
                    'sidebar_content' => '<span><img src="' . get_stylesheet_directory_uri() . '/images/sidebar_content.png" /></span',
                    'sidebar_content_sidebar' => '<span><img src="' . get_stylesheet_directory_uri() . '/images/sidebar_content_sidebar.png" /></span',
                    'content' => '<span><img src="' . get_stylesheet_directory_uri() . '/images/content.png" /</span>'
                ]
            );
        }

    }

   public static function get_options_src() {
        return apply_filters('launchpad_layout_options_src', array(
            'content_sidebar' => get_template_directory_uri() . '/images/content_sidebar.png',
            'sidebar_content' => get_template_directory_uri() . '/images/sidebar_content.png',
            'sidebar_content_sidebar' => get_template_directory_uri() . '/images/sidebar_content_sidebar.png',
            'content' => get_template_directory_uri() . '/images/content.png',
        ) );

    }

    /**
     * Get Layout Settings
     *
     * @since 0.0.1
     * @version 2.2.2
     *
     * @return array
     */
    public static function get_layout_setting()
    {

        global $post;

        // blog page setting
        if ( is_home() || is_category() || is_tag() ) {
            return Layout::get_setting( 'launchpad_default_layout', get_option( 'launchpad_default_blog_layout', 'sidebar_content' ) );
        }

        // course archive
        elseif ( is_post_type_archive( 'course' ) ) {
            return Layout::get_setting( 'launchpad_default_layout', get_option( 'launchpad_default_course_layout', 'content' ) );
        }

        // membership archive
        elseif ( is_post_type_archive( 'llms_membership' ) ) {
            return Layout::get_setting( 'launchpad_default_layout', get_option( 'launchpad_default_membership_layout', 'content' ) );
        }

        // single pages / posts
        elseif ( is_singular() && ! is_null( $post ) ) {

            // *never* show sidebars on certiciates!
            if ( 'llms_certificate' === get_post_type( $post->ID ) || 'llms_my_certificate' === get_post_type( $post->ID ) ) {
                return 'content';
            }

            // post override -- find the default first, if we have nothing well move to the next set of checks
            if ( $layout_option = get_post_meta( $post->ID, 'launchpad_default_layout', true ) ) {
                return $layout_option;
            }

            // no post specific override found so check parents for certain post types

            // courses and lessons
            if ( 'lesson' === get_post_type( $post->ID ) || 'course' === get_post_type( $post->ID ) ) {

                // check parent course
                if ( 'lesson' === get_post_type( $post->ID ) ) {

                    $course = get_post_meta( $post->ID, '_parent_course', true );

                    if ( $course && $course_option = get_post_meta( $course, 'launchpad_default_layout', true ) ) {

                        return $course_option;

                    }

                }

                // courses and lessons without a parent override
                return get_option( 'launchpad_default_course_layout', 'content_sidebar' );

            }

            // memberships fallback to their default
            elseif ( 'llms_membership' ===  get_post_type( $post->ID ) ) {

                return get_option( 'launchpad_default_membership_layout', 'content' );

            }

            // blog posts will take on the default blog layout option
            elseif ( 'post' === get_post_type( $post->ID ) ) {

                return get_option( 'launchpad_default_blog_layout', 'sidebar_content' );

            }

        }

        // return the default site option
        return get_option('launchpad_default_layout', 'sidebar_content');
    }

}
