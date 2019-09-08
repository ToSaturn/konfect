<?php
defined( 'ABSPATH' ) || exit;

/**
* LifterLMS Twilio Base Integration
*
* @version  1.0.0
* @since    1.0.2
*/
class LLMS_Integration_Twilio extends LLMS_Abstract_Integration {

	public $id = 'twilio';
	public $title = '';

	/**
	 * Integration Constructor
	 * @since    1.0.0
	 * @version  [verson]
	 */
	protected function configure() {

		$this->title = __( 'Twilio', 'lifterlms-twilio' );
		$this->description = __(  'Use Twilio to send automatic notifications via text messaging (SMS), create custom SMS engagements, and allow students to enroll in courses and memberships by SMS.', 'lifterlms-twilio' ) .
			'<br>' .
			 sprintf(
				__( 'Check out the getting started guide and documentation %1$shere%2$s.', 'lifterlms-twilio' ),
				'<a href="https://lifterlms.com/doc-category/lifterlms-integrations/lifterlms-twilio/?utm_source=LifterLMS%20Twilio&utm_medium=Plugin%20Settings&utm_campaign=LifterLMS%20Twilio">',
				'</a>'
			);


		if ( $this->is_available() ) {

			// access plan custom fields
			add_filter( 'llms_get_access_plan_properties', array( $this, 'add_access_plan_properties' ) );
			add_action( 'llms_access_plan_mb_after_row_one', array( $this, 'output_access_plan_metabox' ), 10, 3 );
			add_action( 'llms_access_plan_saved', array( $this, 'save_access_plan' ), 777, 3 );

			add_action( 'lifterlms_settings_save_integrations', array( $this, 'after_settings_save' ), 777 );

		}

	}

	/**
	 * Add custom properties to the LLMS_Access_Plan
	 * @param    array     $props  existing properties
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function add_access_plan_properties( $props ) {
		$props = array_merge( $props, array(
			'twilio_t2e_enabled' => 'yesno',
			'twilio_t2e_command' => 'text',
			'twilio_t2e_number' => 'text',
		) );
		return $props;
	}

	/**
	 * After saving settings, update the from number's webhook url
	 * so the Twilio rest handler can send default responses
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.2
	 */
	public function after_settings_save() {

		// this needs to run again because of the order with which options are set
		if ( ! $this->is_available() ) {
			return;
		}

		$update = $this->update_number_webhooks( $this->get_option( 'from_number' ) );
		if ( is_wp_error( $update ) ) {
			LLMS_Admin_Settings::set_error( sprintf( __( 'Error encountered when connecting with Twilio: "%s"', 'lifterlms-twilio' ), $update->get_error_message() ) );
		}

	}

