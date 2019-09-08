<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;
use LaunchPad\ThemeLayout\HeaderLayout;

class Header extends Setting
{
    public function __construct() {
        $this->id    = 'header';
        $this->label = __( 'Header', 'lifterlms-launchpad' );
        $this->menu_order = 10;

        $this->add_actions_and_filters();
    }

    /**
     * Get settings array
     *
     * @return array
     */
    public function get_settings()
    {
        return apply_filters( 'launchpad_header_settings',
            array(
                array( 'type'   => 'sectionstart',
                    'id'        => 'header_options',
                    'class'     =>'top'
                ),

                array(
                    'title'     => __( 'Site Header Settings', 'lifterlms-launchpad' ),
                    'type'      => 'title',
                    'desc'      => 'Manage the look and feel of the site header.',
                    'id'        => 'header_options',
                ),

                /*
                     /$$                                          /$$ /$$
                    | $$                                         | $$|__/
                    | $$$$$$$   /$$$$$$  /$$$$$$  /$$$$$$$   /$$$$$$$ /$$ /$$$$$$$   /$$$$$$
                    | $$__  $$ /$$__  $$|____  $$| $$__  $$ /$$__  $$| $$| $$__  $$ /$$__  $$
                    | $$  \ $$| $$  \__/ /$$$$$$$| $$  \ $$| $$  | $$| $$| $$  \ $$| $$  \ $$
                    | $$  | $$| $$      /$$__  $$| $$  | $$| $$  | $$| $$| $$  | $$| $$  | $$
                    | $$$$$$$/| $$     |  $$$$$$$| $$  | $$|  $$$$$$$| $$| $$  | $$|  $$$$$$$
                    |_______/ |__/      \_______/|__/  |__/ \_______/|__/|__/  |__/ \____  $$
                                                                                    /$$  \ $$
                                                                                   |  $$$$$$/
                                                                                    \______/
                */
                array(
                    'title'     => __( 'Site Branding', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Add a logo and control styling the site title and description',
                    'id'        => 'header_title_styling_options',
                    'class'     => 'collapsable',
                ),

                array(
                    'title'     => __( 'Logo', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Image to be displayed as logo', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_logo',
                    'type'      => 'image',
                    'default'   => '',
                    'desc_tip'  => true,
                ),
                array(
                    'title'     => __( 'Logo Width', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Width of the uploaded logo in px', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_logo_width',
                    'type'      => 'number',
                    'default'   => '260',
                    'desc_tip'  => true,
                ),
                array(
                    'title'     => __( 'Tagline Display', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Display the site tagline below the logo', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_header_tagline',
                    'type'      => 'checkbox',
                    'default'   => 'no',
                    'desc_tip'  => true,
                ),
                array(
                    'title'     => __( 'Site Title Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of the site title.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_class_site-title',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),
                array(
                    'title'     => __( 'Site Description Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of the site description.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_class_site-description',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),


                /*


                     /$$$$$$/$$$$   /$$$$$$  /$$$$$$$  /$$   /$$
                    | $$_  $$_  $$ /$$__  $$| $$__  $$| $$  | $$
                    | $$ \ $$ \ $$| $$$$$$$$| $$  \ $$| $$  | $$
                    | $$ | $$ | $$| $$_____/| $$  | $$| $$  | $$
                    | $$ | $$ | $$|  $$$$$$$| $$  | $$|  $$$$$$/
                    |__/ |__/ |__/ \_______/|__/  |__/ \______/
                */
                array(
                    'title'     => __( 'Main Menu Settings', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling and layout of the main menu',
                    'id'        => 'main_menu_styling_options',
                    'class'     => 'collapsable',
                ),

                array(
                    'title'     => __( 'Main Menu Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of the main menu items', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_id_responsive-menu',
                    'type'      => 'color',
                    'default'   => '#2295ff',
                ),

                array(
                    'title'     => __( 'Main Menu Font Hover Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of the main menu items on hover', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_hover_color_id_responsive-menu',
                    'type'      => 'color',
                    'default'   => '#0077e4',
                ),

	            array(
		            'title'     => __( 'Main Submenu Font Color', 'lifterlms-launchpad' ),
		            'desc'      => __( 'Controls the text color of the main submenu items', 'lifterlms-launchpad' ),
		            'id'        => 'launchpad_settings_submenu_font_color_id_responsive-menu',
		            'type'      => 'color',
		            'default'   => '#2295ff',
	            ),

	            array(
		            'title'     => __( 'Main Submenu Font Hover Color', 'lifterlms-launchpad' ),
		            'desc'      => __( 'Controls the text color of the main submenu items on hover', 'lifterlms-launchpad' ),
		            'id'        => 'launchpad_settings_submenu_hover_color_id_responsive-menu',
		            'type'      => 'color',
		            'default'   => '#0077e4',
	            ),

	            array(
		            'title'     => __( 'Main Submenu Background Color', 'lifterlms-launchpad' ),
		            'desc'      => __( 'Controls the background color of the main submenu items', 'lifterlms-launchpad' ),
		            'id'        => 'launchpad_settings_submenu_bg_color_id_responsive-menu',
		            'type'      => 'color',
		            'default'   => '#ffffff',
	            ),

	            array(
		            'title'     => __( 'Main Submenu Background Hover Color', 'lifterlms-launchpad' ),
		            'desc'      => __( 'Controls the background color of the main submenu items on hover', 'lifterlms-launchpad' ),
		            'id'        => 'launchpad_settings_submenu_bghover_color_id_responsive-menu',
		            'type'      => 'color',
		            'default'   => '#e8e8e8',
	            ),

	            array(
		            'title'     => __( 'Main Submenu Border Color', 'lifterlms-launchpad' ),
		            'desc'      => __( 'Controls the border color of the main submenu items', 'lifterlms-launchpad' ),
		            'id'        => 'launchpad_settings_submenu_border_color_id_responsive-menu',
		            'type'      => 'color',
		            'default'   => '#ffffff',
	            ),

	            array(
		            'title'     => __( 'Main Submenu Border Width', 'lifterlms-launchpad' ),
		            'desc'      => __( 'Controls the border width of the main submenu items on hover', 'lifterlms-launchpad' ),
		            'id'        => 'launchpad_settings_submenu_border_width_id_responsive-menu',
		            'type'      => 'number',
		            'default'   => '1',
	            ),

                array(
                    'title'     => __( 'Main Menu Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'In Pixels, default is 14', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_id_responsive-menu',
                    'type'      => 'number',
                    'default'   => '14',
                    'desc_tip'  => true,
                ),

				array(
					'title'     => __( 'Main Menu Font Weight', 'lifterlms-launchpad' ),
					'desc'      => __( 'Select a font weight for the main menu text', 'lifterlms-launchpad' ),
					'id'        => 'launchpad_settings_font_weight_id_responsive-menu',
					'type'      => 'select',
					'default'   => '500',
					'desc_tip'  => true,
					'options'   => ['100' => '100', '200' => '200', '300' => '300', '400' => '400', '500' => '500', '600' => '600', '700' => '700', '800' => '800', '900' => '900'],
				),

				array(
					'title'     => __( 'Distance Between Menu Items', 'lifterlms-launchpad' ),
					'desc'      => __( 'Controls the distance between each item in the main menu in pixels.', 'lifterlms-launchpad' ),
					'id'        => 'launchpad_settings_text_distance_id_responsive-menu',
					'type'      => 'number',
					'default'   => '0',
					'desc_tip'  => true,
				),

            /*

				MOBILE
				 /$$$$$$/$$$$   /$$$$$$  /$$$$$$$  /$$   /$$
				| $$_  $$_  $$ /$$__  $$| $$__  $$| $$  | $$
				| $$ \ $$ \ $$| $$$$$$$$| $$  \ $$| $$  | $$
				| $$ | $$ | $$| $$_____/| $$  | $$| $$  | $$
				| $$ | $$ | $$|  $$$$$$$| $$  | $$|  $$$$$$/
				|__/ |__/ |__/ \_______/|__/  |__/ \______/ s
	            lol

            */

	            array(
		            'title'     => __( 'Mobile Menu Settings', 'lifterlms-launchpad' ),
		            'type'      => 'subtitle',
		            'desc'      => 'Control styling and layout of the mobile menu',
		            'id'        => 'mobile_menu_styling_options',
		            'class'     => 'collapsable',
	            ),

	            array(
		            'title'     => __( 'Mobile Menu Font Size', 'lifterlms-launchpad' ),
		            'desc'      => __( 'In Pixels, default is 14', 'lifterlms-launchpad' ),
		            'id'        => 'launchpad_settings_mobile_font_size_id_responsive-menu',
		            'type'      => 'number',
		            'default'   => '14',
		            'desc_tip'  => true,
	            ),

	            array(
		            'title'     => __( 'Mobile Menu Font Color', 'lifterlms-launchpad' ),
		            'desc'      => __( 'Controls the text color of the mobile menu items', 'lifterlms-launchpad' ),
		            'id'        => 'launchpad_settings_mobile_font_color_id_responsive-menu',
		            'type'      => 'color',
		            'default'   => '#2295ff',
	            ),

	            array(
		            'title'     => __( 'Mobile Menu Background Color', 'lifterlms-launchpad' ),
		            'desc'      => __( 'Controls the background color of the mobile menu items', 'lifterlms-launchpad' ),
		            'id'        => 'launchpad_settings_mobile_bg_color_id_responsive-menu',
		            'type'      => 'color',
		            'default'   => '#ffffff',
	            ),



			/*
				 /$$                                           /$$
				| $$                                          | $$
				| $$  /$$$$$$  /$$   /$$  /$$$$$$  /$$   /$$ /$$$$$$
				| $$ |____  $$| $$  | $$ /$$__  $$| $$  | $$|_  $$_/
				| $$  /$$$$$$$| $$  | $$| $$  \ $$| $$  | $$  | $$
				| $$ /$$__  $$| $$  | $$| $$  | $$| $$  | $$  | $$ /$$
				| $$|  $$$$$$$|  $$$$$$$|  $$$$$$/|  $$$$$$/  |  $$$$/
				|__/ \_______/ \____  $$ \______/  \______/    \___/
							   /$$  | $$
							  |  $$$$$$/
							   \______/
			*/
                array(
                    'title'     => __( 'Header Layout', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control layout of the header',
                    'id'        => 'header_layout_options',
                    'class'     => 'collapsable',
                ),

                array(
                    'title' => __( 'Layout', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Select the layout for your header area.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_header_layout',
                    'type'      => 'radio',
                    'class'     => 'image-replaced-option',
                    'wrapper_class' => 'launchpad-layout-options',
                    'default'   => 'branding_nav_cols',
                    'desc_tip'  => true,
                    'options'   => HeaderLayout::get_layout_options()
                ),

                array(
                    'title'     => __( 'Content Widths', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Select a font family for body text', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_header_layout_cols',
                    'type'      => 'select',
                    'default'   => 'four_eight',
                    'desc_tip'  => true,
                    'options'   => array(
                        'three_nine' => __( 'Logo 25% / Navigation 75%', 'lifterlms-launchpad' ),
                        'four_eight' => __( 'Logo 33.333% / Navigation 66.666%', 'lifterlms-launchpad' ),
                        'five_seven' => __( 'Logo 41.666% / Navigation 58.333%', 'lifterlms-launchpad' ),
                        'six_six' => __( 'Logo 50% / Navigation 50%', 'lifterlms-launchpad' ),
                        'seven_five' => __( 'Logo 58.333% / Navigation 41.666%', 'lifterlms-launchpad' ),
                        'eight_four' => __( 'Logo 66.666% / Navigation 33.333%', 'lifterlms-launchpad' ),
                        'nine_three' => __( 'Logo 75% / Navigation 25%', 'lifterlms-launchpad' ),
                        'twelve_twelve' => __( 'Logo 100% / Navigation 100%', 'lifterlms-launchpad' ),
                    ),
                ),

				array(
					'title'     => __( 'Logo Distance from Top', 'lifterlms-launchpad' ),
					'desc'      => __( 'Controls the distance between the top of the header and the logo in pixels', 'lifterlms-launchpad' ),
					'id'        => 'launchpad_settings_logo_distance_top_header',
					'type'      => 'number',
					'default'   => '0',
					'desc_tip'  => true,
				),

				array(
					'title'     => __( 'Menu Distance from Top', 'lifterlms-launchpad' ),
					'desc'      => __( 'Controls the distance between the top of the header and the menu in pixels', 'lifterlms-launchpad' ),
					'id'        => 'launchpad_settings_menu_distance_top_header',
					'type'      => 'number',
					'default'   => '16',
					'desc_tip'  => true,
				),

                array(
                    'title'     => __( 'Padding Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top padding of the header in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_top_header',
                    'type'      => 'number',
                    'default'   => '5',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom padding of the header in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_bottom_header',
                    'type'      => 'number',
                    'default'   => '5',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right padding of the header in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_right_header',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left padding of the header in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_left_header',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                /*
                     /$$                           /$$                                                               /$$
                    | $$                          | $$                                                              | $$
                    | $$$$$$$   /$$$$$$   /$$$$$$$| $$   /$$  /$$$$$$   /$$$$$$   /$$$$$$  /$$   /$$ /$$$$$$$   /$$$$$$$
                    | $$__  $$ |____  $$ /$$_____/| $$  /$$/ /$$__  $$ /$$__  $$ /$$__  $$| $$  | $$| $$__  $$ /$$__  $$
                    | $$  \ $$  /$$$$$$$| $$      | $$$$$$/ | $$  \ $$| $$  \__/| $$  \ $$| $$  | $$| $$  \ $$| $$  | $$
                    | $$  | $$ /$$__  $$| $$      | $$_  $$ | $$  | $$| $$      | $$  | $$| $$  | $$| $$  | $$| $$  | $$
                    | $$$$$$$/|  $$$$$$$|  $$$$$$$| $$ \  $$|  $$$$$$$| $$      |  $$$$$$/|  $$$$$$/| $$  | $$|  $$$$$$$
                    |_______/  \_______/ \_______/|__/  \__/ \____  $$|__/       \______/  \______/ |__/  |__/ \_______/
                                                             /$$  \ $$
                                                            |  $$$$$$/
                                                             \______/
                */

                array(
                    'title'     => __( 'Site Header Background', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the site header background',
                    'id'        => 'header_background_styling_options',
                    'class'     => 'collapsable',
                ),

                array(
                    'title'     => __( 'Background Image', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Background image for header area.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_image',
                    'type'      => 'image',
                    'default'   => '',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Background Image Horizontal Positioning', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the horizontal alignment of the background image', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_header_background_image_position_x',
                    'type'      => 'radio',
                    'default'   => 'center',
                    'desc_tip'  => true,
                    'options'   => ['left' => 'Left', 'right' => 'Right', 'center' => 'Center']
                ),

                array(
                    'title'     => __( 'Background Image Vertical Positioning', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the vertical alignment of the background image', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_header_background_image_position_y',
                    'type'      => 'radio',
                    'default'   => 'center',
                    'desc_tip'  => true,
                    'options'   => ['top' => 'Top', 'bottom' => 'Bottom', 'center' => 'Center']
                ),

                array(
                    'title'     => __( 'Repeating Background Image', 'lifterlms-launchpad' ),
                    'desc'      => __( 'If checked, background image will repeat infinitely to cover the available space', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_header_background_image_repeat',
                    'type'      => 'checkbox',
                    'default'   => 'no',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Background Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the background color of the header.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_header_background_color',
                    'type'      => 'color',
                    'default'   => '#e5e5e5',
                ),

                array( 'type' => 'sectionend', 'id' => 'header_options'),
            )
        );
    }
}
