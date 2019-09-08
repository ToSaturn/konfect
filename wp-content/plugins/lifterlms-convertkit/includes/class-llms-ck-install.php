<?php
/**
 * Plugin installation
 *
 * @package  LifterLMS_ConvertKit/Classes
 * @since   2.0.0
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_CK_Install.
 */
class LLMS_CK_Install {

	/**
	 * Initialize the install class
	 * Hooks all actions
	 *
	 * @return   void
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public static function init() {

		add_action( 'init', array( __CLASS__, 'check_version' ), 5 );

	}

	/**
	 * Checks the current LLMS version and runs installer if required
	 *
	 * @return   void
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public static function check_version() {
		if ( ! defined( 'IFRAME_REQUEST' ) && get_option( 'llms_integration_convertkit_version' ) !== LLMS_ConvertKit()->version ) {
			self::install();
			do_action( 'llms_ck_updated' );
		}

	}

	/**
	 * Core install function
	 *
	 * @return  void
	 * @since   2.0.0
	 * @version 2.0.0
	 */
	public static function install() {

		if ( ! is_blog_installed() ) {
			return;
		}

		do_action( 'llms_ck_before_install' );

		// migrate legacy options.
		if ( ! get_option( 'llms_integration_convertkit_version' ) ) {

			$opts = array(
				'lifterlms_convertkit_enabled'           => 'llms_integration_convertkit_enabled',
				'lifterlms_convertkit_apikey'            => 'llms_integration_convertkit_apikey',
				'lifterlms_convertkit_default_tags'      => 'llms_integration_convertkit_default_tags',
				'lifterlms_convertkit_default_sequences' => 'llms_integration_convertkit_default_sequences',
			);

			global $wpdb;
			foreach ( $opts as $old => $new ) {
				$wpdb->update(
					$wpdb->options,
					array(
						'option_name' => $new,
					),
					array(
						'option_name' => $old,
					)
				);
			}
		}

		self::update_version();

		do_action( 'llms_ck_after_install' );

	}

	/**
	 * Update the LifterLMS version record to the latest version
	 *
	 * @param  string $version version number.
	 * @return void
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public static function update_version( $version = null ) {
		delete_option( 'llms_integration_convertkit_version' );
		add_option( 'llms_integration_convertkit_version', is_null( $version ) ? LLMS_ConvertKit()->version : $version );
	}

}

LLMS_CK_Install::init();
