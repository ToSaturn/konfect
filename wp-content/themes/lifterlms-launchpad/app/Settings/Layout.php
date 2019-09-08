<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;
use LaunchPad\ThemeLayout\LayoutSettings;


class Layout extends Setting
{
    public function __construct() {
        $this->id    = 'layout';
        $this->label = __( 'Layout', 'lifterlms-launchpad' );
        $this->menu_order = 30;

        $this->add_actions_and_filters();
    }

    /**
     * Get settings array
     *
     * @return array
     */
    public function get_settings()
    {
        //$layout = LayoutSettings::get_options();

        return apply_filters( 'launchpad_layout_settings', array(

                array( 'type' => 'sectionstart', 'id' => 'layout_options', 'class' =>'top' ),

                array(	'title' => __( 'Layout Settings', 'lifterlms-launchpad' ), 'type' => 'title','desc' => 'Manage Layout Options', 'id' => 'layout_options' ),

                array(
                    'title'     => __( 'Maximum site width', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'In Pixels, default is 1170', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_width_container',
                    'type' 		=> 'number',
                    'default'	=> '1170',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Content top margin', 'lifterlms-launchpad' ),
                    'desc'      => __( 'In Pixels, default is 40px', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_container_margin_top',
                    'type'      => 'number',
                    'default'   => '40',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Content bottom margin', 'lifterlms-launchpad' ),
                    'desc'      => __( 'In Pixels, default is 105px', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_container_margin_bottom',
                    'type'      => 'number',
                    'default'   => '105',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Sidebar Width', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Determines the width of sidebars', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_sidebar_width',
                    'type'      => 'select',
                    'default'   => 'four',
                    'desc_tip'  => true,
                    'options'   => array(
                        'two' => 'Two Columns (16.66%)',
                        'three' => 'Three Columns (25%)',
                        'four' => 'Four Columns (33.33%)',
                        'five' => 'Five Columns( 41.66% )',
                    )
                ),

                array(
                    'title' => __( 'Default Layout', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Select the default layout for your theme. This will apply to all content on your website except where overriden by settings on the post or by other defaults below.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_default_layout',
                    'type' 		=> 'radio',
                    'class'     => 'image-replaced-option',
                    'wrapper_class' => 'launchpad-layout-options',
                    'default'	=> 'sidebar_content',
                    'desc_tip'	=> true,
                    'options'   => LayoutSettings::get_options()
                ),

                array(
                    'title' => __( 'Default Blog Layout', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Select the default layout for your blog. This layout will be the default for blog posts and blog archives.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_default_blog_layout',
                    'type'      => 'radio',
                    'class'     => 'image-replaced-option',
                    'wrapper_class' => 'launchpad-layout-options',
                    'default'   => 'sidebar_content',
                    'desc_tip'  => true,
                    'options'   => LayoutSettings::get_options()
                ),

                array(
                    'title' => __( 'Default Course Layout', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Select the default layout for your courses. This layout will be the default for courses and course archives.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_default_course_layout',
                    'type'      => 'radio',
                    'class'     => 'image-replaced-option',
                    'wrapper_class' => 'launchpad-layout-options',
                    'default'   => 'content_sidebar',
                    'desc_tip'  => true,
                    'options'   => LayoutSettings::get_options()
                ),

                array(
                    'title' => __( 'Default Membership Layout', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Select the default layout for your memberships. This layout will be the default for memberships and membership archives.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_default_membership_layout',
                    'type'      => 'radio',
                    'class'     => 'image-replaced-option',
                    'wrapper_class' => 'launchpad-layout-options',
                    'default'   => 'content',
                    'desc_tip'  => true,
                    'options'   => LayoutSettings::get_options()
                ),

                array( 'type' => 'sectionend', 'id' => 'layout_options')
            )
        );
    }

}
