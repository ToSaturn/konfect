<?php
/**
 * ConvertKit when new students register
 *
 * @package  LifterLMS_ConvertKit/Classes
 * @since    1.0.0
 * @version  2.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_ConvertKit_UserActions class.
 */
class LLMS_CK_User_Actions {

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 * @version  2.1.0
	 */
	public function __construct() {

		// user registration.
		add_action( 'lifterlms_user_registered', array( $this, 'save_user_info' ), 20, 3 );

		// user updates.
		add_action( 'lifterlms_user_updated', array( $this, 'save_user_info' ), 20, 3 );

		// user enrolled in a course or membership.
		add_action( 'llms_user_enrolled_in_course', array( $this, 'user_enrolled' ), 10, 2 );
		add_action( 'llms_user_added_to_membership_level', array( $this, 'user_enrolled' ), 10, 2 );

		// WooCommerce Actions.
		if ( function_exists( 'WC' ) && llms_parse_bool( LLMS_ConvertKit()->get_integration()->get_option( 'woocommerce', 'yes' ) ) ) {

			// process user during wc checkout.
			add_action( 'woocommerce_checkout_update_user_meta', array( $this, 'wc_callback' ), 20, 1 );

			// process user during wc registration.
			add_action( 'woocommerce_created_customer', array( $this, 'wc_callback' ), 20, 1 );

			// process user during wc account update.
			add_action( 'woocommerce_save_account_details', array( $this, 'wc_callback' ), 20, 1 );

		}

	}

	/**
	 * Save user's consent to usermeta table
	 *
	 * @param    int   $person_id  WP User ID.
	 * @param    array $post_data form $_POST data.
	 * @return   boolean           true if user consents, false otherwise
	 * @since    2.0.0
	 * @version  2.1.0
	 */
	private function save_consent( $person_id, $post_data = array() ) {

		$consent = true;

		if ( llms_ck_is_consent_enabled() ) {

			// Try go get data directly from the $_POST request.
			$consent = llms_filter_input( INPUT_POST, 'llms_ck_consent', FILTER_SANITIZE_STRING );

			// fall back to the $post_data passed from the LLMS action if it wasn't in the $_POST data.
			if ( is_null( $consent ) && isset( $post_data['llms_ck_consent'] ) ) {
				$consent = $post_data['llms_ck_consent'];
			}

			// No consent data was posted, don't save anything and return false.
			if ( is_null( $consent ) ) {
				return false;
			}

			// Ensure we only save a yes/no value in the usermeta.
			$consent = in_array( $consent, array( 'yes', 'no' ), true ) ? $consent : 'no';
			update_user_meta( $person_id, 'llms_ck_consent', $consent );

		}

		// Trigger an action.
		do_action( 'llms_ck_user_consent_saved', $person_id, $consent, $post_data );

		// Return a bool.
		return llms_parse_bool( $consent );

	}

	/**
	 * Subscribe a user to default registration sequences & tags
	 *
	 * @param    int $person_id  WP User ID.
	 * @return   void
	 * @since    2.0.0
	 * @version  2.1.0
	 */
	private function subscribe_user( $person_id ) {

		$sequences = LLMS_ConvertKit()->get_integration()->get_sequences();
		if ( $sequences ) {
			LLMS_ConvertKit()->api()->subscribe( $person_id, 'sequences', $sequences );
		}

		$tags = LLMS_ConvertKit()->get_integration()->get_tags();
		if ( $tags ) {
			LLMS_ConvertKit()->api()->subscribe( $person_id, 'tags', $tags );
		}

		do_action( 'llms_ck_user_subscribed', $person_id, $sequences, $tags );

	}

	/**
	 * Apply ConvertKit sequences and Tags as defined on the global settings screens when LifterLMS registers or updates a user
	 *
	 * Called during user registration from open registration or checkout forms.
	 * Called during user update from checkout or account edit forms.
	 *
	 * @param int    $person_id WP User ID.
	 * @param array  $post_data form $_POST data.
	 * @param string $screen update type.
	 * @return void
	 * @since 2.1.0
	 * @version 2.1.0
	 */
	public function save_user_info( $person_id, $post_data, $screen ) {

		// User unsubscribe from account edit screen.
		if ( 'account' === $screen && 'yes' === llms_filter_input( INPUT_POST, 'llms_ck_unsubscribe', FILTER_SANITIZE_STRING ) ) {
			update_user_meta( $person_id, 'llms_ck_unsubscribed', 'yes' );
			LLMS_ConvertKit()->api()->unsubscribe( $person_id );
			do_action( 'llms_ck_user_unsubscribed', $person_id );
			return;

			// Save consent and if consented apply subscriptions via API.
		} elseif ( $this->save_consent( $person_id, $post_data ) ) {
			$this->subscribe_user( $person_id );
		}

	}

	/**
	 * Handle user enrollment in a course or a membership
	 *
	 * @param int $user_id WP User ID.
	 * @param  int $post_id WP Post ID.
	 * @return void
	 * @since 1.0.0
	 * @version 2.1.0
	 */
	public function user_enrolled( $user_id, $post_id ) {

		if ( ! llms_ck_has_user_consented( $user_id ) ) {
			return;
		}

		$post_type = get_post_type( $post_id );

		$sequences = get_post_meta( $post_id, '_' . $post_type . '_ck_sequences', true );
		if ( $sequences ) {
			LLMS_ConvertKit()->api()->subscribe( $user_id, 'sequences', $sequences );
		}

		$tags = get_post_meta( $post_id, '_' . $post_type . '_ck_tags', true );
		if ( $tags ) {
			LLMS_ConvertKit()->api()->subscribe( $user_id, 'tags', $tags );
		}

		do_action( 'llms_ck_user_subscribed_to_post', $user_id, $post_id, $sequences, $tags );

	}

	/**
	 * Save consent data during WooCommerce checkout, account registration, and user account edit updates
	 *
	 * @param    int $customer_id  WP_User ID of the WC Customer.
	 * @return   void
	 * @since    2.1.0
	 * @version  2.1.0
	 */
	public function wc_callback( $customer_id ) {

		$screen = 'woocommerce_save_account_details' === current_filter() ? 'account' : 'checkout';
		$this->save_user_info( $customer_id, array(), $screen );

	}

	// @codeCoverageIgnoreStart
	/**
	 * Deprecated.
	 *
	 * @param int    $person_id WP User ID.
	 * @param array  $post_data form $_POST data.
	 * @param string $screen update type.
	 * @return void
	 * @since 1.0.0
	 * @version 2.1.0
	 * @deprecated 2.1.0
	 */
	public function user_registered( $person_id, $post_data, $screen ) {
		llms_deprecated_function( 'LLMS_CK_User_Actions::user_registered()', '2.1.0', 'LLMS_CK_User_Actions::save_user_info()' );
		$this->save_user_info( $person_id, $post_data, $screen );
	}

	/**
	 * Deprecated.
	 *
	 * @param int    $person_id WP User ID.
	 * @param array  $post_data form $_POST data.
	 * @param string $screen update type.
	 * @return void
	 * @since 1.0.0
	 * @version 2.1.0
	 * @deprecated 2.1.0
	 */
	public function user_updated( $person_id, $post_data, $screen ) {
		llms_deprecated_function( 'LLMS_CK_User_Actions::user_updated()', '2.1.0', 'LLMS_CK_User_Actions::save_user_info()' );
		$this->save_user_info( $person_id, $post_data, $screen );
	}
	// @codeCoverageIgnoreEnd
}

return new LLMS_CK_User_Actions();
