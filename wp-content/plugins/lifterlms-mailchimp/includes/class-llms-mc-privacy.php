<?php
defined( 'ABSPATH' ) || exit;

/**
 * Main Privacy Class
 * Hooks into WP Core data exporters and erasers to export / erase LifterLMS data
 * @since    3.0.0
 * @version  3.0.0
 */
class LLMS_Privacy_MailChimp extends LLMS_Abstract_Privacy {

	/**
	 * Constructor
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function __construct() {

		parent::__construct( __( 'LifterLMS MailChimp', 'lifterlms-mailchimp' ) );

	}

	/**
	 * Get the privacy message sample content
	 * @return   string
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function get_privacy_message() {
		$content = '
			<div contenteditable="false">' .
				'<p class="wp-policy-help">' .
					__( 'This sample language includes the basics around what personal data your site shares with MailChimp. We recommend consulting with a lawyer when deciding what information to disclose on your privacy policy.', 'lifterlms-mailchimp' ) .
				'</p>' .
			'</div>' .
			'<p>' . __( 'When consenting to receive information about courses and memberships which you are enrolled in, your email address, first name, and last name will be added to MailChimp, our email marketing service provider. For more information, please refer to <a href="https://mailchimp.com/legal/privacy/">MailChimp\'s Privacy Policy</a>.', 'lifterlms-mailchimp' ) . '</p>';

		return apply_filters( 'llms_sl_privacy_policy_content', $content );

	}

}

return new LLMS_Privacy_MailChimp();
