<?php

namespace LaunchPad\Config;

use SkyLab\Config\Configuration;
use LaunchPad\Metaboxes\Layout;
use LaunchPad\ThemeLayout\LayoutSettings;
use LaunchPad\Upgrades\Upgrades;

class ConfigurationLive extends Configuration
{
    public $footer_widgets = [
        'Footer1',
        'Footer2',
        'Footer3'
    ];

    public function __construct()
    {
        $this->footer_widgets = $this->get_footer_widgets();
        $this->set_title_tag();
        $upgrades = new Upgrades();

        if ( is_lifterlms_enabled() ) {
            add_filter( 'llms_sidebar_settings', [ $this, 'register_sidebar' ] );
        }

        add_action( 'after_setup_theme', [ $this, 'theme_support' ] );

    }

    public function get_footer_widgets() {
        return $this->footer_widgets;
    }

    public function set_title_tag() {
        add_theme_support( 'title-tag' );
    }

    public function register_sidebar( $args ) {

        $args['before_widget'] = '<aside id="%1$s" class="widget %2$s">';
        $args['after_widget']  = '</aside>';
        $args['before_title']  = '<h2 class="widget-title">';
        $args['after_title']   = '</h2>';

        return $args;

    }

    public function theme_support(){

        add_theme_support( 'lifterlms-sidebars' );

        add_filter( 'llms_get_quiz_theme_settings', array( $this, 'llms_quiz_settings' ) );
        add_filter( 'llms_builder_register_custom_fields', array( $this, 'llms_builder_custom_fields' ), 25 );

        /**
         * https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
         */
        add_theme_support( 'woocommerce' );

        /**
         * Load language packs from the following locations
         *
         * NOTE: the first file overrides any following ones if the same translation is present
         */
        // EG: wp-content/languages/themes/lifterlms-launchpad/{locale}.mo
        load_theme_textdomain( 'lifterlms-launchpad', trailingslashit( WP_LANG_DIR ) . 'themes/' . get_template() );

        // EG: wp-content/themes/lifterlms-launchpad/l18n/{locale}.mo
        load_theme_textdomain( 'lifterlms-launchpad', get_template_directory() . '/l18n' );

    }

    public function llms_builder_custom_fields( $fields ) {

        $custom_fields = Layout::get_fields_for_builder();
        $fields['lesson']['launchpad'] = $custom_fields;
        $fields['assignment']['launchpad'] = $custom_fields;
        $fields['quiz']['launchpad'] = $custom_fields;

        return $fields;
    }

}
