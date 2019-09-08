<?php
/**
 * Do MC subscriptions on various LifterLMS actions
 *
 * @package LifterLMS_MailChimp/Classes
 *
 * @since 2.2.0
 * @version 3.1.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Do MC subscriptions on various LifterLMS actions
 *
 * @since 2.2.0
 * @since 3.1.2 Automatically record consent when consent is disabled via `llms_mc_enable_consent` filter.
 */
class LLMS_Actions_MailChimp {

	/**
	 * Constructor
	 * @since    2.2.0
	 * @version  3.1.0
	 */
	public function __construct() {

		$this->integration = LLMS_MailChimp()->get_integration();

		// user registration
		add_action( 'lifterlms_user_registered', array( $this, 'register_user' ), 20, 2 );

		// user update
		add_action( 'lifterlms_user_updated', array( $this, 'user_updated' ), 20, 3 );

		// user enrollment
		add_action( 'llms_user_enrolled_in_course', array( $this, 'enroll_user' ), 10, 2 );
		add_action( 'llms_user_added_to_membership_level', array( $this, 'enroll_user' ), 10, 2 );

		if ( function_exists( 'WC' ) && llms_parse_bool( $this->integration->get_option( 'woocommerce' ) ) ) {

			// process user during wc checkout
			add_action( 'woocommerce_checkout_update_user_meta', array( $this, 'wc_user_register' ), 20, 1 );

			// process user during wc registration
			add_action( 'woocommerce_created_customer', array( $this, 'wc_user_register' ), 20, 1 );

			// process user during wc account update
			add_action( 'woocommerce_save_account_details', array( $this, 'wc_user_updated' ), 20, 1 );

		}


	}

	/**
	 * Adds a user to a MailChimp via the MC API
	 * @param    string     $list_id   ID of the MailChimp List
	 * @param    int        $user_id   WP User ID
	 * @param    string     $group_id  ID of thi MailChimp interest group
	 * @since    2.2.0
	 * @version  2.2.2
	 */
	public function add_user_to_list( $list_id, $user_id, $group_id = '' ) {

		$user = get_userdata( $user_id );

		$confirmations = llms_parse_bool( $this->integration->get_option( 'enable_confirmations', 'no' ) );

		$data = array(
			'email_address' => $user->user_email,
			'status_if_new' => $confirmations ? 'pending' : 'subscribed',
			'status' => $confirmations ? 'pending' : 'subscribed',
			'ip_signup' => llms_get_ip_address(),
			'merge_fields' => apply_filters( 'llms_mc_merge_fields', array(
				'FNAME' => $user->first_name,
				'LNAME' => $user->last_name,
			), $user_id, $list_id ),
		);

		if ( $group_id ) {
			$data['interests'] = array( $group_id => true );
		}

		$data = apply_filters( 'llms_mc_add_user_to_list_data', $data, $user_id, $list_id );

		$hash = md5( strtolower( $user->user_email ) );

		$call = new LLMS_MailChimp_API( 'lists/' . $list_id . '/members/'. $hash, json_encode( $data ), 'PUT' );

		if ( $call->is_error() ) {

			llms_log( 'Error during add_user_to_list(): ' . $call->get_error_message(), 'mailchimp' );
			llms_log( $list_id, 'mailchimp' );
			llms_log( $user_id, 'mailchimp' );
			llms_log( $group_id, 'mailchimp' );

		}
	}

	/**
	 * Add user to MailChimp lists and groups when the user is enrolled in a course or membership
	 *
	 * @param    int   $user_id     WP User ID
	 * @param    int   $product_id  WP Post Id of the course or membership
	 * @return   void
	 * @since    2.2.0
	 * @version  3.1.0
	 */
	public function enroll_user( $user_id, $product_id ) {

		if ( ! llms_mc_get_user_consent_status() ) {
			return;
		}

		$product_type = str_replace( 'llms_', '', get_post_type( $product_id ) );

		if ( 'course' == $product_type || 'membership' == $product_type ) {
			$list_id = get_post_meta( $product_id, '_' . $product_type . '_registration_list', true );
			$group_id = get_post_meta( $product_id, '_' . $product_type . '_registration_group', true );
		}

		if ( $list_id ) {
			$this->add_user_to_list( $list_id, $user_id, $group_id );
		}

	}

