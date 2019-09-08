<?php
/**
 * Wrapper class for the MailChimp API
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class LLMS_MailChimp_API {

	const ENDPOINT = 'https://api.mailchimp.com/3.0/';

	private $result = null;
	private $error_message = null;
	private $error_object = null;
	private $error_type = null;

	/*
	 * Construct an API call, parameters are passed to private `call()` function
	 * @param  stirng $resource  url endpoint or resource to make a request to
	 * @param  array  $data      array of data to pass in the body of the request
	 * @param  string $method    method of request (POST, GET, DELETE, PUT, etc...)
	 * @return void
	 * @since  2.2.0
	 * @version  2.2.0
	 */
	public function __construct( $resource, $data, $method ) {
		$this->call( $resource, $data, $method );
	}

	/**
	 * Make an API call to stripe
	 * @param  stirng $resource  url endpoint or resource to make a request to
	 * @param  array  $data      array of data to pass in the body of the request
	 * @param  string $method    method of request (POST, GET, DELETE, PUT, etc...)
	 * @return void
	 * @since  2.2.0
	 * @version  2.2.0
	 */
	private function call( $resource, $data, $method = 'POST' ) {

		// attempt to call the API
		$response = wp_safe_remote_post(
			untrailingslashit( $this->get_endpoint() . $resource ),
			array(
				'body'    => $data,
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( 'llms-mc:' . $this->get_api_key() ),
				),
				'method'     => $method,
				'timeout'    => 45,
				'user-agent' => 'LifterLMS MailChimp' . LLMS_MailChimp()->version,
			)

		);

		// connection error
		if ( is_wp_error( $response ) ) {

			return $this->set_error( __( 'There was a problem connecting to the MailChimp API. Please check your API key and try again.', 'lifterlms-mailchimp' ), 'api_connection', $response );

		}

		// empty body
		if ( empty( $response['body'] ) ) {

			return $this->set_error( __( 'Empty Response.', 'lifterlms-mailchimp' ), 'empty_response', $response );

		}

		// parse the response body
		$parsed = json_decode( $response['body'] );

		// Handle response
		if ( ! empty( $parsed->error ) ) {

			return $this->set_error( $parsed->error->message, $parsed->error->type, $response );

		} else {

			$this->result = $parsed;

		}

	}

	/**
	 * Retrieve the stored API key
	 * @return   string
	 * @since    2.2.0
	 * @version  2.2.0
	 */
	private function get_api_key() {
		$int = LLMS_MailChimp()->get_integration();
		if ( $int ) {
			return $int->get_option( 'apikey' );
		}
		return '';
	}

	/**
	 * Get the API endpoint
	 * parses the datacenter from the supplied API key
	 * @return   void
	 * @since    2.2.0
	 * @version  2.2.0
	 */
	private function get_endpoint() {

		$key = $this->get_api_key();

		if ( $key ) {
			$pos = strpos( $key, '-' );
	        if ( $pos !== false ) {
	            $datacenter = substr( $key, $pos + 1 );
				return str_replace( '//api.', '//' . $datacenter . '.api.' , self::ENDPOINT );
	        }
		}

		return self::ENDPOINT;

	}

	/**
	 * Retrive the private "error_message" variable
	 * @return string
	 * @since  2.2.0
	 * @version  2.2.0
	 */
	public function get_error_message() {

		return $this->error_message;

	}

	/**
	 * Get the private "error_object" variable
	 * @return mixed
	 * @since  2.2.0
	 * @version  2.2.0
	 */
	public function get_error_object() {
		return $this->error_object;
	}


	/**
	 * Retrive the private "error_type" variable
	 * @return string
	 * @since  2.2.0
	 * @version  2.2.0
	 */
	public function get_error_type() {
		return $this->error_type;
	}

	/**
	 * Retrive the private "result" variable
	 * @return mixed
	 * @since  2.2.0
	 * @version  2.2.0
	 */
	public function get_result() {
		return $this->result;
	}

	/**
	 * Determine if the response is an error
	 * @return   boolean
	 * @since    2.2.0
	 * @version  2.2.0
	 */
	public function is_error() {
		return is_wp_error( $this->get_result() );
	}

	/**
	 * Set an Error
	 * Sets all error variables and sets the result as a WP_Error so the result can always be tested with `is_wp_error()`
	 *
	 * @param string $message  error message
	 * @param string $type     error code or type
	 * @param object $obj      full error object or api response
	 * @return void
	 * @since  2.2.0
	 * @version  2.2.0
	 */
	private function set_error( $message, $type, $obj ) {
		$this->result = new WP_Error( $type, $message, $obj );
		$this->error_type = $type;
		$this->error_message = $message;
		$this->error_object = $obj;
	}

}
