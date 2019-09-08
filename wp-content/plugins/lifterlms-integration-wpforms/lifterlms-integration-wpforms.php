<?php
/**
 * LifterLMS WPForms Plugin
 *
 * @package   LifterLMS_WPForms/Main
 *
 * Plugin Name: LifterLMS WPForms
 * Plugin URI: https://lifterlms.com/product/wpforms/
 * Description: Seamlessly add WPForms to LifterLMS lessons, add form entries to the LMS reporting, create a custom registration form, and more
 * Version: 1.1.0
 * Author: LifterLMS
 * Author URI: https://lifterlms.com/
 * Text Domain: lifterlms-wpforms
 * Domain Path: /i18n
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * LifterLMS Minimum Version: 3.20.1
 */

defined( 'ABSPATH' ) || exit;

// Define Constants.
if ( ! defined( 'LLMS_WPFORMS_PLUGIN_FILE' ) ) {
	define( 'LLMS_WPFORMS_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'LLMS_WPFORMS_PLUGIN_DIR' ) ) {
	define( 'LLMS_WPFORMS_PLUGIN_DIR', dirname( __FILE__ ) . '/' );
}

if ( ! defined( 'LLMS_WPFORMS_PLUGIN_URL' ) ) {
	define( 'LLMS_WPFORMS_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
}

if ( ! class_exists( 'LifterLMS_WPForms' ) ) {
	require_once LLMS_WPFORMS_PLUGIN_DIR . 'class-lifterlms-wpforms.php';
}

// phpcs:disable WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
/**
 * Main Plugin Instance
 *
 * @since    1.0.0
 * @version  1.0.0
 * @return   obj
 */
function LLMS_WPForms() {
	return LifterLMS_WPForms::instance();
}
return LLMS_WPForms();
// phpcs:enable
