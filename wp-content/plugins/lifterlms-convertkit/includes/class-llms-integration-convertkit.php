<?php
/**
 * LifterLMS ConvertKit Integration Class
 *
 * @package  LifterLMS_ConvertKit/Classes
 * @since    2.0.0
 * @version  2.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_Integration_ConvertKit class.
 */
class LLMS_Integration_ConvertKit extends LLMS_Abstract_Integration {

	/**
	 * Integration ID
	 *
	 * @var string
	 */
	public $id = 'convertkit';

	/**
	 * Integration Description
	 *
	 * @var string
	 */
	public $description = '';

	/**
	 * Integration Title
	 *
	 * @var string
	 */
	public $title = '';

	/**
	 * Integration Constructor
	 *
	 * @since    2.0.0
	 * @version  2.1.0
	 */
	protected function configure() {

		$this->title = 'LifterLMS ConvertKit';
		// Translators: %s = anchor link to ConvertKit website.
		$this->description = sprintf( __( 'Connect LifterLMS to %s! Automatically add LifterLMS Students to tags and sequences during registration, course enrollment, and membership signup.', 'lifterlms-convertkit' ), '<a href="https://lifterlikes.com/convertkit" target="_blank">ConvertKit</a>' );

		add_action( 'admin_init', array( $this, 'clear_cache_post' ) );
		add_action( 'lifterlms_settings_save_integrations', array( $this, 'settings_save' ), 7 );
		add_action( 'lifterlms_settings_save_integrations', array( $this, 'settings_save_after' ), 20 );
		add_action( 'llms_ck_check_new_api_credentials', array( $this, 'check_new_api_credentials' ), 10, 2 );

	}

	/**
	 * Tests API Key & Secret when changed in the settings
	 *
	 * @param    string $key api key to check.
	 * @param    string $secret secret key to check.
	 * @return   boolean  true if creds are good, false if both or either cred is bad.
	 * @since    2.1.0
	 * @version  2.1.0
	 */
	public function check_new_api_credentials( $key, $secret ) {

		$err = true;

		LLMS_ConvertKit()->api()->set_credentials( $key, $secret );

		// Check for some tags.
		$key_result = LLMS_ConvertKit()->api()->get_tags( true );
		if ( empty( $key_result ) ) {
			$err = false;
			LLMS_Admin_Settings::set_error( __( 'We were unable to locate any tags using the submitted API Key. If you have tags in your ConvertKit account your API Key may be incorrect. Please check your key and try again.', 'lifterlms-convertkit' ) );
		}

		// Check if the secret works.
		$secret_result = LLMS_ConvertKit()->api()->get_account();
		if ( is_null( $secret_result ) || ! isset( $secret_result['name'] ) || ! isset( $secret_result['primary_email_address'] ) ) {
			$err = false;
			LLMS_Admin_Settings::set_error( __( 'Unable to connect with the ConvertKit API. The submitted API Secret may be incorrect. Please check your secret and try again.', 'lifterlms-convertkit' ) );
		}

		return $err;

	}

	/**
	 * Clear the Local Cached results when the "Clear Local Cache" button is submitted
	 *
	 * @return   void
	 * @since    2.0.0
	 * @version  2.1.0
	 */
	public function clear_cache_post() {

		if ( ! is_null( llms_filter_input( INPUT_POST, 'llms-ck-clear-cache' ) ) ) {

			LLMS_ConvertKit()->api()->get_tags( true );
			LLMS_ConvertKit()->api()->get_sequences( true );
			LLMS_ConvertKit()->api()->get_custom_fields( true );

			do_action( 'llms_ck_cache_cleared' );

		}

	}

