<?php

namespace LaunchPad\ThemeLayout;

use SkyLab\Templating\Template;
use LaunchPad\Metaboxes\Layout;

class HeaderLayout
{
    public $background_image;

    public $header_content = '';

    public function output()
    {
        $this->get_settings();

        return (new Template)->get('view.header.php', $this);
    }

    /**
     * Output header layout as per settings
     *
     * @since 1.3.0
     * @version 1.3.0
     *
     * @return mixed
     */
    public function output_layout() {

        $this->get_settings();

        $r = '';

        switch ( get_option( 'launchpad_settings_header_layout' ) ) {

            case 'nav_branding_cols':
                $r .= (new Template)->get('view.header.navigation.php', $this);
                $r .= (new Template)->get('view.header.branding.php', $this);
            break;

            case 'branding_nav_cols':
            default:
                $r .= (new Template)->get('view.header.branding.php', $this);
                $r .= (new Template)->get('view.header.navigation.php', $this);
            break;

        }

        return $r;

    }

    /**
     * Get Options
     *
     * @since 1.3.0
     * @version 1.3.0
     *
     * @param bool $text_only
     * @return mixed
     */
    public static function get_layout_options($text_only = false)
    {
        if ($text_only)
        {
            return apply_filters('launchpad_layout_options_text_only',
                [
                    'branding_nav_cols' => 'Logo, Navigation',
                    'nav_branding_cols' => 'Navigation, Logo',
                ]
            );
        }
        else
        {
            return apply_filters('launchpad_layout_options',
                [
                    'branding_nav_cols' => '<span><img src="' . get_stylesheet_directory_uri() . '/images/branding_nav_cols.png" /></span>',
                    'nav_branding_cols' => '<span><img src="' . get_stylesheet_directory_uri() . '/images/nav_branding_cols.png" /></span>',
                ]
            );
        }

    }

    /**
     * Get header settings
     * @since  0.0.1
     * @version  1.3.0
     * @return void
     */
    public function get_settings()
    {
        global $post;

        $this->background_image = get_option('launchpad_settings_background_image');

        $this->logo = get_option('launchpad_settings_logo', false);
        $this->display_tagline = get_option('launchpad_settings_header_tagline', true);

        $cols = explode( '_', get_option( 'launchpad_settings_header_layout_cols', 'four_eight' ) );
        $this->branding_cols = $cols[0];
        $this->navigation_cols = $cols[1];

        $this->menu_args = array(
            'theme_location' => 'header',
            'menu_id' => 'menu-header',
            'menu_class' => 'menu-inline'
        );

        $this->hide_header = 'no';

        // header content
        if (isset($post)) {

            $this->hide_header = Layout::get_setting( 'launchpad_hide_page_header', 'no' );
            $menu = Layout::get_setting( 'launchpad_page_menu', 'default' );
            if ( $menu && 'default' !== $menu && 'none' !== $menu ) {
                unset( $this->menu_args['theme_location'] );
                $this->menu_args['menu'] = $menu;
            } elseif ( 'none' === $menu ) {
                $this->menu_args = false ;
            }
            $this->header_content = Layout::get_setting( 'launchpad_header_content', '' );
        }

    }

    /**
     * Get an array of menus which can be optionally displayed on a post by post basis
     * @return   array
     * @since    2.2.0
     * @version  2.2.0
     */
    public static function get_menu_options() {

        $locs = get_nav_menu_locations();
        $header = isset( $locs['header'] ) ? $locs['header'] : esc_html__( 'None', 'lifterlms-launchpad' );

        $menus = array();

        foreach ( wp_get_nav_menus() as $menu ) {
            if ( $header == $menu->term_id ) {
                $header = $menu->name;
            } else {
                $menus[ $menu->slug ] = $menu->name;
            }
        }

        $menus = array_merge( array(
            'default' => sprintf( esc_html__( 'Site Default (%s)', 'lifterlms-launchpad' ), $header ),
            'none' => esc_html__( 'Hide Menu', 'lifterlms' ),
        ), $menus );

        return $menus;
    }

}
