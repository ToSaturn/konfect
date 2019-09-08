<?php

/**
 * Format a phone number string
 * @param    string     $number  phone number string (can be formatted)
 * @param    string     $format  desired return format [display|api|e164]
 * @return   string
 * @since    1.0.0
 * @version  1.0.0
 */
function llms_twilio_format_number( $number, $format = 'display' ) {

	$number = llms_twilio_get_number( $number );
	return $number->format( $format );

}

/**
 * Retrieve an instance of an LLMS_Twilio_Number for a given number string
 * @param    string     $number   phone number string, may contain formatting
 * @return   obj
 * @since    1.0.0
 * @version  1.0.0
 */
function llms_twilio_get_number( $number ) {

	return new LLMS_Twilio_Number( $number );

}

/**
 * Determine if a phone number string could be a valid phone number
 * @param    string     $number  phone number string, may contain formatting
 * @return   boolean
 * @since    1.0.0
 * @version  1.0.0
 */
function llms_twilio_is_number_valid( $number ) {

	$number = llms_twilio_get_number( $number );
	return $number->is_valid( $number );

}

/**
 * Send an SMS via Twilio
 * @param    string     $to   a phone number -- any format should do
 * @param    string     $msg  a text message
 * @return   boolean
 * @since    1.0.0
 * @version  1.0.0
 */
function llms_twilio_send_sms( $to, $msg ) {

	$twilio = LLMS()->integrations()->get_integration( 'twilio' );
	if ( ! $twilio ) {
		return false;
	}

	$to = llms_twilio_get_number( $to );
	if ( ! $to->is_valid() ) {
		return false;
	}

	$to = $to->format( 'e164' );
	$msg = strip_tags( $msg );
	$from = $twilio->get_option( 'from_number' );

	if ( ! $to || ! $from || ! $msg ) {
		return false;
	}

	$call = new LLMS_Twilio_API( 'Messages', array(
		'Body' => $msg,
		'From' => $from,
		'To' => $to,
	), 'POST' );

	return $call->is_error() ? false : true;

}
