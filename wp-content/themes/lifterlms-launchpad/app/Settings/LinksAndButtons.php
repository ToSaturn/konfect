<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;


class LinksAndButtons extends Setting
{
    public function __construct() {
        $this->id    = 'links_and_buttons';
        $this->label = __( 'Links and Buttons', 'lifterlms-launchpad' );
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
        return apply_filters( 'launchpad_styling_settings', array(

                array( 'type' => 'sectionstart',
                    'id' => 'styling_options',
                    'class' =>'top'
                ),
                array(	'title' => __( 'Link and Button Settings', 'lifterlms-launchpad' ),
                    'type' => 'title',
                    'desc' => 'Link and Button Settings',
                    'id' => 'styling_options'
                ),

                array(
                    'title'     => __( 'Link Styling', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of links.',
                    'id'        => 'link_styling_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Primary Link Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of primary links.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_color_primary_link',
                    'type' 		=> 'color',
                    'default'	=> '#2295ff',
                ),

                array(
                    'title'     => __( 'Primary Link Hover Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of primary links on hover.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_color_primary_link_hover',
                    'type' 		=> 'color',
                    'default'	=> '#0077e4',
                ),

                array(
                    'title'     => __( 'Primary Button Styling', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of primary action buttons',
                    'id'        => 'button_styling_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Background Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of primary buttons.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_background_color_primary_button',
                    'type' 		=> 'color',
                    'default'	=> '#2295ff',
                ),

                array(
                    'title'     => __( 'Font Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of primary button text.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_color_primary_button',
                    'type' 		=> 'color',
                    'default'	=> '#ffffff',
                ),

                array(
                    'title'     => __( 'Border Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of primary button border.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_color_primary_button',
                    'type' 		=> 'color',
                    'default'	=> '#2295ff',
                ),

                array(
                    'title'     => __( 'Background Hover Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of primary buttons on hover.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_background_color_primary_button_hover',
                    'type' 		=> 'color',
                    'default'	=> '#0077e4',
                ),

                array(
                    'title'     => __( 'Font Hover Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of primary button text on hover.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_color_primary_button_hover',
                    'type' 		=> 'color',
                    'default'	=> '#ffffff',
                ),

                array(
                    'title'     => __( 'Border Hover Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of primary button border on hover.', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_color_primary_button_hover',
                    'type' 		=> 'color',
                    'default'	=> '#0077e4',
                ),

                array(
                    'title'     => __( 'Padding Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top padding of the button in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_top_button',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom padding of the button in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_bottom_button',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right padding of the button in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_right_button',
                    'type'      => 'number',
                    'default'   => '20',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left padding of the button in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_left_button',
                    'type'      => 'number',
                    'default'   => '20',
                    'desc_tip'  => true,
                ),




                array(
                    'title'     => __( 'Secondary Button Styling', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of secondary action buttons',
                    'id'        => 'button_styling_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Background Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of primary buttons.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_secondary_button',
                    'type'      => 'color',
                    'default'   => '#e1e1e1',
                ),

                array(
                    'title'     => __( 'Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of primary button text.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_secondary_button',
                    'type'      => 'color',
                    'default'   => '#414141',
                ),

                array(
                    'title'     => __( 'Border Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of primary button border.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_border_color_secondary_button',
                    'type'      => 'color',
                    'default'   => '#e1e1e1',
                ),

                array(
                    'title'     => __( 'Background Hover Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of primary buttons on hover.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_secondary_button_hover',
                    'type'      => 'color',
                    'default'   => '#cdcdcd',
                ),

                array(
                    'title'     => __( 'Font Hover Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of primary button text on hover.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_secondary_button_hover',
                    'type'      => 'color',
                    'default'   => '#414141',
                ),

                array(
                    'title'     => __( 'Border Hover Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of primary button border on hover.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_border_color_secondary_button_hover',
                    'type'      => 'color',
                    'default'   => '#cdcdcd',
                ),

                array(
                    'title'     => __( 'Padding Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top padding of the button in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_top_secondary_button',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom padding of the button in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_bottom_secondary_button',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right padding of the button in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_right_secondary_button',
                    'type'      => 'number',
                    'default'   => '20',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left padding of the button in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_left_secondary_button',
                    'type'      => 'number',
                    'default'   => '20',
                    'desc_tip'  => true,
                ),

                array( 'type' => 'sectionend', 'id' => 'advanced_options'),
            )
        );
    }

}
