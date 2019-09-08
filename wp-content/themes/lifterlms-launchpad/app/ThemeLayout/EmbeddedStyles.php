<?php

namespace LaunchPad\ThemeLayout;

use SkyLab\Templating\Template;

class EmbeddedStyles
{
    /**
     * Options array
     *
     * @var array
     */
    private $options = [];

    public $font_families;
    public $header_background_image;
    public $header_background_image_position_x;
    public $header_background_image_position_y;
    public $header_background_image_repeat;
    public $header_background_color;
    public $logo_width;
    public $logo_distance_top_header;
    public $menu_distance_top_header;
    public $padding_top_header;
    public $padding_bottom_header;
    public $padding_right_header;
    public $padding_left_header;
    public $font_size_h1;
    public $font_size_h2;
    public $font_size_h3;
    public $font_size_h4;
    public $font_size_h5;
    public $font_size_h6;
    public $font_size_p;
    public $font_size_li;
    public $font_size_site_title;
    public $font_color_h1;
    public $font_color_h2;
    public $font_color_h3;
    public $font_color_h4;
    public $font_color_h5;
    public $font_color_h6;
    public $font_color_site_title;
    public $font_color_site_description;
    public $font_color_main_menu;
    public $hover_color_main_menu;
	public $font_color_main_submenu;
	public $hover_color_main_submenu;
	public $bg_color_main_submenu;
	public $bghover_color_main_submenu;
	public $border_color_main_submenu;
	public $border_width_main_submenu;
    public $font_size_main_menu;
    public $font_weight_main_menu;
    public $font_weight_course_title;
    public $text_distance_main_menu;
	public $font_color_mobile_menu;
	public $font_size_mobile_menu;
	public $bg_color_mobile_menu;
    public $font_color_body;
    public $font_color_breadcrumb;
    public $font_color_breadcrumb_separator_icon;
    public $font_color_breadcrumb_current_page;
    public $background_color_breadcrumbs;
    public $background_color_footer;
    public $font_color_primary_link;
    public $font_color_primary_link_hover;
    public $background_color_button_primary;
    public $border_color_button_primary;
    public $font_color_button_primary;
    public $background_color_button_primary_hover;
    public $border_color_button_primary_hover;
    public $font_color_button_primary_hover;
    public $padding_top_button;
    public $padding_bottom_button;
    public $padding_right_button;
    public $padding_left_button;
    public $lifterlms_background_color_product_tile;
    public $lifterlms_border_color_product_tile;
    public $lifterlms_padding_top_product_tile;
    public $lifterlms_padding_bottom_product_tile;
    public $lifterlms_padding_right_product_tile;
    public $lifterlms_padding_left_product_tile;
    public $lifterlms_boxshadow_offset_x_product_tile;
    public $lifterlms_boxshadow_offset_y_product_tile;
    public $lifterlms_boxshadow_blur_product_tile;
    public $lifterlms_boxshadow_spread_product_tile;
    public $lifterlms_text_align_product_tile;
    public $lifterlms_border_radius_product_tile;
    public $lifterlms_boxshadow_color_product_tile;
    public $lifterlms_background_color_hover_product_tile;
    public $lifterlms_padding_top_product_tile_footer;
    public $lifterlms_padding_bottom_product_tile_footer;
    public $lifterlms_padding_right_product_tile_footer;
    public $lifterlms_padding_left_product_tile_footer;
    public $lifterlms_margin_top_product_tile_footer;
    public $lifterlms_margin_bottom_product_tile_footer;
    public $lifterlms_margin_right_product_tile_footer;
    public $lifterlms_margin_left_product_tile_footer;
    public $lifterlms_border_width_product_tile;
    public $lifterlms_border_width_product_tile_footer;
    public $lifterlms_border_color_product_tile_footer;
    public $lifterlms_font_size_product_tile_title;
    public $lifterlms_font_size_product_tile_metas;
    public $lifterlms_margin_bottom_product_tile_image;
    public $lifterlms_font_color_product_tile_title;
    public $lifterlms_font_color_product_tile_title_hover;
    public $lifterlms_font_color_product_tile_metas;
    public $lifterlms_border_color_checkout_form;
    public $lifterlms_border_width_checkout_form;
    public $lifterlms_border_radius_top_left_checkout_form;
    public $lifterlms_border_radius_top_right_checkout_form;
    public $lifterlms_border_radius_bottom_left_checkout_form;
    public $lifterlms_border_radius_bottom_right_checkout_form;
    public $lifterlms_font_color_checkout_form_title;
    public $lifterlms_background_color_checkout_form_title;
    public $lifterlms_font_size_checkout_title;
    public $lifterlms_font_size_course_title;
    public $lifterlms_font_color_course_title;
    public $lifterlms_text_alignment_course_syllabus_title;
    public $lifterlms_font_size_course_syllabus_title;
    public $lifterlms_font_color_course_syllabus_title;
    public $lifterlms_margin_top_lesson_preview;
    public $lifterlms_margin_bottom_lesson_preview;
    public $lifterlms_margin_right_lesson_preview;
    public $lifterlms_margin_left_lesson_preview;
    public $lifterlms_width_lesson_preview;
    public $lifterlms_background_color_lesson_preview;
    public $lifterlms_border_width_lesson_preview;
    public $lifterlms_border_color_lesson_preview;
    public $lifterlms_background_color_lesson_preview_hover;
    public $lifterlms_border_width_lesson_preview_hover;
    public $lifterlms_border_color_lesson_preview_hover;
    public $lifterlms_padding_top_lesson_preview;
    public $lifterlms_padding_bottom_lesson_preview;
    public $lifterlms_padding_right_lesson_preview;
    public $lifterlms_padding_left_lesson_preview;
    public $lifterlms_boxshadow_offset_x_lesson_preview;
    public $lifterlms_boxshadow_offset_y_lesson_preview;
    public $lifterlms_boxshadow_blur_lesson_preview;
    public $lifterlms_boxshadow_spread_lesson_preview;
    public $lifterlms_boxshadow_color_lesson_preview;
    public $lifterlms_font_size_lesson_preview_title;
    public $lifterlms_font_color_lesson_preview_title;
    public $lifterlms_font_size_lesson_preview_count;
    public $lifterlms_font_color_lesson_preview_count;
    public $lifterlms_font_size_lesson_preview_excerpt;
    public $lifterlms_font_color_lesson_preview_excerpt;
    public $lifterlms_margin_bottom_lesson_preview_excerpt;
    public $lifterlms_hide_lesson_count_lesson_preview;
    public $lifterlms_hide_course_featured_image;
    public $lifterlms_border_radius_lesson_preview;
    public $lifterlms_background_color_lesson_preview_disabled;
    public $lifterlms_background_color_lesson_preview_disabled_hover;
    public $lifterlms_icon_lesson_complete;
    public $lifterlms_background_color_lesson_complete;
    public $lifterlms_font_size_lesson_complete;
    public $lifterlms_width_lesson_complete;
    public $lifterlms_height_lesson_complete;
    public $lifterlms_right_border_width_lesson_complete;
    public $lifterlms_right_border_color_lesson_complete;
    public $lifterlms_left_border_width_lesson_complete;
    public $lifterlms_left_border_color_lesson_complete;
    public $lifterlms_background_color_course_progress;
    public $lifterlms_background_color_course_progress_completed;
    public $lifterlms_background_color_lesson_complete_placeholder;
    public $lifterlms_account_greeting;
    public $side_by_side_login_registration;
    public $lifterlms_text_alignment_account_sub_nav;
    public $lifterlms_margin_top_account_sub_nav;
    public $lifterlms_margin_bottom_account_sub_nav;
    public $lifterlms_margin_right_account_sub_nav;
    public $lifterlms_margin_left_account_sub_nav;
    public $lifterlms_padding_top_account_sub_nav;
    public $lifterlms_padding_bottom_account_sub_nav;
    public $lifterlms_padding_right_account_sub_nav;
    public $lifterlms_padding_left_account_sub_nav;
    public $lifterlms_font_size_account_sub_nav;
    public $lifterlms_font_color_sub_nav;
    public $lifterlms_border_width_account_sub_nav;
    public $lifterlms_border_color_sub_nav;
    public $lifterlms_border_radius_account_sub_nav;
    public $lifterlms_account_sub_nav_link_seperator;
    public $lifterlms_account_courses_tile_title;
    public $lifterlms_account_certificates_tile_title;
    public $lifterlms_account_achievements_tile_title;
    public $lifterlms_account_memberships_tile_title;
    public $lifterlms_background_color_account_course_tile_title;
    public $lifterlms_background_color_account_certificate_tile_title;
    public $lifterlms_background_color_account_achievement_tile_title;
    public $lifterlms_background_color_account_membership_tile_title;
    public $lifterlms_background_color_account_tile;
    public $lifterlms_font_size_account_tile_title;
    public $lifterlms_font_color_account_tile_title;
    public $lifterlms_margin_top_account_tile_title;
    public $lifterlms_margin_bottom_account_tile_title;
    public $lifterlms_margin_right_account_tile_title;
    public $lifterlms_margin_left_account_tile_title;
    public $lifterlms_padding_top_account_tile_title;
    public $lifterlms_padding_bottom_account_tile_title;
    public $lifterlms_padding_right_account_tile_title;
    public $lifterlms_padding_left_account_tile_title;
    public $lifterlms_margin_top_account_tile;
    public $lifterlms_margin_bottom_account_tile;
    public $lifterlms_margin_right_account_tile;
    public $lifterlms_margin_left_account_tile;
    public $lifterlms_padding_top_account_tile;
    public $lifterlms_padding_bottom_account_tile;
    public $lifterlms_padding_right_account_tile;
    public $lifterlms_padding_left_account_tile;
    public $lifterlms_border_width_account_tile;
    public $lifterlms_border_color_tile;
    public $lifterlms_border_radius_account_tile;
    public $lifterlms_margin_top_account_course_item;
    public $lifterlms_margin_bottom_account_course_item;
    public $lifterlms_margin_right_account_course_item;
    public $lifterlms_margin_left_account_course_item;
    public $lifterlms_padding_top_account_course_item;
    public $lifterlms_padding_bottom_account_course_item;
    public $lifterlms_padding_right_account_course_item;
    public $lifterlms_padding_left_account_course_item;
    public $lifterlms_border_width_account_course_item;
    public $lifterlms_border_color_account_course_item;
    public $lifterlms_border_radius_account_course_item;
    public $lifterlms_margin_top_account_course_image;
    public $lifterlms_margin_bottom_account_course_image;
    public $lifterlms_margin_right_account_course_image;
    public $lifterlms_margin_left_account_course_image;
    public $lifterlms_padding_top_account_course_image;
    public $lifterlms_padding_bottom_account_course_image;
    public $lifterlms_padding_right_account_course_image;
    public $lifterlms_padding_left_account_course_image;
    public $lifterlms_border_width_account_course_image;
    public $lifterlms_border_color_account_course_image;
    public $lifterlms_border_radius_top_left_account_course_image;
    public $lifterlms_border_radius_top_right_account_course_image;
    public $lifterlms_border_radius_bottom_left_account_course_image;
    public $lifterlms_border_radius_bottom_right_account_course_image;
    public $lifterlms_width_account_course_image;
    public $lifterlms_account_hide_enrollment_status;
    public $lifterlms_font_size_account_course_enrollment_status;
    public $lifterlms_account_course_hide_start_date;
    public $lifterlms_font_size_account_course_start_date;
    public $lifterlms_font_size_account_course_title;
    public $lifterlms_font_size_account_course_author;
    public $lifterlms_account_course_button_text;
    public $lifterlms_boxshadow_offset_x_course_item;
    public $lifterlms_boxshadow_offset_y_course_item;
    public $lifterlms_boxshadow_blur_course_item;
    public $lifterlms_boxshadow_spread_course_item;
    public $lifterlms_boxshadow_color_course_item;
    public $lifterlms_auto_width_account_course_image;
    public $padding_top_footer;
    public $padding_bottom_footer;
    public $padding_right_footer;
    public $padding_left_footer;
    public $footer_font_color;
    public $footer_widget_title_font_color;
    public $footer_link_color;
    public $footer_link_hover_color;
    public $font_color_site_info;
    public $link_color_site_info;
    public $link_hover_color_site_info;
    public $background_color_site_info;
    public $padding_top_site_info;
    public $padding_bottom_site_info;
    public $padding_right_site_info;
    public $padding_left_site_info;
    public $width_container;
    public $margin_top_container;
    public $margin_bottom_container;
    public $margin_top_product_tile_title;
    public $margin_bottom_product_tile_title;
    public $margin_right_product_tile_title;
    public $margin_left_product_tile_title;
    public $padding_top_product_tile_metas;
    public $padding_bottom_product_tile_metas;
    public $padding_right_product_tile_metas;
    public $padding_left_product_tile_metas;
    public $margin_top_lesson_preview_title;
    public $margin_bottom_lesson_preview_title;
    public $margin_right_lesson_preview_title;
    public $margin_left_lesson_preview_title;
    public $margin_top_lesson_preview_complete;
    public $margin_bottom_lesson_preview_complete;
    public $margin_right_lesson_preview_complete;
    public $margin_left_lesson_preview_complete;
    public $padding_top_lesson_preview_complete;
    public $padding_bottom_lesson_preview_complete;
    public $padding_right_lesson_preview_complete;
    public $padding_left_lesson_preview_complete;


