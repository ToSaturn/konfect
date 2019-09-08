<?php

namespace LaunchPad\Http;

use SkyLab\Http\AjaxRequest;
use SkyLab\Config\Configuration;

class AjaxRequestController extends AjaxRequest
{
    /**
     * Instance of Configuration class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private static $config;

    public function __construct(Configuration $config)
    {
        self::$config = $config;

        $this->register();
    }

    /**
     * Generate a JSON object of LaunchPad settings
     * Called from LaunchPad Advanced Settings page "Generate Export" button click
     *
     * @since  1.3.0
     * @version  1.3.0
     *
     * @return array
     */
    public static function export_settings()
    {

        // setup the export object with some metadata
        $export = array(
            '__launchpad_version' => wp_get_theme()->Version,
            '__generated' => array(
                'by' => get_current_user_id(),
                'on' => date( 'Y-m-d h:i:s', current_time( 'timestamp' ) ),
                'start' => microtime(true),
            ),
        );

        // exclude the following field types from the export object
        $exclude = array( 'button', 'desc', 'image', 'llms_license_key', 'sectionend', 'sectionstart', 'subtitle', 'title' );

        // load options into this array
        $options = array();

        // get all settings tabs
        $tabs = (new \SkyLab\Settings\SettingGenerator(self::$config))->get_settings_tabs();
        foreach( $tabs as $tab ) {
            // get all settings in the tab
            $settings = $tab->get_settings();
            foreach( $settings as $s ) {

                // skip if in the exclude array
                if ( in_array( $s['type'], $exclude ) ) { continue; }

                // load the setting into the array
                $options[ $s['id'] ] = get_option( $s['id'] );

            }

        }

        $export['__generated']['finish'] = microtime(true);
        $export['__generated']['in'] = $export['__generated']['finish'] - $export['__generated']['start'];
        $export['__options'] = $options;

        return array(
            'export' => json_encode( $export, JSON_PRETTY_PRINT ),
            'message' => 'Export complete! Copy your settings out of the box above and save them in a text file so you can import them later.',
        );

    }

   /**
     * Import a JSON object of LaunchPad settings
     * Called from LaunchPad Advanced Settings page "Import Settings" button click
     *
     * @since  1.3.0
     * @version  1.3.0
     *
     * @return string
     */
    public static function import_settings()
    {

        $r = array(
            'success' => false,
            'message' => __( 'Please submit a valid settings object.', 'lifterlms-launchpad' ),
        );

        if ( empty( $_REQUEST['settings'] ) ) {
            return $r;
        }

        $settings = json_decode( stripslashes( $_REQUEST['settings'] ), true );
        if ( ! is_array( $settings ) ) {
            return $r;
        }

        if ( empty( $settings['__options'] ) || ! is_array( $settings['__options'] ) ) {
            return $r;
        }

        // reset settings
        $default_settings = (new \SkyLab\Settings\SettingGenerator(self::$config))->save_default_settings(true);

        // load new settings
        foreach( $settings['__options'] as $k => $v ) {
            update_option( $k, $v );
        }

        $r['success'] = true;
        $r['message'] = __( 'Import successful!', 'lifterlms' );
        return $r;

    }


    /**
     * Reset Settings Ajax Call
     * Called from LaunchPad Settings page Reset Options button click
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return string
     */
    public static function reset_settings()
    {
        $default_settings = (new \SkyLab\Settings\SettingGenerator(self::$config))->save_default_settings(true);

        return 'Options Reset Successful!';
    }

}