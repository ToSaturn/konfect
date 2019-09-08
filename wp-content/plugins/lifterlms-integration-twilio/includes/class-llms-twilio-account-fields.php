<?php
/**
 * Add Custom Account Fields, Validation, Formatting, etc...
 * @since    1.0.0
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class LLMS_Twilio_Account_Fields {

	/**
	 * Constructor
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function __construct() {

		// ensure usermeta phone number is formatted appropriately during display
		add_filter( 'llms_get_student_meta_llms_phone', array( $this, 'format_phone_number_for_display' ), 777, 1 );

		// validate phone numbers when saving llms_phone values
		add_filter( 'lifterlms_user_registration_data', array( $this, 'validate_fields' ), 777, 3 );
		add_filter( 'lifterlms_user_update_data', array( $this, 'validate_fields' ), 777, 3 );

		// add custom fields
		add_filter( 'lifterlms_get_person_fields', array( $this, 'add_fields' ), 777, 2 );

		// save custom fields on user info updates & during registration
		add_filter( 'lifterlms_user_update_insert_user_meta', array( $this, 'save_fields' ), 777, 3 );
		add_filter( 'lifterlms_user_registration_insert_user_meta', array( $this, 'save_fields' ), 777, 3 );

	}

	/**
	 * Add an "okay to sms" field if phone numbers are enabled
	 * Adds to Open Reg, Checkout Reg, Checkout Update, and Account Update screens
	 * @param    array     $fields   existing fields
	 * @param    string    $screen   screen fields are being retrieved for
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function add_fields( $fields, $screen ) {

		$phone_index = false;

		$checkbox = array(
			'columns' => 12,
			'default' => 'yes',
			'id' => 'llms_twilio_can_sms',
			'value' => 'yes',
			'label' => __( 'It\'s okay to send me occassional text messages on this number.', 'lifterlms-twilio' ),
			'last_column' => true,
			'required' => false,
			'type'  => 'checkbox',
		);

		foreach ( $fields as $index => &$field ) {

			if ( isset( $field['id'] ) && 'llms_phone' === $field['id'] ) {

				$phone_index = $index + 1;

			}

		}

		if ( false !== $phone_index ) {

			array_splice( $fields, $phone_index, 0, array( $checkbox ) );

		}

		return $fields;

	}

	/**
	 * Format `llms_phone` user meta for national display
	 * @param    string     $number  phone number as saved in db
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function format_phone_number_for_display( $number ) {

		return llms_twilio_format_number( $number, 'national', false );

	}

	/**
	 * Save our custom field
	 * Since it's a checkbox it wont be found in $data if it wasn't checked so we need to explicity set the value as "no"
	 * @param    array     $insert_metas  existing metadata to be saved to the user
	 * @param    array     $data          array of posted / submitted data
	 * @param    string     $action        action being performed, could be "registration" or "update"
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function save_fields( $insert_metas, $data, $action ) {

		if ( ! isset( $data['llms_twilio_can_sms'] ) ) {
			$data['llms_twilio_can_sms'] = 'no';
		}

		$insert_metas['llms_twilio_can_sms'] = $data['llms_twilio_can_sms'];

		return $insert_metas;

	}

	/**
	 * Validate phone number fields to ensure invalid numbers aren't saved in the database
	 * @param    mixed     $valid_or_err  boolean when valid or a WP_Error if validation errors encountered
	 * @param    array     $data          data submitted
	 * @param    string    $screen        current screen
	 * @return   mixed
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function validate_fields( $valid_or_err, $data, $screen ) {

		$err = is_wp_error( $valid_or_err ) ? $valid_or_err : new WP_Error();

		foreach ( $data as $id => $val ) {

			if ( 'llms_phone' === $id ) {
				// var_dump( $id, $val, llms_twilio_is_number_valid( $val ) ); die;
				if ( $val && ! llms_twilio_is_number_valid( $val ) ) {

					$err->add( $id, sprintf( __( '"%s" is not a valid phone number.', 'lifterlms-twilio' ), $val ), 'invalid' );
					return $err;

				}

			}

		}

		return $valid_or_err;

	}

}

return new LLMS_Twilio_Account_Fields();
