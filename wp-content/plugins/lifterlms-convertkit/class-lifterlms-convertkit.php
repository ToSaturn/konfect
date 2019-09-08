<?php
/**
 * LifterLMS ConvertKit Main Class
 *
 * @package  LifterLMS_ConvertKit/Classes
 * @since    1.0.0
 * @version  2.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * LifterLMS ConvertKit Main Class
 */
final class LifterLMS_ConvertKit {

	/**
	 * Current version of the plugin
	 *
	 * @var string
	 */
	public $version = '2.1.0';

	/**
	 * Singleton instance of the class
	 *
	 * @var     obj
	 */
	private static $_instance = null;

	/**
	 * Singleton Instance of the LifterLMS_Social_Learning class
	 *
	 * @return   obj  instance of the LifterLMS_Social_Learning class
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Constructor, get things started!
	 *
	 * @return  void
	 * @since   1.0.0
	 * @version 2.1.0
	 */
	private function __construct() {

		add_action( 'plugins_loaded', array( $this, 'init' ) );
		add_action( 'init', array( $this, 'load_textdomain' ), 0 );

	}

	/**
	 * Inititalize the Plugin
	 *
	 * @return  void
	 * @since   1.0.0
	 * @version 1.0.0
	 */
	public function init() {

		// only load if we have the minimum LifterLMS version installed & activated.
		if ( function_exists( 'LLMS' ) && version_compare( '3.29.0', LLMS()->version, '<=' ) ) {

			require_once LLMS_CONVERTKIT_PLUGIN_DIR . 'includes/class-llms-integration-convertkit.php';

			// register the integration.
			add_filter( 'lifterlms_integrations', array( $this, 'register_integration' ), 10, 1 );

			// load includes.
			add_action( 'plugins_loaded', array( $this, 'includes' ), 9999 );

		}

	}

	/**
	 * Retrieve an instance of the LLMS_CK_API class.
	 *
	 * @example LLMS_ConvertKit()->api();
	 *
	 * @return  LLMS_CK_API
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	public function api() {
		return LLMS_CK_API::instance();
	}

	/**
	 * Access the integration class
	 *
	 * @example  $integration = LLMS_ConvertKit()->get_integration();
	 * @return   obj
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public function get_integration() {
		return LLMS()->integrations()->get_integration( 'convertkit' );
	}

	/**
	 * Include all clasess required by the plugin
	 *
	 * @return  void
	 * @since   1.0.0
	 * @version 2.1.0
	 */
	public function includes() {

		require_once 'includes/class-llms-ck-install.php';
		require_once 'includes/class-llms-ck-api.php';

		$integration = $this->get_integration();

		if ( ! $integration ) {
			return;
		}

		require_once 'includes/llms-ck-functions.php';

		require_once 'includes/llms-ck-template-hooks.php';

		require_once 'includes/class-llms-ck-posts-settings.php';
		require_once 'includes/class-llms-ck-purchases.php';
		require_once 'includes/class-llms-ck-user-actions.php';

		if ( class_exists( 'LLMS_Privacy' ) ) {
			require_once 'includes/class-llms-ck-privacy.php';
		}

		// Include deprecated functions.
		require_once 'includes/deprecated/llms-ck-functions-deprecated.php';

	}

	/**
	 * Load Localization files
	 *
	 * The first loaded file takes priority
	 *
	 * Files can be found in the following order:
	 *      WP_LANG_DIR/lifterlms/lifterlms-convertkit-LOCALE.mo
	 *      wp_content/plugins/lifterlms-integration-twilio/i18n/lifterlms-convertkit-LOCALE.mo
	 *
	 * @return   void
	 * @since    1.1.0
	 * @version  1.1.0
	 */
	public function load_textdomain() {

		// load locale.
		$locale = apply_filters( 'plugin_locale', get_locale(), 'lifterlms-convertkit' );

		// load a lifterlms specific locale file if one exists.
		load_textdomain( 'lifterlms-convertkit', WP_LANG_DIR . '/lifterlms/lifterlms-convertkit-' . $locale . '.mo' );

		// load localization files.
		load_plugin_textdomain( 'lifterlms-convertkit', false, dirname( plugin_basename( __FILE__ ) ) . '/i18n' );

	}

	/**
	 * Register the integration with LifterLMS
	 *
	 * @param    array $integrations  array of LifterLMS Integration Classes.
	 * @return   array
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public function register_integration( $integrations ) {

		$integrations[] = 'LLMS_Integration_ConvertKit';
		return $integrations;

	}

}
