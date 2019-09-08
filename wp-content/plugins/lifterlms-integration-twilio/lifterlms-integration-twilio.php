<?php
/**
 * Plugin Name: LifterLMS Twilio
 * Plugin URI: https://lifterlms.com/
 * Description: Use Twilio to send automatic notifications via text messaging (SMS), create custom SMS engagements, and allow students to enroll in courses and memberships by SMS.
 * Version: 1.0.3
 * Author: Thomas Patrick Levy
 * Author URI: https://lifterlms.com
 * Text Domain: lifterlms-twilio
 * Domain Path: /i18n
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 4.2
 * Tested up to: 4.9.6
 * Requires LifterLMS: 3.8.0
 */

defined( 'ABSPATH' ) || exit;

final class LifterLMS_Twilio {

	public $version = '1.0.3';

	const MIN_CORE_VERSION = '3.8.0';

	protected static $_instance = null;

	/**
	 * Main Instance of LifterLMS_Twilio
	 * Ensures only one instance of LifterLMS_Twilio is loaded or can be loaded.
	 * @since    1.0.0
	 * @version  1.0.0
	 * @see      LLMS_Twilio()
	 * @return   LifterLMS_Twilio - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 * @since    1.0.0
	 * @version  1.0.2
	 * @return   void
	 */
	private function __construct() {

		if ( ! defined( 'LLMS_TWILIO_PLUGIN_FILE' ) ) {
			define( 'LLMS_TWILIO_PLUGIN_FILE', __FILE__ );
		}
		if ( ! defined( 'LLMS_TWILIO_PLUGIN_DIR' ) ) {
			define( 'LLMS_TWILIO_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
		}

		add_action( 'admin_init', array( $this, 'admin_notice' ) );
		add_action( 'init', array( $this, 'load_textdomain' ), 0 );

		register_activation_hook( __FILE__, array( $this, 'install' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ), 10 );

	}

	/**
	 * Add an admin notice if user's dont meet the minimum required LifterLMS version
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function admin_notice() {

		// there's no hope...
		if ( ! class_exists( 'LLMS_Admin_Notices' ) ) {
			return;
		}

		if ( ! $this->check_core_version() ) {

			$msg = sprintf(
				__( 'LifterLMS Twilio requires LifterLMS version %s or later. Please upgrade LifterLMS to the latest version in order to start using LifterLMS Twilio.', 'lifterlms-twilio' ),
				self::MIN_CORE_VERSION
			);

			LLMS_Admin_Notices::add_notice( 'twilio-version', $msg, array(
				'dismissible' => true,
				'dismiss_for_days' => 3,
				'type' => 'warning',
			) );

		} else {

			if ( LLMS_Admin_Notices::has_notice( 'twilio-version' ) ) {
				LLMS_Admin_Notices::delete_notice( 'twilio-version' );
			}

		}

	}

	/**
	 * Ensure the LifterLMS core meets the minimum required version
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function check_core_version() {
		if ( $this->check_dependencies() ) {
			return version_compare( LLMS()->version, self::MIN_CORE_VERSION, '>=' );
		}
		return false;
	}

	/**
	 * Check for needed functions & dependencies
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function check_dependencies() {
		return function_exists( 'LLMS' );
	}

	/**
	 * Access the integration class
	 * @example  $integration = LLMS_Twilio()->get_integration();
	 * @return   obj
	 * @since    [verson]
	 * @version  [verson]
	 */
	public function get_integration() {
		return LLMS()->integrations()->get_integration( 'twilio' );
	}

	/**
	 * Include files and instantiate classes
	 * @return  void
	 * @since    1.0.0
	 * @version  1.0.2
	 */
	public function includes() {

		$integration = $this->get_integration();

		if ( ! $integration ) {
			return;
		}

		if ( is_admin() ) {
			require_once 'includes/metaboxes/class-llms-twilio-metabox-sms-settings.php';
		}

		require_once 'includes/llms-twilio-functions.php';
		require_once 'includes/class-llms-twilio-api.php';

		require_once 'includes/class-llms-twilio-number.php';
		require_once 'includes/class-llms-twilio-rest.php';
		require_once 'includes/class-llms-twilio-twiml.php';

		require_once 'includes/class-llms-twilio-account-fields.php';
		require_once 'includes/class-llms-twilio-engagements.php';
		require_once 'includes/class-llms-twilio-notifications.php';

		if ( class_exists( 'LLMS_Privacy' ) ) {
			require_once 'includes/class-llms-twilio-privacy.php';
		}

	}

	/**
	 * Initialize, require, add hooks & filters
	 * @since    1.0.0
	 * @version  1.0.2
	 * @return   void
	 */
	public function init() {

		if ( $this->check_core_version() ) {

			// includes
			require_once 'includes/class-llms-integration-twilio.php';

			// register the integration
			add_filter( 'lifterlms_integrations', array( $this, 'register_integration' ), 10, 1 );

			// load includes
			add_action( 'plugins_loaded', array( $this, 'includes' ), 9999 );

		}

	}

	/**
	 * Load Localization files
	 *
	 * The first loaded file takes priority
	 *
	 * Files can be found in the following order:
	 * 		WP_LANG_DIR/lifterlms/lifterlms-twilio-LOCALE.mo
	 * 		wp_content/plugins/lifterlms-integration-twilio/i18n/lifterlms-twilio-LOCALE.mo
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function load_textdomain() {

		// load locale
		$locale = apply_filters( 'plugin_locale', get_locale(), 'lifterlms-twilio' );

		// load a lifterlms specific locale file if one exists
		load_textdomain( 'lifterlms-twilio', WP_LANG_DIR . '/lifterlms/lifterlms-twilio-' . $locale . '.mo' );

		// load localization files
		load_plugin_textdomain( 'lifterlms-twilio', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n' );

	}

	/**
	 * Called during plugin activation
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.2
	 */
	public function install() {
		flush_rewrite_rules();
	}

	/**
	 * Register the integration with LifterLMS
	 * @param    array     $integrations  array of LifterLMS Integration Classes
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function register_integration( $integrations ) {

		$integrations[] = 'LLMS_Integration_Twilio';
		return $integrations;

	}

}

/**
 * Returns the main instance of LLMS
 * @since    1.0.0
 * @version  1.0.0
 * @return LifterLMS
 */
function LLMS_Twilio() {
	return LifterLMS_Twilio::instance();
}
return LLMS_Twilio();
