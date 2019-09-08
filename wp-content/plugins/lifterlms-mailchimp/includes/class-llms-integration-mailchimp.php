<?php
defined( 'ABSPATH' ) || exit;

/**
 * LifterLMS MailChimp Integration Class
 * @since       3.0.0
 * @version     3.1.0
 */
class LLMS_Integration_MailChimp extends LLMS_Abstract_Integration {

	public $id = 'mailchimp';
	public $title = '';

	/**
	 * Integration Constructor
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	protected function configure() {

		$this->title = __( 'LifterLMS MailChimp', 'lifterlms-mailchimp' );
		$this->description = __( 'Automatically add your LifterLMS students and members to MailChimp lists and groups during enrollment and registration.', 'lifterlms-mailchimp' );

		add_action( 'admin_init', array( $this, 'clear_cache_post' ) );

		add_action( 'lifterlms_settings_save_integrations', array( $this, 'settings_save' ), 7 );

	}


	/**
	 * Clear the Local Cached results when the "Clear Local Cache" button is submitted
	 * @return   void
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function clear_cache_post() {

		if ( isset( $_POST['llms-mc-clear-cache'] ) ) {
			$this->retrieve_lists();
		}

	}

	/**
	 * Get additional settings specific to the integration
	 * extending classes should override this with the settings
	 * specific to the integration
	 * @return   array
	 * @since    3.0.0
	 * @version  3.1.0
	 */
	protected function get_integration_settings() {

		$content = array();

		$content[] = array(
			'title' => __( 'API Key', 'lifterlms-mailchimp' ),
			'desc' => '<br>' . sprintf( __( 'Your MailChimp API key. Click %shere%s for help creating a new key.', 'lifterlms-mailchimp' ), '<a href="http://kb.mailchimp.com/integrations/api-integrations/about-api-keys" target="_blank">', '</a>' ),
			'id' => $this->get_option_name( 'apikey' ),
			'type' => 'text',
		);

		// only show when enabled
		if ( LLMS_MailChimp()->get_integration() ) {

			if ( function_exists( 'WC' ) ) {
				$content[] = array(
					'default' => 'yes',
					'desc_tip' => true,
					'desc' => __( 'Integrate with WooCommerce', 'lifterlms-mailchimp' ) . '<br>' .
							  '<span class="description">' . __( 'When enabled, consenting WooCommerce customers will be added to the Default List and added to course and membership lists during enrollment via products.', 'lifterlms-mailchimp' ) . '</span>',
					'id' => $this->get_option_name( 'woocommerce' ),
					'title' => __( 'WooCommerce', 'lifterlms-mailchimp' ),
					'type' => 'checkbox',
					'default' => 'yes',
				);
			}

			$content[] = array(
				'title' => __( 'Subscriber Consent Message', 'lifterlms-mailchimp' ),
				'desc' => '<br>' . __( 'Customize the consent message displayed during enrollment and registrations.', 'lifterlms-mailchimp' ),
				'id' => $this->get_option_name( 'consent' ),
				'type' => 'textarea',
				'default' => $this->get_consent_notice(),
			);

			$content[] = array(
				'title' => __( 'Unsubscribe Message', 'lifterlms-mailchimp' ),
				'desc' => '<br>' . __( 'Customize the message displayed on the student dashboard where students can opt out of their MailChimp email subscriptions.', 'lifterlms-mailchimp' ),
				'id' => $this->get_option_name( 'unsubscribe' ),
				'type' => 'textarea',
				'default' => $this->get_unsubscribe_notice(),
			);

			$lists = array_merge( array(
				'' => __( 'None', 'lifterlms-mailchimp' ),
			), $this->get_lists() );

			$content[] = array(
				'title' => __( 'Default List', 'lifterlms-mailchimp' ),
				'desc' => '<br>' . __( 'During account registration, add consenting subscribers to this list in MailChimp.', 'lifterlms-mailchimp' ),
				'id' => $this->get_option_name( 'default_list' ),
				'type' => 'select',
				'class' => 'llms-select2',
				'options' => $lists,
			);

			$list = $this->get_option( 'default_list' );
			$groups =  $list ? $this->get_groups_formatted( $list ) : array();
			$groups = array_merge( array(
				'' => __( 'None', 'lifterlms-mailchimp' ),
			), $groups );
			$content[] = array(
				'title' => __( 'Default Group', 'lifterlms-mailchimp' ),
				'desc' => '<br>' . __( 'During account registration, add consenting subscribers to this group in MailChimp.', 'lifterlms-mailchimp' ),
				'id' => $this->get_option_name( 'default_group' ),
				'type' => 'select',
				'class' => 'llms-select2',
				'options' => $groups,
			);

			$content[] = array(
				'type' => 'custom-html',
				'value' => '<p style="margin-left:220px;"><button class="llms-button-secondary small" name="llms-mc-clear-cache" type="submit">' . __( 'Clear Local Cache', 'lifterlms-mailchimp' ) . '</button>' . '<br><p style="margin-left:220px;"><em>' . __( 'Clears locally cached MailChimp list and group data and retrieves an updated set of lists from MailChimp', 'lifterlms-mailchimp' ) . '</em></p>',
			);

			$content[] = array(
				'default' => 'yes',
				'desc_tip' => true,
				'desc' => __( 'When enabled, students will be subscribed as "pending" and must confirm their email address before being subscribed to lists.', 'lifterlms-mailchimp' ),
				'id' => $this->get_option_name( 'enable_confirmations' ),
				'title' => __( 'Confirmation Emails', 'lifterlms-mailchimp' ),
				'type' => 'checkbox',
			);

		}

		$content[] = array(
			'type' => 'custom-html',
			'value' => '<p>' . sprintf( __( 'Debugging information is logged to "%s"', 'lifterlms-mailchimp' ), llms_get_log_path( 'mailchimp' ) ) . '</p>',
		);

		return $content;

	}

