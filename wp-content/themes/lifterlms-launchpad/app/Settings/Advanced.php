<?php
namespace LaunchPad\Settings;

use SkyLab\Settings\Setting;

class Advanced extends Setting
{
    public function __construct() {
        $this->id    = 'advanced';
        $this->label = __( 'Advanced', 'lifterlms-launchpad' );
        $this->menu_order = 70;

        $this->add_actions_and_filters();
    }

    /**
     * Get settings array
     * @since  1.0.0
     * @version  1.3.0
     * @return array
     */
    public function get_settings()
    {
        return apply_filters( 'launchpad_advanced_settings', array(

                array(
                    'type' => 'sectionstart',
                    'id' => 'advanced_options',
                    'class' =>'top'
                ),

                array(
                    'title' => __( 'Advanced Settings', 'lifterlms-launchpad' ),
                    'type' => 'title',
                    'desc' => 'Advanced CSS and JavaScript Settings.',
                    'id' => 'advanced_settings_title'
                ),

                array(
                    'title' => __( 'Custom CSS', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Enter custom CSS', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_custom_css',
                    'type' 		=> 'textarea',
                    'default'	=> '',
                    'desc_tip'	=> true,
                ),

                array(
                    'title' => __( 'Custom JavaScript (Header)', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Enter custom JavaScript to be included in the site header', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_custom_header_js',
                    'type' 		=> 'script',
                    'default'	=> '',
                    'desc_tip'	=> true,
                ),
                array(
                    'title' => __( 'Custom JavaScript (Footer)', 'lifterlms-launchpad' ),
                    'desc' 		=> __( 'Enter custom JavaScript to be included in the site footer', 'lifterlms-launchpad' ),
                    'id' 		=> 'launchpad_settings_custom_footer_js',
                    'type' 		=> 'script',
                    'default'	=> '',
                    'desc_tip'	=> true,
                ),
                array(
                    'title'     => __( 'Add Script Wrapper', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Automatically wrap header and footer scripts in a &lt;script&gt; tag', 'lifterlms-launchpad' ),
                    'id'        => 'launchpad_settings_custom_js_wrapper',
                    'type'      => 'checkbox',
                    'default'   => 'yes',
                    'desc_tip'  => true,
                ),

                array(
                    'type' => 'sectionend',
                    'id' => 'advanced_options'
                ),



                array(
                    'type' => 'sectionstart',
                    'id' => 'advanced_options_license',
                    'class' =>'top'
                ),

                array(
                    'title' => __( 'License', 'lifterlms-launchpad' ),
                    'type' => 'title',
                    'desc' => 'Add your license keys to receive automatic theme updates. If you don\'t see a field below this title you need to install the <a href="https://lifterlms.com/docs/lifterlms-helper/" target="_blank">LifterLMS Helper</a>.',
                    'id' => 'license_title'
                ),

                array(
                    'title'     => __( 'Activation Key', 'lifterlms-launchpad' ),
                    'desc'      => __( 'Required for support and automated plugin updates. Located on your <a href="https://lifterlms.com/my-account/" target="_blank">LifterLMS Account Settings page</a>.', 'lifterlms-launchpad' ),
                    'id'        => 'lifterlms_launchpad_activation_key',
                    'type'      => 'llms_license_key',
                    'default'   => '',
                    'extension' => get_template_directory(),
                ),

                array(
                    'type' => 'sectionend',
                    'id' => 'advanced_options_license'
                ),

                array(
                    'type' => 'sectionstart',
                    'id' => 'advanced_options_import_export',
                    'class' =>'top'
                ),

                array(
                    'type' => 'sectionstart',
                    'id' => 'export_options',
                    'class' =>'top'
                ),
                array(
                    'title' => __( 'Import and Export LaunchPad Configurations', 'lifterlms-launchpad' ),
                    'desc' => __( 'Save your current settings and import settings from saved configurations.', 'lifterlms-launchpad' ),
                    'type' => 'title',
                    'id' => 'export_title'
                ),
                array(
                    'title' => __( 'Export Current Settings', 'lifterlms-launchpad' ),
                    'type' => 'button',
                    'id' => 'generate-export',
                    'option_value' => __( 'Generate Export', 'lifterlms-launchpad' ),
                    'class' => 'button-secondary',
                ),
                array(
                    'title' => __( 'Import Saved Settings', 'lifterlms-launchpad' ),
                    'type' => 'button',
                    'id' => 'generate-import-field',
                    'option_value' => __( 'Import Settings', 'lifterlms-launchpad' ),
                    'class' => 'button-secondary',
                ),
                array(
                    'type' => 'sectionend',
                    'id' => 'export_options'
                ),

            )
        );
    }

}
