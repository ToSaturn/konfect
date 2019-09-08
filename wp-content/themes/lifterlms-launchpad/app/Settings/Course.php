<?php

namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;

class Course extends Setting
{

    public $icons = array();

    public function __construct()
    {
        if (is_lifterlms_enabled())
        {
            $this->id    = 'lifterlms_course';
            $this->label = __( 'LifterLMS Course', 'lifterlms-launchpad' );
            $this->menu_order = 50;

            $this->icons = $this->get_icons();

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
        return apply_filters( 'launchpad_lifterlms_course_settings', array(

                array( 'type'   => 'sectionstart',
                    'id'        => 'lifterlms_course_options',
                    'class'     =>'top'
                ),

                array(
                    'title'     => __( 'LifterLMS Course Settings', 'lifterlms-launchpad' ),
                    'type'      => 'title',
                    'desc'      => 'Manage the look and feel of the Course.',
                    'id'        => 'lifterlms_course_options'
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
                    'title'     => __( 'Course Title', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the course title element',
                    'id'        => 'course_title_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Font Size', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'The font size of the course title', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_font_size_course_title',
                    'type' 		=> 'number',
                    'default'	=> '34',
                    'desc_tip'	=> true,
                ),

                array(
                    'title'     => __( 'Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font color of course title', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_course_title',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

				array(
					'title'     => __( 'Course Title Font Weight', 'lifterlms-launchpad' ),
					'desc'      => __( 'Select a font weight for the course title', 'lifterlms-launchpad' ),
					'id'        => 'launchpad_settings_font_weight_course_title',
					'type'      => 'select',
					'default'   => '500',
					'desc_tip'  => true,
					'options'   => ['100' => '100', '200' => '200', '300' => '300', '400' => '400', '500' => '500', '600' => '600', '700' => '700', '800' => '800', '900' => '900'],
				),


               /*
                     /$$
                    |__/
                     /$$ /$$$$$$/$$$$   /$$$$$$   /$$$$$$   /$$$$$$
                    | $$| $$_  $$_  $$ |____  $$ /$$__  $$ /$$__  $$
                    | $$| $$ \ $$ \ $$  /$$$$$$$| $$  \ $$| $$$$$$$$
                    | $$| $$ | $$ | $$ /$$__  $$| $$  | $$| $$_____/
                    | $$| $$ | $$ | $$|  $$$$$$$|  $$$$$$$|  $$$$$$$
                    |__/|__/ |__/ |__/ \_______/ \____  $$ \_______/
                                                 /$$  \ $$
                                                |  $$$$$$/
                                                 \______/
                */
                array(
                    'title'     => __( 'Course Image', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the course image element',
                    'id'        => 'course_image_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Hide featured image on course page', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls whether the featured image displays on the course page.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_hide_course_featured_image',
                    'type'      => 'checkbox',
                    'default'   => 'no',
                    'desc_tip'  => true,
                ),


                /*
                     /$$                       /$$                                     /$$
                    |__/                      | $$                                    | $$
                     /$$ /$$$$$$$   /$$$$$$$ /$$$$$$    /$$$$$$  /$$   /$$  /$$$$$$$ /$$$$$$    /$$$$$$   /$$$$$$   /$$$$$$$
                    | $$| $$__  $$ /$$_____/|_  $$_/   /$$__  $$| $$  | $$ /$$_____/|_  $$_/   /$$__  $$ /$$__  $$ /$$_____/
                    | $$| $$  \ $$|  $$$$$$   | $$    | $$  \__/| $$  | $$| $$        | $$    | $$  \ $$| $$  \__/|  $$$$$$
                    | $$| $$  | $$ \____  $$  | $$ /$$| $$      | $$  | $$| $$        | $$ /$$| $$  | $$| $$       \____  $$
                    | $$| $$  | $$ /$$$$$$$/  |  $$$$/| $$      |  $$$$$$/|  $$$$$$$  |  $$$$/|  $$$$$$/| $$       /$$$$$$$/
                    |__/|__/  |__/|_______/    \___/  |__/       \______/  \_______/   \___/   \______/ |__/      |_______/
                */
                array(
                    'title'     => __( 'Instructors', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the course instructors area',
                    'id'        => 'course_instructor_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Area Border Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the border highlight on course instructors elements', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_border_color_instructors',
                    'type'      => 'color',
                    'default'   => '#2295ff',
                ),

                array(
                    'title'     => __( 'Instructor Name Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'The font size of the instructor names', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_instructor_name',
                    'type'      => 'number',
                    'default'   => '15',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Instructor Name Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'The font color of the instructor names', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_instructor_name',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Instructor Label Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'The font size of the instructor labels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_instructor_label',
                    'type'      => 'number',
                    'default'   => '13',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Instructor Label Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'The font color of the instructor labels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_instructor_label',
                    'type'      => 'color',
                    'default'   => '#444444',
                ),


                /*
                                                                                                          /$$
                                                                                                         | $$
                      /$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$   /$$$$$$$ /$$$$$$$      | $$$$$$$   /$$$$$$   /$$$$$$
                     /$$__  $$ /$$__  $$ /$$__  $$ /$$__  $$ /$$__  $$ /$$__  $$ /$$_____//$$_____/      | $$__  $$ |____  $$ /$$__  $$
                    | $$  \ $$| $$  \__/| $$  \ $$| $$  \ $$| $$  \__/| $$$$$$$$|  $$$$$$|  $$$$$$       | $$  \ $$  /$$$$$$$| $$  \__/
                    | $$  | $$| $$      | $$  | $$| $$  | $$| $$      | $$_____/ \____  $$\____  $$      | $$  | $$ /$$__  $$| $$
                    | $$$$$$$/| $$      |  $$$$$$/|  $$$$$$$| $$      |  $$$$$$$ /$$$$$$$//$$$$$$$/      | $$$$$$$/|  $$$$$$$| $$
                    | $$____/ |__/       \______/  \____  $$|__/       \_______/|_______/|_______/       |_______/  \_______/|__/
                    | $$                           /$$  \ $$
                    | $$                          |  $$$$$$/
                    |__/                           \______/
                */
                array(
                    'title'     => __( 'Course Progress Bar', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the progress element',
                    'id'        => 'course_progress_bar_options',
                    'class'     => 'collapsable'
                ),


                array(
                    'title'     => __( 'Course progress bar Background Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the background color of the course progress bar', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_course_progress',
                    'type'      => 'color',
                    'default'   => '#f1f2f1',
                ),

                array(
                    'title'     => __( 'Course progress bar completion % Background Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the background color of the completion % course progress bar', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_course_progress_completed',
                    'type'      => 'color',
                    'default'   => '#ef476f',
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
                    'title'     => __( 'Course Meta Information', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the course meta information such as length and categories',
                    'id'        => 'course_meta_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Meta Title Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'The font size of the course length', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_meta_title',
                    'type'      => 'number',
                    'default'   => '18',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Meta Title Margin Top', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_meta_title_margin_top',
                    'type'      => 'number',
                    'default'   => '20',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Meta Title Margin Bottom', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_meta_title_margin_bottom',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Meta Title Margin Left', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_meta_title_margin_left',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Meta Title Margin Right', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_meta_title_margin_right',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Meta Title Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font color of course length', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_meta_title',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Meta Information Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'The font size of the course length', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_meta_info',
                    'type'      => 'number',
                    'default'   => '14',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Meta Information Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font color of course length', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_meta_info',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                /*
                                         /$$ /$$           /$$
                                        | $$| $$          | $$
                      /$$$$$$$ /$$   /$$| $$| $$  /$$$$$$ | $$$$$$$  /$$   /$$  /$$$$$$$
                     /$$_____/| $$  | $$| $$| $$ |____  $$| $$__  $$| $$  | $$ /$$_____/
                    |  $$$$$$ | $$  | $$| $$| $$  /$$$$$$$| $$  \ $$| $$  | $$|  $$$$$$
                     \____  $$| $$  | $$| $$| $$ /$$__  $$| $$  | $$| $$  | $$ \____  $$
                     /$$$$$$$/|  $$$$$$$| $$| $$|  $$$$$$$| $$$$$$$/|  $$$$$$/ /$$$$$$$/
                    |_______/  \____  $$|__/|__/ \_______/|_______/  \______/ |_______/
                               /$$  | $$
                              |  $$$$$$/
                               \______/
                */
                array(
                    'title'     => __( 'Course Syllabus', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the course syllabus element',
                    'id'        => 'course_syllabus_options',
                    'class'     => 'collapsable'
                ),

               array(
                    'title'     => __( 'Title Text Alignment', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the alignment of course syllabus titles', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_text_alignment_course_syllabus_title',
                    'type'      => 'radio',
                    'default'   => 'center',
                    'desc_tip'  => true,
                    'options'   => ['left' => 'Left', 'right' => 'Right', 'center' => 'Center']
                ),

                array(
                    'title'     => __( 'Title Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'The font size of the course syllabus titles', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_course_syllabus_title',
                    'type'      => 'number',
                    'default'   => '16',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Title Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font color of course syllabus titles', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_course_syllabus_title',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),



                /*
                     /$$                                                          /$$     /$$ /$$
                    | $$                                                         | $$    |__/| $$
                    | $$  /$$$$$$   /$$$$$$$ /$$$$$$$  /$$$$$$  /$$$$$$$        /$$$$$$   /$$| $$  /$$$$$$   /$$$$$$$
                    | $$ /$$__  $$ /$$_____//$$_____/ /$$__  $$| $$__  $$      |_  $$_/  | $$| $$ /$$__  $$ /$$_____/
                    | $$| $$$$$$$$|  $$$$$$|  $$$$$$ | $$  \ $$| $$  \ $$        | $$    | $$| $$| $$$$$$$$|  $$$$$$
                    | $$| $$_____/ \____  $$\____  $$| $$  | $$| $$  | $$        | $$ /$$| $$| $$| $$_____/ \____  $$
                    | $$|  $$$$$$$ /$$$$$$$//$$$$$$$/|  $$$$$$/| $$  | $$        |  $$$$/| $$| $$|  $$$$$$$ /$$$$$$$/
                    |__/ \_______/|_______/|_______/  \______/ |__/  |__/         \___/  |__/|__/ \_______/|_______/
                */
                array(
                    'title'     => __( 'Lesson Preview Tiles', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control styling of the lesson preview tiles in the course syllabus',
                    'id'        => 'course_lesson_preview_tile_options',
                    'class'     => 'collapsable'
                ),

                array(
                    'title'     => __( 'Margin Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top margin of lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_top_lesson_preview',
                    'type'      => 'number',
                    'default'   => '15',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Margin Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom margin of lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_bottom_lesson_preview',
                    'type'      => 'number',
                    'default'   => '15',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Margin Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right margin of lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_right_lesson_preview',
                    'type'      => 'number',
                    'default'   => '15',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Margin Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left margin of lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_left_lesson_preview',
                    'type'      => 'number',
                    'default'   => '15',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Tile Width', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the width of the lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_width_lesson_preview',
                    'type'      => 'number',
                    'default'   => '480',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Background Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the background color of the lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_lesson_preview',
                    'type'      => 'color',
                    'default'   => '#f1f1f1',
                ),

                array(
                    'title'     => __( 'Border Width', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the width of the lesson preview tile border', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_border_width_lesson_preview',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Border Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the border color of the lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_border_color_lesson_preview',
                    'type'      => 'color',
                    'default'   => '#f1f1f1',
                ),

                array(
                    'title'     => __( 'Background Color on Hover', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the background color of the lesson preview tile on hover', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_lesson_preview_hover',
                    'type'      => 'color',
                    'default'   => '#eaeaea',
                ),

                array(
                    'title'     => __( 'Border Width on Hover', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the width of the lesson preview tile border on hover', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_border_width_lesson_preview_hover',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Border Color on Hover', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the border color of the lesson preview tile on hover', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_border_color_lesson_preview_hover',
                    'type'      => 'color',
                    'default'   => '#eaeaea',
                ),

                array(
                    'title'     => __( 'Padding Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top padding of lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_top_lesson_preview',
                    'type'      => 'number',
                    'default'   => '15',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom padding of lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_bottom_lesson_preview',
                    'type'      => 'number',
                    'default'   => '15',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right padding of lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_right_lesson_preview',
                    'type'      => 'number',
                    'default'   => '15',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Padding Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left padding of lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_left_lesson_preview',
                    'type'      => 'number',
                    'default'   => '15',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Shadow Offset X', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top shadow of lesson preview tiles in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_boxshadow_offset_x_lesson_preview',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Shadow Offset Y', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom shadow of lesson preview tiles in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_boxshadow_offset_y_lesson_preview',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Shadow Offset Blur', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right shadow of lesson preview tiles in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_boxshadow_blur_lesson_preview',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Shadow Spread', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left shadow of lesson preview tiles in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_boxshadow_spread_lesson_preview',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Shadow Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of showdow of lesson preview tiles', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_boxshadow_color_lesson_preview',
                    'type'      => 'color',
                    'default'   => '#ffffff',
                ),

                array(
                    'title'     => __( 'Title Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font size of the lesson title in the lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_lesson_preview_title',
                    'type'      => 'number',
                    'default'   => '18',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Title Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font color of the lesson title in the lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_lesson_preview_title',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Title Margin Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top margin of lesson preview title', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_top_lesson_preview_title',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Title Margin Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom margin of lesson preview title', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_bottom_lesson_preview_title',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Title Margin Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right margin of lesson preview title', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_right_lesson_preview_title',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Title Margin Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left margin of lesson preview title', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_left_lesson_preview_title',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Hide Count', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls whether the lesson count displays in the lesson preview tile.', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_hide_lesson_count_lesson_preview',
                    'type'      => 'checkbox',
                    'default'   => 'no',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Count Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font size of the lesson count in the lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_lesson_preview_count',
                    'type'      => 'number',
                    'default'   => '14',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Count Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font color of the lesson count in the lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_lesson_preview_count',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Excerpt Font Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font size of the excerpt in the lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_lesson_preview_excerpt',
                    'type'      => 'number',
                    'default'   => '16',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Excerpt Font Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font color of the excerpt in the lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_color_lesson_preview_excerpt',
                    'type'      => 'color',
                    'default'   => '#333333',
                ),

                array(
                    'title'     => __( 'Excerpt Bottom Margin', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom margin of the lesson preview excerpt', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_bottom_lesson_preview_excerpt',
                    'type'      => 'number',
                    'default'   => '10',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Border Radius', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the border radius of the lesson preview tile', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_border_radius_lesson_preview',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Disabled Lesson Background Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the background color of disabled lesson preview', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_lesson_preview_disabled',
                    'type'      => 'color',
                    'default'   => '#a1a1a1',
                ),

                array(
                    'title'     => __( 'Disabled Lesson Background Color on Hover', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the background color of disabled lesson preview on hover', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_lesson_preview_disabled_hover',
                    'type'      => 'color',
                    'default'   => '#a1a1a1',
                ),







                /*
                                                                 /$$             /$$                     /$$
                                                                | $$            | $$                    |__/
                      /$$$$$$$  /$$$$$$  /$$$$$$/$$$$   /$$$$$$ | $$  /$$$$$$  /$$$$$$    /$$$$$$        /$$  /$$$$$$$  /$$$$$$  /$$$$$$$
                     /$$_____/ /$$__  $$| $$_  $$_  $$ /$$__  $$| $$ /$$__  $$|_  $$_/   /$$__  $$      | $$ /$$_____/ /$$__  $$| $$__  $$
                    | $$      | $$  \ $$| $$ \ $$ \ $$| $$  \ $$| $$| $$$$$$$$  | $$    | $$$$$$$$      | $$| $$      | $$  \ $$| $$  \ $$
                    | $$      | $$  | $$| $$ | $$ | $$| $$  | $$| $$| $$_____/  | $$ /$$| $$_____/      | $$| $$      | $$  | $$| $$  | $$
                    |  $$$$$$$|  $$$$$$/| $$ | $$ | $$| $$$$$$$/| $$|  $$$$$$$  |  $$$$/|  $$$$$$$      | $$|  $$$$$$$|  $$$$$$/| $$  | $$
                     \_______/ \______/ |__/ |__/ |__/| $$____/ |__/ \_______/   \___/   \_______/      |__/ \_______/ \______/ |__/  |__/
                                                      | $$
                                                      | $$
                                                      |__/
                */
                array(
                    'title'     => __( 'Lesson Complete Icon', 'lifterlms-launchpad' ),
                    'type'      => 'subtitle',
                    'desc'      => 'Control the styling and display of the lesson completion icon in the lesson preview tiles in the course syllabus.',
                    'id'        => 'course_lesson_complete_icon_options',
                    'class'     => 'collapsable'
                ),

               array(
                    'title'     => __( 'Lesson Complete Icon', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the icon displayed when a lesson is complete', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_icon_lesson_complete',
                    'type'      => 'select',
                    'default'   => 'check-circle',
                    'desc_tip'  => true,
                    'options'   => $this->icons,
                ),

                //
                array(
                    'title'     => __( 'Icon Margin Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top margin of lesson preview complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_top_lesson_preview_complete',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Icon Margin Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom margin of lesson preview complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_bottom_lesson_preview_complete',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Icon Margin Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right margin of lesson preview complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_right_lesson_preview_complete',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Icon Margin Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left margin of lesson preview complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_margin_left_lesson_preview_complete',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),
                //
                array(
                    'title'     => __( 'Icon Padding Top', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the top padding of lesson preview complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_top_lesson_preview_complete',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Icon Padding Bottom', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the bottom padding of lesson preview complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_bottom_lesson_preview_complete',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Icon Padding Right', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the right padding of lesson preview complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_right_lesson_preview_complete',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Icon Padding Left', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the left padding of lesson preview complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_padding_left_lesson_preview_complete',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Lesson Complete Placeholder Icon Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of the lesson complete icon when the lesson is not completed', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_lesson_complete_placeholder',
                    'type'      => 'color',
                    'default'   => '#eaeaea',
                ),

                array(
                    'title'     => __( 'Icon Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color of the lesson complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_background_color_lesson_complete',
                    'type'      => 'color',
                    'default'   => '#e5554e',
                ),

                array(
                    'title'     => __( 'Icon Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the font size of the lesson complete icon in pixels', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_font_size_lesson_complete',
                    'type'      => 'number',
                    'default'   => '30',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Icon Right Border Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the width for the right border of the lesson complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_right_border_width_lesson_complete',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Icon Right Border Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color for the right border of the lesson complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_right_border_color_lesson_complete',
                    'type'      => 'color',
                    'default'   => '#ffffff',
                ),

                array(
                    'title'     => __( 'Icon Left Border Size', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the width for the left border of the lesson complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_left_border_width_lesson_complete',
                    'type'      => 'number',
                    'default'   => '0',
                    'desc_tip'  => true,
                ),

                array(
                    'title'     => __( 'Icon Left Border Color', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Controls the color for the left border of the lesson complete icon', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_left_border_color_lesson_complete',
                    'type'      => 'color',
                    'default'   => '#ffffff',
                ),

                array( 'type' => 'sectionend', 'id' => 'lifterlms_course_options'),
            )
        );
    }

    /**
     * Get an array of icons for use in the icon select
     * @return array
     */
    public function get_icons()
    {
        $icons = array( 'glass' => 'glass','music' => 'music','search' => 'search','envelope-o' => 'envelope-o','heart' => 'heart','star' => 'star','star-o' => 'star-o','user' => 'user','film' => 'film','th-large' => 'th-large','th' => 'th','th-list' => 'th-list','check' => 'check','remove' => 'remove','close' => 'close','times' => 'times','search-plus' => 'search-plus','search-minus' => 'search-minus','power-off' => 'power-off','signal' => 'signal','gear' => 'gear','cog' => 'cog','trash-o' => 'trash-o','home' => 'home','file-o' => 'file-o','clock-o' => 'clock-o','road' => 'road','download' => 'download','arrow-circle-o-down' => 'arrow-circle-o-down','arrow-circle-o-up' => 'arrow-circle-o-up','inbox' => 'inbox','play-circle-o' => 'play-circle-o','rotate-right' => 'rotate-right','repeat' => 'repeat','refresh' => 'refresh','list-alt' => 'list-alt','lock' => 'lock','flag' => 'flag','headphones' => 'headphones','volume-off' => 'volume-off','volume-down' => 'volume-down','volume-up' => 'volume-up','qrcode' => 'qrcode','barcode' => 'barcode','tag' => 'tag','tags' => 'tags','book' => 'book','bookmark' => 'bookmark','print' => 'print','camera' => 'camera','font' => 'font','bold' => 'bold','italic' => 'italic','text-height' => 'text-height','text-width' => 'text-width','align-left' => 'align-left','align-center' => 'align-center','align-right' => 'align-right','align-justify' => 'align-justify','list' => 'list','dedent' => 'dedent','outdent' => 'outdent','indent' => 'indent','video-camera' => 'video-camera','photo' => 'photo','image' => 'image','picture-o' => 'picture-o','pencil' => 'pencil','map-marker' => 'map-marker','adjust' => 'adjust','tint' => 'tint','edit' => 'edit','pencil-square-o' => 'pencil-square-o','share-square-o' => 'share-square-o','check-square-o' => 'check-square-o','arrows' => 'arrows','step-backward' => 'step-backward','fast-backward' => 'fast-backward','backward' => 'backward','play' => 'play','pause' => 'pause','stop' => 'stop','forward' => 'forward','fast-forward' => 'fast-forward','step-forward' => 'step-forward','eject' => 'eject','chevron-left' => 'chevron-left','chevron-right' => 'chevron-right','plus-circle' => 'plus-circle','minus-circle' => 'minus-circle','times-circle' => 'times-circle','check-circle' => 'check-circle','question-circle' => 'question-circle','info-circle' => 'info-circle','crosshairs' => 'crosshairs','times-circle-o' => 'times-circle-o','check-circle-o' => 'check-circle-o','ban' => 'ban','arrow-left' => 'arrow-left','arrow-right' => 'arrow-right','arrow-up' => 'arrow-up','arrow-down' => 'arrow-down','mail-forward' => 'mail-forward','share' => 'share','expand' => 'expand','compress' => 'compress','plus' => 'plus','minus' => 'minus','asterisk' => 'asterisk','exclamation-circle' => 'exclamation-circle','gift' => 'gift','leaf' => 'leaf','fire' => 'fire','eye' => 'eye','eye-slash' => 'eye-slash','warning' => 'warning','exclamation-triangle' => 'exclamation-triangle','plane' => 'plane','calendar' => 'calendar','random' => 'random','comment' => 'comment','magnet' => 'magnet','chevron-up' => 'chevron-up','chevron-down' => 'chevron-down','retweet' => 'retweet','shopping-cart' => 'shopping-cart','folder' => 'folder','folder-open' => 'folder-open','arrows-v' => 'arrows-v','arrows-h' => 'arrows-h','bar-chart-o' => 'bar-chart-o','bar-chart' => 'bar-chart','twitter-square' => 'twitter-square','facebook-square' => 'facebook-square','camera-retro' => 'camera-retro','key' => 'key','gears' => 'gears','cogs' => 'cogs','comments' => 'comments','thumbs-o-up' => 'thumbs-o-up','thumbs-o-down' => 'thumbs-o-down','star-half' => 'star-half','heart-o' => 'heart-o','sign-out' => 'sign-out','linkedin-square' => 'linkedin-square','thumb-tack' => 'thumb-tack','external-link' => 'external-link','sign-in' => 'sign-in','trophy' => 'trophy','github-square' => 'github-square','upload' => 'upload','lemon-o' => 'lemon-o','phone' => 'phone','square-o' => 'square-o','bookmark-o' => 'bookmark-o','phone-square' => 'phone-square','twitter' => 'twitter','facebook' => 'facebook','github' => 'github','unlock' => 'unlock','credit-card' => 'credit-card','rss' => 'rss','hdd-o' => 'hdd-o','bullhorn' => 'bullhorn','bell' => 'bell','certificate' => 'certificate','hand-o-right' => 'hand-o-right','hand-o-left' => 'hand-o-left','hand-o-up' => 'hand-o-up','hand-o-down' => 'hand-o-down','arrow-circle-left' => 'arrow-circle-left','arrow-circle-right' => 'arrow-circle-right','arrow-circle-up' => 'arrow-circle-up','arrow-circle-down' => 'arrow-circle-down','globe' => 'globe','wrench' => 'wrench','tasks' => 'tasks','filter' => 'filter','briefcase' => 'briefcase','arrows-alt' => 'arrows-alt','group' => 'group','users' => 'users','chain' => 'chain','link' => 'link','cloud' => 'cloud','flask' => 'flask','cut' => 'cut','scissors' => 'scissors','copy' => 'copy','files-o' => 'files-o','paperclip' => 'paperclip','save' => 'save','floppy-o' => 'floppy-o','square' => 'square','navicon' => 'navicon','reorder' => 'reorder','bars' => 'bars','list-ul' => 'list-ul','list-ol' => 'list-ol','strikethrough' => 'strikethrough','underline' => 'underline','table' => 'table','magic' => 'magic','truck' => 'truck','pinterest' => 'pinterest','pinterest-square' => 'pinterest-square','google-plus-square' => 'google-plus-square','google-plus' => 'google-plus','money' => 'money','caret-down' => 'caret-down','caret-up' => 'caret-up','caret-left' => 'caret-left','caret-right' => 'caret-right','columns' => 'columns','unsorted' => 'unsorted','sort' => 'sort','sort-down' => 'sort-down','sort-desc' => 'sort-desc','sort-up' => 'sort-up','sort-asc' => 'sort-asc','envelope' => 'envelope','linkedin' => 'linkedin','rotate-left' => 'rotate-left','undo' => 'undo','legal' => 'legal','gavel' => 'gavel','dashboard' => 'dashboard','tachometer' => 'tachometer','comment-o' => 'comment-o','comments-o' => 'comments-o','flash' => 'flash','bolt' => 'bolt','sitemap' => 'sitemap','umbrella' => 'umbrella','paste' => 'paste','clipboard' => 'clipboard','lightbulb-o' => 'lightbulb-o','exchange' => 'exchange','cloud-download' => 'cloud-download','cloud-upload' => 'cloud-upload','user-md' => 'user-md','stethoscope' => 'stethoscope','suitcase' => 'suitcase','bell-o' => 'bell-o','coffee' => 'coffee','cutlery' => 'cutlery','file-text-o' => 'file-text-o','building-o' => 'building-o','hospital-o' => 'hospital-o','ambulance' => 'ambulance','medkit' => 'medkit','fighter-jet' => 'fighter-jet','beer' => 'beer','h-square' => 'h-square','plus-square' => 'plus-square','angle-double-left' => 'angle-double-left','angle-double-right' => 'angle-double-right','angle-double-up' => 'angle-double-up','angle-double-down' => 'angle-double-down','angle-left' => 'angle-left','angle-right' => 'angle-right','angle-up' => 'angle-up','angle-down' => 'angle-down','desktop' => 'desktop','laptop' => 'laptop','tablet' => 'tablet','mobile-phone' => 'mobile-phone','mobile' => 'mobile','circle-o' => 'circle-o','quote-left' => 'quote-left','quote-right' => 'quote-right','spinner' => 'spinner','circle' => 'circle','mail-reply' => 'mail-reply','reply' => 'reply','github-alt' => 'github-alt','folder-o' => 'folder-o','folder-open-o' => 'folder-open-o','smile-o' => 'smile-o','frown-o' => 'frown-o','meh-o' => 'meh-o','gamepad' => 'gamepad','keyboard-o' => 'keyboard-o','flag-o' => 'flag-o','flag-checkered' => 'flag-checkered','terminal' => 'terminal','code' => 'code','mail-reply-all' => 'mail-reply-all','reply-all' => 'reply-all','star-half-empty' => 'star-half-empty','star-half-full' => 'star-half-full','star-half-o' => 'star-half-o','location-arrow' => 'location-arrow','crop' => 'crop','code-fork' => 'code-fork','unlink' => 'unlink','chain-broken' => 'chain-broken','question' => 'question','info' => 'info','exclamation' => 'exclamation','superscript' => 'superscript','subscript' => 'subscript','eraser' => 'eraser','puzzle-piece' => 'puzzle-piece','microphone' => 'microphone','microphone-slash' => 'microphone-slash','shield' => 'shield','calendar-o' => 'calendar-o','fire-extinguisher' => 'fire-extinguisher','rocket' => 'rocket','maxcdn' => 'maxcdn','chevron-circle-left' => 'chevron-circle-left','chevron-circle-right' => 'chevron-circle-right','chevron-circle-up' => 'chevron-circle-up','chevron-circle-down' => 'chevron-circle-down','html5' => 'html5','css3' => 'css3','anchor' => 'anchor','unlock-alt' => 'unlock-alt','bullseye' => 'bullseye','ellipsis-h' => 'ellipsis-h','ellipsis-v' => 'ellipsis-v','rss-square' => 'rss-square','play-circle' => 'play-circle','ticket' => 'ticket','minus-square' => 'minus-square','minus-square-o' => 'minus-square-o','level-up' => 'level-up','level-down' => 'level-down','check-square' => 'check-square','pencil-square' => 'pencil-square','external-link-square' => 'external-link-square','share-square' => 'share-square','compass' => 'compass','toggle-down' => 'toggle-down','caret-square-o-down' => 'caret-square-o-down','toggle-up' => 'toggle-up','caret-square-o-up' => 'caret-square-o-up','toggle-right' => 'toggle-right','caret-square-o-right' => 'caret-square-o-right','euro' => 'euro','eur' => 'eur','gbp' => 'gbp','dollar' => 'dollar','usd' => 'usd','rupee' => 'rupee','inr' => 'inr','cny' => 'cny','rmb' => 'rmb','yen' => 'yen','jpy' => 'jpy','ruble' => 'ruble','rouble' => 'rouble','rub' => 'rub','won' => 'won','krw' => 'krw','bitcoin' => 'bitcoin','btc' => 'btc','file' => 'file','file-text' => 'file-text','sort-alpha-asc' => 'sort-alpha-asc','sort-alpha-desc' => 'sort-alpha-desc','sort-amount-asc' => 'sort-amount-asc','sort-amount-desc' => 'sort-amount-desc','sort-numeric-asc' => 'sort-numeric-asc','sort-numeric-desc' => 'sort-numeric-desc','thumbs-up' => 'thumbs-up','thumbs-down' => 'thumbs-down','youtube-square' => 'youtube-square','youtube' => 'youtube','xing' => 'xing','xing-square' => 'xing-square','youtube-play' => 'youtube-play','dropbox' => 'dropbox','stack-overflow' => 'stack-overflow','instagram' => 'instagram','flickr' => 'flickr','adn' => 'adn','bitbucket' => 'bitbucket','bitbucket-square' => 'bitbucket-square','tumblr' => 'tumblr','tumblr-square' => 'tumblr-square','long-arrow-down' => 'long-arrow-down','long-arrow-up' => 'long-arrow-up','long-arrow-left' => 'long-arrow-left','long-arrow-right' => 'long-arrow-right','apple' => 'apple','windows' => 'windows','android' => 'android','linux' => 'linux','dribbble' => 'dribbble','skype' => 'skype','foursquare' => 'foursquare','trello' => 'trello','female' => 'female','male' => 'male','gittip' => 'gittip','sun-o' => 'sun-o','moon-o' => 'moon-o','archive' => 'archive','bug' => 'bug','vk' => 'vk','weibo' => 'weibo','renren' => 'renren','pagelines' => 'pagelines','stack-exchange' => 'stack-exchange','arrow-circle-o-right' => 'arrow-circle-o-right','arrow-circle-o-left' => 'arrow-circle-o-left','toggle-left' => 'toggle-left','caret-square-o-left' => 'caret-square-o-left','dot-circle-o' => 'dot-circle-o','wheelchair' => 'wheelchair','vimeo-square' => 'vimeo-square','turkish-lira' => 'turkish-lira','try' => 'try','plus-square-o' => 'plus-square-o','space-shuttle' => 'space-shuttle','slack' => 'slack','envelope-square' => 'envelope-square','wordpress' => 'wordpress','openid' => 'openid','institution' => 'institution','bank' => 'bank','university' => 'university','mortar-board' => 'mortar-board','graduation-cap' => 'graduation-cap','yahoo' => 'yahoo','google' => 'google','reddit' => 'reddit','reddit-square' => 'reddit-square','stumbleupon-circle' => 'stumbleupon-circle','stumbleupon' => 'stumbleupon','delicious' => 'delicious','digg' => 'digg','pied-piper' => 'pied-piper','pied-piper-alt' => 'pied-piper-alt','drupal' => 'drupal','joomla' => 'joomla','language' => 'language','fax' => 'fax','building' => 'building','child' => 'child','paw' => 'paw','spoon' => 'spoon','cube' => 'cube','cubes' => 'cubes','behance' => 'behance','behance-square' => 'behance-square','steam' => 'steam','steam-square' => 'steam-square','recycle' => 'recycle','automobile' => 'automobile','car' => 'car','cab' => 'cab','taxi' => 'taxi','tree' => 'tree','spotify' => 'spotify','deviantart' => 'deviantart','soundcloud' => 'soundcloud','database' => 'database','file-pdf-o' => 'file-pdf-o','file-word-o' => 'file-word-o','file-excel-o' => 'file-excel-o','file-powerpoint-o' => 'file-powerpoint-o','file-photo-o' => 'file-photo-o','file-picture-o' => 'file-picture-o','file-image-o' => 'file-image-o','file-zip-o' => 'file-zip-o','file-archive-o' => 'file-archive-o','file-sound-o' => 'file-sound-o','file-audio-o' => 'file-audio-o','file-movie-o' => 'file-movie-o','file-video-o' => 'file-video-o','file-code-o' => 'file-code-o','vine' => 'vine','codepen' => 'codepen','jsfiddle' => 'jsfiddle','life-bouy' => 'life-bouy','life-buoy' => 'life-buoy','life-saver' => 'life-saver','support' => 'support','life-ring' => 'life-ring','circle-o-notch' => 'circle-o-notch','ra' => 'ra','rebel' => 'rebel','ge' => 'ge','empire' => 'empire','git-square' => 'git-square','git' => 'git','hacker-news' => 'hacker-news','tencent-weibo' => 'tencent-weibo','qq' => 'qq','wechat' => 'wechat','weixin' => 'weixin','send' => 'send','paper-plane' => 'paper-plane','send-o' => 'send-o','paper-plane-o' => 'paper-plane-o','history' => 'history','circle-thin' => 'circle-thin','header' => 'header','paragraph' => 'paragraph','sliders' => 'sliders','share-alt' => 'share-alt','share-alt-square' => 'share-alt-square','bomb' => 'bomb','soccer-ball-o' => 'soccer-ball-o','futbol-o' => 'futbol-o','tty' => 'tty','binoculars' => 'binoculars','plug' => 'plug','slideshare' => 'slideshare','twitch' => 'twitch','yelp' => 'yelp','newspaper-o' => 'newspaper-o','wifi' => 'wifi','calculator' => 'calculator','paypal' => 'paypal','google-wallet' => 'google-wallet','cc-visa' => 'cc-visa','cc-mastercard' => 'cc-mastercard','cc-discover' => 'cc-discover','cc-amex' => 'cc-amex','cc-paypal' => 'cc-paypal','cc-stripe' => 'cc-stripe','bell-slash' => 'bell-slash','bell-slash-o' => 'bell-slash-o','trash' => 'trash','copyright' => 'copyright','at' => 'at','eyedropper' => 'eyedropper','paint-brush' => 'paint-brush','birthday-cake' => 'birthday-cake','area-chart' => 'area-chart','pie-chart' => 'pie-chart','line-chart' => 'line-chart','lastfm' => 'lastfm','lastfm-square' => 'lastfm-square','toggle-off' => 'toggle-off','toggle-on' => 'toggle-on','bicycle' => 'bicycle','bus' => 'bus','ioxhost' => 'ioxhost','angellist' => 'angellist','cc' => 'cc','shekel' => 'shekel','sheqel' => 'sheqel','ils' => 'ils','meanpath' => 'meanpath', );
        asort( $icons );
        return $icons;
    }

}
