<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;
use LaunchPad\ThemeLayout\LayoutSettings;


class Footer extends Setting
{
    public function __construct() {
        $this->id    = 'footer';
        $this->label = __( 'Footer', 'lifterlms-launchpad' );
        $this->menu_order = 20;

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

        return apply_filters( 'launchpad_footer_settings', array(

                array( 'type' => 'sectionstart', 'id' => 'footer_options', 'class' =>'top' ),

                array(	'title' => __( 'Footer Settings', 'lifterlms-launchpad' ), 'type' => 'title','desc' => 'Manage Footer Layout Options', 'id' => 'layout_options' ),

                /*
                      /$$$$$$                      /$$
                     /$$__  $$                    | $$
                    | $$  \__//$$$$$$   /$$$$$$  /$$$$$$    /$$$$$$   /$$$$$$
                    | $$$$   /$$__  $$ /$$__  $$|_  $$_/   /$$__  $$ /$$__  $$
                    | $$_/  | $$  \ $$| $$  \ $$  | $$    | $$$$$$$$| $$  \__/
                    | $$    | $$  | $$| $$  | $$  | $$ /$$| $$_____/| $$
                    | $$    |  $$$$$$/|  $$$$$$/  |  $$$$/|  $$$$$$$| $$
                    |__/     \______/  \______/    \___/   \_______/|__/
                */
                array(
                    'title'     => __( 'Footer Styling', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control the color and layout of the footer section.',
                    'id'        => 'footer_layout_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Background Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the background color of the footer.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_footer_background_color',
                    'type' 		=> 'color',
                    'default'	=> '#333333',
                ),

                array(
                    'title'     => __( 'Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color in the site footer', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_footer_font_color',
                    'type'      => 'color',
                    'default'   => '#fefefe',
                ),

                array(
                    'title'     => __( 'Widget Title Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of footer widget titles', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_footer_widget_title_font_color',
                    'type'      => 'color',
                    'default'   => '#fefefe',
                ),

                array(
                    'title'     => __( 'Link Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of links in the site footer', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_footer_link_color',
                    'type'      => 'color',
                    'default'   => '#2295ff',
                ),

                array(
                    'title'     => __( 'Link Hover Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of hovered links in the site footer', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_footer_link_hover_color',
                    'type'      => 'color',
                    'default'   => '#0077e4',
                ),

                array(
                    'title'     => __( 'Padding Top', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the top padding of the footer in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_top_footer',
                    'type' 		=> 'number',
                    'default'	=> '20',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Padding Bottom', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the bottom padding of the footer in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_bottom_footer',
                    'type' 		=> 'number',
                    'default'	=> '20',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Padding Right', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the right padding of the footer in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_right_footer',
                    'type' 		=> 'number',
                    'default'	=> '20',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Padding Left', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the left padding of the footer in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_left_footer',
                    'type' 		=> 'number',
                    'default'	=> '20',
                    'desc_tip'	=> true,
                ),


                /*
                               /$$   /$$                     /$$            /$$$$$$
                              |__/  | $$                    |__/           /$$__  $$
                      /$$$$$$$ /$$ /$$$$$$    /$$$$$$        /$$ /$$$$$$$ | $$  \__//$$$$$$
                     /$$_____/| $$|_  $$_/   /$$__  $$      | $$| $$__  $$| $$$$   /$$__  $$
                    |  $$$$$$ | $$  | $$    | $$$$$$$$      | $$| $$  \ $$| $$_/  | $$  \ $$
                     \____  $$| $$  | $$ /$$| $$_____/      | $$| $$  | $$| $$    | $$  | $$
                     /$$$$$$$/| $$  |  $$$$/|  $$$$$$$      | $$| $$  | $$| $$    |  $$$$$$/
                    |_______/ |__/   \___/   \_______/      |__/|__/  |__/|__/     \______/
                */
                array(
                    'title'     => __( 'Site Info Styling', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control the layout and content of the site info section typically found at the very bottom of the site.',
                    'id'        => 'site_info_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Background Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the background color of the site info bar.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_site_info',
                    'type'      => 'color',
                    'default'   => '#222222',
                ),

                array(
                    'title'     => __( 'Font Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the text color in the site info area', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_color_site_info',
                    'type' 		=> 'color',
                    'default'	=> '#fefefe',
                ),

                array(
                    'title'     => __( 'Link Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of links in the site footer', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_link_color_site_info',
                    'type'      => 'color',
                    'default'   => '#2295ff',
                ),

                array(
                    'title'     => __( 'Link Hover Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of hovered links in the site footer', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_link_hover_color_site_info',
                    'type'      => 'color',
                    'default'   => '#0077e4',
                ),

                array(
                    'title'     => __( 'Padding Top', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the top padding of the site info bar in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_top_site_info',
                    'type' 		=> 'number',
                    'default'	=> '20',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Padding Bottom', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the bottom padding of the site info bar in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_bottom_site_info',
                    'type' 		=> 'number',
                    'default'	=> '20',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Padding Right', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the right padding of the site info bar in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_right_site_info',
                    'type' 		=> 'number',
                    'default'	=> '20',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Padding Left', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the left padding of the site info bar in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_left_site_info',
                    'type' 		=> 'number',
                    'default'	=> '20',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Left Side Text', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Enter text to display on the left side of the site info bar', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_text_site_info_left',
                    'type' 		=> 'wysiwyg',
                    'default'	=> '<h4>Powered by <a href="https://wordpress.org/">WordPress</a> and <a href="https://lifterlms.com/product/launchpad">LifterLMS</a></h4>',
                    'desc_tip'	=> true,
                    'sanitize_field' => false
                ),

                array(
                    'title'     => __( 'Right Side Text', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Enter text to display on the right side of the site info bar', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_text_site_info_right',
                    'type' 		=> 'wysiwyg',
                    'default'	=> '<h4 style="text-align: right;">Theme <a href="https://lifterlms.com/product/launchpad">LaunchPad</a> by <a href="https://lifterlms.com">LifterLMS</a></h4>',
                    'desc_tip'	=> true,
                    'sanitize_field' => false
                ),

                array( 'type' => 'sectionend', 'id' => 'footer_options')
            )
        );
    }

}
