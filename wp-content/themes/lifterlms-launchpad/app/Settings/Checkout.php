<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;

class Checkout extends Setting
{
    public function __construct()
    {
        if (is_lifterlms_enabled())
        {
            $this->id    = 'lifterlms_checkout';
            $this->label = __( 'LifterLMS Checkout', 'lifterlms-launchpad' );
            $this->menu_order = 60;

            $this->add_actions_and_filters();
        }

    }

    /**
     * Get settings array
     *
     * @return array
     */
    public function get_settings()
    {
        return apply_filters( 'launchpad_lifterlms_product_checkout_settings', array(

                array( 'type'   => 'sectionstart',
                    'id'        => 'lifterlms_product_checkout_options',
                    'class'     =>'top'
                ),
                array(
                    'title'     => __( 'LifterLMS Product Checkout Settings', 'lifterlms-launchpad' ),
                    'type'      => 'title',
                    'desc'      => 'Manage the look and feel of the LifterLMS checkout page.',
                    'id'        => 'lifterlms_product_checkout_options'
                ),

                array(
                    'title'     => __( 'Checkout form border color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of the border on the checkout tile', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_color_checkout_form',
                    'type' 		=> 'color',
                    'default'	=> '#2295ff',
                ),

                array(
                    'title'     => __( 'Checkout form border width', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the width of border on the checkout tile', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_width_checkout_form',
                    'type' 		=> 'number',
                    'default'	=> '3',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Checkout form top left border radius', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the radius of the top left border of the checkout tile in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_radius_top_left_checkout_form',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Checkout form top right border radius', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the radius of the top right border of the checkout tile in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_radius_top_right_checkout_form',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Checkout form bottom left border radius', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the radius of the bottom right border of the checkout tile in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_radius_bottom_left_checkout_form',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Checkout form bottom right border radius', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the radius of the bottom right border of the checkout tile in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_radius_bottom_right_checkout_form',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Checkout form title font color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of the title on the checkout form', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_color_checkout_form_title',
                    'type' 		=> 'color',
                    'default'	=> '#ffffff',
                ),

                array(
                    'title'     => __( 'Checkout form title background color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the background color of the checkout form title', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_background_color_checkout_form_title',
                    'type' 		=> 'color',
                    'default'	=> '#2295ff',
                ),

                array(
                    'title'     => __( 'Checkout title font size', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the font size of the checkout form tile', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_size_checkout_title',
                    'type' 		=> 'number',
                    'default'	=> '16',
                    'desc_tip'	=> true,
                ),

                array( 'type' => 'sectionend', 'id' => 'lifterlms_product_checkout_options'),
            )
        );
    }
}