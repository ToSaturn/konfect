<?php
/**
 * LifterLMS MailChimp Functions
 * @since    3.0.0
 * @version  3.1.0
 */
defined( 'ABSPATH' ) || exit;

/**
 * Get the HTML for the Terms field displayed on reg forms
 * @return   void
 * @since    3.0.0
 * @version  3.1.0
 */
if ( ! function_exists( 'llms_mc_consent_form_field' ) ) {

	function llms_mc_consent_form_field() {

		if ( llms_mc_get_user_consent_status() ) {
			return;
		}

		llms_form_field( array(
			'columns' => 12,
			'description' => '',
			'default' => 'no',
			'id' => 'llms_mc_consent',
			'label' => llms_mc_get_consent_notice(),
			'last_column' => true,
			'type'  => 'checkbox',
			'value' => 'yes',
		) );

	}
}


/**
 * Outputs an unsubscribe or subscribe field on the student dashboard
 * Depending on student's current subscription status
 * @return   void
 * @since    3.0.0
 * @version  3.1.0
 */
if ( ! function_exists( 'llms_mc_dashboard_consent_form_field' ) ) {

	function llms_mc_dashboard_consent_form_field() {

		// if not consented
		if ( ! llms_mc_get_user_consent_status() ) {
			llms_mc_consent_form_field();
		// has consented, let them unsubscribe
		} else {
			llms_form_field( array(
				'columns' => 12,
				'description' => '',
				'default' => 'no',
				'id' => 'llms_mc_unsubscribe',
				'label' => llms_mc_get_unsubscribe_notice(),
				'last_column' => true,
				'type'  => 'checkbox',
				'value' => 'yes',
			) );
		}

	}

}


/**
 * Get the default / customized text for the consent notice checkbox
 * @return   [type]
 * @since    3.0.0
 * @version  3.0.0
 */
function llms_mc_get_consent_notice() {
	return LLMS_MailChimp()->get_integration()->get_consent_notice();
}

/**
 * Get the default / customized text for the unsubscribe notice checkbox
 * @return   [type]
 * @since    3.0.0
 * @version  3.0.0
 */
function llms_mc_get_unsubscribe_notice() {
	return LLMS_MailChimp()->get_integration()->get_unsubscribe_notice();
}

/**
 * Determine if a user has consented to email subscriptions
 * @param    int     $user_id  WP User ID, if null will user current user id
 * @return   bool
 * @since    3.1.0
 * @version  3.1.0
 */
function llms_mc_get_user_consent_status( $user_id = null ) {

	$status = false;

	if ( llms_mc_is_consent_enabled() ) {

		$user_id = $user_id ? $user_id : get_current_user_id();
		if ( $user_id ) {
			$status = llms_parse_bool( get_user_meta( get_current_user_id(), 'llms_mc_consent', true ) );
		}

	} else {

		$status = true;

	}

	return apply_filters( 'llms_mc_get_user_consent_status', $status, $user_id );

}

/**
 * Determines if consent is enabled
 * Consent is automatically enabled and can be disabled with a filter
 * when disabled students will be automatically subscribed to lists without requiring their explicit consent
 * @return   boolean
 * @since    3.1.0
 * @version  3.1.0
 */
function llms_mc_is_consent_enabled() {
	/**
	 * @filter llms_mc_enable_consent
	 * @example
	 * 		add_filter( 'llms_mc_enable_consent', '__return_false' );
	 */
	return apply_filters( 'llms_mc_enable_consent', true );
}

/**
 * Get the HTML for the Terms field displayed on WC Checkout
 * @return   void
 * @since    3.1.0
 * @version  3.1.0
 */
if ( ! function_exists( 'llms_mc_wc_consent_form_field' ) ) {

	function llms_mc_wc_consent_form_field() {

		if ( ! llms_parse_bool( LLMS_MailChimp()->get_integration()->get_option( 'woocommerce', 'yes' ) ) ) {
			return;
		}

		if ( llms_mc_get_user_consent_status() ) {
			return;
		}

		?>
		<p class="llms-mc-wc-consent-checkbox-row form-row">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
			<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="llms_mc_consent" <?php checked( isset( $_POST['llms_mc_consent'] ), true ); ?> id="llms_mc_consent" value="yes">
				<span class="llms-mc-wc-consent-checkbox-text"><?php echo llms_mc_get_consent_notice(); ?></span>
			</label>
		</p>
		<?php

	}
}

/**
 * Outputs an unsubscribe or subscribe field on the student dashboard
 * Depending on student's current subscription status
 * @return   void
 * @since    3.0.0
 * @version  3.1.0
 */
if ( ! function_exists( 'llms_mc_wc_dashboard_consent_form_field' ) ) {

	function llms_mc_wc_dashboard_consent_form_field() {

		if ( ! llms_parse_bool( LLMS_MailChimp()->get_integration()->get_option( 'woocommerce', 'yes' ) ) ) {
			return;
		}

		// if not consented
		if ( ! llms_mc_get_user_consent_status() ) {
			llms_mc_wc_consent_form_field();
		// has consented, let them unsubscribe
		} else {
			?>
			<p class="llms-mc-wc-unsubscribe-checkbox-row form-row">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
				<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="llms_mc_unsubscribe" <?php checked( isset( $_POST['llms_mc_unsubscribe'] ), true ); ?> id="llms_mc_unsubscribe" value="yes">
					<span class="llms-mc-wc-unsubscribe-checkbox-text"><?php echo llms_mc_get_unsubscribe_notice(); ?></span>
				</label>
			</p>
			<?php
		}

	}

}

/**
 * Only add actions if consent is enabled
 */
if ( llms_mc_is_consent_enabled() ) {

	/**
	 * Hook the consent field to checkout, enrollment, & reg
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	add_action( 'llms_registration_privacy', 'llms_mc_consent_form_field', 15 );

	/**
	 * Hook the consent field / unsubscribe field to student dashboard edit account tab
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	add_action( 'lifterlms_after_update_fields', 'llms_mc_dashboard_consent_form_field', 15 );

	/**
	 * Hook the consent field to WC checkout
	 * @since    3.1.0
	 * @version  3.1.0
	 */
	add_action( 'woocommerce_checkout_after_terms_and_conditions', 'llms_mc_wc_consent_form_field', 15 );

	/**
	 * Hook the consent field to WC registration
	 * @since    3.1.0
	 * @version  3.1.0
	 */
	add_action( 'woocommerce_register_form', 'llms_mc_wc_consent_form_field', 25 );

	/**
	 * Hook the consent field / unsubscribe field to WC account edit
	 * @since    3.1.0
	 * @version  3.1.0
	 */
	add_action( 'woocommerce_edit_account_form', 'llms_mc_wc_dashboard_consent_form_field', 15 );

}
