<?php
defined( 'ABSPATH' ) || exit;

/**
 * Main Privacy Class
 * Hooks into WP Core data exporters and erasers to export / erase LifterLMS data
 * @since    1.0.2
 * @version  1.0.2
 */
class LLMS_Twilio_Privacy extends LLMS_Abstract_Privacy {

	/**
	 * Constructor
	 * @since    1.0.2
	 * @version  1.0.2
	 */
	public function __construct() {

		parent::__construct( __( 'LifterLMS Twilio', 'lifterlms-twilio' ) );

	}

	/**
	 * Get the privacy message sample content
	 * @return   string
	 * @since    1.0.2
	 * @version  1.0.2
	 */
	public function get_privacy_message() {
		$content = '
			<div contenteditable="false">' .
				'<p class="wp-policy-help">' .
					__( 'This sample language includes the basics around what personal data your site shares with Twilio. We recommend consulting with a lawyer when deciding what information to disclose on your privacy policy.', 'lifterlms-twilio' ) .
				'</p>' .
			'</div>' .
			'<p>' . __( 'We Utilize Twilio to receive and process SMS text messages sent to us in order to enroll you into courses or memberships via SMS. If you use any text to enroll features of this site or if you have consented to receive text message notifications from us your phone number will be shared with Twilio using Twilio APIs. For more information, please refer to <a href="https://www.twilio.com/legal/privacy">Twilio\'s Privacy Policy</a>.', 'lifterlms-twilio' ) . '</p>';

		return apply_filters( 'llms_sl_privacy_policy_content', $content );

	}

}

return new LLMS_Twilio_Privacy();
