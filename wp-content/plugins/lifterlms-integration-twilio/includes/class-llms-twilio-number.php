<?php
defined( 'ABSPATH' ) || exit;

/**
* Twilio Notifications
*
* @since   1.0.0
* @version 1.0.0
*/
class LLMS_Twilio_Number {

	private $cache_duration = 0;
	private $number = '';
	private $result;

	public function __construct( $number ) {

		$this->number = $number;
		$this->cache_duration = apply_filters( 'llms_twilio_number_cache_duration', WEEK_IN_SECONDS );
		$this->lookup();

	}

	/**
	 * Format the number, returns the submitted number if invalid
	 * @param    string     $format   desired return format [display|api|e164]
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function format( $format = 'display' ) {

		if ( $this->is_valid() ) {

			$res = $this->get_result();

			switch ( $format ) {

				// get an E.164 formatted number, eg +16175551212
				case 'api':
				case 'e164':
					return $res->phone_number;
				break;

				// get the number formatted according to the national formatting for the number
				case 'display':
				default:
					return $res->national_format;

			}

		}

		return $this->number;

	}

	/**
	 * Get a transient key/id for the number
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_id() {
		$number = trim( preg_replace( '/[^0-9]/', '', $this->number ) );
		return sprintf( 'llms_twilio_number_%s', $number );
	}

	/**
	 * Retrieve the raw API result response
	 * @return   object|WP_Error
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_result() {
		return $this->result;
	}

	/**
	 * Lookup the raw number via Twilio Lookups API
	 * @return   $this
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function lookup() {

		$res = null;

		// if caching enabled, grab from the cache
		if ( $this->cache_duration ) {
			$res = get_transient( $this->get_id() );
		}

		// cache is disabled or nothing cached for the number
		if ( ! $res ) {

			$lookup = new LLMS_Twilio_API( 'PhoneNumbers/' . $this->number );
			$res = $lookup->get_result();
			$this->save( $res );

		}

		// add to the instance
		$this->result = $res;

		// allow chaining
		return $this;

	}

	/**
	 * Save the lookup results in a transient to prevent unnecessary lookups
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function save( $data ) {
		if ( $this->cache_duration ) {
			set_transient( $this->get_id(), $data, $this->cache_duration );
		}
	}

	/**
	 * Determine if a phone number is valid
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function is_valid() {

		$res = $this->get_result();

		if ( ! $res ) {
			return false;
		} elseif ( is_wp_error( $res ) ) {
			return false;
		} elseif ( ! isset( $res->phone_number ) && ! isset( $res->national_format ) ) {
			return false;
		}

		return true;

	}

}