    public $background_color_secondary_button;
    public $font_color_secondary_button;
    public $border_color_secondary_button;
    public $background_color_secondary_button_hover;
    public $font_color_secondary_button_hover;
    public $border_color_secondary_button_hover;
    public $padding_top_secondary_button;
    public $padding_bottom_secondary_button;
    public $padding_right_secondary_button;
    public $padding_left_secondary_button;

    public $font_size_meta_title;
    public $font_color_meta_title;
    public $font_size_meta_info;
    public $font_color_meta_info;
    public $meta_title_margin_top;
    public $meta_title_margin_bottom;
    public $meta_title_margin_left;
    public $meta_title_margin_right;

    public $access_plan_bg_color;
    public $access_plan_button_bg_color;
    public $access_plan_button_hover_bg_color;
    public $access_plan_button_font_color;
    public $access_plan_button_hover_font_color;
    public $access_plan_button_border_color;
    public $access_plan_button_hover_border_color;
    public $access_plan_title_bg_color;
    public $access_plan_title_text_color;
    public $access_plan_title_text_size;
    public $access_plan_featured_bg_color;
    public $access_plan_text_color;
    public $access_plan_featured_text_color;
    public $access_plan_featured_border_size;
    public $access_plan_featured_border_color;
    public $access_plan_price_text_color;
    public $access_plan_price_text_size;
    public $access_plan_stamp_bg_color;
    public $access_plan_stamp_text_color;