	/**
	 * Get the default / customized text for the consent notice checkbox
	 * @return   [type]
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function get_consent_notice() {
		$default = __( 'I would like to receive information about the courses and memberships I\'ve enrolled in on this site.', 'lifterlms-mailchimp' );
		$notice = $this->get_option( 'consent', $default );
		return apply_filters( 'llms_ck_get_consent_notice', $notice );
	}

	/**
	 * Get MailChimp Groups
	 * @param    string     $list_id      MailChimp List ID
	 * @param    bool       $flush_cache  if true, retrieves groups via API instead of cache
	 * @return   array
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function get_groups( $list_id, $flush_cache = false ) {

		if ( $flush_cache ) {
			$this->retrieve_groups( $list_id );
		}

		$ret = $this->get_option( 'groups', array() );
		if ( '' === $ret ) {
			$ret = array();
		}

		if ( isset( $ret[ $list_id ] ) ) {

			$ret = $ret[ $list_id ];
		}

		return apply_filters( 'llms_mc_get_groups', $ret, $list_id, $this );

	}

	/**
	 * Retrieve a Formatted array of Groups for a specific List
	 * @param    string     $list_id  MC ID of the List
	 * @return   array
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function get_groups_formatted( $list_id ) {

		$groups = array();

		if ( $list_id ) {

			foreach ( $this->get_groups( $list_id ) as $id => $data ) {

				if ( isset( $data['groups'] ) ) {

					foreach ( $data['groups'] as $g ) {

						$groups[] = array(
							'key' => $g->id,
							'title' => $data['name'] . ': ' .  $g->name,
						);

					}

				}

			}

		}

		return $groups;

	}

	/**
	 * Retrieve MailChimp Lists
	 * @return   array
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function get_lists( $flush_cache = false ) {

		if ( $flush_cache ) {
			$this->retrieve_lists();
		}

		$ret = $this->get_option( 'lists', array() );
		if ( '' === $ret ) {
			$ret = array();
		}
		return apply_filters( 'llms_mc_get_lists', $ret, $this );

	}

	/**
	 * Get the default / customized text for the unsubscribe notice checkbox
	 * @return   [type]
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function get_unsubscribe_notice() {
		$default = __( 'Unsubscribe me from newsletter emails about the courses and memberships I\'ve enrolled in on this site.', 'lifterlms-mailchimp' );
		$notice = $this->get_option( 'unsubscribe', $default );
		return apply_filters( 'llms_ck_get_unsubscribe_notice', $notice );
	}

	/**
	 * Determine if the related plugin, theme, 3rd party is
	 * installed and activated
	 *
	 * For CK we need to ensure we have api keys
	 *
	 * @return   boolean
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function is_installed() {
		return ( $this->get_option( 'apikey', false ) );
	}

	/**
	 * Retrieve groups from the MC API
	 * @param    string     $list_id  MC List ID
	 * @return   array
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	private function retrieve_groups( $list_id ) {

		$save = array();

		$call = new LLMS_MailChimp_API( 'lists/' . $list_id . '/interest-categories', array(
			'count' => 100,
			'fields' => 'categories.id,categories.title,categories.type',
		), 'GET' );

		if ( $call->is_error() ) {

			llms_log( 'Error during get_groups( ' . $list_id . ' ): ' . $call->get_error_message(), 'mailchimp' );

		} else {

			$res = $call->get_result();

			if ( isset( $res->categories ) ) {

				foreach ( $res->categories as $cat ) {

					$i_call = new LLMS_MailChimp_API( 'lists/' . $list_id . '/interest-categories/' . $cat->id . '/interests', array(
						'count' => 100,
						'fields' => 'interests.id,interests.name',
					), 'GET' );

					if ( $i_call->is_error() ) {

						llms_log( 'Error during get_groups( ' . $list_id . ' ): ' . $i_call->get_error_message(), 'mailchimp' );
						$groups = array();

					} else {

						$res = $i_call->get_result();
						if ( isset( $res->interests ) ) {
							$groups = $res->interests;
						} else {
							$groups = array();
						}

					}

					$save[ $cat->id ] = array(
						'name' => $cat->title,
						'form_field' => $cat->type,
						'groups' => $groups,
					);

				}

			}

		}

		return $save;

	}

	/**
	 * Retrieve MC lists & groups from MC API & store them in the cache
	 * @return   void
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	private function retrieve_lists() {

		$page = 0;
		$count = 50; // retrieve 50 lists at a time
		$lists = array();
		$groups = array();

		while ( true ) {

			$call = new LLMS_MailChimp_API( 'lists', array(
				'count' => $count,
				'fields' => 'lists.id,lists.name,total_items',
				'offset' => $page * $count,
			), 'GET' );

			// call errored
			if ( $call->is_error( $call ) ) {

				llms_log( 'Error during get_lists(): ' . $call->get_error_message(), 'mailchimp' );
				return;

			} else {

				$ret = $call->get_result();

				// we can work with the response
				if ( isset( $ret->total_items ) && isset( $ret->lists ) ) {

					// add all lists to the running array
					// in the format we want to store them
					foreach ( $ret->lists as $list ) {

						$lists[ $list->id ] = $list->name;
						$groups[ $list->id ] = $this->retrieve_groups( $list->id );

					}

					// we've received all lists, store and return
					if ( count( $lists ) === $ret->total_items ) {
						$this->set_option( 'lists', $lists );
						$this->set_option( 'groups', $groups );
						return $lists;
					} else {
						$page++;
					}

				}
				// i dont know what happened...
				else {
					llms_log( 'Error during get_lists():', 'mailchimp' );
					llms_log( $ret, 'mailchimp' );
					return;
				}

			}

		}

	}

	/**
	 * Called before integration settings are saved
	 * If the MC api key has changed, adds action called after settings are saved
	 * which will test the new api key and output a message if there was an error
	 *
	 * @return   void
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function settings_save() {

		if ( ! empty( $_POST['llms_integration_mailchimp_enabled'] ) && ! empty( $_POST['llms_integration_mailchimp_apikey'] ) ) {

			$new_key = $_POST['llms_integration_mailchimp_apikey'];
			$saved_key = $this->get_option( 'apikey' );

			if ( $new_key !== $saved_key ) {

				add_action( 'lifterlms_settings_save_integrations', array( $this, 'settings_save_after' ), 777 );

			}

		}

	}

	/**
	 * Handles validating the API key when the key changes
	 * Additionally gets lists from MC via API
	 * @return   void
	 * @since    3.0.0
	 * @version  3.0.0
	 */
	public function settings_save_after() {

		$call = new LLMS_MailChimp_API( '', array(), 'GET' );

		if ( $call->is_error() ) {

			LLMS_Admin_Settings::set_error( sprintf( __( 'LifterLMS MailChimp Error: %s', 'lifterlms-mailchimp' ), $call->get_error_message() ) );

		} else {

			$res = $call->get_result();
			if ( isset( $res->status ) && 200 !== $res->status ) {

				$msg = isset( $res->detail ) ? $res->detail : __( 'An unknown response was recieved from MailChimp. Please check your API key and try again.', 'lifterlms-mailchimp' );

				LLMS_Admin_Settings::set_error( sprintf( __( 'LifterLMS MailChimp Error: %s', 'lifterlms-mailchimp' ), $msg ) );

			} else {

				$this->retrieve_lists();

			}

		}

	}

}
