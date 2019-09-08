<?php

namespace LaunchPad\Metaboxes;

use SkyLab\Metaboxes\Metabox;
use LaunchPad\ThemeLayout\LayoutSettings;
use LaunchPad\ThemeLayout\HeaderLayout;

class Layout extends Metabox
{
    public function __construct()
    {
        $this->id = 'layout_settings';
        $this->title = 'Layout Settings';
        $this->context = 'normal';
        $this->priority = 'high';
        $this->screens = apply_filters( 'launchpad_layout_settings_metabox_post_types', [
            'post',
            'page',
            'course',
            'lesson',
            'llms_quiz',
            'llms_membership',
        ] );

        $this->init();
    }

    public static function get_setting( $setting, $default = '' ) {

        $post_id = false;


        // default home page (shows posts)
        if ( is_front_page() && is_home() ) {
          $show_widgets = true;
        // static front page
        } elseif ( is_front_page() ) {
          $post_id = get_option( 'page_on_front' );
        // blog page
        } elseif ( is_home() ) {
          $post_id = get_option( 'page_for_posts' );
        // singular post
        } elseif ( is_singular() ) {
          $post_id = get_the_ID();
        // wut...
        } elseif ( is_lifterlms_enabled() ) {
            if ( is_courses() ) {
                $post_id = llms_get_page_id( 'courses' );
            } elseif ( is_memberships() ) {
                $post_id = llms_get_page_id( 'memberships' );
            }
        }

        $val = $default;
        if ( $post_id ) {
          $val = get_post_meta( $post_id, $setting, true );
        }

        return $val;

    }

    public static function get_fields_for_builder() {
        return array(
            'title' => __( 'LaunchPad Theme Layout', 'lifterlms-launchpad' ),
            'toggleable' => true,
            'fields' => array(
                array(
                    array(
                        'attribute' => 'launchpad_page_menu',
                        'type' => 'select',
                        'label' => __( 'Alternate Navigation', 'lifterlms-launchpad' ),
                        'tip' => __( 'Hide navigation or display an alternate navigation for this post.', 'lifterlms-launchpad' ),
                        'options'   => HeaderLayout::get_menu_options(),
                    ),
                ),
                array(
                    array(
                        'attribute' => 'launchpad_hide_page_title',
                        'type' => 'switch',
                        'label' => __( 'Hide Title', 'lifterlms-launchpad' ),
                        'tip' => __( 'Check this box to hide the title from view.', 'lifterlms-launchpad' ),
                    ),
                    array(
                        'attribute' => 'launchpad_hide_page_header',
                        'type' => 'switch',
                        'label' => __( 'Hide Header', 'lifterlms-launchpad' ),
                        'tip' => __( 'Check this box to hide the entire header from view.', 'lifterlms-launchpad' ),
                    ),
                    array(
                        'attribute' => 'launchpad_hide_page_footer_widgets',
                        'type' => 'switch',
                        'label' => __( 'Hide Footer Widgets Area', 'lifterlms-launchpad' ),
                        'tip' => __( 'Check this box to hide the footer widgets area from view.', 'lifterlms-launchpad' ),
                    ),
                ),
                array(
                    array(
                        'attribute' => 'launchpad_default_layout',
                        'type' => 'radio',
                        'label' => __( 'Sidebar Layout', 'lifterlms-launchpad' ),
                        'tip' => __( 'Select the default layout for your theme.', 'lifterlms-launchpad' ),
                        'options'   => LayoutSettings::get_options_src(),
                    ),
                ),
            ),

        );

    }

    public function get_fields()
    {

        $fields = [];

        return [

            [
                'type'      => 'sectionstart',
                'id'        => 'layout_options',
                'class'     =>'top'
            ],

            [
                'title'     => __( 'Layout Settings', 'lifterlms-launchpad' ),
                'type'      => 'title',
                'desc'      => 'Manage Layout Options',
                'id'        => 'layout_options'
            ],

            [
                'title'     => __( 'Alternate Navigation', 'lifterlms-launchpad' ),
                'desc'      => __( 'Hide navigation or display an alternate navigation for this post.', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_page_menu',
                'type'      => 'select',
                'default'   => 'default',
                'desc_tip'  => true,
                'options'   => HeaderLayout::get_menu_options(),
            ],

            [
                'title'     => __( 'Hide Title', 'lifterlms-launchpad' ),
                'desc'      => __( 'Check this box to hide the title from view.', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_hide_page_title',
                'type'      => 'checkbox',
                'default'   => 'no',
            ],

            [
                'title'     => __( 'Hide Header', 'lifterlms-launchpad' ),
                'desc'      => __( 'Check this box to hide the entire header from view.', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_hide_page_header',
                'type'      => 'checkbox',
                'default'   => 'no',
            ],

            [
                'title'     => __( 'Hide Footer Widgets Area', 'lifterlms-launchpad' ),
                'desc'      => __( 'Check this box to hide the footer widgets area from view.', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_hide_page_footer_widgets',
                'type'      => 'checkbox',
                'default'   => 'no',
            ],

            [
                'title'     => __( 'Default Layout', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Select the default layout for your theme.', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_default_layout',
                'type' 		=> 'radio',
                'class'     => 'image-replaced-option',
                'wrapper_class' => 'launchpad-layout-options',
                'default'	=> get_option('launchpad_default_layout') ?: 'sidebar_content',
                'desc_tip'	=> true,
                'options'   => LayoutSettings::get_options()
            ],

            [
                'title'     => __( 'Page Header Content', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Display Content in the Page Header', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_header_content',
                'type' 		=> 'wysiwyg',
                'default'	=> '',
                'desc_tip'	=> true,
                'sanitize_field' => false
            ],

            [
                'type' => 'sectionend',
                'id' => 'layout_options'
            ]
        ];
    }

}
