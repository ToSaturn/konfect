<?php
/**
 * Main Privacy Class
 * Hooks into WP Core data exporters and erasers to export / erase LifterLMS data
 *
 * @package  LifterLMS_ConvertKit/Classes
 * @since    2.0.0
 * @version  2.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_CK_Privacy class.
 */
class LLMS_CK_Privacy extends LLMS_Abstract_Privacy {

	/**
	 * Constructor
	 *
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public function __construct() {

		parent::__construct( __( 'LifterLMS ConvertKit', 'lifterlms-convertkit' ) );

	}

	/**
	 * Get the privacy message sample content
	 *
	 * @return   string
	 * @since    2.0.0
	 * @version  2.0.0
	 */
	public function get_privacy_message() {
		$content = '
			<div contenteditable="false">' .
				'<p class="wp-policy-help">' .
					__( 'This sample language includes the basics around what personal data your site shares with ConvertKit. We recommend consulting with a lawyer when deciding what information to disclose on your privacy policy.', 'lifterlms-convertkit' ) .
				'</p>' .
			'</div>' .
			'<p>' . __( 'When consenting to receive information about courses and memberships which you are enrolled in, your email address, first name, and last name will be added to ConvertKit, our email marketing service provider. For more information, please refer to <a href="https://convertkit.com/privacy/">ConvertKit\'s Privacy Policy</a>.', 'lifterlms-convertkit' ) . '</p>';

		return apply_filters( 'llms_sl_privacy_policy_content', $content );

	}

}

return new LLMS_CK_Privacy();
