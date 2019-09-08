<?php
defined( 'ABSPATH' ) || exit;

/**
* Twilio Notifications
*
* @since   1.0.0
* @version 1.0.3
*/
class LLMS_Twilio_Notifications {

	private $type_id = 'twilio';

	/**
	 * Constructor
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function __construct() {

		add_action( 'llms_notifications_loaded', array( $this, 'load_processor' ) );

		foreach ( $this->get_supported_triggers() as $trigger_id ) {

			// enable SMS as a notification type
			add_filter( 'llms_notification_' . $trigger_id . '_supported_types', array( $this, 'add_type_support' ) );

			// enable SMS supported fields
			add_filter( 'llms_notification_view' . $trigger_id . '_get_supported_fields', array( $this, 'add_field_support' ) );

			// setup default subscriber options
			add_filter( 'llms_notification_' . $trigger_id . '_subscriber_options', array( $this, 'get_subscriber_options' ), 10, 3 );

			// setup default body content sms notifications
			add_filter( 'llms_notification_view' . $trigger_id . '_set_body', array( $this, 'set_body' ), 10, 2 );

		}

	}

	/**
	 * Add field support for fields available in Twilio Notifications
	 * @param    arra0     $fields  array of existing fields
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function add_field_support( $fields ) {
		$fields[ $this->type_id ] = array(
			'body' => true,
		);
		return $fields;
	}

	/**
	 * Add the custom twilio sms notification type to supported notifications
	 * @param    array     $types  existing notification types
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function add_type_support( $types ) {
		$types[ $this->type_id ] = __( 'SMS', 'lifterlms-twilio' );
		return $types;
	}

	/**
	 * Define an array of notification triggers we want to send twilio notifications for
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function get_supported_triggers() {

		return apply_filters( 'llms_twilio_notification_triggers', array(
			'course_complete',
			'enrollment',
			'course_track_complete',
			'purchase_receipt',
			'quiz_failed',
			'quiz_passed',
		) );

	}

	/**
	 * Define subscriber options for twilio notifications
	 * @param    array      $options     array of existing options
	 * @param    string     $type        notification type
	 * @param    obj        $controller  notification controller instance
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_subscriber_options( $options = array(), $type, $controller ) {

		if ( $this->type_id !== $type ) {
			return $options;
		}

		return $this->set_subscriber_options( $controller );

	}

	/**
	 * Load the background processor for twilio notifications
	 * @param    obj     $notifications  LLMS_Notifications singleton
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function load_processor( $notifications ) {

		$path = LLMS_TWILIO_PLUGIN_DIR . 'includes/class-llms-twilio-notification-processor.php';
		$notifications->load_processor( $this->type_id, $path );

	}

	/**
	 * Set subscriber options for twilio notifications
	 * @param    obj     $controller  instance of the LLMS_Notification_Controller
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function set_subscriber_options( $controller ) {

		$options = array();

		// setup custom with a custom description
		$custom = $controller->get_subscriber_option_array( 'custom', 'no' );
		$custom['description'] = sprintf(
			__( 'Enter additional SMS-enabled numbers which should recieve this notification. Separate multiple numbers with commas.<br>Format numbers with a "+" and country code e.g., %1$s (%2$sE.164 format%3$s).', 'lifterlms-twilio' ),
			'+16175551212',
			'<a href="http://wikipedia.org/wiki/E.164" target="_blank">',
			'</a>'
		);

		switch ( $controller->id ) {

			case 'course_complete':
			case 'quiz_failed':
			case 'quiz_passed':
				$options[] = $controller->get_subscriber_option_array( 'course_author', 'no' );
				$options[] = $custom;
			break;

			case 'enrollment':
			case 'purchase_receipt':
				$options[] = $controller->get_subscriber_option_array( 'author', 'no' );
				$options[] = $custom;
			break;

			case 'course_track_complete':
				$options[] = $custom;
			break;

		}

		return $options;

	}

	/**
	 * Set the default body (message) for twilio notifications
	 * @param    string     $content  existing default content
	 * @param    obj        $view     instance of an LLMS_Notification_View
	 * @since    1.0.0
	 * @version  1.0.3
	 */
	public function set_body( $content, $view ) {

		if ( ! method_exists( $view, 'get_notification' ) || 'twilio' !== $view->get_notification()->get( 'type' ) ) {
			return $content;
		}

		switch ( $view->trigger_id ) {

			case 'course_complete':
				$content = sprintf( __( '%1$s completed the course %2$s', 'lifterlms-twilio' ), '{{STUDENT_NAME}}', '{{COURSE_TITLE}}' );
			break;

			case 'enrollment':
				$content = sprintf( __( '%1$s enrolled in the course %2$s', 'lifterlms-twilio' ), '{{STUDENT_NAME}}', '{{TITLE}}' );
			break;

			case 'course_track_complete':
				$content = sprintf( __( '%1$s completed the track %2$s', 'lifterlms-twilio' ), '{{STUDENT_NAME}}', '{{TRACK_TITLE}}' );
			break;

			case 'purchase_receipt':
				$content = sprintf(
					__( 'Purchase (#%1$s) from %2$s purchased %3$s on %4$s for %5$s', 'lifterlms-twilio' ),
					'{{TRANSACTION_ID}}', '{{CUSTOMER_NAME}}', '{{PRODUCT_TITLE}}',  '{{PLAN_TITLE}}', '{{TRANSACTION_AMOUNT}}'
				);
			break;

			case 'quiz_failed':
				$content = sprintf(
					__( '%1$s failed quiz %2$s from lesson %3$s in course %4$s with a %5$s', 'lifterlms-twilio' ),
					'{{STUDENT_NAME}}', '{{QUIZ_TITLE}}', '{{LESSON_TITLE}}', '{{COURSE_TITLE}}',  '{{GRADE}}'
				);
			break;

			case 'quiz_passed':
				$content = sprintf(
					__( '%1$s passed quiz %2$s from lesson %3$s in course %4$s with a %5$s', 'lifterlms-twilio' ),
					'{{STUDENT_NAME}}', '{{QUIZ_TITLE}}', '{{LESSON_TITLE}}', '{{COURSE_TITLE}}',  '{{GRADE}}'
				);
			break;

		}

		return $content;
	}


}

return new LLMS_Twilio_Notifications();
