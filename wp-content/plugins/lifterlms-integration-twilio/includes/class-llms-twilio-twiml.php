<?php
/**
* Create TwiML output
*
* @version  1.0.0
* @since    1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) { exit; }

class LLMS_TwiML {

	private static function add_message( $message = '' ) {
		return '<Message>' . $message . '</Message>';
	}

	private static function get_header() {
		return '<?xml version="1.0" encoding="UTF-8" ?><Response>';
	}

	private static function get_footer() {
		return '</Response>';
	}

	public static function get( $messages = array() ) {

		$twiml = self::get_header();

		if ( $messages ) {

			// allow a single string to be passed in
			if ( is_string( $messages ) ) {
				$messages = array( $messages );
			}

			foreach ( $messages as $msg ) {
				$twiml .= self::add_message( $msg );
			}
		}

		$twiml .= self::get_footer();
		return $twiml;

	}

	public static function output( $messages = array() ) {
		echo self::get( $messages );
	}

}
