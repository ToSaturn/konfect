<?php
/**
 * LifterLMS ConvertKit Template hooks.
 *
 * @package  LifterLMS_ConvertKit/Hooks
 * @since    2.0.0
 * @version  2.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Only add actions if consent is enabled
 */
if ( llms_ck_is_consent_enabled() ) {

	/**
	 * Hook the consent field to checkout, enrollment, & reg
	 *
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	add_action( 'llms_registration_privacy', 'llms_ck_consent_form_field', 15 );

	/**
	 * Hook the consent field / unsubscribe field to student dashboard edit account tab
	 *
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	add_action( 'lifterlms_after_update_fields', 'llms_ck_dashboard_consent_form_field', 15 );

	/**
	 * Hook the consent field to WC checkout
	 *
	 * @since    2.1.0
	 * @version  2.1.0
	 */
	add_action( 'woocommerce_checkout_after_terms_and_conditions', 'llms_ck_wc_consent_form_field', 15 );

	/**
	 * Hook the consent field to WC registration
	 *
	 * @since    2.1.0
	 * @version  2.1.0
	 */
	add_action( 'woocommerce_register_form', 'llms_ck_wc_consent_form_field', 25 );

	/**
	 * Hook the consent field / unsubscribe field to WC account edit
	 *
	 * @since    2.1.0
	 * @version  2.1.0
	 */
	add_action( 'woocommerce_edit_account_form', 'llms_ck_wc_dashboard_consent_form_field', 15 );

}