	/**
	 * Retrieve an array of LifterLMS core custom fields from the checkout & registration screens.
	 *
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_core_fields() {

		$fields = array();

		$fields_raw = array_merge(
			LLMS_Person_Handler::get_available_fields( 'checkout' ),
			LLMS_Person_Handler::get_available_fields( 'registration' )
		);

		$exclude = apply_filters( 'llms_ck_excluded_core_fields', array( 'email_address', 'email_address_confirm', 'password', 'password_confirm', 'llms_voucher', 'user_login' ) );

		foreach ( $fields_raw as $key => $field ) {

			if ( in_array( $field['id'], $exclude, true ) || in_array( $field['id'], $fields, true ) || empty( $field['label'] ) ) {
				continue;
			}

			$fields[ $field['id'] ] = 'llms_billing_address_2' !== $field['id'] ? $field['label'] : __( 'Street Address 2', 'lifterlms-convertkit' );

		}

		return apply_filters( 'llms_ck_core_fields', $fields );

	}

	/**
	 * Get additional settings specific to the integration
	 * extending classes should override this with the settings
	 * specific to the integration
	 *
	 * @return   array
	 * @since    2.0.0
	 * @version  2.1.0
	 */
	protected function get_integration_settings() {

		$settings = $this->get_integration_settings_credentials_fields();

		if ( $this->is_available() ) {

			$settings = array_merge(
				$settings,
				$this->get_integration_settings_consent_fields(),
				$this->get_integration_settings_automations_fields(),
				$this->get_integration_settings_purchase_fields(),
				$this->get_integration_settings_custom_fields(),
				$this->get_integration_settings_wc_fields()
			);

			$settings[] = array(
				'value' => '<br><hr><br><button class="llms-button-secondary small" name="llms-ck-clear-cache" type="submit">' . __( 'Clear Cached Data', 'lifterlms-convertkit' ) . '</button><br><p><em>' . sprintf( __( 'LifterLMS ConvertKit automatically caches custom fields, tags, and sequences for better admin panel performance. Use this button to clear the cache and retrieve new results directly from ConvertKit.', 'lifterlms-convertkit' ) ) . '</em></p>',
				'type'  => 'custom-html',
			);

		}

		return $settings;

	}

