<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;


class BreadCrumbs extends Setting
{
    public function __construct() {
        $this->id    = 'breadcrumbs';
        $this->label = __( 'Breadcrumbs', 'lifterlms-launchpad' );
        $this->menu_order = 40;

        $this->add_actions_and_filters();
    }

    /**
     * Get settings array
     *
     * @return array
     */
    public function get_settings()
    {
        return apply_filters( 'launchpad_breadcrumbs_settings', array(

                array( 'type' => 'sectionstart',
                    'id' => 'breadcrumbs_options',
                    'class' =>'top'
                ),
                array(	'title' => __( 'Breadcrumbs Settings', 'lifterlms-launchpad' ),
                    'type' => 'title',
                    'desc' => 'Enable and customize sitewide breadcrumbs.',
                    'id' => 'breadcrumbs_options'
                ),

                array(
                    'title'     => __( 'Enable site-wide breadcrumbs', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Enable breadcrumbs across the entire site.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_breadcrumbs_enable',
                    'type' 		=> 'checkbox',
                    'default'	=> 'no',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Breadcrumb Background Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Set the background color of the breadcrumb bar.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_breadcrumbs_background_color',
                    'type' 		=> 'color',
                    'default'	=> '#555555',
                ),

                array(
                    'title'     => __( 'Breadcrumb Font Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the text color of the breadcrumb items.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_breadcrumbs_font_color',
                    'type' 		=> 'color',
                    'default'	=> '#fefefe',
                ),

                array(
                    'title'     => __( 'Current Page Font Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the current page text color inside the breadcrumb.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_breadcrumbs_current_item_font_color',
                    'type' 		=> 'color',
                    'default'	=> '#fefefe',
                ),

                array(
                    'title'     => __( 'Separator Icon Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of the separator icon.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_breadcrumbs_separator_icon_font_color',
                    'type' 		=> 'color',
                    'default'	=> '#fefefe',
                ),

                array(
                    'title'     => __( 'Separator Icon', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Icon used to seperate page titles', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_breadcrumbs_separator_icon',
                    'type' 		=> 'text',
                    'default'	=> '>',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Home Title', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Title used for home page', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_breadcrumbs_home_title',
                    'type' 		=> 'text',
                    'default'	=> 'Home',
                    'desc_tip'	=> true,
                ),

                array( 'type' => 'sectionend', 'id' => 'breadcrumbs_options'),
            )
        );
    }

}
