<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;

class Account extends Setting
{
    public function __construct()
    {
        if (is_lifterlms_enabled())
        {
            $this->id    = 'lifterlms_account';
            $this->label = __( 'LifterLMS Account', 'lifterlms-launchpad' );
            $this->menu_order = 50;

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
       $settings = array(

            array( 'type'   => 'sectionstart',
                'id'        => 'lifterlms_account_options',
                'class'     =>'top'
            ),

            array(
                'title'     => __( 'LifterLMS Account Settings', 'lifterlms-launchpad' ),
                'type'      => 'title',
                'desc'      => 'Manage the look and feel of the user account.',
                'id'        => 'lifterlms_account_options'
            ),


            /*
                 /$$                     /$$                       /$$                                     /$$             /$$                          /$$     /$$
                | $$                    |__/                      /$$/                                    |__/            | $$                         | $$    |__/
                | $$  /$$$$$$   /$$$$$$  /$$ /$$$$$$$            /$$/         /$$$$$$   /$$$$$$   /$$$$$$  /$$  /$$$$$$$ /$$$$$$    /$$$$$$  /$$$$$$  /$$$$$$   /$$  /$$$$$$  /$$$$$$$
                | $$ /$$__  $$ /$$__  $$| $$| $$__  $$          /$$/         /$$__  $$ /$$__  $$ /$$__  $$| $$ /$$_____/|_  $$_/   /$$__  $$|____  $$|_  $$_/  | $$ /$$__  $$| $$__  $$
                | $$| $$  \ $$| $$  \ $$| $$| $$  \ $$         /$$/         | $$  \__/| $$$$$$$$| $$  \ $$| $$|  $$$$$$   | $$    | $$  \__/ /$$$$$$$  | $$    | $$| $$  \ $$| $$  \ $$
                | $$| $$  | $$| $$  | $$| $$| $$  | $$        /$$/          | $$      | $$_____/| $$  | $$| $$ \____  $$  | $$ /$$| $$      /$$__  $$  | $$ /$$| $$| $$  | $$| $$  | $$
                | $$|  $$$$$$/|  $$$$$$$| $$| $$  | $$       /$$/           | $$      |  $$$$$$$|  $$$$$$$| $$ /$$$$$$$/  |  $$$$/| $$     |  $$$$$$$  |  $$$$/| $$|  $$$$$$/| $$  | $$
                |__/ \______/  \____  $$|__/|__/  |__/      |__/            |__/       \_______/ \____  $$|__/|_______/    \___/  |__/      \_______/   \___/  |__/ \______/ |__/  |__/
                               /$$  \ $$                                                         /$$  \ $$
                              |  $$$$$$/                                                        |  $$$$$$/
                               \______/                                                          \______/
            */

            array(
                'title'     => __( 'Login & Registration', 'lifterlms-launchpad' ),
                'type'      => 'subtitle',
                'desc'      => 'Customize the login & registration screen for logged out users',
                'id'        => 'login_registration_options',
                'class'     => 'collapsable',
            ),

            array(
                'title'     => __( 'Side by Side Layout ', 'lifterlms-launchpad' ),
                'desc'      => __( 'Display alternate side by side layout for the login & registration forms', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_side_by_side_login_registration',
                'type'      => 'checkbox',
                'default'   => 'no',
                'desc_tip'  => true,
            ),
            /*
                                                           /$$     /$$
                                                          | $$    |__/
                  /$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$  /$$$$$$   /$$ /$$$$$$$   /$$$$$$
                 /$$__  $$ /$$__  $$ /$$__  $$ /$$__  $$|_  $$_/  | $$| $$__  $$ /$$__  $$
                | $$  \ $$| $$  \__/| $$$$$$$$| $$$$$$$$  | $$    | $$| $$  \ $$| $$  \ $$
                | $$  | $$| $$      | $$_____/| $$_____/  | $$ /$$| $$| $$  | $$| $$  | $$
                |  $$$$$$$| $$      |  $$$$$$$|  $$$$$$$  |  $$$$/| $$| $$  | $$|  $$$$$$$
                 \____  $$|__/       \_______/ \_______/   \___/  |__/|__/  |__/ \____  $$
                 /$$  \ $$                                                       /$$  \ $$
                |  $$$$$$/                                                      |  $$$$$$/
                 \______/                                                        \______/
            */
            array(
                'title'     => __( 'Greeting', 'lifterlms-launchpad' ),
                'type'      => 'subtitle',
                'desc'      => 'Customize the content on the top of the Account page',
                'id'        => 'greeting_styling_options',
                'class'     => 'collapsable',
            ),

            array(
                'title'     => __( 'Dashboard Greeting', 'lifterlms-launchpad' ),
                'desc'      => __( 'Custom greeting that displays on all users dashboard.', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_account_greeting',
                'type'      => 'wysiwyg',
                'default'   => __( 'What would you like to learn today?', 'lifterlms-launchpad' ),
                'desc_tip'  => true,
                'sanitize_field' => false
            ),


            /*
                                                /$$                       /$$     /$$
                                               |__/                      | $$    |__/
                 /$$$$$$$   /$$$$$$  /$$    /$$ /$$  /$$$$$$   /$$$$$$  /$$$$$$   /$$  /$$$$$$  /$$$$$$$
                | $$__  $$ |____  $$|  $$  /$$/| $$ /$$__  $$ |____  $$|_  $$_/  | $$ /$$__  $$| $$__  $$
                | $$  \ $$  /$$$$$$$ \  $$/$$/ | $$| $$  \ $$  /$$$$$$$  | $$    | $$| $$  \ $$| $$  \ $$
                | $$  | $$ /$$__  $$  \  $$$/  | $$| $$  | $$ /$$__  $$  | $$ /$$| $$| $$  | $$| $$  | $$
                | $$  | $$|  $$$$$$$   \  $/   | $$|  $$$$$$$|  $$$$$$$  |  $$$$/| $$|  $$$$$$/| $$  | $$
                |__/  |__/ \_______/    \_/    |__/ \____  $$ \_______/   \___/  |__/ \______/ |__/  |__/
                                                    /$$  \ $$
                                                   |  $$$$$$/
                                                    \______/
            */
            array(
                'title'     => __( 'Account Navigation Settings', 'lifterlms-launchpad' ),
                'type'      => 'subtitle',
                'desc'      => 'Control styling and layout of the account page navigation',
                'id'        => 'nav_styling_options',
                'class'     => 'collapsable',
            ),

            array(
                'title'     => __( 'Navigation Alignment', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the alignment of navigation', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_text_alignment_account_sub_nav',
                'type' 		=> 'radio',
                'default'	=> 'left',
                'desc_tip'	=> true,
                'options'   => ['left' => 'Left', 'right' => 'Right', 'center' => 'Center']
            ),

            array(
                'title'     => __( 'Navigation Margin Top', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the top margin of the navigation in pixels', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_margin_top_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '0',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation Margin Bottom', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the bottom margin of the navigation in pixels', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_margin_bottom_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '40',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation Margin Right ', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the right margin of the navigation in pixels', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_margin_right_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '0',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation Margin Left', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the left margin of the navigation in pixels', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_margin_left_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '0',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation Padding Top', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the top padding of the navigation in pixels', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_padding_top_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '0',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation Padding Bottom', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the bottom padding of the navigation in pixels', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_padding_bottom_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '0',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation Padding Right', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the right padding of the navigation in pixels', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_padding_right_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '0',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation Padding Left', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the left padding of the navigation in pixels', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_padding_left_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '0',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation Font Size', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the font size of the navigation links', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_font_size_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '15',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation Font Color', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the font color of the navigation links', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_font_color_sub_nav',
                'type' 		=> 'color',
                'default'	=> '#2295ff',
            ),

            array(
                'title'     => __( 'Navigation Border Width', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the width of the border around the navigation links in pixels', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_border_width_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '0',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation Border Color', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the border color color around the navigation links', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_border_color_sub_nav',
                'type' 		=> 'color',
                'default'	=> '#ffffff',
            ),

            array(
                'title'     => __( 'Navigation border radius', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the radius of the border around the navigation links', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_border_radius_account_sub_nav',
                'type' 		=> 'number',
                'default'	=> '0',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Navigation link seperator', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the icon used to seperate links. Leave empty if none', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_account_sub_nav_link_seperator',
                'type' 		=> 'text',
                'default'	=> '·',
                'desc_tip'	=> true,
            ),




            /*
                                                 /$$     /$$                                 /$$            /$$$$$$                    /$$   /$$
                                                | $$    |__/                                | $$           /$$__  $$                  | $$  | $$
                  /$$$$$$$  /$$$$$$   /$$$$$$$ /$$$$$$   /$$  /$$$$$$  /$$$$$$$         /$$$$$$$  /$$$$$$ | $$  \__//$$$$$$  /$$   /$$| $$ /$$$$$$   /$$$$$$$
                 /$$_____/ /$$__  $$ /$$_____/|_  $$_/  | $$ /$$__  $$| $$__  $$       /$$__  $$ /$$__  $$| $$$$   |____  $$| $$  | $$| $$|_  $$_/  /$$_____/
                |  $$$$$$ | $$$$$$$$| $$        | $$    | $$| $$  \ $$| $$  \ $$      | $$  | $$| $$$$$$$$| $$_/    /$$$$$$$| $$  | $$| $$  | $$   |  $$$$$$
                 \____  $$| $$_____/| $$        | $$ /$$| $$| $$  | $$| $$  | $$      | $$  | $$| $$_____/| $$     /$$__  $$| $$  | $$| $$  | $$ /$$\____  $$
                 /$$$$$$$/|  $$$$$$$|  $$$$$$$  |  $$$$/| $$|  $$$$$$/| $$  | $$      |  $$$$$$$|  $$$$$$$| $$    |  $$$$$$$|  $$$$$$/| $$  |  $$$$//$$$$$$$/
                |_______/  \_______/ \_______/   \___/  |__/ \______/ |__/  |__/       \_______/ \_______/|__/     \_______/ \______/ |__/   \___/ |_______/
            */
            array(
                'title'     => __( 'Account Section Defaults', 'lifterlms-launchpad' ),
                'type'      => 'subtitle',
                'desc'      => 'Control the default settings for all sections on the account page.',
                'id'        => 'nav_styling_options',
                'class'     => 'collapsable',
            ),
            array(
                'title'     => __( 'Section Title Font Size', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the font size of the section titles', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_font_size_account_tile_title',
                'type'      => 'number',
                'default'   => '20',
                'desc_tip'  => true,
            ),
            array(
                'title'     => __( 'Section Title Font Color', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the font color of the section titles', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_font_color_account_tile_title',
                'type'      => 'color',
                'default'   => '#333333',
            ),

            array(
                'title'     => __( 'Section Title Alignment', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the alignment of the account section titles', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_text_alignment_account_tile_title',
                'type'      => 'radio',
                'default'   => 'left',
                'desc_tip'  => true,
                'options'   => ['left' => 'Left', 'right' => 'Right', 'center' => 'Center']
            ),

            array(
                'title'     => __( 'Section Title Margin Top', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top margin of the account section titles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_top_account_tile_title',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Title Margin Bottom', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom margin of the account section titles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_bottom_account_tile_title',
                'type'      => 'number',
                'default'   => '20',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Title Margin Right ', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the right margin of the account section titles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_right_account_tile_title',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Title Margin Left', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the left margin of the account section titles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_left_account_tile_title',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Title Padding Top', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top padding of the account section titles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_top_account_tile_title',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Title Padding Bottom', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom padding of the account section titles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_bottom_account_tile_title',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Title Padding Right', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the right padding of the account section titles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_right_account_tile_title',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Title Padding Left', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the left padding of the account section titles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_left_account_tile_title',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Margin Top', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top margin of the account section tiles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_top_account_tile',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Margin Bottom', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom margin of the account section tiles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_bottom_account_tile',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Margin Right ', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the right margin of the account section tiles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_right_account_tile',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Margin Left', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the left margin of the account section tiles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_left_account_tile',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Padding Top', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top padding of the account section in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_top_account_tile',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Padding Bottom', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom padding of the account section tiles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_bottom_account_tile',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Padding Right', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the right padding of the account section tiles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_right_account_tile',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Padding Left', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the left padding of the account section tiles in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_left_account_tile',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Section Border Width', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the width of the border around each section tile', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_width_account_tile',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

                array(
                    'title'     => __( 'Section Background Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the background color around each section tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_account_tile',
                    'type'      => 'color',
                    'default'   => '#ffffff',
                ),

            array(
                'title'     => __( 'Section Border Color', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the border color color around each section tile', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_color_tile',
                'type'      => 'color',
                'default'   => '#ffffff',
            ),

            array(
                'title'     => __( 'Section border radius', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the radius of the border around each section tile', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_radius_account_tile',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),


            /*


                  /$$$$$$$  /$$$$$$  /$$   /$$  /$$$$$$   /$$$$$$$  /$$$$$$   /$$$$$$$
                 /$$_____/ /$$__  $$| $$  | $$ /$$__  $$ /$$_____/ /$$__  $$ /$$_____/
                | $$      | $$  \ $$| $$  | $$| $$  \__/|  $$$$$$ | $$$$$$$$|  $$$$$$
                | $$      | $$  | $$| $$  | $$| $$       \____  $$| $$_____/ \____  $$
                |  $$$$$$$|  $$$$$$/|  $$$$$$/| $$       /$$$$$$$/|  $$$$$$$ /$$$$$$$/
                 \_______/ \______/  \______/ |__/      |_______/  \_______/|_______/
            */
            array(
                'title'     => __( 'My Courses Section', 'lifterlms-launchpad' ),
                'type'      => 'subtitle',
                'desc'      => 'Control styling and layout of the "Courses In-Progress" area.',
                'id'        => 'my_courses_styling_options',
                'class'     => 'collapsable',
            ),

            array(
                'title'     => __( 'Courses Tile: Section title', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the section title of the account courses tile', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_account_courses_tile_title',
                'type' 		=> 'text',
                'default'	=> 'Courses In-Progress',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Course section title Background Color', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the background color of the course section title', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_background_color_account_course_tile_title',
                'type'      => 'color',
                'default'   => '#ffffff',
            ),

        );

        if ( function_exists( 'LLMS' ) && version_compare( '3.14.0', LLMS()->version, '>=' ) ) {

            $settings = array_merge( $settings, array(
            /*
                                                                                   /$$   /$$
                                                                                  |__/  | $$
                  /$$$$$$$  /$$$$$$  /$$   /$$  /$$$$$$   /$$$$$$$  /$$$$$$        /$$ /$$$$$$    /$$$$$$  /$$$$$$/$$$$   /$$$$$$$
                 /$$_____/ /$$__  $$| $$  | $$ /$$__  $$ /$$_____/ /$$__  $$      | $$|_  $$_/   /$$__  $$| $$_  $$_  $$ /$$_____/
                | $$      | $$  \ $$| $$  | $$| $$  \__/|  $$$$$$ | $$$$$$$$      | $$  | $$    | $$$$$$$$| $$ \ $$ \ $$|  $$$$$$
                | $$      | $$  | $$| $$  | $$| $$       \____  $$| $$_____/      | $$  | $$ /$$| $$_____/| $$ | $$ | $$ \____  $$
                |  $$$$$$$|  $$$$$$/|  $$$$$$/| $$       /$$$$$$$/|  $$$$$$$      | $$  |  $$$$/|  $$$$$$$| $$ | $$ | $$ /$$$$$$$/
                 \_______/ \______/  \______/ |__/      |_______/  \_______/      |__/   \___/   \_______/|__/ |__/ |__/|_______/
            */
            array(
                'title'     => __( 'Course Items', 'lifterlms-launchpad' ),
                'type'      => 'subtitle',
                'desc'      => 'Control styling for each course tile in the My Courses section',
                'id'        => 'course_items_styling_options',
                'class'     => 'collapsable',
            ),

            array(
                'title'     => __( 'Course item Margin Top', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top margin of the course items in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_top_account_course_item',
                'type'      => 'number',
                'default'   => '10',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item Margin Bottom', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom margin of the course items in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_bottom_account_course_item',
                'type'      => 'number',
                'default'   => '10',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item Margin Right ', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the right margin of the course items in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_right_account_course_item',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item Margin Left', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the left margin of the course items in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_left_account_course_item',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item Padding Top', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top padding of the course items in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_top_account_course_item',
                'type'      => 'number',
                'default'   => '10',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item Padding Bottom', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom padding of the course items in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_bottom_account_course_item',
                'type'      => 'number',
                'default'   => '10',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item Padding Right', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the right padding of the course items in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_right_account_course_item',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item Padding Left', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the left padding of the course items in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_left_account_course_item',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item Border Width', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the width of the border around each course item', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_width_account_course_item',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item Border Color', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the border color color around each course item', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_color_account_course_item',
                'type'      => 'color',
                'default'   => '#ffffff',
            ),

            array(
                'title'     => __( 'Course item border radius', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the radius of the border around each course item', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_radius_account_course_item',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image Margin Top', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top margin of the course image in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_top_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image Margin Bottom', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom margin of the course image in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_bottom_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image Margin Right ', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the right margin of the course image in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_right_account_course_image',
                'type'      => 'number',
                'default'   => '20',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image Margin Left', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the left margin of the course image in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_margin_left_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image Padding Top', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top padding of the course items in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_top_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image Padding Bottom', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom padding of the course image in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_bottom_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image Padding Right', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the right padding of the course image in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_right_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image Padding Left', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the left padding of the course image in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_padding_left_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image Border Width', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the width of the border around each course image', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_width_account_course_image',
                'type'      => 'number',
                'default'   => '1',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image Border Color', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the border color color around each course image', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_color_account_course_image',
                'type'      => 'color',
                'default'   => '#ffffff',
            ),

            array(
                'title'     => __( 'Course image border radius top left', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top left radius of the border around the course image', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_radius_top_left_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image border radius top right', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top right radius of the border around the course image', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_radius_top_right_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image border radius bottom left', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom left radius of the border around the course image', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_radius_bottom_left_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image border radius bottom right', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom rightradius of the border around the course image', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_border_radius_bottom_right_account_course_image',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image width dynamic', 'lifterlms-launchpad' ),
                'desc'      => __( 'Set the image width to be automatically calculated', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_auto_width_account_course_image',
                'type'      => 'checkbox',
                'default'   => 'no',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course image width', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the width of the course image', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_width_account_course_image',
                'type'      => 'number',
                'default'   => '150',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Hide course enrollment status', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls whether the enrollment status displays on the course.', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_account_hide_enrollment_status',
                'type'      => 'checkbox',
                'default'   => 'no',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course enrollment status Font Size', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the font size of the enrollment status', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_font_size_account_course_enrollment_status',
                'type'      => 'number',
                'default'   => '15',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Hide course start date', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls whether the start date displays on the course.', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_account_course_hide_start_date',
                'type'      => 'checkbox',
                'default'   => 'no',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course start date Font Size', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the font size of the start date', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_font_size_account_course_start_date',
                'type'      => 'number',
                'default'   => '15',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course title Font Size', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the font size of the course title', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_font_size_account_course_title',
                'type'      => 'number',
                'default'   => '16',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course author Font Size', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the font size of the author', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_font_size_account_course_author',
                'type'      => 'number',
                'default'   => '15',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course view button text', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the button text of the course', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_account_course_button_text',
                'type'      => 'text',
                'default'   => 'View Course',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item tile shadow offset x', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the top shadow of each course item in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_boxshadow_offset_x_course_item',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item tile shadow offset y', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the bottom shadow of each course item in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_boxshadow_offset_y_course_item',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item tile shadow offset blur-radius', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the right shadow of each course item in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_boxshadow_blur_course_item',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item tile shadow spread-radius', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the left shadow of each course item in pixels', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_boxshadow_spread_course_item',
                'type'      => 'number',
                'default'   => '0',
                'desc_tip'  => true,
            ),

            array(
                'title'     => __( 'Course item tile shadow color', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the color of showdow of lesson preview tiles', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_boxshadow_color_course_item',
                'type'      => 'color',
                'default'   => '#ffffff',
            ),

            ) );

        }


        $settings = array_merge( $settings, array(
            /*
                                                 /$$
                                                | $$
                  /$$$$$$$  /$$$$$$   /$$$$$$  /$$$$$$   /$$$$$$$
                 /$$_____/ /$$__  $$ /$$__  $$|_  $$_/  /$$_____/
                | $$      | $$$$$$$$| $$  \__/  | $$   |  $$$$$$
                | $$      | $$_____/| $$        | $$ /$$\____  $$
                |  $$$$$$$|  $$$$$$$| $$        |  $$$$//$$$$$$$/
                 \_______/ \_______/|__/         \___/ |_______/
            */
            array(
                'title'     => __( 'My Certificates Section', 'lifterlms-launchpad' ),
                'type'      => 'subtitle',
                'desc'      => 'Control styling and layout of the "Courses In-Progress" area.',
                'id'        => 'my_certs_styling_options',
                'class'     => 'collapsable',
            ),

            array(
                'title'     => __( 'Certificates Tile: Section title', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the section title of the account certificates tile', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_account_certificates_tile_title',
                'type' 		=> 'text',
                'default'	=> 'My Certificates',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Certificate section title Background Color', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the background color of the certificates section title', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_background_color_account_certificate_tile_title',
                'type'      => 'color',
                'default'   => '#ffffff',
            ),


            /*
                                     /$$       /$$                                                                   /$$
                                    | $$      |__/                                                                  | $$
                  /$$$$$$   /$$$$$$$| $$$$$$$  /$$  /$$$$$$  /$$    /$$ /$$$$$$  /$$$$$$/$$$$   /$$$$$$  /$$$$$$$  /$$$$$$   /$$$$$$$
                 |____  $$ /$$_____/| $$__  $$| $$ /$$__  $$|  $$  /$$//$$__  $$| $$_  $$_  $$ /$$__  $$| $$__  $$|_  $$_/  /$$_____/
                  /$$$$$$$| $$      | $$  \ $$| $$| $$$$$$$$ \  $$/$$/| $$$$$$$$| $$ \ $$ \ $$| $$$$$$$$| $$  \ $$  | $$   |  $$$$$$
                 /$$__  $$| $$      | $$  | $$| $$| $$_____/  \  $$$/ | $$_____/| $$ | $$ | $$| $$_____/| $$  | $$  | $$ /$$\____  $$
                |  $$$$$$$|  $$$$$$$| $$  | $$| $$|  $$$$$$$   \  $/  |  $$$$$$$| $$ | $$ | $$|  $$$$$$$| $$  | $$  |  $$$$//$$$$$$$/
                 \_______/ \_______/|__/  |__/|__/ \_______/    \_/    \_______/|__/ |__/ |__/ \_______/|__/  |__/   \___/ |_______/
            */
            array(
                'title'     => __( 'My Achievements Section', 'lifterlms-launchpad' ),
                'type'      => 'subtitle',
                'desc'      => 'Control styling and layout of the "Courses In-Progress" area.',
                'id'        => 'my_achievements_styling_options',
                'class'     => 'collapsable',
            ),

            array(
                'title'     => __( 'Achievements Tile: Section title', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the section title of the account achievements tile', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_account_achievements_tile_title',
                'type' 		=> 'text',
                'default'	=> 'My Achievements',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Achievement section title Background Color', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the background color of the achievements section title', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_background_color_account_achievement_tile_title',
                'type'      => 'color',
                'default'   => '#ffffff',
            ),


            /*
                                                       /$$                                     /$$       /$$
                                                      | $$                                    | $$      |__/
                 /$$$$$$/$$$$   /$$$$$$  /$$$$$$/$$$$ | $$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$$| $$$$$$$  /$$  /$$$$$$   /$$$$$$$
                | $$_  $$_  $$ /$$__  $$| $$_  $$_  $$| $$__  $$ /$$__  $$ /$$__  $$ /$$_____/| $$__  $$| $$ /$$__  $$ /$$_____/
                | $$ \ $$ \ $$| $$$$$$$$| $$ \ $$ \ $$| $$  \ $$| $$$$$$$$| $$  \__/|  $$$$$$ | $$  \ $$| $$| $$  \ $$|  $$$$$$
                | $$ | $$ | $$| $$_____/| $$ | $$ | $$| $$  | $$| $$_____/| $$       \____  $$| $$  | $$| $$| $$  | $$ \____  $$
                | $$ | $$ | $$|  $$$$$$$| $$ | $$ | $$| $$$$$$$/|  $$$$$$$| $$       /$$$$$$$/| $$  | $$| $$| $$$$$$$/ /$$$$$$$/
                |__/ |__/ |__/ \_______/|__/ |__/ |__/|_______/  \_______/|__/      |_______/ |__/  |__/|__/| $$____/ |_______/
                                                                                                            | $$
                                                                                                            | $$
                                                                                                            |__/
            */
            array(
                'title'     => __( 'My Memberships Section', 'lifterlms-launchpad' ),
                'type'      => 'subtitle',
                'desc'      => 'Control styling and layout of the "Courses In-Progress" area.',
                'id'        => 'my_memberships_styling_options',
                'class'     => 'collapsable',
            ),

            array(
                'title'     => __( 'Memberships Tile: Section title', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Controls the section title of the account memberships tile', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_settings_account_memberships_tile_title',
                'type' 		=> 'text',
                'default'	=> 'My Memberships',
                'desc_tip'	=> true,
            ),

            array(
                'title'     => __( 'Membership section title Background Color', 'lifterlms-launchpad' ),
                'desc'      => __( 'Controls the background color of the memberships section title', 'lifterlms-launchpad' ),
                'id'        => 'launchpad_settings_background_color_account_membership_tile_title',
                'type'      => 'color',
                'default'   => '#ffffff',
            ),

            array( 'type' => 'sectionend', 'id' => 'lifterlms_account_options'),

        ) );

        return apply_filters( 'launchpad_lifterlms_account_settings', $settings );
    }
}
