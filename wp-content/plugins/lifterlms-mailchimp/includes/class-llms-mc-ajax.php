<?php
defined( 'ABSPATH' ) || exit;

/**
 * MailChimp admin ajax
 * @since    3.0.0
 * @version  3.0.0
 */
class LLMS_AJAX_MailChimp {

	public function __construct() {

		add_action( 'wp_ajax_llms_mc_get_groups', array( $this, 'get_groups_ajax' ) );

	}

	/**
	 * Get groups via AJAX
	 * @return   string
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function get_groups_ajax() {

		check_ajax_referer( LLMS_AJAX::NONCE );

		$request = LLMS_AJAX::scrub_request( $_REQUEST );

		$ret = array(
			'groups' => array(),
		);

		if ( isset( $request['list_id'] ) ) {

			$ret['groups'] = LLMS_MailChimp()->get_integration()->get_groups_formatted( $request['list_id'] );

		}

		wp_send_json( $ret );

	}

}

return new LLMS_AJAX_MailChimp();