    public $border_color_instructors;
    public $font_size_instructor_name;
    public $font_color_instructor_name;
    public $font_size_instructor_label;
    public $font_color_instructor_label;


    /**
     * Output template
     *
     * @return mixed
     */
    public function output()
    {
        $this->get_settings();

        global $content_width;
        if ( ! isset( $content_width ) ) {
            $content_width = $this->width_container;
        }

        $view = (new Template)->get('view.embeddedstyles.php', $this);
        // make it into one long line
        $view = str_replace( array("\n","\r"), '', $view );
        // replace all multiple spaces by one space
        $view = preg_replace( '!\s+!', ' ', $view );
        // replace some unneeded spaces, modify as needed
        $view = str_replace( array(' {', ' }', '{ ', '; ' ), array( '{', '}', '{', ';' ), $view );
        return $view;
    }

    /**
     * Get Font Info
     * Builds an array of font info to build out the font family
     * and google http request if necessary
     *
     * @param $font
     * @return array
     */
    private function get_font_info($font)
    {
        $response = [
            'font_type' => 'os'
            , 'font_name' => 'Arial'
            , 'font_family' => 'Arial, sans-serif'
        ];

        if ($font)
        {
            $font_info = explode('_', $font);

            $response = [];

            if (count($font_info) > 1)
            {
                $font_family_array = explode(',', $font_info[1]);
                $font_family_array[0] = '"' . $font_family_array[0] . '"';
                $font_family = implode(',', $font_family_array);
                $response['font_type'] = $font_info[0];
                $font_names = explode(', ', $font_info[1]);
                $response['font_name'] = str_replace(' ', '+',$font_names[0]);
                $response['font_family'] = $font_family;
            }
            else
            {
                $response['font_type'] = 'os';
                $font_names = explode(', ', $font_info[0]);
                $response['font_name'] = str_replace(' ', '+',$font_names[0]);
                $response['font_family'] = $font_info[0];
            }
        }

        return $response;
    }

    /**
     * Get All Options
     * Sets the variable $options with all options from the database that start with %lifterlms_settings%
     */
    private function get_options()
    {
        global $wpdb;

        $table = $wpdb->prefix . 'options';

        $results = $wpdb->get_results( 'SELECT * FROM ' . $table . ' WHERE option_name LIKE "%launchpad_settings%";', OBJECT );

        if ($results)
        {
            foreach ($results as $result)
            {
                $this->options[$result->option_name] = $result->option_value;
            }
        }

    }

    /**
     * Get Option Call
     * Looks for the option in the options array
     * If no matching key is found it returns false
     *
     * @param $meta_key
     * @return mixed
     */
    private function get_option( $meta_key ) {
        if ( isset( $this->options[ $meta_key ] ) ) {
            return $this->options[ $meta_key ];
        }

        return false;
    }

