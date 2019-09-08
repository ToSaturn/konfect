<?php
/**
 * Add a WP Rest API endpoint to handle incoming SMSs to configured twilio number(s)
 * @since    1.0.0
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class LLMS_Twilio_REST extends WP_REST_Controller {

	/**
	 * Local debugging via ngrok
	 * !example command line usage with WP VVV
	 * 		ngrok http llms-72.test:80 -host-header=llms-72.test
	 * Copy the generated ngrok url and paste into $debug_url var (comment out the null version for production usage)
	 * @var  string
	 */
	// private $debug_url = 'https://2e81806b.ngrok.io/';
	private $debug_url = null;

	private $webhook_url = '';

	private $version = '1';
	private $vendor = 'llms-twilio';
	private $sms_route = '/sms';
	protected $namespace = '';

	private $data = array();

	/**
	 * Instance of the main twilio integration
	 * LLMS()->integrations()->get_integration( 'twilio' )
	 * @var  [type]
	 */
	private $integration;

	protected static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function __construct() {

		$this->namespace = $this->vendor . '/v' . $this->version;

		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
		add_filter( 'rest_pre_serve_request', array( $this, 'pre_serve_request' ), 10, 4 );

	}

	/**
	 * Retrieve a session variable by key
	 * @param    string     $key   variable key
	 * @return   mixed
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function get( $key ) {

		$defaults = array(
			'new_user' => false,
			'plan_id' => null,
			'step' => 'verify_command',
			'user_id' => null,
		);

		return isset( $_SESSION[ $key ] ) ? $_SESSION[ $key ] : $defaults[ $key ];

	}

	/**
	 * Unset a session variable by key
	 * @param    string     $key   variable key
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function delete( $key ) {

		if ( isset( $_SESSION[ $key ] ) ) {
			unset( $_SESSION[ $key ] );
		}

	}

	/**
	 * Set a session variable
	 * @param    string     $key  key name
	 * @param    mixed     $val  value
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function set( $key, $val ) {

		$_SESSION[ $key ] = $val;

	}

	/**
	 * Create a new order for a student on a given access plan
	 * Processes using the manual payment gateway b/c text to enroll will only work for free access plans
	 * @param    obj    $student  Instance of an LLMS_Student
	 * @param    obj    $plan     Instance of an LLMS_Access_Plan
	 * @return   obj
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function create_order( $student, $plan ) {

		$order = new LLMS_Order( 'new' );
		$order->init( $student, $plan, LLMS()->payment_gateways()->get_gateway_by_id( 'manual' ) );
		$order->set( 'status', 'llms-completed' );
		$order->add_note( __( 'User enrolled via Twilio Text to Enroll', 'lifterlms-twilio' ) );

		return $order;

	}

	/**
	 * Verify the command recieved at a TO number
	 * STEP ONE
	 * @param    array     $params  parameters from Twilio
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function do_command_verification( $params ) {

		// verify required params, probably this will never happen...
		if ( ! isset( $params['To'] ) || ! isset( $params['Body'] ) || ! isset( $params['From'] ) ) {
			return __( 'Invalid request.', 'lifterlms-twilio' );
		}

		$plan = $this->locate_plan( $params['To'], $params['Body'] );

		if ( ! $plan ) {

			return strip_tags( $this->integration->get_option( 'default_auto_reply', __( 'Please try again.', 'lifterlms-twilio' ) ) );

		} else {

			$this->set( 'plan_id', $plan );
			$this->set( 'step', 'get_email' );

			$plan = llms_get_post( $plan );
			$product = llms_get_post( $plan->get( 'product_id' ) );

			return sprintf(
				__( 'Please respond with your email address to complete your enrollment into the %1$s "%2$s"', 'lifterlms-twilio' ),
				strtolower( strtolower( $product->get_post_type_label() ) ), $product->get( 'title' )
			);

		}

	}

	/**
	 * Verify a users email during a text to enroll conversation
	 * STEP TWO
	 * @param    array     $params  parameters from Twilio
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function do_email_verification( $params ) {

		$email = filter_var( trim( $params['Body'] ), FILTER_VALIDATE_EMAIL );
		if ( false === $email ) {

			return __( 'That didn\'t appear to be a valid email address. Please try again.', 'lifterlms-twilio' );

		} else {

			$user = $this->get_user( $email );
			$student = llms_get_student( $user->ID );
			$student->set( 'phone', $params['From'] );

			$plan = llms_get_post( $_SESSION['plan_id'] );
			$product_id = $plan->get( 'product_id' );
			$product = llms_get_post( $product_id );

			$product_label = strtolower( $product->get_post_type_label() );
			$product_link = get_permalink( $product_id );
			$dashboard_link = llms_get_page_url( 'myaccount', array(
				'redirect' => $product_link,
			) );

			$this->delete( 'step' );

			if ( $student->is_enrolled( $product_id ) ) {

				return sprintf(
					__( 'Looks like you\'re already enrolled in this %1$s. You can sign in to your account at %2$s or visit the %1$s at %3$s.', 'lifterlms-twilio' ),
					$product_label,
					$dashboard_link,
					$product_link
				);

			} else {

				$this->create_order( $student, $plan );

				if ( true === $this->get( 'new_user' ) ) {

					return sprintf(
						__( 'A new account has been created for you and enrolled into the %1$s! Instructions for creating a password have been sent to your email or you can visit %2$s now to get started.', 'lifterlms-twilio' ),
						$product_label,
						llms_lostpassword_url()
					);

				} else {

					return sprintf(
						__( 'You\'ve been successfully enrolled in the %1$s! You can sign in to your account at %2$s or visit the %1$s at %3$s.', 'lifterlms-twilio' ),
						$product_label,
						$dashboard_link,
						$product_link
					);

				}

			}

		}

	}

	/**
	 * Retrieve a user id for a given email address
	 * Will create a new user in the database if no user is found for the email address
	 * @param    string     $email   email address
	 * @return   obj                 WP_User
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function get_user( $email ) {

		// email address exists, return the user
		$user = get_user_by( 'email', $email );
		if ( $user ) {
			return $user;
		}

		$data = array(
			'user_email' => $email,
			'user_login' => LLMS_Person_Handler::generate_username( $email ),
			'user_pass' => wp_generate_password( 22 ),
			'role' => 'student',
		);

		// create the user
		$uid = wp_insert_user( $data );
		if ( is_numeric( $uid ) ) {

			$this->set( 'new_user', true );
			do_action( 'lifterlms_user_registered', $uid, $data, 'twilio_text_to_enroll' );

			return get_user_by( 'ID', $uid );

		}

		return false;

	}

	/**
	 * Retrieves the full url that can be used by twilio as the webhook for posting
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_webhook_url() {
		if ( ! $this->webhook_url ) {
			$this->set_webhook_url();
		}
		return $this->webhook_url;
	}

	/**
	 * Locate a plan for the To number and Command
	 * @param    string     $number   e164 number the command was sent to
	 * @param    string     $command  command text
	 * @return   int|null
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function locate_plan( $number, $command ) {

		$numbers = wp_list_pluck( $this->integration->get_available_numbers_object(), 'sid', 'phone_number' );

		if ( isset( $numbers[ $number ] ) ) {
			$sid = $numbers[ $number ];
		} else {
			return null;
		}

		$query = new WP_Query( array(

			'posts_per_page' => 1,
			'post_status' => 'publish',
			'post_type' => 'llms_access_plan',

			'meta_query' => array(
				'relation' => 'AND',
				array(
					'compare' => '=',
					'key' => '_llms_twilio_t2e_enabled',
					'value' => 'yes',
				),
				array(
					'compare' => '=',
					'key' => '_llms_twilio_t2e_command',
					'value' => trim( $command ),
				),
				array(
					'compare' => '=',
					'key' => '_llms_twilio_t2e_number',
					'value' => $sid,
				),
			),

		) );

		if ( $query->have_posts() ) {
			return $query->posts[0]->ID;
		}

		return null;

	}

	/**
	 * Stubbed out permissions check, don't need it but maybe we'll change that one day
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function permissions_check() {
		return true;
	}

	/**
	 * Hijack the WP_REST_SERVER default response and respond with TwiML
	 * @param    boolean  $bool     whether or not the response has been served
	 * @param    obj      $response  default response
	 * @param    obj      $request   request
	 * @param    obj      $server    instance of the rest server
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function pre_serve_request( $bool, $response, $request, $server ) {

		if ( false !== strpos( $request->get_route(), $this->vendor ) ) {
			$server->send_header( 'Content-Type', 'text/xml' );
			$bool = true;
			exit;
		}

		return $bool;

	}

	/**
	 * Register routes
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function register_routes() {

		register_rest_route( $this->namespace, $this->sms_route, array(
			array(
				'methods' => 'POST',
				'callback' => array( $this, 'sms_received_callback' ),
				'permission_callback' => array( $this, 'permissions_check' ),
				'args' => array()
			),
		) );

	}

	private function set_webhook_url() {
		$baseurl = ( $this->debug_url ) ? $this->debug_url . 'wp-json/' : get_rest_url();
		$this->webhook_url = $baseurl . $this->namespace . $this->sms_route;
	}

	/**
	 * SMS route callback function
	 * @param    obj    $request  WP_Rest_Request
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function sms_received_callback( $request ) {

		$this->integration = LLMS()->integrations()->get_integration( 'twilio' );

		if ( ! $this->validate_signature( $request ) ) {
			return LLMS_TwiML::output();
		}

		session_start();

		// decode characters in the request paramaters
		// $params = array_map( 'urldecode', $request->get_params() );
		$params = $request->get_params();

		// handle the current step
		switch ( $this->get( 'step' ) ) {

			case 'verify_command':

				$msg = $this->do_command_verification( $params );

			break;

			case 'get_email':

				$msg = $this->do_email_verification( $params );

			break;

		}

		return LLMS_TwiML::output( $msg );

	}

	/**
	 * Validate that incomming requests are incoming from Twilio
	 * thanks to Twilio PHP SDK for the validator function in here
	 * @source   https://github.com/twilio/twilio-php/blob/master/Twilio/Security/RequestValidator.php
	 * @param    obj     $request  WP_Rest_Reqest
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function validate_signature( $request ) {

		$url = $this->get_webhook_url();

		// if we're not posting to an https url, don't verify b/c twilio signature is SSL only
		if ( false === strpos( $url, 'https://' ) ) {
			return true;
		}

		$sig = $request->get_header( 'x_twilio_signature' );
		if ( ! $sig ) {
			return false;
		}

		$params = $request->get_params();

		// sort the array by keys
		ksort( $params );

		// append them to the data string in order
		// with no delimiters
		foreach ( $params as $key => $value ) {
			$url .= $key . $value;
		}

		// This function calculates the HMAC hash of the data with the key passed in
		$computed = base64_encode( hash_hmac( 'sha1', $url, $this->integration->get_option( 'authkey' ), true ) );

		return ( $sig === $computed );

	}

}

return LLMS_Twilio_REST::instance();