	/**
	 * Settings for the automations group
	 *
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_integration_settings_automations_fields() {

		$settings = array();

		$settings[] = array(
			'title' => __( 'New User Registration Automations', 'lifterlms-convertkit' ),
			'type'  => 'subtitle',
			'desc'  => __( 'When a consenting user registers for a new account automatcally add them to tags and sequences.', 'lifterlms-convertkit' ),
		);

		$settings[] = array(
			'title'   => __( 'New Registration Tag(s)', 'lifterlms-convertkit' ),
			'desc'    => __( 'During account registration, apply these tag(s) to the consenting ConvertKit contact.', 'lifterlms-convertkit' ),
			'id'      => $this->get_option_name( 'default_tags' ),
			'type'    => 'multiselect',
			'default' => '',
			'class'   => 'llms-select2',
			'options' => LLMS_ConvertKit()->api()->get_tags(),
		);

		$settings[] = array(
			'title'   => __( 'New Registration Sequence(s)', 'lifterlms-convertkit' ),
			'desc'    => __( 'During account registration, apply these sequence(s) to the consenting ConvertKit contact.', 'lifterlms-convertkit' ),
			'id'      => $this->get_option_name( 'default_sequences' ),
			'type'    => 'multiselect',
			'default' => '',
			'class'   => 'llms-select2',
			'options' => LLMS_ConvertKit()->api()->get_sequences(),
		);

		return $settings;

	}

	/**
	 * Settings for the consent fields settings group
	 *
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_integration_settings_consent_fields() {

		$settings = array();

		$settings[] = array(
			'title' => __( 'Consent Messages', 'lifterlms-convertkit' ),
			'type'  => 'subtitle',
		);

		$settings[] = array(
			'title' => __( 'Subscriber Consent Message', 'lifterlms-convertkit' ),
			'desc'  => '<br>' . __( 'Customize the consent message displayed during enrollment and registrations.', 'lifterlms-convertkit' ),
			'id'    => $this->get_option_name( 'consent' ),
			'type'  => 'textarea',
			'value' => $this->get_consent_notice(),
		);

		$settings[] = array(
			'title' => __( 'Unsubscribe Message', 'lifterlms-convertkit' ),
			'desc'  => '<br>' . __( 'Customize the message displayed on the student dashboard where students can opt out of their ConvertKit email subscriptions.', 'lifterlms-convertkit' ),
			'id'    => $this->get_option_name( 'unsubscribe' ),
			'type'  => 'textarea',
			'value' => $this->get_unsubscribe_notice(),
		);

		return $settings;

	}

	/**
	 * API cred settings group.
	 *
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_integration_settings_credentials_fields() {

		$settings = array();

		$settings[] = array(
			'title' => __( 'API Credentials', 'lifterlms-convertkit' ),
			'type'  => 'subtitle',
			// Translators: %1$s = opening anchor tag; %2$s = closing anchor tag.
			'desc'  => sprintf( __( 'Your API credentials are located in your ConvertKit Account Settings. %1$sShow me where%2$s.', 'lifterlms-convertkit' ), '<a href="https://lifterlms.com/docs/getting-started-lifterlms-convertkit/" target="_blank">', '</a>' ),
		);

		$settings[] = array(
			'title'   => __( 'API Key', 'lifterlms-convertkit' ),
			'id'      => $this->get_option_name( 'apikey' ),
			'type'    => 'text',
			'default' => '',
		);

		$settings[] = array(
			'title'   => __( 'API Secret', 'lifterlms-convertkit' ),
			'id'      => $this->get_option_name( 'apisecret' ),
			'type'    => 'password',
			'default' => '',
		);

		return $settings;

	}

	/**
	 * Settings group for custom field mapping.
	 *
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_integration_settings_custom_fields() {

		$settings = array();

		$settings[] = array(
			'title' => __( 'Custom Fields', 'lifterlms-convertkit' ),
			'type'  => 'subtitle',
			'desc'  => __( 'Customize how subscriber data is saved in ConvertKit by mapping LifterLMS enrollment, checkout, and registration fields to custom fields in ConvertKit.', 'lifterlms-convertkit' ),
		);

		$fields = array_merge( array( '' => __( 'None', 'lifterlms-convertkit' ) ), LLMS_ConvertKit()->api()->get_custom_fields() );

		$settings[] = array(
			'type'  => 'custom-html',
			'id'    => 'llms-ck-custom-fields-heading',
			'value' => '<span style="display:inline-block;width:225px;font-weight:600;">' . __( 'LifterLMS Field', 'lifterlms-convertkit' ) . '</span><span style="font-weight:600;">' . __( 'ConvertKit Field', 'lifterlms-convertkit' ) . '</span>',
		);

		foreach ( $this->get_core_fields() as $id => $label ) {

			$settings[] = array(
				'disabled' => ( 'first_name' === $id ),
				'default'  => str_replace( 'llms_', '', $id ),
				'id'       => $this->get_option_name( 'custom_fields' ) . '[' . $id . ']',
				'title'    => $label,
				'type'     => 'select',
				'options'  => ( 'first_name' === $id ) ? array( '' => __( 'First Name', 'lifterlms-convertkit' ) ) : $fields,
			);

		}

		return $settings;

	}

	/**
	 * Add Purchase API settings fields.
	 *
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_integration_settings_purchase_fields() {

		$settings = array();

		$settings[] = array(
			'title' => __( 'Purchases and Products', 'lifterlms-convertkit' ),
			'type'  => 'subtitle',
		);

		$settings[] = array(
			'default' => 'yes',
			// Translators: %1$s = Opening anchor tag to documentation; %2$s = closing anchor tag.
			'desc'    => __( 'Enable', 'lifterlms-convertkit' ) . '<br><span class="description">' . sprintf( __( 'Saves subscriber ecommerce data to ConvertKit via the Purchases API. %1$sLearn more%2$s.', 'lifterlms-convertkit' ), '<a href="https://help.convertkit.com/article/837-purchases-setup-and-faq" target="_blank">', '</a>' ) . '</span>',
			'id'      => $this->get_option_name( 'purchases' ),
			'title'   => __( 'Sync Subscriber Purchases', 'lifterlms-convertkit' ),
			'type'    => 'checkbox',
		);

		return $settings;

	}

	/**
	 * Add WooCommerce-related actions
	 *
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_integration_settings_wc_fields() {

		$settings = array();

		if ( function_exists( 'WC' ) ) {

			$settings[] = array(
				'title' => __( 'WooCommerce', 'lifterlms-convertkit' ),
				'type'  => 'subtitle',
			);

			$settings[] = array(
				'default' => 'yes',
				'desc'    => __( 'Enable', 'lifterlms-convertkit' ) . '<br><span class="description">' . __( 'Add consenting WooCommerce customers to the registration automations during checkout registartion and to course and membership automations during enrollment via product purchases.', 'lifterlms-convertkit' ) . '</span>',
				'id'      => $this->get_option_name( 'woocommerce' ),
				'title'   => __( 'Checkout Actions', 'lifterlms-convertkit' ),
				'type'    => 'checkbox',
			);

		}

		return $settings;

	}

	/**
	 * Get the default / customized text for the consent notice checkbox
	 *
	 * @return   string
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public function get_consent_notice() {
		$default = __( 'I would like to receive information about the courses and memberships I\'ve enrolled in on this site.', 'lifterlms-convertkit' );
		$notice  = $this->get_option( 'consent', $default );
		return apply_filters( 'llms_ck_get_consent_notice', $notice );
	}

	/**
	 * Get the default / customized text for the unsubscribe notice checkbox
	 *
	 * @return   string
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public function get_unsubscribe_notice() {
		$default = __( 'Unsubscribe me from newsletter emails about the courses and memberships I\'ve enrolled in on this site.', 'lifterlms-convertkit' );
		$notice  = $this->get_option( 'unsubscribe', $default );
		return apply_filters( 'llms_ck_get_unsubscribe_notice', $notice );
	}

	/**
	 * Get the saved default sequences
	 *
	 * @return array
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public function get_sequences() {
		$ret = $this->get_option( 'default_sequences', array() );
		if ( '' === $ret ) {
			$ret = array();
		}
		return apply_filters( 'llms_ck_get_sequences', $ret, $this );

	}

	/**
	 * Get the saved default tags
	 *
	 * @return array
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public function get_tags() {
		$ret = $this->get_option( 'default_tags', array() );
		if ( '' === $ret ) {
			$ret = array();
		}
		return apply_filters( 'llms_ck_get_tags', $ret, $this );
	}

	/**
	 * Determine if the related plugin, theme, 3rd party is
	 * installed and activated
	 * For CK we need to ensure we have api keys
	 *
	 * @return   boolean
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public function is_installed() {
		return ( $this->get_option( 'apikey', false ) && $this->get_option( 'apisecret', false ) );
	}

	/**
	 * Called before integration settings are saved
	 * If the CK keys have changed, adds action called after settings are saved
	 * which will test the new api key and output a message if there was an error
	 *
	 * @return   void
	 * @since    2.0.1
	 * @version  2.1.0
	 */
	public function settings_save() {

		$new_key    = llms_filter_input( INPUT_POST, $this->get_option_name( 'apikey' ), FILTER_SANITIZE_STRING );
		$new_secret = llms_filter_input( INPUT_POST, $this->get_option_name( 'apisecret' ), FILTER_SANITIZE_STRING );

		if ( empty( $new_key ) || empty( $new_secret ) ) {
			return;
		}

		$saved_key    = $this->get_option( 'apikey' );
		$saved_secret = $this->get_option( 'apisecret' );

		if ( $new_key !== $saved_key || $new_secret !== $saved_secret ) {

			do_action( 'llms_ck_check_new_api_credentials', $new_key, $new_secret );

		}

	}

	/**
	 * Save custom field array options.
	 *
	 * @todo  LifterLMS core doesn't properly save array options so this is a "double" save that runs after the core saves the option as empty...
	 *
	 * @return     void
	 * @since      2.0.1
	 * @version    2.1.0
	 */
	public function settings_save_after() {

		$fields = llms_filter_input( INPUT_POST, $this->get_option_name( 'custom_fields' ), FILTER_DEFAULT, FILTER_REQUIRE_ARRAY );
		if ( $fields ) {

			$custom_fields = array_map( 'sanitize_text_field', $fields );
			$this->set_option( 'custom_fields', $custom_fields );

		}

	}

}
