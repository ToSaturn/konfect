<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;

class PricingTables extends Setting
{
    public function __construct()
    {
        if (is_lifterlms_enabled())
        {
            $this->id    = 'lifterlms_pricing_tables';
            $this->label = __( 'LifterLMS Pricing Tables', 'lifterlms-launchpad' );
            $this->menu_order = 53;

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
        return apply_filters( 'launchpad_lifterlms_pricing_table_settings', array(

                array( 'type'   => 'sectionstart',
                    'id'        => 'lifterlms_product_checkout_options',
                    'class'     =>'top'
                ),
                array(
                    'title'     => __( 'LifterLMS Pricing Table Settings', 'lifterlms-launchpad' ),
                    'type'      => 'title',
                    'desc'      => __( 'Customize the style of LifterLMS access plan pricing tables.', 'lifterlms-launchpad' ),
                    'id'        => 'lifterlms_product_checkout_options'
                ),


                /*
                     /$$                           /$$
                    | $$                          |__/
                    | $$$$$$$   /$$$$$$   /$$$$$$$ /$$  /$$$$$$$
                    | $$__  $$ |____  $$ /$$_____/| $$ /$$_____/
                    | $$  \ $$  /$$$$$$$|  $$$$$$ | $$| $$
                    | $$  | $$ /$$__  $$ \____  $$| $$| $$
                    | $$$$$$$/|  $$$$$$$ /$$$$$$$/| $$|  $$$$$$$
                    |_______/  \_______/|_______/ |__/ \_______/
                */
                array(
                    'title'     => __( 'Access Plan Styles', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Customize the basic styles of access plans', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'id'        => 'access_plan_basic',
                    'class'     => 'collapsable',
                ),

                array(
                    'title'     => __( 'Access Plan Background Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_bg_color',
                    'type'      => 'color',
                    'default'   => '#f1f1f1',
                ),

                array(
                    'title'     => __( 'Access Plan Text Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_text_color',
                    'type'      => 'color',
                    'default'   => '#222222',
                ),

                /*
                      /$$$$$$                      /$$                                         /$$
                     /$$__  $$                    | $$                                        | $$
                    | $$  \__//$$$$$$   /$$$$$$  /$$$$$$   /$$   /$$  /$$$$$$   /$$$$$$   /$$$$$$$
                    | $$$$   /$$__  $$ |____  $$|_  $$_/  | $$  | $$ /$$__  $$ /$$__  $$ /$$__  $$
                    | $$_/  | $$$$$$$$  /$$$$$$$  | $$    | $$  | $$| $$  \__/| $$$$$$$$| $$  | $$
                    | $$    | $$_____/ /$$__  $$  | $$ /$$| $$  | $$| $$      | $$_____/| $$  | $$
                    | $$    |  $$$$$$$|  $$$$$$$  |  $$$$/|  $$$$$$/| $$      |  $$$$$$$|  $$$$$$$
                    |__/     \_______/ \_______/   \___/   \______/ |__/       \_______/ \_______/
                */
                array(
                    'title'     => __( 'Featured Access Plan Styles', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => __( 'Customize the styles of featured access plans', 'lifterlms-launchpad' ),
                    'id'        => 'access_plan_featured',
                    'class'     => 'collapsable',
                ),
                array(
                    'title'     => __( 'Featured Plan Text', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Customize the default displayed above the featured plan', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_featured_text',
                    'type'      => 'text',
                    'default'   => __( 'FEATURED', 'lifterlms-launchpad' ),
                ),
                array(
                    'title'     => __( 'Featured Text Background Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_featured_bg_color',
                    'type'      => 'color',
                    'default'   => '#4ba9ff',
                ),
                array(
                    'title'     => __( 'Featured Text Font Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_featured_text_color',
                    'type'      => 'color',
                    'default'   => '#fff',
                ),
                array(
                    'title'     => __( 'Border Size', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_featured_border_size',
                    'type'      => 'number',
                    'default'   => '3',
                ),
                array(
                    'title'     => __( 'Border Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_featured_border_color',
                    'type'      => 'color',
                    'default'   => '#2295ff',
                ),

                /*
                       /$$     /$$   /$$     /$$
                      | $$    |__/  | $$    | $$
                     /$$$$$$   /$$ /$$$$$$  | $$  /$$$$$$   /$$$$$$$
                    |_  $$_/  | $$|_  $$_/  | $$ /$$__  $$ /$$_____/
                      | $$    | $$  | $$    | $$| $$$$$$$$|  $$$$$$
                      | $$ /$$| $$  | $$ /$$| $$| $$_____/ \____  $$
                      |  $$$$/| $$  |  $$$$/| $$|  $$$$$$$ /$$$$$$$/
                       \___/  |__/   \___/  |__/ \_______/|_______/
                */
                array(
                    'desc'      => __( 'Customize the styles of access plan titles', 'lifterlms-launchpad' ),
                    'title'     => __( 'Access Plan Titles', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'id'        => 'access_plan_titles',
                    'class'     => 'collapsable',
                ),
                array(
                    'title'     => __( 'Title Background Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_title_bg_color',
                    'type'      => 'color',
                    'default'   => '#2295ff',
                ),
                array(
                    'title'     => __( 'Title Font Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_title_text_color',
                    'type'      => 'color',
                    'default'   => '#fff',
                ),
                array(
                    'title'     => __( 'Title Font Size', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_title_text_size',
                    'type'      => 'number',
                    'default'   => '18',
                ),

                /*
                                         /$$
                                        |__/
                      /$$$$$$   /$$$$$$  /$$  /$$$$$$$  /$$$$$$
                     /$$__  $$ /$$__  $$| $$ /$$_____/ /$$__  $$
                    | $$  \ $$| $$  \__/| $$| $$      | $$$$$$$$
                    | $$  | $$| $$      | $$| $$      | $$_____/
                    | $$$$$$$/| $$      | $$|  $$$$$$$|  $$$$$$$
                    | $$____/ |__/      |__/ \_______/ \_______/
                    | $$
                    | $$
                    |__/
                */
                array(
                    'desc'      => __( 'Customize the styles of access plan prices', 'lifterlms-launchpad' ),
                    'title'     => __( 'Access Plan Prices', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'id'        => 'access_plan_titles',
                    'class'     => 'collapsable',
                ),
                array(
                    'title'     => __( 'Price Font Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_price_text_color',
                    'type'      => 'color',
                    'default'   => '#222222',
                ),
                array(
                    'title'     => __( 'Price Font Size', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_price_text_size',
                    'type'      => 'number',
                    'default'   => '18',
                ),

                /*
                                 /$$
                                | $$
                      /$$$$$$$ /$$$$$$    /$$$$$$  /$$$$$$/$$$$   /$$$$$$   /$$$$$$$
                     /$$_____/|_  $$_/   |____  $$| $$_  $$_  $$ /$$__  $$ /$$_____/
                    |  $$$$$$   | $$      /$$$$$$$| $$ \ $$ \ $$| $$  \ $$|  $$$$$$
                     \____  $$  | $$ /$$ /$$__  $$| $$ | $$ | $$| $$  | $$ \____  $$
                     /$$$$$$$/  |  $$$$/|  $$$$$$$| $$ | $$ | $$| $$$$$$$/ /$$$$$$$/
                    |_______/    \___/   \_______/|__/ |__/ |__/| $$____/ |_______/
                                                                | $$
                                                                | $$
                                                                |__/
                */
                array(
                    'desc'      => __( 'Customize the styles of access plan stamps. These are the small highlights like "MEMBER PRICING" and "TRIAL"', 'lifterlms-launchpad' ),
                    'title'     => __( 'Access Plan Stamps', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'id'        => 'access_plan_stamps',
                    'class'     => 'collapsable',
                ),
                array(
                    'title'     => __( 'Stamp Background Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_stamp_bg_color',
                    'type'      => 'color',
                    'default'   => '#2295ff',
                ),
                array(
                    'title'     => __( 'Stamp Font Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_stamp_text_color',
                    'type'      => 'color',
                    'default'   => '#fff',
                ),

               /*
                     /$$                   /$$     /$$
                    | $$                  | $$    | $$
                    | $$$$$$$  /$$   /$$ /$$$$$$ /$$$$$$    /$$$$$$  /$$$$$$$   /$$$$$$$
                    | $$__  $$| $$  | $$|_  $$_/|_  $$_/   /$$__  $$| $$__  $$ /$$_____/
                    | $$  \ $$| $$  | $$  | $$    | $$    | $$  \ $$| $$  \ $$|  $$$$$$
                    | $$  | $$| $$  | $$  | $$ /$$| $$ /$$| $$  | $$| $$  | $$ \____  $$
                    | $$$$$$$/|  $$$$$$/  |  $$$$/|  $$$$/|  $$$$$$/| $$  | $$ /$$$$$$$/
                    |_______/  \______/    \___/   \___/   \______/ |__/  |__/|_______/
                */
                array(
                    'desc'      => __( 'Customize the styles of access plan "Enroll" buttons', 'lifterlms-launchpad' ),
                    'title'     => __( 'Access Plan Buttons', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'id'        => 'access_plan_buttons',
                    'class'     => 'collapsable',
                ),

                array(
                    'title'     => __( 'Button Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_button_bg_color',
                    'type'      => 'color',
                    'default'   => '#f8954f',
                ),

                array(
                    'title'     => __( 'Button Font Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_button_font_color',
                    'type'      => 'color',
                    'default'   => '#ffffff',
                ),

                array(
                    'title'     => __( 'Button Border Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_button_border_color',
                    'type'      => 'color',
                    'default'   => '#f8954f',
                ),

                array(
                    'title'     => __( 'Button Hover Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_button_hover_bg_color',
                    'type'      => 'color',
                    'default'   => '#f67d28',
                ),

                array(
                    'title'     => __( 'Button Font Hover Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_button_hover_font_color',
                    'type'      => 'color',
                    'default'   => '#ffffff',
                ),

                array(
                    'title'     => __( 'Button Border Hover Color', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_access_plan_button_hover_border_color',
                    'type'      => 'color',
                    'default'   => '#f67d28',
                ),

                array( 'type' => 'sectionend', 'id' => 'lifterlms_product_checkout_options'),
            )
        );
    }
}