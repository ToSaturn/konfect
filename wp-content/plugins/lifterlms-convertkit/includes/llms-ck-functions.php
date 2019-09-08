<?php
/**
 * LifterLMS ConvertKit Functions
 *
 * @package  LifterLMS_ConvertKit/Functions
 * @since    1.0.0
 * @version  2.1.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'llms_ck_consent_form_field' ) ) {

	/**
	 * Get the HTML for the Terms field displayed on reg forms
	 *
	 * @return   void
	 * @since    2.0.0
	 * @version  2.1.0
	 */
	function llms_ck_consent_form_field() {

		if ( llms_ck_is_user_unsubscribed() || llms_ck_has_user_consented() ) {
			return;
		}

		llms_form_field(
			array(
				'columns'     => 12,
				'description' => '',
				'default'     => 'no',
				'id'          => 'llms_ck_consent',
				'label'       => llms_ck_get_consent_notice(),
				'last_column' => true,
				'type'        => 'checkbox',
				'value'       => 'yes',
			)
		);

	}
}

/**
 * Outputs an unsubscribe or subscribe field on the student dashboard
 * Depending on student's current subscription status
 *
 * @return   void
 * @since    2.0.0
 * @version  2.1.0
 */
function llms_ck_dashboard_consent_form_field() {

	// user already unsubscribed.
	if ( llms_ck_is_user_unsubscribed() ) {
		return;
	}

	// if not consented.
	if ( ! llms_ck_has_user_consented() ) {
		llms_ck_consent_form_field();
	} else {
		// has consented, let them unsubscribe.
		llms_form_field(
			array(
				'columns'     => 12,
				'description' => '',
				'default'     => 'no',
				'id'          => 'llms_ck_unsubscribe',
				'label'       => llms_ck_get_unsubscribe_notice(),
				'last_column' => true,
				'type'        => 'checkbox',
				'value'       => 'yes',
			)
		);
	}

}

/**
 * Get the default / customized text for the consent notice checkbox
 *
 * @return   string
 * @since    2.0.0
 * @version  2.0.0
 */
function llms_ck_get_consent_notice() {
	return LLMS_ConvertKit()->get_integration()->get_consent_notice();
}

/**
 * Get the default / customized text for the unsubscribe notice checkbox
 *
 * @return   string
 * @since    2.0.0
 * @version  2.0.0
 */
function llms_ck_get_unsubscribe_notice() {
	return LLMS_ConvertKit()->get_integration()->get_unsubscribe_notice();
}

/**
 * Determine if a user has provided consent after checking if they're unsubscribed.
 *
 * @param   int $user_id WP_User id (optional).
 * @return  bool
 * @since   2.1.0
 * @version 2.1.0
 */
function llms_ck_has_user_consented( $user_id = null ) {

	$status = false;

	// Consent is disabled, return true.
	if ( ! llms_ck_is_consent_enabled() ) {

		$status = true;

	} else {

		$user_id = $user_id ? $user_id : get_current_user_id();

		// if the user is not unsubscribed and we have a user ID check the consent status stored on the usermeta table.
		if ( ! llms_ck_is_user_unsubscribed( $user_id ) && $user_id ) {
			$status = llms_parse_bool( get_user_meta( $user_id, 'llms_ck_consent', true ) );
		}
	}

	return apply_filters( 'llms_ck_has_user_consented', $status, $user_id );

}

/**
 * Determines if consent is enabled
 * Consent is automatically enabled and can be disabled with a filter.
 * When disabled students will be automatically subscribed without first requiring their explicit consent.
 *
 * @return   boolean
 * @since    2.1.0
 * @version  2.1.0
 */
function llms_ck_is_consent_enabled() {
	return apply_filters( 'llms_ck_enable_consent', true );
}

/**
 * Determine if a user has unsubscribed via the student dashboard option
 *
 * @param    int $user_id WP_User ID.
 * @return   boolean
 * @since    2.0.0
 * @version  2.1.0
 */
function llms_ck_is_user_unsubscribed( $user_id = null ) {

	$status = false;

	// Consent is disabled, return false because user's can't unsubscribe.
	if ( ! llms_ck_is_consent_enabled() ) {

		$status = false;

	} else {

		$user_id = $user_id ? $user_id : get_current_user_id();
		if ( $user_id ) {
			$status = llms_parse_bool( get_user_meta( $user_id, 'llms_ck_unsubscribed', true ) );
		}
	}

	return apply_filters( 'llms_ck_is_user_unsubscribed', $status, $user_id );
}

if ( ! function_exists( 'llms_ck_wc_consent_form_field' ) ) {

	/**
	 * Get the HTML for the Terms field displayed on WC Checkout
	 *
	 * @return   void
	 * @since    2.1.0
	 * @version  2.1.0
	 */
	function llms_ck_wc_consent_form_field() {

		// WC not enabled, user is unsubscribed, or user has already consented.
		if ( ! llms_parse_bool( LLMS_ConvertKit()->get_integration()->get_option( 'woocommerce', 'yes' ) ) || llms_ck_is_user_unsubscribed() || llms_ck_has_user_consented() ) {
			return;
		}

		$posted = llms_parse_bool( llms_filter_input( INPUT_POST, 'llms_ck_consent', FILTER_SANITIZE_STRING ) );
		?>
		<p class="llms-ck-wc-consent-checkbox-row form-row">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
			<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="llms_ck_consent" <?php checked( $posted, true ); ?> id="llms_ck_consent" value="yes">
				<span class="llms-ck-wc-consent-checkbox-text"><?php echo llms_ck_get_consent_notice(); ?></span>
			</label>
		</p>
		<?php

	}
}

if ( ! function_exists( 'llms_ck_wc_dashboard_consent_form_field' ) ) {

	/**
	 * Outputs an unsubscribe or subscribe field on the student dashboard
	 * Depending on student's current subscription status
	 *
	 * @return   void
	 * @since    2.1.0
	 * @version  2.1.0
	 */
	function llms_ck_wc_dashboard_consent_form_field() {

		// WC not enabled or user is unsubscribed.
		if ( ! llms_parse_bool( LLMS_ConvertKit()->get_integration()->get_option( 'woocommerce', 'yes' ) ) || llms_ck_is_user_unsubscribed() ) {
			return;
		}

		// if not consented.
		if ( ! llms_ck_has_user_consented() ) {
			llms_ck_consent_form_field();

			// has consented, let them unsubscribe.
		} else {

			$posted = llms_parse_bool( llms_filter_input( INPUT_POST, 'llms_ck_unsubscribe', FILTER_SANITIZE_STRING ) );
			?>
			<p class="llms-ck-wc-unsubscribe-checkbox-row form-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
				<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="llms_ck_unsubscribe" <?php checked( $posted, true ); ?> id="llms_ck_unsubscribe" value="yes">
					<span class="llms-ck-wc-unsubscribe-checkbox-text"><?php echo llms_ck_get_unsubscribe_notice(); ?></span>
				</label>
			</p>
			<?php
		}

	}
}