	/**
	 * Add a user to a MailChimp list
	 *
	 * Fires during:
	 * 		1) LifterLMS user registration.
	 * 		2) WooCommerce checkout.
	 *
	 * @since 2.2.0
	 *
	 * @param int $person_id WP User ID.
	 * @param array $post_data Form $_POST data.
	 * @return void
	 */
	public function register_user( $person_id, $post_data ) {

		$consent = $this->save_consent( $person_id );
		if ( ! $consent ) {
			return;
		}

		$list_id = $this->integration->get_option( 'default_list' );
		if ( $list_id ) {
			$group_id = $this->integration->get_option( 'default_group' );
			$this->add_user_to_list( $list_id, $person_id, $group_id );
		}

	}

	/**
	 * Removes a user to a MailChimp via the MC API
	 * @param    string     $list_id   ID of the MailChimp List
	 * @param    int        $user_id   WP User ID
	 * @param    string     $group_id  ID of thi MailChimp interest group
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function remove_user_from_list( $list_id, $user_id ) {

		$user = get_userdata( $user_id );

		$data = array(
			'email_address' => $user->user_email,
			'status' => 'unsubscribed',
		);

		$data = apply_filters( 'llms_mc_remove_user_from_list_data', $data, $user_id, $list_id );

		$hash = md5( strtolower( $user->user_email ) );

		$call = new LLMS_MailChimp_API( 'lists/' . $list_id . '/members/'. $hash, json_encode( $data ), 'PATCH' );
		llms_log( 'lists/' . $list_id . '/members/'. $hash, 'mailchimp' );
		llms_log( $call, 'mailchimp' );

		if ( $call->is_error() ) {

			llms_log( 'Error during add_user_to_list(): ' . $call->get_error_message(), 'mailchimp' );
			llms_log( $list_id, 'mailchimp' );
			llms_log( $user_id, 'mailchimp' );
			llms_log( $group_id, 'mailchimp' );

		}
	}

	/**
	 * Save user's consent to usermeta table
	 *
	 * @since    3.0.0
     * @since 3.1.2 Automatically record consent when consent is disabled via `llms_mc_enable_consent` filter.
     *
	 * @param int $person_id WP User ID.
	 * @return bool true if user consents, false otherwise.
	 */
	private function save_consent( $person_id ) {

		$consent = true;

		if ( llms_mc_is_consent_enabled() ) {

			$consent = filter_input( INPUT_POST, 'llms_mc_consent', FILTER_SANITIZE_STRING );

			// No consent field was submitted, don't save anything.
			if ( is_null( $consent ) ) {
				return false;
			}

			$consent = ( $consent && 'yes' === $consent ) ? 'yes' : 'no';
			update_user_meta( $person_id, 'llms_mc_consent', $consent );


		}

		// Trigger an action.
		do_action( 'llms_mc_user_consent_saved', $person_id, $consent );

		return llms_parse_bool( $consent );

	}

	/**
	 * Unsubscribes user from all lists
	 * @param    int     $user_id  WP User ID
	 * @return   void
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function unsubscribe_user( $user_id ) {

		foreach ( array_keys( $this->integration->get_lists() ) as $list_id ) {
			$this->remove_user_from_list( $list_id, $user_id );
		}

	}

	/**
	 * Called on user update from edit account page on student dashboard
	 * Also called during enrollments / checkout for existing users
	 * Also called during WooCommerce account update
	 * @param    int     $person_id  WP User ID
	 * @param    array   $post_data  form $_POST data
	 * @return   void
	 * @since    3.0.0
	 * @version  3.1.0
	 */
	public function user_updated( $person_id, $post_data ) {

		if ( isset( $_POST['llms_mc_unsubscribe'] ) && 'yes' === $_POST['llms_mc_unsubscribe'] ) {
			update_user_meta( $person_id, 'llms_mc_consent', 'no' );
			$this->unsubscribe_user( $person_id );
			return;
		}

		$this->register_user( $person_id, $post_data );

	}

	/**
	 * Save consent data during WooCommerce checkout & Account Registration
	 * @param    int     $person_id  WP User ID of the WC Customer
	 * @return   void
	 * @since    3.1.0
	 * @version  3.1.0
	 */
	public function wc_user_register( $person_id ) {

		$this->register_user( $person_id, $_POST );

	}

	/**
	 * Update consent during WC account updaet
	 * @param    int     $person_id  WP User ID
	 * @return   void
	 * @since    3.1.0
	 * @version  3.1.0
	 */
	public function wc_user_updated( $person_id ) {

		$this->user_updated( $person_id, $_POST );

	}

}

return new LLMS_Actions_MailChimp();
