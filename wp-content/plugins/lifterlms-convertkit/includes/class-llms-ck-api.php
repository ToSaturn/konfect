<?php
/**
 * LifterLMS ConvertKit API
 * Wrapper functions for access to the ConvertKit API
 *
 * @package LifterLMS_ConvertKit/Classes
 * @since   1.0.0
 * @version 2.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_ConvertKit_Api class.
 */
class LLMS_CK_API {

	/**
	 * API URL
	 */
	const API_URL = 'https://api.convertkit.com';

	/**
	 * API Version
	 */
	const API_VERSION = 'v3';

	/**
	 * API Key
	 *
	 * @var string
	 */
	private $api_key = null;

	/**
	 * API Secret
	 *
	 * @var string
	 */
	private $api_secret = null;

	/**
	 * Class instance
	 *
	 * @var LLMS_CK_API
	 */
	private static $_instance = null;

	/**
	 * Main Instance of LifterLMS ConvertKit API
	 *
	 * @return   LLMS_CK_API
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function __construct() {

		$this->set_credentials();

	}

	/**
	 * Perform a Request to the ConvertKit Rest API
	 *
	 * @param  string $request_endpoint  api request endpoint (eg: "tags" or "tags/123/subscribe".
	 * @param  array  $params            array of parameters to send in the body of the request.
	 * @param  string $method            GET or POST.
	 * @return mixed                     request body json decoded to an array if request succeeds
	 *                                   NULL when the request errors or cannot be perform because ConvertKit is not enabled or there's no API key saved
	 * @since    1.0.0
	 * @version  2.1.0
	 */
	private function request( $request_endpoint, $params = array(), $method = 'GET' ) {

		if ( ! $this->can_request() ) {
			return;
		}

		$params = apply_filters( 'llms_ck_api_request_body', $params, $request_endpoint, $method );

		$params['api_key'] = $this->api_key;

		$args = array(
			'method' => $method,
			'body'   => $params,
		);

		if ( $this->is_json_request( $request_endpoint ) ) {

			$args['body']    = wp_json_encode( $args['body'] );
			$args['headers'] = array(
				'Accept'       => 'application/json',
				'Content-Type' => 'application/json; charset=utf-8',
			);

		}

		$url = self::API_URL . '/' . self::API_VERSION . '/' . $request_endpoint;

		$ret = wp_remote_post( $url, $args );

		if ( is_wp_error( $ret ) || ! $ret['response'] || ! in_array( $ret['response']['code'], array( 200, 201 ), true ) ) {

			llms_log(
				array(
					'$url'  => $url,
					'$args' => $args,
					'$ret'  => $ret,
				),
				'convertkit'
			);
			return;

		}

		return json_decode( $ret['body'], true );

	}

	/**
	 * Setup API credentials
	 *
	 * @param    string $key     API Key, if not supplied will pull from site options.
	 * @param    string $secret  API Secret, if not supplied will pull from site options.
	 * @return   void
	 * @since    2.0.1
	 * @version  2.1.0
	 */
	public function set_credentials( $key = null, $secret = null ) {

		$integration = LLMS_ConvertKit()->get_integration();

		if ( ! $key && ! $secret && ! $integration ) {

			$this->api_key    = $key;
			$this->api_secret = $secret;

		} else {

			$this->api_key    = $key ? $key : $integration->get_option( 'apikey' );
			$this->api_secret = $secret ? $secret : $integration->get_option( 'apisecret' );

		}

	}


	/**
	 * Determine if we can perform a request to the API
	 * Must have an API key and the integration must be enabled
	 *
	 * @return boolean
	 * @since    1.0.0
	 * @version  2.0.1
	 */
	public function can_request() {

		return ( $this->api_secret && $this->api_key );

	}

	// @codeCoverageIgnoreStart
	/**
	 * Clear all cached API results
	 *
	 * @return     void
	 * @since      1.0.0
	 * @version    1.0.0
	 * @deprecated 2.0.1
	 */
	public function clear_cache() {

		llms_deprecated_function( 'LLMS_CK_API::clear_cache()', '2.0.1' );
		delete_transient( 'llms-ck-tags' );
		delete_transient( 'llms-ck-sequences' );

	}
	// @codeCoverageIgnoreEnd

	/**
	 * Filter API results down to the essentials.
	 *
	 * @param   array  $list  assoc. array of thing data from the API.
	 * @param   string $thing thing name (tags, sequences, custom_fields, etc).
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function filter_things_list( $list, $thing ) {

		switch ( $thing ) {

			case 'custom_fields':
				$key = 'key';
				$val = 'label';
				break;

			case 'sequences':
			case 'tags':
			default:
				$val = 'name';
				$key = 'id';

		}

		return wp_list_pluck( $list, $val, $key );

	}

	/**
	 * Retrieve account information
	 * Used to test the api_secret to ensure it is a valid key
	 *
	 * @return   array
	 * @since    2.0.1
	 * @version  2.0.1
	 */
	public function get_account() {

		return $this->request(
			'account/',
			array(
				'api_secret' => $this->api_secret,
			),
			'GET'
		);

	}