    /**
     * Get Settings
     * Calls get_option on all settings keys to set all style variables
     */
    public function get_settings()
    {
        $this->get_options();

        $this->google_font_families = '';

        $this->font_families = [
            'body'        => $this->get_font_info($this->get_option('launchpad_settings_font_family_body'))
            , 'headings'    => $this->get_font_info($this->get_option('launchpad_settings_font_family_headings'))
            , 'menu'        => $this->get_font_info($this->get_option('launchpad_settings_font_family_menu_link'))
        ];

        $this->header_background_image                                      = $this->get_option('launchpad_settings_background_image');
        $this->header_background_image_position_x                           = $this->get_option('launchpad_settings_header_background_image_position_x');
        $this->header_background_image_position_y                           = $this->get_option('launchpad_settings_header_background_image_position_y');
        $this->header_background_image_repeat                               = $this->get_option('launchpad_settings_header_background_image_repeat');
        $this->header_background_color                                      = $this->get_option('launchpad_settings_header_background_color');
        $this->logo_width                                                   = $this->get_option('launchpad_settings_logo_width');
        $this->logo_distance_top_header                                     = $this->get_option('launchpad_settings_logo_distance_top_header');
        $this->menu_distance_top_header                                     = $this->get_option('launchpad_settings_menu_distance_top_header');
        $this->padding_top_header                                           = $this->get_option('launchpad_settings_padding_top_header');
        $this->padding_bottom_header                                        = $this->get_option('launchpad_settings_padding_bottom_header');
        $this->padding_right_header                                         = $this->get_option('launchpad_settings_padding_right_header');
        $this->padding_left_header                                          = $this->get_option('launchpad_settings_padding_left_header');
        $this->font_size_h1                                                 = $this->get_option('launchpad_settings_typography_header_h1');
        $this->font_size_h2                                                 = $this->get_option('launchpad_settings_typography_header_h2');
        $this->font_size_h3                                                 = $this->get_option('launchpad_settings_typography_header_h3');
        $this->font_size_h4                                                 = $this->get_option('launchpad_settings_typography_header_h4');
        $this->font_size_h5                                                 = $this->get_option('launchpad_settings_typography_header_h5');
        $this->font_size_h6                                                 = $this->get_option('launchpad_settings_typography_header_h6');
        $this->font_size_p                                                  = $this->get_option('launchpad_settings_typography_paragraph_size');
        $this->font_size_li                                                 = $this->get_option('launchpad_settings_typography_list_size');
        $this->font_color_site_title                                        = $this->get_option('launchpad_settings_font_color_class_site-title');
        $this->font_color_site_description                                  = $this->get_option('launchpad_settings_font_color_class_site-description');
        $this->font_color_body                                              = $this->get_option('launchpad_settings_font_color_body');
        $this->font_color_h1                                                = $this->get_option('launchpad_settings_font_color_h1');
        $this->font_color_h2                                                = $this->get_option('launchpad_settings_font_color_h2');
        $this->font_color_h3                                                = $this->get_option('launchpad_settings_font_color_h3');
        $this->font_color_h4                                                = $this->get_option('launchpad_settings_font_color_h4');
        $this->font_color_h5                                                = $this->get_option('launchpad_settings_font_color_h5');
        $this->font_color_h6                                                = $this->get_option('launchpad_settings_font_color_h6');
	    $this->font_size_main_menu                                          = $this->get_option('launchpad_settings_font_size_id_responsive-menu');
	    $this->font_weight_main_menu                                        = $this->get_option('launchpad_settings_font_weight_id_responsive-menu');
	    $this->font_weight_course_title                                     = $this->get_option('launchpad_settings_font_weight_course_title');
	    $this->text_distance_main_menu                                      = $this->get_option('launchpad_settings_text_distance_id_responsive-menu');
	    $this->font_color_main_menu                                         = $this->get_option('launchpad_settings_font_color_id_responsive-menu');
        $this->hover_color_main_menu                                        = $this->get_option('launchpad_settings_hover_color_id_responsive-menu');
	    $this->font_color_main_submenu                                      = $this->get_option('launchpad_settings_submenu_font_color_id_responsive-menu');
	    $this->hover_color_main_submenu                                     = $this->get_option('launchpad_settings_submenu_hover_color_id_responsive-menu');
	    $this->bg_color_main_submenu                                        = $this->get_option('launchpad_settings_submenu_bg_color_id_responsive-menu');
	    $this->bghover_color_main_submenu                                   = $this->get_option('launchpad_settings_submenu_bghover_color_id_responsive-menu');
	    $this->border_color_main_submenu                                    = $this->get_option('launchpad_settings_submenu_border_color_id_responsive-menu');
	    $this->border_width_main_submenu                                    = $this->get_option('launchpad_settings_submenu_border_width_id_responsive-menu');
	    $this->font_size_mobile_menu                                        = $this->get_option('launchpad_settings_mobile_font_size_id_responsive-menu');
	    $this->font_color_mobile_menu                                       = $this->get_option('launchpad_settings_mobile_font_color_id_responsive-menu');
	    $this->bg_color_mobile_menu                                         = $this->get_option('launchpad_settings_mobile_bg_color_id_responsive-menu');
	    $this->font_color_breadcrumb                                        = $this->get_option('launchpad_settings_breadcrumbs_font_color');
        $this->font_color_breadcrumb_current_page                           = $this->get_option('launchpad_settings_breadcrumbs_current_item_font_color');
        $this->background_color_breadcrumbs                                 = $this->get_option('launchpad_settings_breadcrumbs_background_color');
        $this->font_color_breadcrumb_separator_icon                         = $this->get_option('launchpad_settings_breadcrumbs_separator_icon_font_color');
        $this->background_color_footer                                      = $this->get_option('launchpad_settings_footer_background_color');
        $this->font_size_site_title                                         = $this->get_option('launchpad_settings_font_size_site_title');
        $this->font_color_primary_link                                      = $this->get_option('launchpad_settings_font_color_primary_link');
        $this->font_color_primary_link_hover                                = $this->get_option('launchpad_settings_font_color_primary_link_hover');
        $this->background_color_button_primary                              = $this->get_option('launchpad_settings_background_color_primary_button');
        $this->font_color_button_primary                                    = $this->get_option('launchpad_settings_font_color_primary_button');
        $this->border_color_button_primary                                  = $this->get_option('launchpad_settings_border_color_primary_button');
        $this->background_color_button_primary_hover                        = $this->get_option('launchpad_settings_background_color_primary_button_hover');
        $this->font_color_button_primary_hover                              = $this->get_option('launchpad_settings_font_color_primary_button_hover');
        $this->border_color_button_primary_hover                            = $this->get_option('launchpad_settings_border_color_primary_button_hover');
        $this->padding_top_button                                           = $this->get_option('launchpad_settings_padding_top_button');
        $this->padding_bottom_button                                        = $this->get_option('launchpad_settings_padding_bottom_button');
        $this->padding_right_button                                         = $this->get_option('launchpad_settings_padding_right_button');
        $this->padding_left_button                                          = $this->get_option('launchpad_settings_padding_left_button');
        $this->lifterlms_background_color_product_tile                      = $this->get_option('launchpad_settings_background_color_product_tile');
        $this->lifterlms_border_color_product_tile                          = $this->get_option('launchpad_settings_border_color_product_tile');
        $this->lifterlms_padding_top_product_tile                           = $this->get_option('launchpad_settings_padding_top_product_tile');
        $this->lifterlms_padding_bottom_product_tile                        = $this->get_option('launchpad_settings_padding_bottom_product_tile');
        $this->lifterlms_padding_right_product_tile                         = $this->get_option('launchpad_settings_padding_right_product_tile');
        $this->lifterlms_padding_left_product_tile                          = $this->get_option('launchpad_settings_padding_left_product_tile');
        $this->lifterlms_boxshadow_offset_x_product_tile                    = $this->get_option('launchpad_settings_boxshadow_offset_x_product_tile');
        $this->lifterlms_boxshadow_offset_y_product_tile                    = $this->get_option('launchpad_settings_boxshadow_offset_y_product_tile');
        $this->lifterlms_boxshadow_blur_product_tile                        = $this->get_option('launchpad_settings_boxshadow_blur_product_tile');
        $this->lifterlms_boxshadow_spread_product_tile                      = $this->get_option('launchpad_settings_boxshadow_spread_product_tile');
        $this->lifterlms_boxshadow_color_product_tile                       = $this->get_option('launchpad_settings_boxshadow_color_product_tile');
        $this->lifterlms_text_align_product_tile                            = $this->get_option('launchpad_settings_text_alignment_product_tile');
        $this->lifterlms_border_radius_product_tile                         = $this->get_option('launchpad_settings_border_radius_product_tile');
        $this->lifterlms_background_color_hover_product_tile                = $this->get_option('launchpad_settings_background_color_hover_product_tile');
        $this->lifterlms_padding_top_product_tile_footer                    = $this->get_option('launchpad_settings_padding_top_product_tile_footer');
        $this->lifterlms_padding_bottom_product_tile_footer                 = $this->get_option('launchpad_settings_padding_bottom_product_tile_footer');
        $this->lifterlms_padding_right_product_tile_footer                  = $this->get_option('launchpad_settings_padding_right_product_tile_footer');
        $this->lifterlms_padding_left_product_tile_footer                   = $this->get_option('launchpad_settings_padding_left_product_tile_footer');
        $this->lifterlms_margin_top_product_tile_footer                     = $this->get_option('launchpad_settings_margin_top_product_tile_footer');
        $this->lifterlms_margin_bottom_product_tile_footer                  = $this->get_option('launchpad_settings_margin_bottom_product_tile_footer');
        $this->lifterlms_margin_right_product_tile_footer                   = $this->get_option('launchpad_settings_margin_right_product_tile_footer');
        $this->lifterlms_margin_left_product_tile_footer                    = $this->get_option('launchpad_settings_margin_left_product_tile_footer');
        $this->lifterlms_border_width_product_tile                          = $this->get_option('launchpad_settings_border_width_product_tile');
        $this->lifterlms_border_width_product_tile_footer                   = $this->get_option('launchpad_settings_border_width_product_tile_footer');
        $this->lifterlms_border_color_product_tile_footer                   = $this->get_option('launchpad_settings_border_color_product_tile_footer');
        $this->lifterlms_font_size_product_tile_title                       = $this->get_option('launchpad_settings_font_size_product_tile_title');
        $this->lifterlms_font_size_product_tile_metas                       = $this->get_option('launchpad_settings_font_size_product_tile_metas');
        $this->lifterlms_margin_bottom_product_tile_image                   = $this->get_option('launchpad_settings_margin_bottom_product_tile_image');
        $this->lifterlms_font_color_product_tile_title                      = $this->get_option('launchpad_settings_font_color_product_tile_title');
        $this->lifterlms_font_color_product_tile_title_hover                = $this->get_option('launchpad_settings_font_color_product_tile_title_hover');
        $this->lifterlms_font_color_product_tile_metas                      = $this->get_option('launchpad_settings_font_color_product_tile_metas');
        $this->lifterlms_border_color_checkout_form                         = $this->get_option('launchpad_settings_border_color_checkout_form');
        $this->lifterlms_border_width_checkout_form                         = $this->get_option('launchpad_settings_border_width_checkout_form');
        $this->lifterlms_border_radius_top_left_checkout_form               = $this->get_option('launchpad_settings_border_radius_top_left_checkout_form');
        $this->lifterlms_border_radius_top_right_checkout_form              = $this->get_option('launchpad_settings_border_radius_top_right_checkout_form');
        $this->lifterlms_border_radius_bottom_left_checkout_form            = $this->get_option('launchpad_settings_border_radius_bottom_left_checkout_form');
        $this->lifterlms_border_radius_bottom_right_checkout_form           = $this->get_option('launchpad_settings_border_radius_bottom_right_checkout_form');
        $this->lifterlms_font_color_checkout_form_title                     = $this->get_option('launchpad_settings_font_color_checkout_form_title');
        $this->lifterlms_background_color_checkout_form_title               = $this->get_option('launchpad_settings_background_color_checkout_form_title');
        $this->lifterlms_font_size_checkout_title                           = $this->get_option('launchpad_settings_font_size_checkout_title');
        $this->lifterlms_font_size_course_title                             = $this->get_option('launchpad_settings_font_size_course_title');
        $this->lifterlms_font_color_course_title                            = $this->get_option('launchpad_settings_font_color_course_title');
        $this->lifterlms_text_alignment_course_syllabus_title               = $this->get_option('launchpad_settings_text_alignment_course_syllabus_title');
        $this->lifterlms_font_size_course_syllabus_title                    = $this->get_option('launchpad_settings_font_size_course_syllabus_title');
        $this->lifterlms_font_color_course_syllabus_title                   = $this->get_option('launchpad_settings_font_color_course_syllabus_title');
        $this->lifterlms_margin_top_lesson_preview                          = $this->get_option('launchpad_settings_margin_top_lesson_preview');
        $this->lifterlms_margin_bottom_lesson_preview                       = $this->get_option('launchpad_settings_margin_bottom_lesson_preview');
        $this->lifterlms_margin_right_lesson_preview                        = $this->get_option('launchpad_settings_margin_right_lesson_preview');
        $this->lifterlms_margin_left_lesson_preview                         = $this->get_option('launchpad_settings_margin_left_lesson_preview');
        $this->lifterlms_width_lesson_preview                               = $this->get_option('launchpad_settings_width_lesson_preview');
        $this->lifterlms_background_color_lesson_preview                    = $this->get_option('launchpad_settings_background_color_lesson_preview');
        $this->lifterlms_border_width_lesson_preview                        = $this->get_option('launchpad_settings_border_width_lesson_preview');
        $this->lifterlms_border_color_lesson_preview                        = $this->get_option('launchpad_settings_border_color_lesson_preview');
        $this->lifterlms_background_color_lesson_preview_hover              = $this->get_option('launchpad_settings_background_color_lesson_preview_hover');
        $this->lifterlms_border_width_lesson_preview_hover                  = $this->get_option('launchpad_settings_border_width_lesson_preview_hover');
        $this->lifterlms_border_color_lesson_preview_hover                  = $this->get_option('launchpad_settings_border_color_lesson_preview_hover');
        $this->lifterlms_padding_top_lesson_preview                         = $this->get_option('launchpad_settings_padding_top_lesson_preview');
        $this->lifterlms_padding_bottom_lesson_preview                      = $this->get_option('launchpad_settings_padding_bottom_lesson_preview');
        $this->lifterlms_padding_right_lesson_preview                       = $this->get_option('launchpad_settings_padding_right_lesson_preview');
        $this->lifterlms_padding_left_lesson_preview                        = $this->get_option('launchpad_settings_padding_left_lesson_preview');
        $this->lifterlms_boxshadow_offset_x_lesson_preview                  = $this->get_option('launchpad_settings_boxshadow_offset_x_lesson_preview');
        $this->lifterlms_boxshadow_offset_y_lesson_preview                  = $this->get_option('launchpad_settings_boxshadow_offset_y_lesson_preview');
        $this->lifterlms_boxshadow_blur_lesson_preview                      = $this->get_option('launchpad_settings_boxshadow_blur_lesson_preview');
        $this->lifterlms_boxshadow_spread_lesson_preview                    = $this->get_option('launchpad_settings_boxshadow_spread_lesson_preview');
        $this->lifterlms_boxshadow_color_lesson_preview                     = $this->get_option('launchpad_settings_boxshadow_color_lesson_preview');
        $this->lifterlms_font_size_lesson_preview_title                     = $this->get_option('launchpad_settings_font_size_lesson_preview_title');
        $this->lifterlms_font_color_lesson_preview_title                    = $this->get_option('launchpad_settings_font_color_lesson_preview_title');
        $this->lifterlms_font_size_lesson_preview_count                     = $this->get_option('launchpad_settings_font_size_lesson_preview_count');
        $this->lifterlms_font_color_lesson_preview_count                    = $this->get_option('launchpad_settings_font_color_lesson_preview_count');
        $this->lifterlms_font_size_lesson_preview_excerpt                   = $this->get_option('launchpad_settings_font_size_lesson_preview_excerpt');
        $this->lifterlms_font_color_lesson_preview_excerpt                  = $this->get_option('launchpad_settings_font_color_lesson_preview_excerpt');
        $this->lifterlms_margin_bottom_lesson_preview_excerpt               = $this->get_option('launchpad_settings_margin_bottom_lesson_preview_excerpt');
        $this->lifterlms_hide_lesson_count_lesson_preview                   = $this->get_option('launchpad_settings_hide_lesson_count_lesson_preview');
        $this->lifterlms_hide_course_featured_image                         = $this->get_option('launchpad_settings_hide_course_featured_image');
        $this->lifterlms_background_color_account_tile                      = $this->get_option('launchpad_settings_background_color_account_tile');
        $this->lifterlms_border_radius_lesson_preview                       = $this->get_option('launchpad_settings_border_radius_lesson_preview');
        $this->lifterlms_background_color_lesson_preview_disabled           = $this->get_option('launchpad_settings_background_color_lesson_preview_disabled');
        $this->lifterlms_background_color_lesson_preview_disabled_hover     = $this->get_option('launchpad_settings_background_color_lesson_preview_disabled_hover');
        $this->lifterlms_icon_lesson_complete                               = $this->get_option('launchpad_settings_icon_lesson_complete');
        $this->lifterlms_background_color_lesson_complete                   = $this->get_option('launchpad_settings_background_color_lesson_complete');
        $this->lifterlms_font_size_lesson_complete                          = $this->get_option('launchpad_settings_font_size_lesson_complete');
        $this->lifterlms_right_border_width_lesson_complete                 = $this->get_option('launchpad_settings_right_border_width_lesson_complete');
        $this->lifterlms_right_border_color_lesson_complete                 = $this->get_option('launchpad_settings_right_border_color_lesson_complete');
        $this->lifterlms_left_border_width_lesson_complete                  = $this->get_option('launchpad_settings_left_border_width_lesson_complete');
        $this->lifterlms_left_border_color_lesson_complete                  = $this->get_option('launchpad_settings_left_border_color_lesson_complete');
        $this->lifterlms_background_color_course_progress                   = $this->get_option('launchpad_settings_background_color_course_progress');
        $this->lifterlms_background_color_course_progress_completed         = $this->get_option('launchpad_settings_background_color_course_progress_completed');
        $this->lifterlms_background_color_lesson_complete_placeholder       = $this->get_option('launchpad_settings_background_color_lesson_complete_placeholder');
        $this->side_by_side_login_registration                              = $this->get_option('launchpad_settings_side_by_side_login_registration');
        $this->lifterlms_account_greeting                                   = $this->get_option('launchpad_settings_account_greeting');
        $this->lifterlms_text_alignment_account_sub_nav                     = $this->get_option('launchpad_settings_text_alignment_account_sub_nav');
        $this->lifterlms_margin_top_account_sub_nav                         = $this->get_option('launchpad_settings_margin_top_account_sub_nav');
        $this->lifterlms_margin_bottom_account_sub_nav                      = $this->get_option('launchpad_settings_margin_bottom_account_sub_nav');
        $this->lifterlms_margin_right_account_sub_nav                       = $this->get_option('launchpad_settings_margin_right_account_sub_nav');
        $this->lifterlms_margin_left_account_sub_nav                        = $this->get_option('launchpad_settings_margin_left_account_sub_nav');
        $this->lifterlms_padding_top_account_sub_nav                        = $this->get_option('launchpad_settings_padding_top_account_sub_nav');
        $this->lifterlms_padding_bottom_account_sub_nav                     = $this->get_option('launchpad_settings_padding_bottom_account_sub_nav');
        $this->lifterlms_padding_right_account_sub_nav                      = $this->get_option('launchpad_settings_padding_right_account_sub_nav');
        $this->lifterlms_padding_left_account_sub_nav                       = $this->get_option('launchpad_settings_padding_left_account_sub_nav');
        $this->lifterlms_font_size_account_sub_nav                          = $this->get_option('launchpad_settings_font_size_account_sub_nav');
        $this->lifterlms_font_color_sub_nav                                 = $this->get_option('launchpad_settings_font_color_sub_nav');
        $this->lifterlms_border_width_account_sub_nav                       = $this->get_option('launchpad_settings_border_width_account_sub_nav');
        $this->lifterlms_border_color_sub_nav                               = $this->get_option('launchpad_settings_border_color_sub_nav');
        $this->lifterlms_border_radius_account_sub_nav                      = $this->get_option('launchpad_settings_border_radius_account_sub_nav');
        $this->lifterlms_account_sub_nav_link_seperator                     = $this->get_option('launchpad_settings_account_sub_nav_link_seperator');
        $this->lifterlms_account_courses_tile_title                         = $this->get_option('launchpad_settings_account_courses_tile_title');
        $this->lifterlms_account_certificates_tile_title                    = $this->get_option('launchpad_settings_account_certificates_tile_title');
        $this->lifterlms_account_achievements_tile_title                    = $this->get_option('launchpad_settings_account_achievements_tile_title');
        $this->lifterlms_account_memberships_tile_title                     = $this->get_option('launchpad_settings_account_memberships_tile_title');
        $this->lifterlms_background_color_account_course_tile_title         = $this->get_option('launchpad_settings_background_color_account_course_tile_title');
        $this->lifterlms_background_color_account_certificate_tile_title    = $this->get_option('launchpad_settings_background_color_account_certificate_tile_title');
        $this->lifterlms_background_color_account_achievement_tile_title    = $this->get_option('launchpad_settings_background_color_account_achievement_tile_title');
        $this->lifterlms_background_color_account_membership_tile_title     = $this->get_option('launchpad_settings_background_color_account_membership_tile_title');
        $this->lifterlms_font_size_account_tile_title                       = $this->get_option('launchpad_settings_font_size_account_tile_title');
        $this->lifterlms_text_alignment_account_tile_title                  = $this->get_option('launchpad_settings_text_alignment_account_tile_title');
        $this->lifterlms_font_color_account_tile_title                      = $this->get_option('launchpad_settings_font_color_account_tile_title');
        $this->lifterlms_margin_top_account_tile_title                      = $this->get_option('launchpad_settings_margin_top_account_tile_title');
        $this->lifterlms_margin_bottom_account_tile_title                   = $this->get_option('launchpad_settings_margin_bottom_account_tile_title');
        $this->lifterlms_margin_right_account_tile_title                    = $this->get_option('launchpad_settings_margin_right_account_tile_title');
        $this->lifterlms_margin_left_account_tile_title                     = $this->get_option('launchpad_settings_margin_left_account_tile_title');
        $this->lifterlms_padding_top_account_tile_title                     = $this->get_option('launchpad_settings_padding_top_account_tile_title');
        $this->lifterlms_padding_bottom_account_tile_title                  = $this->get_option('launchpad_settings_padding_bottom_account_tile_title');
        $this->lifterlms_padding_right_account_tile_title                   = $this->get_option('launchpad_settings_padding_right_account_tile_title');
        $this->lifterlms_padding_left_account_tile_title                    = $this->get_option('launchpad_settings_padding_left_account_tile_title');
        $this->lifterlms_margin_top_account_tile                            = $this->get_option('launchpad_settings_margin_top_account_tile');
        $this->lifterlms_margin_bottom_account_tile                         = $this->get_option('launchpad_settings_margin_bottom_account_tile');
        $this->lifterlms_margin_right_account_tile                          = $this->get_option('launchpad_settings_margin_right_account_tile');
        $this->lifterlms_margin_left_account_tile                           = $this->get_option('launchpad_settings_margin_left_account_tile');
        $this->lifterlms_padding_top_account_tile                           = $this->get_option('launchpad_settings_padding_top_account_tile');
        $this->lifterlms_padding_bottom_account_tile                        = $this->get_option('launchpad_settings_padding_bottom_account_tile');
        $this->lifterlms_padding_right_account_tile                         = $this->get_option('launchpad_settings_padding_right_account_tile');
        $this->lifterlms_padding_left_account_tile                          = $this->get_option('launchpad_settings_padding_left_account_tile');
        $this->lifterlms_border_width_account_tile                          = $this->get_option('launchpad_settings_border_width_account_tile');
        $this->lifterlms_border_color_tile                                  = $this->get_option('launchpad_settings_border_color_tile');
        $this->lifterlms_border_radius_account_tile                         = $this->get_option('launchpad_settings_border_radius_account_tile');
        $this->lifterlms_margin_top_account_course_item                     = $this->get_option('launchpad_settings_margin_top_account_course_item');
        $this->lifterlms_margin_bottom_account_course_item                  = $this->get_option('launchpad_settings_margin_bottom_account_course_item');
        $this->lifterlms_margin_right_account_course_item                   = $this->get_option('launchpad_settings_margin_right_account_course_item');
        $this->lifterlms_margin_left_account_course_item                    = $this->get_option('launchpad_settings_margin_left_account_course_item');
        $this->lifterlms_padding_top_account_course_item                    = $this->get_option('launchpad_settings_padding_top_account_course_item');
        $this->lifterlms_padding_bottom_account_course_item                 = $this->get_option('launchpad_settings_padding_bottom_account_course_item');
        $this->lifterlms_padding_right_account_course_item                  = $this->get_option('launchpad_settings_padding_right_account_course_item');
        $this->lifterlms_padding_left_account_course_item                   = $this->get_option('launchpad_settings_padding_left_account_course_item');
        $this->lifterlms_border_width_account_course_item                   = $this->get_option('launchpad_settings_border_width_account_course_item');
        $this->lifterlms_border_color_account_course_item                   = $this->get_option('launchpad_settings_border_color_account_course_item');
        $this->lifterlms_border_radius_account_course_item                  = $this->get_option('launchpad_settings_border_radius_account_course_item');
        $this->lifterlms_margin_top_account_course_image                    = $this->get_option('launchpad_settings_margin_top_account_course_image');
        $this->lifterlms_margin_bottom_account_course_image                 = $this->get_option('launchpad_settings_margin_bottom_account_course_image');
        $this->lifterlms_margin_right_account_course_image                  = $this->get_option('launchpad_settings_margin_right_account_course_image');
        $this->lifterlms_margin_left_account_course_image                   = $this->get_option('launchpad_settings_margin_left_account_course_image');
        $this->lifterlms_padding_top_account_course_image                   = $this->get_option('launchpad_settings_padding_top_account_course_image');
        $this->lifterlms_padding_bottom_account_course_image                = $this->get_option('launchpad_settings_padding_bottom_account_course_image');
        $this->lifterlms_padding_right_account_course_image                 = $this->get_option('launchpad_settings_padding_right_account_course_image');
        $this->lifterlms_padding_left_account_course_image                  = $this->get_option('launchpad_settings_padding_left_account_course_image');
        $this->lifterlms_border_width_account_course_image                  = $this->get_option('launchpad_settings_border_width_account_course_image');
        $this->lifterlms_border_color_account_course_image                  = $this->get_option('launchpad_settings_border_color_account_course_image');
        $this->lifterlms_border_radius_top_left_account_course_image        = $this->get_option('launchpad_settings_border_radius_top_left_account_course_image');
        $this->lifterlms_border_radius_top_right_account_course_image       = $this->get_option('launchpad_settings_border_radius_top_right_account_course_image');
        $this->lifterlms_border_radius_bottom_left_account_course_image     = $this->get_option('launchpad_settings_border_radius_bottom_left_account_course_image');
        $this->lifterlms_border_radius_bottom_right_account_course_image    = $this->get_option('launchpad_settings_border_radius_bottom_right_account_course_image');
        $this->lifterlms_width_account_course_image                         = $this->get_option('launchpad_settings_width_account_course_image');
        $this->lifterlms_account_hide_enrollment_status                     = $this->get_option('launchpad_settings_account_hide_enrollment_status');
        $this->lifterlms_font_size_account_course_enrollment_status         = $this->get_option('launchpad_settings_font_size_account_course_enrollment_status');
        $this->lifterlms_account_course_hide_start_date                     = $this->get_option('launchpad_settings_account_course_hide_start_date');
        $this->lifterlms_font_size_account_course_start_date                = $this->get_option('launchpad_settings_font_size_account_course_start_date');
        $this->lifterlms_font_size_account_course_title                     = $this->get_option('launchpad_settings_font_size_account_course_title');
        $this->lifterlms_font_size_account_course_author                    = $this->get_option('launchpad_settings_font_size_account_course_author');
        $this->lifterlms_account_course_button_text                         = $this->get_option('launchpad_settings_account_course_button_text');
        $this->lifterlms_boxshadow_offset_x_course_item                     = $this->get_option('launchpad_settings_boxshadow_offset_x_course_item');
        $this->lifterlms_boxshadow_offset_y_course_item                     = $this->get_option('launchpad_settings_boxshadow_offset_y_course_item');
        $this->lifterlms_boxshadow_blur_course_item                         = $this->get_option('launchpad_settings_boxshadow_blur_course_item');
        $this->lifterlms_boxshadow_spread_course_item                       = $this->get_option('launchpad_settings_boxshadow_spread_course_item');
        $this->lifterlms_boxshadow_color_course_item                        = $this->get_option('launchpad_settings_boxshadow_color_course_item');
        $this->lifterlms_auto_width_account_course_image                    = $this->get_option('launchpad_settings_auto_width_account_course_image');
        $this->footer_font_color                                            = $this->get_option('launchpad_settings_footer_font_color');
        $this->footer_widget_title_font_color                               = $this->get_option('launchpad_settings_footer_widget_title_font_color');
        $this->font_color_site_info                                         = $this->get_option('launchpad_settings_font_color_site_info');
        $this->footer_link_color                                            = $this->get_option('launchpad_settings_footer_link_color');
        $this->footer_link_hover_color                                      = $this->get_option('launchpad_settings_footer_link_hover_color');
        $this->link_color_site_info                                         = $this->get_option('launchpad_settings_link_color_site_info');
        $this->link_hover_color_site_info                                   = $this->get_option('launchpad_settings_link_hover_color_site_info');
        $this->padding_top_footer                                           = $this->get_option('launchpad_settings_padding_top_footer');
        $this->padding_bottom_footer                                        = $this->get_option('launchpad_settings_padding_bottom_footer');
        $this->padding_right_footer                                         = $this->get_option('launchpad_settings_padding_right_footer');
        $this->padding_left_footer                                          = $this->get_option('launchpad_settings_padding_left_footer');
        $this->background_color_site_info                                   = $this->get_option('launchpad_settings_background_color_site_info');
        $this->padding_top_site_info                                        = $this->get_option('launchpad_settings_padding_top_site_info');
        $this->padding_bottom_site_info                                     = $this->get_option('launchpad_settings_padding_bottom_site_info');
        $this->padding_right_site_info                                      = $this->get_option('launchpad_settings_padding_right_site_info');
        $this->padding_left_site_info                                       = $this->get_option('launchpad_settings_padding_left_site_info');
        $this->width_container                                              = $this->get_option('launchpad_settings_width_container');
        $this->margin_top_container                                         = $this->get_option('launchpad_settings_container_margin_top');
        $this->margin_bottom_container                                      = $this->get_option('launchpad_settings_container_margin_bottom');
        $this->margin_top_product_tile_title                                = $this->get_option('launchpad_settings_margin_top_product_tile_title');
        $this->margin_bottom_product_tile_title                             = $this->get_option('launchpad_settings_margin_bottom_product_tile_title');
        $this->margin_right_product_tile_title                              = $this->get_option('launchpad_settings_margin_right_product_tile_title');
        $this->margin_left_product_tile_title                               = $this->get_option('launchpad_settings_margin_left_product_tile_title');
        $this->padding_top_product_tile_metas                               = $this->get_option('launchpad_settings_padding_top_product_tile_metas');
        $this->padding_bottom_product_tile_metas                            = $this->get_option('launchpad_settings_padding_bottom_product_tile_metas');
        $this->padding_right_product_tile_metas                             = $this->get_option('launchpad_settings_padding_right_product_tile_metas');
        $this->padding_left_product_tile_metas                              = $this->get_option('launchpad_settings_padding_left_product_tile_metas');
        $this->margin_top_lesson_preview_title                              = $this->get_option('launchpad_settings_margin_top_lesson_preview_title');
        $this->margin_bottom_lesson_preview_title                           = $this->get_option('launchpad_settings_margin_bottom_lesson_preview_title');
        $this->margin_right_lesson_preview_title                            = $this->get_option('launchpad_settings_margin_right_lesson_preview_title');
        $this->margin_left_lesson_preview_title                             = $this->get_option('launchpad_settings_margin_left_lesson_preview_title');
        $this->margin_top_lesson_preview_complete                           = $this->get_option('launchpad_settings_margin_top_lesson_preview_complete');
        $this->margin_bottom_lesson_preview_complete                        = $this->get_option('launchpad_settings_margin_bottom_lesson_preview_complete');
        $this->margin_right_lesson_preview_complete                         = $this->get_option('launchpad_settings_margin_right_lesson_preview_complete');
        $this->margin_left_lesson_preview_complete                          = $this->get_option('launchpad_settings_margin_left_lesson_preview_complete');
        $this->padding_top_lesson_preview_complete                          = $this->get_option('launchpad_settings_padding_top_lesson_preview_complete');
        $this->padding_bottom_lesson_preview_complete                       = $this->get_option('launchpad_settings_padding_bottom_lesson_preview_complete');
        $this->padding_right_lesson_preview_complete                        = $this->get_option('launchpad_settings_padding_right_lesson_preview_complete');
        $this->padding_left_lesson_preview_complete                         = $this->get_option('launchpad_settings_padding_left_lesson_preview_complete');

        $this->background_color_secondary_button = $this->get_option('launchpad_settings_background_color_secondary_button');
        $this->font_color_secondary_button = $this->get_option('launchpad_settings_font_color_secondary_button');
        $this->border_color_secondary_button = $this->get_option('launchpad_settings_border_color_secondary_button');
        $this->background_color_secondary_button_hover = $this->get_option('launchpad_settings_background_color_secondary_button_hover');
        $this->font_color_secondary_button_hover = $this->get_option('launchpad_settings_font_color_secondary_button_hover');
        $this->border_color_secondary_button_hover = $this->get_option('launchpad_settings_border_color_secondary_button_hover');
        $this->padding_top_secondary_button = $this->get_option('launchpad_settings_padding_top_secondary_button');
        $this->padding_bottom_secondary_button = $this->get_option('launchpad_settings_padding_bottom_secondary_button');
        $this->padding_right_secondary_button = $this->get_option('launchpad_settings_padding_right_secondary_button');
        $this->padding_left_secondary_button = $this->get_option('launchpad_settings_padding_left_secondary_button');

        $this->font_size_meta_title = $this->get_option('launchpad_settings_font_size_meta_title');
        $this->font_color_meta_title = $this->get_option('launchpad_settings_font_color_meta_title');
        $this->font_size_meta_info = $this->get_option('launchpad_settings_font_size_meta_info');
        $this->font_color_meta_info = $this->get_option('launchpad_settings_font_color_meta_info');
        $this->meta_title_margin_top = $this->get_option('launchpad_settings_meta_title_margin_top');
        $this->meta_title_margin_bottom = $this->get_option('launchpad_settings_meta_title_margin_bottom');
        $this->meta_title_margin_left = $this->get_option('launchpad_settings_meta_title_margin_left');
        $this->meta_title_margin_right = $this->get_option('launchpad_settings_meta_title_margin_right');

        $this->access_plan_bg_color = $this->get_option('launchpad_settings_access_plan_bg_color');
        $this->access_plan_text_color = $this->get_option('launchpad_settings_access_plan_text_color');

        $this->access_plan_title_bg_color = $this->get_option('launchpad_settings_access_plan_title_bg_color');
        $this->access_plan_title_text_color = $this->get_option('launchpad_settings_access_plan_title_text_color');
        $this->access_plan_title_text_size = $this->get_option('launchpad_settings_access_plan_title_text_size');

        $this->access_plan_button_bg_color = $this->get_option('launchpad_settings_access_plan_button_bg_color');
        $this->access_plan_button_hover_bg_color = $this->get_option('launchpad_settings_access_plan_button_hover_bg_color');
        $this->access_plan_button_font_color = $this->get_option('launchpad_settings_access_plan_button_font_color');
        $this->access_plan_button_hover_font_color = $this->get_option('launchpad_settings_access_plan_button_hover_font_color');
        $this->access_plan_button_border_color = $this->get_option('launchpad_settings_access_plan_button_border_color');
        $this->access_plan_button_hover_border_color = $this->get_option('launchpad_settings_access_plan_button_hover_border_color');
        $this->access_plan_price_text_color = $this->get_option('launchpad_settings_access_plan_price_text_color');
        $this->access_plan_price_text_size = $this->get_option('launchpad_settings_access_plan_price_text_size');
        $this->access_plan_featured_bg_color = $this->get_option('launchpad_settings_access_plan_featured_bg_color');
        $this->access_plan_featured_text_color = $this->get_option('launchpad_settings_access_plan_featured_text_color');
        $this->access_plan_featured_border_size = $this->get_option('launchpad_settings_access_plan_featured_border_size');
        $this->access_plan_featured_border_color = $this->get_option('launchpad_settings_access_plan_featured_border_color');
        $this->access_plan_stamp_bg_color = $this->get_option('launchpad_settings_access_plan_stamp_bg_color');
        $this->access_plan_stamp_text_color = $this->get_option('launchpad_settings_access_plan_stamp_text_color');

        $this->border_color_instructors = $this->get_option('launchpad_settings_border_color_instructors');
        $this->font_size_instructor_name = $this->get_option( 'launchpad_settings_font_size_instructor_name' );
        $this->font_color_instructor_name = $this->get_option( 'launchpad_settings_font_color_instructor_name' );
        $this->font_size_instructor_label = $this->get_option( 'launchpad_settings_font_size_instructor_label' );
        $this->font_color_instructor_label = $this->get_option( 'launchpad_settings_font_color_instructor_label' );

    }
}
