<?php
/**
 * LifterLMS WPForms Main Class
 *
 * @package  LifterLMS_WPForms/Classes
 * @since    1.0.0
 * @version  1.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * LifterLMS_WPForms class.
 */
final class LifterLMS_WPForms {

	/**
	 * Current version of the plugin
	 *
	 * @var string
	 */
	public $version = '1.1.0';

	/**
	 * Singleton instance of the class
	 *
	 * @var     obj
	 */
	private static $_instance = null;

	/**
	 * Singleton Instance of the LifterLMS_WPForms class
	 *
	 * @return   obj  instance of the LifterLMS_WPForms class.
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
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.1.0
	 */
	private function __construct() {

		if ( ! defined( 'LLMS_WPFORMS_VERSION' ) ) {
			define( 'LLMS_WPFORMS_VERSION', $this->version );
		}

		add_action( 'init', array( $this, 'load_textdomain' ), 0 );

		// get started.
		add_action( 'plugins_loaded', array( $this, 'init' ), 10 );

	}

	/**
	 * Access the integration class
	 *
	 * @example  $integration = LLMS_WPForms()->get_integration();.
	 * @return   obj
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_integration() {
		return LLMS()->integrations()->get_integration( 'wpforms' );
	}

	/**
	 * Include files and instantiate classes
	 *
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
	 *
	 * @return  void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function init() {

		// only load if we have the minimum LifterLMS version installed & activated.
		if ( function_exists( 'LLMS' ) && version_compare( '3.20.1', LLMS()->version, '<=' ) ) {

			// require integration class.
			require_once LLMS_WPFORMS_PLUGIN_DIR . 'includes/class-llms-integration-wpforms.php';

			// register the integration.
			add_filter( 'lifterlms_integrations', array( $this, 'register_integration' ), 10, 1 );

			// load includes.
			add_action( 'plugins_loaded', array( $this, 'includes' ), 100 );

		}

	}

	/**
	 * Load l10n files
	 * The first loaded file takes priority
	 *
	 * Files can be found in the following order:
	 *      WP_LANG_DIR/lifterlms/lifterlms-wpforms-LOCALE.mo
	 *      WP_LANG_DIR/plugins/lifterlms-wpforms-LOCALE.mo
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function load_textdomain() {

		// load locale.
		$locale = apply_filters( 'plugin_locale', get_locale(), 'lifterlms-wpforms' );

		// load a lifterlms specific locale file if one exists.
		load_textdomain( 'lifterlms-wpforms', WP_LANG_DIR . '/lifterlms/lifterlms-wpforms-' . $locale . '.mo' );

		// load localization files.
		load_plugin_textdomain( 'lifterlms-wpforms', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n' );

	}


	/**
	 * Register the integration with LifterLMS
	 *
	 * @param    array $integrations  array of LifterLMS Integration Classes.
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function register_integration( $integrations ) {

		$integrations[] = 'LLMS_Integration_WPForms';
		return $integrations;

	}

}
