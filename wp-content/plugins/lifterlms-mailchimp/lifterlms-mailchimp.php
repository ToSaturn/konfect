<?php
/**
 * LifterLMS MailChimp Plugin
 *
 * @package LifterLMS_MailChimp/Main
 *
 * @since 1.0.0
 * @version 3.1.2
 *
 * Plugin Name: LifterLMS MailChimp Add-on
 * Plugin URI: https://lifterlms.com/product/mailchimp-extension/
 * Description: Automatically add your LifterLMS students and members to MailChimp lists and groups during enrollment and registration
 * Version: 3.1.2
 * Text Domain: lifterlms-mailchimp
 * Domain Path: /i18n
 * License:     GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Author: Thomas Patrick Levy, codeBOX LLC
 * Author URI: https://gocodebox.com
 * Requires LifterLMS: 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LifterLMS_MailChimp') ):

/**
 * LifterLMS MailChimp Plugin
 *
 * @package LifterLMS_MailChimp/Main
 *
 * @since 1.0.0
 * @since 3.1.2 Always load the API class.
 */
final class LifterLMS_MailChimp {

	/**
	 * Plugin Version.
	 *
	 * @var string
	 */
	public $version = '3.1.2';

	/**
	 * Singleton instance of the class.
	 *
	 * @var LifterLMS_MailChimp
	 */
	private static $_instance = null;

	/**
	 * Singleton Instance of the LifterLMS_Stripe class
	 * @return  obj    instance of the LifterLMS_Stripe class
	 * @since   2.2.0
	 * @version 2.2.0
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Contructor
	 * @since    1.0.0
	 * @version  3.0.0
	 */
	private function __construct() {

		$this->define_constants();

		add_action( 'plugins_loaded', array( $this, 'init') );
		add_action( 'init', array( $this, 'load_textdomain' ), 0 );

	}

	/**
	 * Define constants for plugin
	 * @return   void
	 * @since    1.0.0
	 * @version  3.0.0
	 */
	private function define_constants() {

		// initial file of mailchimp plugin
		if ( ! defined( 'LLMS_MAILCHIMP_PLUGIN_FILE' ) ) {
			define( 'LLMS_MAILCHIMP_PLUGIN_FILE', __FILE__ );

		}

		// location directory of where the mailchimp plugin lives
		if ( ! defined( 'LLMS_MAILCHIMP_PLUGIN_DIR' ) ) {
			define( 'LLMS_MAILCHIMP_PLUGIN_DIR', WP_PLUGIN_DIR . "/" . plugin_basename( dirname(__FILE__) ) . '/');
		}

	}

	/**
	 * Init
	 * @return  void
	 * @since   1.0.1
	 * @version 2.2.0
	 */
	public function init() {

		// only load if we have the minimum LifterLMS version installed & activated
		if ( function_exists( 'LLMS' ) && version_compare( '3.8.0', LLMS()->version, '<=' ) ) {

			require_once LLMS_MAILCHIMP_PLUGIN_DIR . 'includes/class-llms-integration-mailchimp.php';

			// register the integration
			add_filter( 'lifterlms_integrations', array( $this, 'register_integration' ), 10, 1 );

			// load includes
			add_action( 'plugins_loaded', array( $this, 'includes' ), 9999 );

		}

	}

	/**
	 * Enqueue admin scripts & styles
	 * @return   void
	 * @since    2.2.0
	 * @version  3.1.0
	 */
	public function admin_enqueue() {

		$screen = get_current_screen();

		if ( ( 'lifterlms_page_llms-settings' === $screen->id && isset( $_GET['section'] ) && 'mailchimp' === $_GET['section'] ) || in_array( $screen->post_type, apply_filters( 'llms_mc_js_screens', array( 'course', 'llms_membership' ) ) ) ) {

			wp_register_script( 'llms-mc-scripts',  plugins_url( '/assets/js/llms-mailchimp.min.js', __FILE__ ), array( 'jquery', 'llms', 'llms-ajax' ), $this->version, true );
			wp_enqueue_script( 'llms-mc-scripts' );

		}

	}

	/**
	 * Access the integration class
	 * @example  $integration = LLMS_ConvertKit()->get_integration();
	 * @return   obj
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function get_integration() {
		return LLMS()->integrations()->get_integration( 'mailchimp' );
	}

	/**
	 * Include all files
	 *
	 * @since 1.0.0
	 * @since 3.1.2 Always include API class.
	 *
	 * @return  void
	 */
	public function includes() {

		require_once LLMS_MAILCHIMP_PLUGIN_DIR . 'includes/class-llms-mc-install.php';
		require_once LLMS_MAILCHIMP_PLUGIN_DIR . 'includes/class-llms-mc-api.php';

		$integration = $this->get_integration();

		if ( ! $integration ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );

		require_once LLMS_MAILCHIMP_PLUGIN_DIR . 'includes/class-llms-mc-actions.php';
		require_once LLMS_MAILCHIMP_PLUGIN_DIR . 'includes/class-llms-mc-ajax.php';
		require_once LLMS_MAILCHIMP_PLUGIN_DIR . 'includes/class-llms-mc-post.php';

		require_once LLMS_MAILCHIMP_PLUGIN_DIR . 'includes/functions-llms-mc.php';

		if ( class_exists( 'LLMS_Privacy' ) ) {
			require_once LLMS_MAILCHIMP_PLUGIN_DIR . 'includes/class-llms-mc-privacy.php';
		}

	}

	/**
	 * Load Localization files
	 *
	 * The first loaded file takes priority
	 *
	 * Files can be found in the following order:
	 * 		WP_LANG_DIR/lifterlms/lifterlms-mailchimp-LOCALE.mo
	 * 		wp_content/plugins/lifterlms-integration-mailchimp/i18n/lifterlms-mailchimp-LOCALE.mo
	 *
	 * @return   void
	 * @since    2.2.1
	 * @version  2.2.1
	 */
	public function load_textdomain() {

		// load locale
		$locale = apply_filters( 'plugin_locale', get_locale(), 'lifterlms-mailchimp' );

		// load a lifterlms specific locale file if one exists
		load_textdomain( 'lifterlms-mailchimp', WP_LANG_DIR . '/lifterlms/lifterlms-mailchimp-' . $locale . '.mo' );

		// load localization files
		load_plugin_textdomain( 'lifterlms-mailchimp', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n' );

	}

	/**
	 * Register the integration with LifterLMS
	 * @param    array     $integrations  array of LifterLMS Integration Classes
	 * @return   array
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function register_integration( $integrations ) {

		$integrations[] = 'LLMS_Integration_MailChimp';
		return $integrations;

	}

}

endif;

/**
 * Main Stripe Instance
 * @since  2.2.0
 * @version 2.2.0
 */
function LLMS_MailChimp() {
	return LifterLMS_MailChimp::instance();
}

return LLMS_MailChimp();
