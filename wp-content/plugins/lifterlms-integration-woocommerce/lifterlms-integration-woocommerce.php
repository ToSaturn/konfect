<?php
/**
 * LifterLMS WooCommerce Plugin
 *
 * @package   LifterLMS_WooCommerce/Main
 *
 * @since 1.0.0
 * @version 2.0.0
 *
 * Plugin Name: LifterLMS WooCommerce
 * Plugin URI: https://lifterlms.com/product/woocommerce-extension/
 * Description: Sell LifterLMS Courses and Memberships using WooCommerce
 * Version: 2.0.11
 * Author: Team LifterLMS
 * Author URI: https://lifterlms.com
 * Text Domain: lifterlms-woocommerce
 * Domain Path: /i18n
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Requires at least: 4.2
 * Tested up to: 4.5.3
 * LLMS requires at least: 3.25.2
 * LLMS tested up to: 3.25.2
 * WC requires at least: 3.0
 * WC tested up to: 3.5.4
 */

defined( 'ABSPATH' ) || exit;

// Define Constants.
if ( ! defined( 'LLMS_WC_PLUGIN_FILE' ) ) {
	define( 'LLMS_WC_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'LLMS_WC_PLUGIN_DIR' ) ) {
	define( 'LLMS_WC_PLUGIN_DIR', dirname( __FILE__ ) . '/' );
}

// Load LifterLMS WooCommerce.
if ( ! class_exists( 'LifterLMS_WooCommerce' ) ) {
	require_once LLMS_WC_PLUGIN_DIR . 'class-lifterlms-woocommerce.php';
}

// phpcs:disable WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
/**
 * Returns the main instance of LifterLMS_WooCommerce
 *
 * @since    1.0.0
 * @version  1.0.0
 * @return   LifterLMS
 */
function LLMS_WooCommerce() {
	return LifterLMS_WooCommerce::instance();
}
return LLMS_WooCommerce();
// phpcs:enable