	/**
	 * Retrieve custom fields as an array
	 *
	 * @param    bool $skip_cache   if true, uses cached results if they exist.
	 *                              if false, will ignore cached results and get fresh results from api.
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	public function get_custom_fields( $skip_cache = false ) {

		return $this->get_things( 'custom_fields', $skip_cache );

	}

	/**
	 * Retrive sequences as an array
	 *
	 * @param    bool $skip_cache   if true, uses cached results if they exist.
	 *                              if false, will ignore cached results and get fresh results from api.
	 * @return   array
	 * @since    1.0.0
	 * @version  2.1.0
	 */
	public function get_sequences( $skip_cache = false ) {

		return $this->get_things( 'sequences', $skip_cache );

	}

	/**
	 * Retrive tags as an array
	 *
	 * @param    bool $skip_cache   if true, uses cached results if they exist.
	 *                              if false, will ignore cached results and get fresh results from api.
	 * @return   array
	 * @since    1.0.0
	 * @version  2.1.0
	 */
	public function get_tags( $skip_cache = false ) {

		return $this->get_things( 'tags', $skip_cache );

	}

	/**
	 * Allow converting "thing" names like "sequences" or "tags" to their legacy name as specified in the CK api.
	 * ConvertKit still referes to "sequences" as "courses" in certain places in their API returns and methods.
	 *
	 * @param   string $thing thing name (sequences, tags).
	 * @return  string
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_thing_legacy_name( $thing ) {

		return 'sequences' === $thing ? 'courses' : $thing;

	}

	/**
	 * Utility to get "things" (sequences or tags) from the CK api
	 *
	 * @param   string $thing   item name (sequences, tags)...
	 * @param   bool   $skip_cache   if true, uses cached results if they exist.
	 *                               if false, will ignore cached results and get fresh results from api.
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_things( $thing, $skip_cache = false ) {

		$transient_key = sprintf( 'llms-ck-%s', $thing );
		$ret           = $skip_cache ? false : get_transient( $transient_key );
		if ( ! $ret ) {

			$ret    = array();
			$things = $this->request( $thing );

			$thing_key = $this->get_thing_legacy_name( $thing );

			if ( is_array( $things ) && array_key_exists( $thing_key, $things ) && count( $things[ $thing_key ] ) ) {

				$ret = $this->filter_things_list( $things[ $thing_key ], $thing );
				set_transient( $transient_key, $ret, apply_filters( 'llms_ck_cache_duration', DAY_IN_SECONDS, $thing ) );

			}
		}

		return $ret;

	}

	/**
	 * Determine if the request should be made as a JSON request
	 *
	 * @param   string $endpoint Request endpoint url part.
	 * @return  bool
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function is_json_request( $endpoint ) {

		return ( 'purchases' === $endpoint );

	}

	/**
	 * Get an array of user information suitable to pass to CK for subscription calls.
	 * If custom field data exists, will map the fields in this array.
	 *
	 * @param   int $user_id WP_User ID.
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function prepare_subscriber_info( $user_id ) {

		$info = array();

		$student = llms_get_student( $user_id );
		if ( $student ) {

			$info['email']      = $student->get( 'user_email' );
			$info['first_name'] = $student->get( 'first_name' );
			$info['fields']     = array();

			$integration = LLMS_ConvertKit()->get_integration();
			$fields      = array_filter( $integration->get_option( 'custom_fields', array() ) );
			foreach ( $fields as $llms_key => $ck_key ) {
				$info['fields'][ $ck_key ] = $student->get( $llms_key );
			}
		}

		return apply_filters( 'llms_ck_prepare_subscriber_info', $info, $user_id, $student );

	}

	/**
	 * Create a purchase
	 *
	 * @param   array $purchase_data Purchase data array.
	 * @return  mixed                response array from CK or null on failure.
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	public function purchase( $purchase_data ) {

		return $this->request(
			'purchases',
			array(
				'api_secret' => $this->api_secret,
				'purchase'   => $purchase_data,
			),
			'POST'
		);

	}

	/**
	 * Subscribe a user to either a Sequence or a Tag
	 *
	 * @param  int       $user_id             WP user id of the user to subscribe.
	 * @param  string    $subscription_type   "tags" or "sequences".
	 * @param  int/array $subscription_ids    tag or sequence id or array of tag or sequence ids to subscribe the user to.
	 * @return mixed                           response object from ConvertKit or null on
	 * @since    1.0.0
	 * @version  2.1.0
	 */
	public function subscribe( $user_id, $subscription_type, $subscription_ids ) {

		// if we have an array, prepare to submit multiple to ConvertKit via query string.
		if ( is_array( $subscription_ids ) ) {

			$sub_id = array_shift( $subscription_ids );
			$csv    = implode( ',', $subscription_ids );

		} else {

			$sub_id = $subscription_ids;

		}

		$subscription_type = $this->get_thing_legacy_name( $subscription_type );

		$endpoint = $subscription_type . '/' . $sub_id . '/subscribe';
		if ( isset( $csv ) ) {

			$endpoint .= '?' . $subscription_type . '=' . $csv;

		}

		// perform the request.
		$ret = $this->request(
			$endpoint,
			$this->prepare_subscriber_info( $user_id ),
			'POST'
		);

		return $ret;

	}

	/**
	 * Unsubscribe a user to either
	 *
	 * @param    int $user_id  WP user id of the user to subscribe.
	 * @return   mixed                response object from ConvertKit or null on failure
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public function unsubscribe( $user_id ) {

		// get user data.
		$user = get_userdata( $user_id );

		// perform the request.
		$ret = $this->request(
			'unsubscribe/',
			array(
				'api_secret' => $this->api_secret,
				'email'      => $user->user_email,
			),
			'PUT'
		);

		return $ret;

	}


}
