<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;

class ProductArchive extends Setting
{
    public function __construct()
    {
        if (is_lifterlms_enabled())
        {
            $this->id    = 'lifterlms_product_archive';
            $this->label = __( 'LifterLMS Catalogs', 'lifterlms-launchpad' );
            $this->menu_order = 55;

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
        return apply_filters( 'launchpad_lifterlms_product_archive_settings', array(

                array( 'type'   => 'sectionstart',
                    'id'        => 'lifterlms_product_archive_options',
                    'class'     =>'top'
                ),

                array(
                    'title'     => __( 'LifterLMS Catalog Settings', 'lifterlms-launchpad' ),
                    'type'      => 'title',
                    'desc'      => 'Manage the look and feel of the Course and Membership Archive pages.',
                    'id'        => 'lifterlms_product_archive_options'
                ),


                /*
                                 /$$               /$$ /$$
                                | $$              | $$|__/
                      /$$$$$$$ /$$$$$$   /$$   /$$| $$ /$$ /$$$$$$$   /$$$$$$
                     /$$_____/|_  $$_/  | $$  | $$| $$| $$| $$__  $$ /$$__  $$
                    |  $$$$$$   | $$    | $$  | $$| $$| $$| $$  \ $$| $$  \ $$
                     \____  $$  | $$ /$$| $$  | $$| $$| $$| $$  | $$| $$  | $$
                     /$$$$$$$/  |  $$$$/|  $$$$$$$| $$| $$| $$  | $$|  $$$$$$$
                    |_______/    \___/   \____  $$|__/|__/|__/  |__/ \____  $$
                                         /$$  | $$                   /$$  \ $$
                                        |  $$$$$$/                  |  $$$$$$/
                                         \______/                    \______/
                */
                array(
                    'title'     => __( 'Catalog Item Styling', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the course and membership tile elements',
                    'id'        => 'course_tile_styling_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Columns', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Determine the number of tiles to display per row. Maximum is 6.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_catalog_columns',
                    'type'      => 'text',
                    'default'   => '3',
                ),

                array(
                    'title'     => __( 'Background Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the background color of course and membership tiles', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_background_color_product_tile',
                    'type' 		=> 'color',
                    'default'	=> '#f1f1f1',
                ),

                array(
                    'title'     => __( 'Background Color Hover', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the background color of course and membership tiles on hover', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_background_color_hover_product_tile',
                    'type' 		=> 'color',
                    'default'	=> '#eaeaea',
                ),

                array(
                    'title'     => __( 'Border Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the border color of course and membership tiles', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_color_product_tile',
                    'type' 		=> 'color',
                    'default'	=> '#f1f1f1',
                ),

                array(
                    'title'     => __( 'Border Width', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the width of the course and membership tile border', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_width_product_tile',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Border Radius', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls border radius of course and membership tiles', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_border_radius_product_tile',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Padding Top', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the top padding of course and membership tiles in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_top_product_tile',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Padding Bottom', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the bottom padding of course and membership tiles in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_bottom_product_tile',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Padding Right', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the right padding of course and membership tiles in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_right_product_tile',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Padding Left', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the left padding of course and membership tiles in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_padding_left_product_tile',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Shadow Offset X', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the top shadow of course and membership tiles in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_boxshadow_offset_x_product_tile',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Shadow Offset Y', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the bottom shadow of course and membership tiles in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_boxshadow_offset_y_product_tile',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Shadow Offset Blur', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the right shadow of course and membership tiles in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_boxshadow_blur_product_tile',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Shadow Spread', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the left shadow of course and membership tiles in pixels', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_boxshadow_spread_product_tile',
                    'type' 		=> 'number',
                    'default'	=> '0',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Shadow Color', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Controls the color of shadow of course and membership tiles', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_boxshadow_color_product_tile',
                    'type' 		=> 'color',
                    'default'	=> '#ffffff',
                ),

                array(
                    'title'     => __( 'Text Align', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the alignment of text in the course and membership tiles', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_text_alignment_product_tile',
                    'type'      => 'radio',
                    'default'   => 'left',
                    'desc_tip'  => true,
                    'options'   => ['left' => 'Left', 'right' => 'Right', 'center' => 'Center']
                ),

                array(
                    'title'     => __( 'Image Bottom Margin', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom margin of the course and membership tile image', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_bottom_product_tile_image',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),




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
                    'title'     => __( 'Catalog Item Footer Styling', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the footer area of the course and membership tile elements',
                    'id'        => 'course_tile_styling_options',
                    'class'     => 'collapsable'
                ),

               array(
                    'title'     => __( 'Padding Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top padding of course and membership tile footer in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_top_product_tile_footer',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom padding of course and membership tile footer in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_bottom_product_tile_footer',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right padding of course and membership tile footer in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_right_product_tile_footer',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left padding of course and membership tile footer in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_left_product_tile_footer',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Margin Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top margin of course and membership tile footer in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_top_product_tile_footer',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Margin Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom margin of course and membership tile footer in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_bottom_product_tile_footer',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Margin Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right margin of course and membership tile footer in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_right_product_tile_footer',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Margin Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left margin of course and membership tile footer in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_left_product_tile_footer',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Border Width', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the width of the course and membership tile footer border', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_border_width_product_tile_footer',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Border Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the border color of the course and membership tile footer border', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_border_color_product_tile_footer',
                    'type'      => 'color',
                    'default'   => '#f1f1f1',
                ),


                /*
                       /$$     /$$   /$$     /$$
                      | $$    |__/  | $$    | $$
                     /$$$$$$   /$$ /$$$$$$  | $$  /$$$$$$
                    |_  $$_/  | $$|_  $$_/  | $$ /$$__  $$
                      | $$    | $$  | $$    | $$| $$$$$$$$
                      | $$ /$$| $$  | $$ /$$| $$| $$_____/
                      |  $$$$/| $$  |  $$$$/| $$|  $$$$$$$
                       \___/  |__/   \___/  |__/ \_______/
                */
                array(
                    'title'     => __( 'Catalog Item Title Styling', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the title of the course and membership tile elements',
                    'id'        => 'course_tile_title_styling_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font size of the course and membership tile title', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_product_tile_title',
                    'type'      => 'number',
                    'default'   => '18',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of course and membership tile title', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_product_tile_title',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Font Hover Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of course and membership tile title during hover events', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_product_tile_title_hover',
                    'type'      => 'color',
                    'default'   => '#111111',
                ),

                array(
                    'title'     => __( 'Margin Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top margin of course and membership tile title in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_top_product_tile_title',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Margin Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom margin of course and membership tile title in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_bottom_product_tile_title',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Margin Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right margin of course and membership tile title in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_right_product_tile_title',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Margin Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left margin of course and membership tile title in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_left_product_tile_title',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),



                /*
                                               /$$
                                              | $$
                     /$$$$$$/$$$$   /$$$$$$  /$$$$$$    /$$$$$$
                    | $$_  $$_  $$ /$$__  $$|_  $$_/   |____  $$
                    | $$ \ $$ \ $$| $$$$$$$$  | $$      /$$$$$$$
                    | $$ | $$ | $$| $$_____/  | $$ /$$ /$$__  $$
                    | $$ | $$ | $$|  $$$$$$$  |  $$$$/|  $$$$$$$
                    |__/ |__/ |__/ \_______/   \___/   \_______/
                */
                array(
                    'title'     => __( 'Catalog Item Meta Styling', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the meta of the course and membership tile elements',
                    'id'        => 'course_tile_meta_styling_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font size of the course and membership tile metas', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_product_tile_metas',
                    'type'      => 'number',
                    'default'   => '15',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of course and membership tile metas', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_product_tile_metas',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Padding Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top padding of course and membership tile metas in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_top_product_tile_metas',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom padding of course and membership tile metas in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_bottom_product_tile_metas',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right padding of course and membership tile metas in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_right_product_tile_metas',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left padding of course and membership tile metas in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_left_product_tile_metas',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array( 'type' => 'sectionend', 'id' => 'lifterlms_product_archive_options'),
            )
        );
    }
}