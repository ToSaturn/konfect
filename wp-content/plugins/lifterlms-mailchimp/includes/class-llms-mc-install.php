<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin installation
 * @since   3.0.0
 * @version 3.0.0
 */
class LLMS_MC_Install {

	/**
	 * Initialize the install class
	 * Hooks all actions
	 * @return   void
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public static function init() {

		add_action( 'init', array( __CLASS__, 'check_version' ), 5 );

	}

	/**
	 * Checks the current LLMS version and runs installer if required
	 * @return   void
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public static function check_version() {
		if ( ! defined( 'IFRAME_REQUEST' ) && get_option( 'llms_integration_mailchimp_version' ) !== LLMS_MailChimp()->version ) {
			self::install();
			do_action( 'llms_mc_updated' );
		}

	}

	/**
	 * Core install function
	 * @return  void
	 * @since   3.0.0
	 * @version 3.0.0
	 */
	public static function install() {

		if ( ! is_blog_installed() ) {
			return;
		}

		do_action( 'llms_mc_before_install' );

		// migrate legacy options
		if ( ! get_option( 'llms_integration_mailchimp_version' ) ) {

			$opts = array(
				'lifterlms_mailchimp_enabled' => 'llms_integration_mailchimp_enabled',
				'lifterlms_mailchimp_apikey' => 'llms_integration_mailchimp_apikey',
				'lifterlms_mailchimp_default_list' => 'llms_integration_mailchimp_default_list',
				'lifterlms_mailchimp_enable_confirmations' => 'llms_integration_mailchimp_enable_confirmations',
				'llms_mailchimp_lists' => 'llms_integration_mailchimp_lists',
				'llms_mailchimp_groups' => 'llms_integration_mailchimp_groups',
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

		do_action( 'llms_mc_after_install' );

	}

	/**
	 * Update the LifterLMS version record to the latest version
	 * @param  string $version version number
	 * @return void
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public static function update_version( $version = null ) {
		delete_option( 'llms_integration_mailchimp_version' );
		add_option( 'llms_integration_mailchimp_version', is_null( $version ) ? LLMS_MailChimp()->version : $version );
	}

}

LLMS_MC_Install::init();
