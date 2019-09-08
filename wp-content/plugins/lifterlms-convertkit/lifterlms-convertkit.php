<?php
/**
 * LifterLMS ConvertKit Plugin
 *
 * @package   LifterLMS_ConvertKit/Main
 *
 * Plugin Name: LifterLMS ConvertKit
 * Plugin URI: https://lifterlms.com/products/lifterlms-convertkit
 * Description: Connect LifterLMS to ConvertKit! Automatically add LifterLMS Students to ConvertKit Tags and ConverKit Sequences during LifterLMS registration, LifterLMS Course enrollment, and LifterLMS Membership signup.
 * Version: 2.1.0
 * Author: Thomas Patrick Levy
 * Author URI: https://lifterlms.com
 * Text Domain: lifterlms-convertkit
 * Domain Path: /i18n
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Requires at least: 4.2
 * Tested up to: 5.1
 * LLMS requires at least: 2.29.0
 * LLMS tested up to: 3.29.3
 */

defined( 'ABSPATH' ) || exit;

// Define constants.
if ( ! defined( 'LLMS_CONVERTKIT_PLUGIN_FILE' ) ) {
	define( 'LLMS_CONVERTKIT_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'LLMS_CONVERTKIT_PLUGIN_DIR' ) ) {
	define( 'LLMS_CONVERTKIT_PLUGIN_DIR', dirname( __FILE__ ) . '/' );
}

// Load LifterLMS ConvertKit.
if ( ! class_exists( 'LifterLMS_ConvertKit' ) ) {
	require_once LLMS_CONVERTKIT_PLUGIN_DIR . 'class-lifterlms-convertkit.php';
}

// phpcs:disable WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
/**
 * Main Plugin Instance
 *
 * @since    2.0.0
 * @version  2.0.0
 */
function LLMS_ConvertKit() {
	return LifterLMS_ConvertKit::instance();
}
return LLMS_ConvertKit();
// phpcs:enable
