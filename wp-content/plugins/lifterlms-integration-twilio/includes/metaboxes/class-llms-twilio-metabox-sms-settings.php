<?php
/**
* Metabox for Twilio SMS Message Engagements
* @since    1.0.0
* @version  1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) { exit; }

class LLMS_Twilio_Metabox_Sms_Settings extends LLMS_Admin_Metabox {

	/**
	 * Configure the metabox settings
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function configure() {

		$this->id = 'lifterlms-twilio-sms-message';
		$this->title = __( 'SMS Settings', 'lifterlms-twilio' );
		$this->screens = array(
			'llms_twilio_sms',
		);
		// $this->context = 'side';
		$this->priority = 'high';

	}

	/**
	 * Builds array of metabox options.
	 * Array is called in output method to display options.
	 * Appropriate fields are generated based on type.
	 * @return array [md array of metabox fields]
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_fields() {

		$merge = array(
			'{student_phone}' => __( 'Student Phone Number', 'lifterlms-twilio' ),
		);

		return array(
			array(
				'title' 	=> 'Settings',
				'fields' 	=> array(
					array(
						'class' => 'code input-full',
						'desc' => sprintf(
											__( 'Enter additional SMS-enabled numbers which should recieve this notification. Separate multiple numbers with commas.<br>Format numbers with a "+" and country code e.g., %1$s (%2$sE.164 format%3$s).', 'lifterlms-twilio' ),
											'+16175551212',
											'<a href="http://wikipedia.org/wiki/E.164" target="_blank">',
											'</a>'
										) . llms_merge_code_button( '#' . $this->prefix . 'to_numbers', false, $merge ),
						'desc_class' => 'd-all',
						'default' => '{student_phone}',
						'id' => $this->prefix . 'to_numbers',
						'label'	=> __( 'To Numbers:', 'lifterlms-twilio' ),
						'required' => true,
						'type' => 'text',
						'value' => '',
					),
				),
			),
		);

	}

}

return new LLMS_Twilio_Metabox_Sms_Settings();
