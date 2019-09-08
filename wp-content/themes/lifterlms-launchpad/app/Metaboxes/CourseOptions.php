<?php

namespace LaunchPad\Metaboxes;

use SkyLab\Metaboxes\Metabox;
use LaunchPad\ThemeLayout\LayoutSettings;

class CourseOptions extends Metabox
{
    public function __construct()
    {
        $this->id = 'course_settings';
        $this->title = 'Course Settings';
        $this->context = 'normal';
        $this->priority = 'high';
        $this->screens = [
            'course'
        ];

        $this->init();
    }

    public function get_fields()
    {
        return [

            [
                'type'      => 'sectionstart',
                'id'        => 'course_options',
                'class'     =>'top'
            ],

            [
                'title'     => __( 'Course Settings', 'lifterlms-launchpad' ),
                'type'      => 'title',
                'desc'      => 'Manage Course Options',
                'id'        => 'course_options'
            ],

            [
                'title'     => __( 'Course Excerpt', 'lifterlms-launchpad' ),
                'desc' 		=> __( 'Displays on course archive tile.', 'lifterlms-launchpad' ),
                'id' 		=> 'launchpad_course_excerpt',
                'type' 		=> 'wysiwyg',
                'default'	=> '',
                'desc_tip'	=> true,
                'sanitize_field' => false
            ],

            [
                'type' => 'sectionend',
                'id' => 'layout_options'
            ]
        ];
    }

}
