<?php
/**
 * Plugin Name: LifterLMS Ninja Forms
 * Plugin URI: https://lifterlms.com/product/ninja-forms/
 * Description: Seamlessly add Ninja Forms to LifterLMS lessons, add form entries to the LMS reporting, create a custom registration form, and more.
 * Version: 1.0.1
 * Author: LifterLMS
 * Author URI: https://lifterlms.com/
 * Text Domain: lifterlms-ninja-forms
 * Domain Path: /i18n
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * LifterLMS Minimum Version: 3.19.6
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'LifterLMS_Ninja_Forms' ) ) :

final class LifterLMS_Ninja_Forms {

	/**
	 * Current version of the plugin
	 * @var string
	 */
	public $version = '1.0.1';

	/**
	 * Singleton instance of the class
	 * @var     obj
	 */
	private static $_instance = null;

	/**
	 * Singleton Instance of the LifterLMS_Ninja_Forms class
	 * @return   obj  instance of the LifterLMS_Ninja_Forms class
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Constructor
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function __construct() {

		// define plugin constants
		$this->define_constants();

		add_action( 'init', array( $this, 'load_textdomain' ), 0 );

		// get started
		add_action( 'plugins_loaded', array( $this, 'init' ), 10 );

	}

	/**
	 * Define all constants used by the plugin
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function define_constants() {

		if ( ! defined( 'LLMS_NINJA_FORMS_PLUGIN_FILE' ) ) {
			define( 'LLMS_NINJA_FORMS_PLUGIN_FILE', __FILE__ );
		}

		if ( ! defined( 'LLMS_NINJA_FORMS_PLUGIN_DIR' ) ) {
			define( 'LLMS_NINJA_FORMS_PLUGIN_DIR', WP_PLUGIN_DIR . "/" . plugin_basename( dirname(__FILE__ ) ) . '/' );
		}

		if ( ! defined( 'LLMS_NINJA_FORMS_PLUGIN_URL' ) ) {
			define( 'LLMS_NINJA_FORMS_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
		}

		if ( ! defined( 'LLMS_NINJA_FORMS_VERSION' ) ) {
			define( 'LLMS_NINJA_FORMS_VERSION', $this->version );
		}

	}


	/**
	 * Access the integration class
	 * @example  $integration = LLMS_Ninja_Forms()->get_integration();
	 * @return   obj
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_integration() {
		return LLMS()->integrations()->get_integration( 'ninja_forms' );
	}

	/**
	 * Include files and instantiate classes
	 * @return  void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function includes() {

		if ( ! $this->get_integration() ) {
			return;
		}

	}

	/**
	 * Include all required files and classes
	 * @return  void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function init() {

		// only load if we have the minimum LifterLMS version installed & activated
		if ( function_exists( 'LLMS' ) && version_compare( '3.19.6', LLMS()->version, '<=' ) ) {

			// require integration class
			require_once LLMS_NINJA_FORMS_PLUGIN_DIR . 'includes/class-llms-integration-ninja-forms.php';

			// register the integration
			add_filter( 'lifterlms_integrations', array( $this, 'register_integration' ), 10, 1 );


			// load includes
			add_action( 'plugins_loaded', array( $this, 'includes' ), 100 );

		}

	}

	/**
	 * Load l10n files
	 * The first loaded file takes priority
	 *
	 * Files can be found in the following order:
	 * 		WP_LANG_DIR/lifterlms/lifterlms-ninja-forms-LOCALE.mo
	 * 		WP_LANG_DIR/plugins/lifterlms-ninja-forms-LOCALE.mo
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function load_textdomain() {

		// load locale
		$locale = apply_filters( 'plugin_locale', get_locale(), 'lifterlms-ninja-forms' );

		// load a lifterlms specific locale file if one exists
		load_textdomain( 'lifterlms-ninja-forms', WP_LANG_DIR . '/lifterlms/lifterlms-ninja-forms-' . $locale . '.mo' );

		// load localization files
		load_plugin_textdomain( 'lifterlms-ninja-forms', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n' );

	}


	/**
	 * Register the integration with LifterLMS
	 * @param    array     $integrations  array of LifterLMS Integration Classes
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function register_integration( $integrations ) {

		$integrations[] = 'LLMS_Integration_Ninja_Forms';
		return $integrations;

	}

}
endif;

/**
 * Main Plugin Instance
 * @since    1.0.0
 * @version  1.0.0
 */
function LLMS_Ninja_Forms() {
	return LifterLMS_Ninja_Forms::instance();
}

return LLMS_Ninja_Forms();
