<?php
defined( 'ABSPATH' ) || exit;

/**
 * LifterLMS engagements for sending Twilio SMS messages
 * @version  1.0.0
 * @since    1.0.1
 */
class LLMS_Twilio_Engagements {

	/**
	 * Constructor
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ) );
		add_filter( 'lifterlms_engagement_types', array( $this, 'register_engagement_type' ), 10, 1 );
		add_filter( 'lifterlms_external_engagement_handler_arguments', array( $this, 'register_engagement_handler' ), 10, 5 );
		add_action( 'lifterlms_engagement_send_twilio_sms', array( $this, 'handle_engagement' ), 10, 1 );
		add_filter( 'llms_merge_codes_for_button', array( $this, 'register_sms_merge_codes' ), 10, 3 );

		if ( is_admin() ) {
			add_action( 'admin_footer', array( $this, 'admin_engagement_scripts' ) );
			add_filter( 'user_can_richedit', array( $this, 'disable_wysiwyg' ), 10, 1 );
		}

	}

	/**
	 * Add some JS to the admin panel to handle user interaction with the engagment creation screen
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function admin_engagement_scripts() {

		$screen = get_current_screen();

		if ( 'llms_engagement' !== $screen->id ) {
			return;
		}

		echo "
			<script>( function( $ ) {
				$( '#_llms_engagement' ).on( 'llms-engagement-type-change-external', function( e, data ) {
					if ( data && 'twilio_sms' !== data ) {
						return;
					}
					$( this ).val( null ).attr( 'data-post-type', 'llms_' + data ).trigger( 'change' );
					window.llms.metaboxes.post_select( $( this ) );
				} );
			} )( jQuery );</script>
		";
	}

	/**
	 * Disable the WYSIWYG editor for SMS message post type
	 * @param    boolean     $enabled  default setting
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function disable_wysiwyg( $enabled ) {
		if ( get_post_type() === 'llms_twilio_sms' ) {
			return false;
		}
		return $enabled;
	}

	/**
	 * Retrieve a filtered array of merge codes that can be used in the sms message content
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.1
	 */
	private function get_merge_codes() {
		return apply_filters( 'llms_twilio_sms_engagement_merge_codes', array(
			'{current_date}' => __( 'Current Date', 'lifterlms-twilio' ),
			'{first_name}' => __( 'Student First Name', 'lifterlms-twilio' ),
			'{last_name}' => __( 'Student Last Name', 'lifterlms-twilio' ),
			'{site_title}' => __( 'Website Title', 'lifterlms-twilio' ),
			'{site_url}' => __( 'Website URL', 'lifterlms-twilio' ),
			'{student_phone}' => __( 'Student Phone Number', 'lifterlms-twilio' ),
		) );
	}

