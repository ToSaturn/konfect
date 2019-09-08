<?php

namespace SkyLab\Settings;

use SkyLab\Fields\FieldGenerator;
use SkyLab\Config\Configuration;

/**
 * Generates Settings Sections
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class SettingGenerator {

	/**
	* Settings array
    *
    * @since 0.0.1
    * @version 0.0.1
    *
	* @access private
	* @var array
	*/
	private static $settings = [];

    /**
    * Errors array
    *
    * @since 0.0.1
    * @version 0.0.1
    *
    * @access private
    * @var array
    */
	private static $errors   = [];

    /**
     * Instance of Configuration class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private $config;

    /**
    * Messages array
    *
    * @since 0.0.1
    * @version 0.0.1
    *
    * @access private
    * @var array
    */
	private static $messages = [];

    public function __construct(Configuration $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
    * Inits $settings and includes settings base class.
    *
    * @since 0.0.1
    * @version 0.0.1
    *
    * @return self::$settings array
    */
	public function get_settings_tabs()
    {
		if (empty(self::$settings))
        {
			$settings = [];

            $files = glob(trailingslashit(get_template_directory())
                . $this->config->get_settings_directory() . '*.php');

            foreach ($files as $file)
            {
                $file = $this->config->get_settings_namespace() . str_replace('.php', '', basename($file));
                $settings[] = new $file;
            }

			self::$settings = apply_filters('launchpad_settings_sections', $settings);

		}

		return self::$settings;
	}

    /**
    * Save method. Saves all fields on current tab
    *
    * @since 0.0.1
    * @version 0.0.1
    *
    * @return void
    */
	public static function save() {
		global $current_tab;

		if (empty($_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'launchpad-settings') ) {
			die(__( 'Whoa! something went wrong there!. Please refresh the page and retry.', 'lifterlms-launchpad'));
		}

	   	do_action('launchpad_settings_save_' . $current_tab);
	    do_action('launchpad_update_options_' . $current_tab);
	    do_action('launchpad_update_options');

		self::set_message(__('Your settings have been saved.', 'lifterlms-launchpad'));

		do_action('launchpad_settings_saved');
	}

    /**
    * set message to messages array
    *
    * @since 0.0.1
    * @version 0.0.1
    *
    * @param string $message
    * @return void
    */
	public static function set_message($message)
    {
		self::$messages[] = $message;
	}

    /**
    * set message to messages array
    *
    * @since 0.0.1
    * @version 0.0.1
    *
    * @param string $message
    * @return void
    */
	public static function set_error($message)
    {
		self::$errors[] = $message;
	}

    /**
    * display messages in settings
    *
    * @since 0.0.1
    * @version 0.0.1
    *
    * @return void
    */
	public static function display_messages_html()
    {
		if ( sizeof( self::$errors ) > 0 )
        {
			foreach ( self::$errors as $error )
            {
				echo '<div class="error"><p><strong>' . esc_html( $error ) . '</strong></p></div>';
			}

		} elseif ( sizeof( self::$messages ) > 0 )
        {
			foreach ( self::$messages as $message )
            {
				echo '<div class="updated"><p><strong>' . esc_html( $message ) . '</strong></p></div>';
			}
		}
	}

    /**
    * Settings Page output tabs
    *
    * @since 0.0.1
    * @version 0.0.1
    *
    * @return void
    */
	public function output()
    {
		global $current_tab;

		do_action( 'launchpad_settings_start' );

		self::get_settings_tabs();

		$current_tab = empty( $_GET['tab'] ) ? apply_filters( 'launchpad_settings_default_tab', 'general' ) : sanitize_title( $_GET['tab'] );

	    if ( ! empty( $_POST ) )
	    	self::save();

	    if ( ! empty( $_GET['launchpad_error'] ) )
	    	self::set_error( stripslashes( $_GET['launchpad_error'] ) );

	    if ( ! empty( $_GET['launchpad_message'] ) )
	    	self::set_message( stripslashes( $_GET['launchpad_message'] ) );

	    self::display_messages_html();

	    $tabs = apply_filters( 'launchpad_settings_tabs_array', array() );

        // if the current tab doesn't exist, return the first tab in the array
        if ( ! isset( $tabs[$current_tab] ) ) {

            $current_tab = array_keys( $tabs )[0];

        }

		include ($this->config->get_admin_views_directory() . 'view.settings.form.php');
	}

    /**
    * Output fields for settings tabs. Dynamically generates fields.
    *
    * @since 0.0.1
    * @version 0.0.1
    *
    * @return echo html
    */
	public static function output_fields($settings)
    {
        $fields = new FieldGenerator($settings);

        $fields->output();
	}

	/**
	 * Save admin fields.
	 * Loops though the launchpad options array and outputs each field.
	 *
     * @since 0.0.1
     * @version 0.0.1
     *
	 * @param array $settings Opens array to output
	 * @return bool
	 */
	public static function save_fields($settings, $restore_to_defaults = false)
    {
        $fields = new FieldGenerator($settings);

        $fields->save($restore_to_defaults);
	}

    /**
     * Save the default settings
     * If force_reset is false it will always check if the default
     * settings have already been installed. set force_reset to true
     * to reset the default settings if they have already been set.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param bool $force_reset
     */
    public function save_default_settings($force_reset = false)
    {
        if ( ! get_option('launchpad_default_settings_saved', false) || $force_reset)
        {
            $settings = self::get_default_settings();

            // save fields and restore to defaults
            self::save_fields($settings, true);

            update_option('launchpad_default_settings_saved', true);

        }

    }

    /**
     * Get Sidebars
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    public function get_default_settings()
    {
        if (empty(self::$settings))
        {
            $settings = [];

            $files = glob(trailingslashit(get_template_directory())
                . $this->config->get_settings_directory() . '*.php');

            foreach ($files as $file)
            {
                $file = $this->config->get_settings_namespace() . str_replace('.php', '', basename($file));
                $settings = array_merge($settings, (new $file)->get_settings());
            }

            self::$settings = apply_filters('launchpad_save_default_settings', $settings);

        }

        $settings = apply_filters('launchpad_default_settings', self::$settings);

        return $settings;
    }

}