	/**
	 * Get additional settings specific to the integration
	 * extending classes should override this with the settings
	 * specific to the integration
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	protected function get_integration_settings() {

		$settings = array();

		$settings[] = array(
			'desc' 		=> '<br>' . sprintf( __( 'Your Twilio Account SID. Find out how %1$shere%2$s.', 'lifterlms-twilio' ), '<a href="https://lifterlms.com/docs/getting-started-lifterlms-twilio/?utm_source=LifterLMS%20Twilio&utm_medium=Plugin%20Settings&utm_campaign=LifterLMS%20Twilio#api-auth">', '</a>' ),
			'default'	=> '',
			'id' 		=> $this->get_option_name( 'sid' ),
			'type' 		=> 'text',
			'title'     => __( 'Account SID', 'lifterlms-twilio' ),
		);

		$settings[] = array(
			'desc' 		=> '<br>' . sprintf( __( 'Your Twilio Auth Token. Find out how %1$shere%2$s.', 'lifterlms-twilio' ), '<a href="https://lifterlms.com/docs/getting-started-lifterlms-twilio/?utm_source=LifterLMS%20Twilio&utm_medium=Plugin%20Settings&utm_campaign=LifterLMS%20Twilio#api-auth">', '</a>' ),
			'default'	=> '',
			'id' 		=> $this->get_option_name( 'authkey' ),
			'type' 		=> 'text',
			'title'     => __( 'Authkey', 'lifterlms-twilio' ),
		);

		if ( $this->is_available() ) {

			$settings[] = array(
				'desc' 		=> '<br>' . __( 'The phone number used for sending SMS engagements and SMS notifications.', 'lifterlms-twilio' ),
				'id' 		=> $this->get_option_name( 'from_number' ),
				'type' 		=> 'select',
				'title'     => __( 'From Number', 'lifterlms-twilio' ),
				'options'   => $this->get_available_numbers( 'phone_number' ),
			);

			$settings[] = array(
				'default'	=> __( 'I didn\'t understand that, please try again. If you\'re trying to get in touch with a human, send an email instead.', 'lifterlms-twilio' ),
				'desc' 		=> '<br>' . __( 'This message is automatically sent in response to incoming messages when someone sends an invalid text to enroll command or responds to any SMS engagement or notification message.', 'lifterlms-twilio' ),
				'id' 		=> $this->get_option_name( 'default_auto_reply' ),
				'type' 		=> 'text',
				'title'     => __( 'Default Auto-Reply', 'lifterlms-twilio' ),
			);

		}

		return $settings;

	}

	/**
	 * Retrieve phone numbers available on the configured Twilio Account
	 * @param    boolean    $skip_cache  bypass the cache and make a new api call, by default we'll cache the results for a week
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_available_numbers_object( $skip_cache = false ) {

		$key = $this->get_option_name( 'numbers' );

		$numbers = $skip_cache ? array() : get_transient( $key );

		if ( ! $numbers ) {

			$numbers = array();

			$call = new LLMS_Twilio_API( 'IncomingPhoneNumbers', array(
				'PageSize' => 500
			), 'GET' );

			if ( ! $call->is_error() ) {

				$res = $call->get_result();
				if ( isset( $res->incoming_phone_numbers ) ) {

					foreach ( $res->incoming_phone_numbers as $data ) {

						if ( ! $data->capabilities->sms ) {
							continue;
						}

						$numbers[] = $data;

					}

				}

			}

			set_transient( $key, $numbers, WEEK_IN_SECONDS );

		}

		return $numbers;

	}

	/**
	 * Retrieve a key=>val array of available numbers using a specific field as the key
	 * @param    string     $key         field to use as the key
	 *                                   metabox uses "sid", settings uses "phone_number"
	 * @param    boolean    $skip_cache  whether cached data should be used, if true a new api call is made, otherwise uses the cache when available
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_available_numbers( $key = 'phone_number', $skip_cache = false ) {

		$numbers = array();

		foreach ( $this->get_available_numbers_object( $skip_cache ) as $data ) {
			$numbers[ $data->$key ] = sprintf( '%1$s (%2$s)', $data->friendly_name, $data->phone_number );
		}

		return $numbers;

	}

	/**
	 * Determine if the related plugin, theme, 3rd party is
	 * installed and activated
	 *
	 * For twilio we need to ensure we have api keys
	 *
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function is_installed() {
		return ( $this->get_option( 'sid', false ) && $this->get_option( 'authkey', false ) );
	}

	/**
	 * Output Twilio-related fields for access plans on the admin panel in the product metabox
	 * @param    obj|false  $plan   instance of the LLMS_Access_Plan or false (for the model/new access plan)
	 * @param    int        $id     access plan ID or a randomly generated id for a new plan
	 * @param    ind        $order  access plan order
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function output_access_plan_metabox( $plan, $id, $order ) {
		$meta_prefix = 'twilio_';

		$number = $plan ? $plan->get( 'twilio_t2e_number' ) : null;

		?>
		<div data-controller="llms-plan-is-free" data-value-is="yes">

			<div class="llms-metabox-field d-1of4">
				<label><?php _e( 'Twilio Text to Enroll', 'lifterlms-twilio' ) ?></label>
				<input data-controller-id="llms-plan-twilio-t2e" name="_llms_plans[<?php echo $order; ?>][twilio_t2e_enabled]" type="checkbox" value="yes"<?php checked( 'yes', $plan ? $plan->get( 'twilio_t2e_enabled' ) : 'no' ); ?>>
				<em><?php _e( 'Enable Text to Enroll', 'lifterlms-twilio' ); ?></em>
			</div>

			<div class="d-3of4" data-controller="llms-plan-twilio-t2e" data-value-is="yes">

				<div class="llms-metabox-field d-1of3">
					<label><?php _e( 'Enroll Command Text', 'lifterlms-twilio' ) ?></label>
					<input name="_llms_plans[<?php echo $order; ?>][twilio_t2e_command]" placeholder="<?php _e( 'ENROLL', 'lifterlms-twilio' ); ?>" required="required" type="text"<?php echo ( $plan ) ? ' value="' . $plan->get( 'twilio_t2e_command' ) . '"' : ' disabled="disabled"'; ?>>
				</div>

				<div class="llms-metabox-field d-2of3">
					<label><?php _e( 'To Number', 'lifterlms-twilio' ) ?></label>
					<select name="_llms_plans[<?php echo $order; ?>][twilio_t2e_number]"<?php echo ( $plan ) ? '' : ' disabled="disabled"'; ?>>
						<?php foreach ( $this->get_available_numbers( 'sid' ) as $val => $name ) : ?>
							<option value="<?php echo esc_attr( $val ); ?>"<?php selected( $val, $number ); ?>><?php echo esc_attr( $name ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>

			</div>

		</div>

		<div class="clear"></div>
		<?php
	}

	/**
	 * When an access plan is saved and twilio t2e is enabled
	 * update the webhook url for the saved number to make sure that
	 * t2e will work
	 * @param    obj     $plan       LLMS_Access_Plan
	 * @param    array   $post_data  $_POST data for the updated access plan
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function save_access_plan( $plan, $post_data, $metabox ) {

		$enabled = $plan->get( 'twilio_t2e_enabled' );

		if ( 'yes' === $enabled ) {

			if ( empty( $post_data['twilio_t2e_number'] ) ) {
				return;
			}

			$sid = $post_data['twilio_t2e_number'];

			$update = $this->update_number_webhooks( $sid );
			if ( is_wp_error( $update ) ) {
				$metabox->add_error( sprintf( __( 'Error encountered when connecting with Twilio: "%s"', 'lifterlms-twilio' ), $update->get_error_message() ) );
			}

		}
		// clear saved data if t2e is disabled
		else {
			$plan->set( 'twilio_t2e_command', '' );
			$plan->set( 'twilio_t2e_number', '' );
		}

	}


	/**
	 * Update the webhook url of a twilio number by number or sid
	 * @param    string     $number_or_sid  either a number in e.164 format or a twilio number sid
	 * @return   obj
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function update_number_webhooks( $number_or_sid ) {

		// find the SID if a number is supplied
		if ( 0 === strpos( $number_or_sid, '+' ) ) {

			$sid = '';
			foreach ( $this->get_available_numbers_object() as $data ) {

				if ( $data->phone_number !== $number_or_sid ) {
					continue;
				}

				$sid = $data->sid;
				break;

			}

		}
		// otherwise we already have the SID
		else {

			$sid = $number_or_sid;

		}

		$data = array(
			'SmsUrl' => LLMS_Twilio_REST::instance()->get_webhook_url(),
			'SmsMethod' => 'POST',
			'VoiceUrl' => '', // remove the voice number because we don't have call to enroll, yet ;-p
		);

		return new LLMS_Twilio_API( 'IncomingPhoneNumbers/' . $sid . '/', $data, 'POST' );


	}

}