	/**
	 * Get an array of merged values for use in str_replace when merging the SMS message
	 * @param    int     $user_id  WP User ID
	 * @return   mixed
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function get_merge_values( $user_id ) {

		$vals = array();

		foreach ( array_keys( $this->get_merge_codes() ) as $code ) {
			$vals[] = $this->get_merge_code_value( $code, $user_id );
		}

		return $vals;

	}

	/**
	 * Get the value of a merge code
	 * @param    string     $code     merge code
	 * @param    int        $user_id  user id
	 * @return   mixed
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function get_merge_code_value( $code, $user_id ) {

		switch ( $code ) {

			case '{site_title}':
				$value = get_bloginfo( 'name', 'raw' );
			break;

			case '{site_url}':
				$value = get_bloginfo( 'url', 'raw' );
			break;

			case '{first_name}':
				$value = get_user_meta( $user_id, 'first_name', true );
			break;

			case '{last_name}':
				$value = get_user_meta( $user_id, 'last_name', true );
			break;

			case '{current_date}':
				$format = apply_filters( 'llms_twilio_sms_engagement_date_format', get_option( 'date_format' ) );
				$value = date_i18n( $format, current_time( 'timestamp' ) );
			break;

			default:
				$value = apply_filters( 'llms_twilio_sms_engagement_external_merge_code_value', $code, $user_id );

		}

		return apply_filters( 'llms_twilio_sms_engagement_merge_code_value', $value, $code, $user_id );

	}

	/**
	 * Engagement trigger handler
	 * Sends preps and sends an SMS
	 * @param    array     $args  arguments from the triggering action
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function handle_engagement( $args ) {

		$logger = LLMS()->engagements();
		$logger->log( '======== LLMS_Twilio_Engagements::handle_engagement() =======' );
		$logger->log( $args );

		$user_id = $args[0];
		$sms_id = $args[1];
		// $related_post_id = $args[2];

		$message = $this->merge_message( $sms_id, $user_id );

		$logger->log( $message );

		$numbers = explode( ',', get_post_meta( $sms_id, '_llms_to_numbers', true ) );
		$numbers = array_map( 'trim', $numbers );

		foreach ( $numbers as $number ) {

			$logger->log( 'sending to number: ' . $number );

			if ( '{student_phone}' === $number ) {

				$student = llms_get_student( $user_id );
				if ( ! $student ) {
					$logger->log( 'not sent: no user could be located for the given user id' );
					continue;
				}

				if ( 'yes' !== $student->get( 'llms_twilio_can_sms' ) ) {
					$logger->log( 'not sent: user has not opted-in to sms messaging' );
					continue;
				}

				$number = $student->get( 'phone' );

				if ( ! $number ) {
					$logger->log( 'not sent: no phone number for user' );
					continue;
				}

			}

			if ( ! llms_twilio_send_sms( $number, $message ) ) {
				$logger->log( 'not sent' );
				continue;
			}

			$logger->log( 'sent' );

		}


	}

	/**
	 * gets a merged message for the sms message for a user
	 * @param    int     $sms_id   WP Post ID of the SMS Message
	 * @param    int     $user_id  WP Used ID of the student
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	private function merge_message( $sms_id, $user_id ) {

		$post = get_post( $sms_id );
		if ( ! $post ) {
			$logger = LLMS()->engagements();
			$logger->log( sprintf( 'no sms message found for post %d', $sms_id ) );
			return '';
		}

		$content = strip_tags( $post->post_content );
		return str_replace( array_keys( $this->get_merge_codes() ), $this->get_merge_values( $user_id ), $content );

	}

	/**
	 * Register a Twilio SMS engagement handler with LifterLMS
	 * @param    array      $data             existing handler data
	 * @param    obj        $engagement       engagement data object
	 * @param    int        $user_id          WP User ID of the user who triggered the engagement
	 * @param    int        $related_post_id  triggering post id
	 * @param    string     $trigger_type     type of engagement that was triggered (eg "lesson_complete")
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function register_engagement_handler( $data, $engagement, $user_id, $related_post_id, $trigger_type ) {

		if ( 'twilio_sms' !== $engagement->event_type ) {
			return $data;
		}

		$data['handler_action'] = 'lifterlms_engagement_send_twilio_sms';
		$data['handler_args'] = array( $user_id, $engagement->engagement_id, $related_post_id );

		return $data;

	}

	/**
	 * Register SMS messages as an engagement type
	 * @param    array     $types  existing engagement types
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function register_engagement_type( $types ) {
		$types['twilio_sms'] = __( 'Send an SMS (via Twilio)', 'lifterlms-twilio' );
		return $types;
	}

	/**
	 * Add available merge codes to the merge code button for the SMS wysiwyg editor
	 * @param    array     $codes   existing codes (if any)
	 * @param    obj       $screen  get_current_screen()
	 * @param    string    $target  html element target id
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function register_sms_merge_codes( $codes, $screen, $target ) {

		if ( 'llms_twilio_sms' === $screen->id ) {

			$codes = $this->get_merge_codes();

		}

		return $codes;
	}

	/**
	 * Register the Twilio SMS Message Post Type
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function register_post_type() {

		register_post_type( 'llms_twilio_sms', apply_filters( 'lifterlms_register_post_type_twilio_sms', array(
			'labels' => array(
				'name' 					=> __( 'SMS Messages', 'lifterlms-twilio' ),
				'singular_name' 		=> __( 'SMS Message', 'lifterlms-twilio' ),
				'menu_name'				=> _x( 'SMS Messages', 'Admin menu name', 'lifterlms-twilio' ),
				'add_new' 				=> __( 'Add SMS Message', 'lifterlms-twilio' ),
				'add_new_item' 			=> __( 'Add New SMS Message', 'lifterlms-twilio' ),
				'edit' 					=> __( 'Edit', 'lifterlms-twilio' ),
				'edit_item' 			=> __( 'Edit SMS Message', 'lifterlms-twilio' ),
				'new_item' 				=> __( 'New SMS Message', 'lifterlms-twilio' ),
				'view' 					=> __( 'View SMS Message', 'lifterlms-twilio' ),
				'view_item' 			=> __( 'View SMS Message', 'lifterlms-twilio' ),
				'search_items' 			=> __( 'Search SMS Messages', 'lifterlms-twilio' ),
				'not_found' 			=> __( 'No SMS Messages found', 'lifterlms-twilio' ),
				'not_found_in_trash' 	=> __( 'No SMS Messages found in trash', 'lifterlms-twilio' ),
				'parent' 				=> __( 'Parent SMS Message', 'lifterlms-twilio' ),
			),
			'description' 			=> __( 'This is where you can add new SMS Messages.', 'lifterlms-twilio' ),
			'public' 				=> false,
			'show_ui' 				=> ( current_user_can( apply_filters( 'llms_twilio_manage_sms_capability', 'manage_options' ) ) ) ? true : false,
			'map_meta_cap'			=> true,
			'publicly_queryable' 	=> false,
			'exclude_from_search' 	=> true,
			'show_in_menu' 			=> 'edit.php?post_type=llms_engagement',
			'hierarchical' 			=> false,
			'show_in_nav_menus' 	=> false,
			'rewrite' 				=> false,
			'query_var' 			=> false,
			'supports' 				=> array( 'title', 'editor' ),
			'has_archive' 			=> false,
		) ) );

	}

}

return new LLMS_Twilio_Engagements();
