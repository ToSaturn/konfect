<?php

namespace LaunchPad\ThemeActions;

use SkyLab\Templating\Template;

class Account {

    public function __construct() {

        if ( ! is_lifterlms_enabled() ) {
            return;
        }

        if ( version_compare( '3.14.0', LLMS()->version, '<=' ) ) {

            add_action( 'lifterlms_before_student_dashboard_tab',  array( $this, 'output_account_greeting' ) );

        } else {

            add_filter('lifterlms_account_greeting', array( $this, 'get_account_greeting') );

        }

        add_filter('lifterlms_my_account_navigation_link_separator', array( $this, 'get_account_sub_nav_link_seperator') );
        add_filter('lifterlms_my_courses_title', array( $this, 'get_account_courses_tile_title') );
        add_filter('lifterlms_my_certificates_title', array( $this, 'get_account_certificates_tile_title') );
        add_filter('lifterlms_my_achievements_title', array( $this, 'get_account_achievements_tile_title') );
        add_filter('lifterlms_my_memberships_title', array( $this, 'get_account_memberships_tile_title') );
        add_filter('lifterlms_my_courses_enrollment_status_html', array( $this, 'hide_course_enrollment_status') );
        add_filter('lifterlms_my_courses_start_date_html', array( $this, 'hide_course_start_date') );
        add_filter('lifterlms_my_courses_course_button_text', array( $this, 'get_course_button_text') );

    }

    public function get_account_greeting( $greeting = '' )
    {
        $custom_greeting = get_option('launchpad_settings_account_greeting');

        if ($custom_greeting)
        {
            $greeting = $custom_greeting;
        }

        return $greeting;
    }

    public function output_account_greeting() {

        echo wpautop( $this->get_account_greeting() );

    }

    public function get_account_sub_nav_link_seperator($seperator)
    {
        $custom_seperator = get_option('launchpad_settings_account_sub_nav_link_seperator');

        if ($custom_seperator)
        {
            $seperator = $custom_seperator;
        }

        return $seperator;
    }

    public function get_account_courses_tile_title($title)
    {
        $custom_title = get_option('launchpad_settings_account_courses_tile_title');

        if ($custom_title)
        {
            $title = $custom_title;
        }

        return $title;
    }

    public function get_account_certificates_tile_title($title)
    {
        $custom_title = get_option('launchpad_settings_account_certificates_tile_title');

        if ($custom_title)
        {
            $title = $custom_title;
        }

        return $title;
    }

    public function get_account_achievements_tile_title($title)
    {
        $custom_title = get_option('launchpad_settings_account_achievements_tile_title');

        if ($custom_title)
        {
            $title = $custom_title;
        }

        return $title;
    }

    public function get_account_memberships_tile_title($title)
    {
        $custom_title = get_option('launchpad_settings_account_memberships_tile_title');

        if ($custom_title)
        {
            $title = $custom_title;
        }

        return $title;
    }

    public function hide_course_enrollment_status($html)
    {
        if (get_option('launchpad_settings_account_hide_enrollment_status') === 'yes')
        {
            $html = '';
        }

        return $html;
    }

    public function hide_course_start_date($html)
    {
        if (get_option('launchpad_settings_account_course_hide_start_date') === 'yes')
        {
            $html = '';
        }

        return $html;
    }

    public function get_course_button_text($text)
    {
        $custom_text = get_option('launchpad_settings_account_course_button_text');

        if ($custom_text)
        {
            $text = $custom_text;
        }

        return $text;
    }

}