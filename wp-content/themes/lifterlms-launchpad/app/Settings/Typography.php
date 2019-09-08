<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;
use SkyLab\Fonts\FontOptions;

class Typography extends Setting
{
    public function __construct() {
        $this->id    = 'typography';
        $this->label = __( 'Typography', 'lifterlms-launchpad' );
        $this->menu_order = 30;

        $this->fonts = new FontOptions();

        $this->add_actions_and_filters();
    }

    /**
     * Get settings array
     *
     * @return array
     */
    public function get_settings()
    {
        return apply_filters( 'launchpad_typography_settings', array(

                array( 'type' => 'sectionstart',
                    'id' => 'typography_options',
                    'class' =>'top'
                ),
                array(	'title' => __( 'Typography Settings', 'lifterlms-launchpad' ),
                    'type' => 'title',
                    'desc' => 'Customize font types, sizes and line heights.',
                    'id' => 'typography_options'
                ),

                array(
                    'title'     => __( 'Font Family Options', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Custom font options for paragraphs, headings and menus.',
                    'id'        => 'font_family_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Body Font Family', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Select a font family for body text', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_family_body',
                    'type' 		=> 'select',
                    'default'	=> 'google_PT Serif, serif',
                    'desc_tip'	=> true,
                    'options'   => $this->fonts->get_font_options()
                ),

                array(
                    'title'     => __( 'Headings Font Family', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Select a font family for headings (h1-h6)', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_family_headings',
                    'type' 		=> 'select',
                    'default'	=> 'google_PT Sans, sans-serif',
                    'desc_tip'	=> true,
                    'options'   => $this->fonts->get_font_options()
                ),

                array(
                    'title'     => __( 'Main Menu Font Family', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Select a font family for the main menu (h1-h6)', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_family_menu_link',
                    'type' 		=> 'select',
                    'default'	=> 'google_PT Sans, sans-serif',
                    'desc_tip'	=> true,
                    'options'   => $this->fonts->get_font_options()
                ),

                array(
                    'title'     => __( 'Font Size Options', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Custom font size for paragraphs and headings.',
                    'id'        => 'font_size_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Site Title Font size', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'In Pixels, default is 20', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_size_site_title',
                    'type' 		=> 'number',
                    'default'	=> '20',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Heading Font Size H1', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'In Pixels, default is 34', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_typography_header_h1',
                    'type' 		=> 'number',
                    'default'	=> '34',
                    'desc_tip'	=> true,
                ),
                array(
                    'title'     => __( 'Heading Font Size H2', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'In Pixels, default is 18', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_typography_header_h2',
                    'type' 		=> 'number',
                    'default'	=> '18',
                    'desc_tip'	=> true,
                ),
                array(
                    'title'     => __( 'Heading Font Size H3', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'In Pixels, default is 16', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_typography_header_h3',
                    'type' 		=> 'number',
                    'default'	=> '16',
                    'desc_tip'	=> true,
                ),
                array(
                    'title'     => __( 'Heading Font Size H4', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'In Pixels, default is 13', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_typography_header_h4',
                    'type' 		=> 'number',
                    'default'	=> '13',
                    'desc_tip'	=> true,
                ),
                array(
                    'title'     => __( 'Heading Font Size H5', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'In Pixels, default is 12', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_typography_header_h5',
                    'type' 		=> 'number',
                    'default'	=> '12',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Header Font Size H6', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'In Pixels, default is 11', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_typography_header_h6',
                    'type' 		=> 'number',
                    'default'	=> '11',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Paragraph Font Size', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'In Pixels, default is 14', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_typography_paragraph_size',
                    'type' 		=> 'number',
                    'default'	=> '14',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'List Font Size', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'In Pixels, default is 14', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_typography_list_size',
                    'type' 		=> 'number',
                    'default'	=> '14',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Font Colors', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => __( 'Control colors of fonts on your website', 'lifterlms-launchpad' ),
                    'id'        => 'heading_styling_options',
                    'class'     => 'collapsable'
                ),

               array(
                    'title'     => __( 'Main Text Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of most text on the website', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_body',
                    'type'      => 'color',
                    'default'   => '#444444',
                ),

                array(
                    'title'     => __( 'Heading 1 (H1) Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of H1 headings..', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_h1',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Heading 2 (H2) Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of H2 headings..', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_h2',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Heading 3 (H3) Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of H3 headings..', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_h3',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Heading 4 (H4) Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of H4 headings..', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_h4',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Heading 5 (H5) Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of H5 headings..', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_h5',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Heading 6 (H6) Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the text color of H6 headings..', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_h6',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),


                array( 'type' => 'sectionend', 'id' => 'advanced_options'),
            )
        );
    }

}
