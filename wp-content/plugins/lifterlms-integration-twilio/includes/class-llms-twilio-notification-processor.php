<?php
/**
 * Notification Background Processor: Twilio SMS
 *
 * @since    1.0.0
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class LLMS_Notification_Processor_Twilio extends LLMS_Abstract_Notification_Processor {

	/**
	 * action name
	 * @var  string
	 */
	protected $action = 'llms_notification_processor_twilio';

	/**
	 * Processes an item in the queue
	 * @param    int     $notification_id  ID of an LLMS_Notification
	 * @return   boolean                   false removes item from the queue
	 *                                     true leaves it in the queue for further processing
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	protected function task( $notification_id ) {

		$this->log( sprintf( 'sending twilio notification ID #%d', $notification_id ) );

		$notification = new LLMS_Notification( $notification_id );

		$view = $notification->get_view();

		if ( ! $view ) {
			$this->log( 'ID#' . $notification_id );
			return false;
		}

		$number = $notification->get( 'subscriber' );

		// if the number isn't already a formatted number
		// attempt to locate a number by user id
		if ( 0 !== strpos( $number, '+' ) ) {

			$student = llms_get_student( $number );
			if ( ! $student ) {
				return $this->update_status( $notification, 'error', sprintf( 'could not locate user %1$d ID (Notification ID #%2$d)', $number, $notification_id ) );
			}

			$number = $student->get( 'phone' );
			if ( ! $number ) {
				return $this->update_status( $notification, 'error', sprintf( 'could not locate phone number for user %1$d (Notification ID #%2$d)', $number, $notification_id ) );
			}

		}

		// attempt to send message & log failure
		if ( llms_twilio_send_sms( $number, $view->get_body( true ) ) ) {
			return $this->update_status( $notification, 'sent' );
		}

		return $this->update_status( $notification, 'error', sprintf( 'error sending twilio notification ID #%d', $notification_id ) );

	}

	private function update_status( $notification, $status, $msg = '' ) {
		if ( $msg ) {
			$this->log( $msg );
		}
		$notification->set( 'status', $status );
		return false;
	}

}

return new LLMS_Notification_Processor_Twilio();

