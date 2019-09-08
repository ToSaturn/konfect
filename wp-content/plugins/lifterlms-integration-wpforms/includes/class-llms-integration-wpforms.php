<?php
/**
 * LifterLMS WPForms Integration Class
 *
 * @package  LifterLMS_WPForms/Classes
 * @since    1.0.0
 * @version  1.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_Integration_WPForms class.
 */
class LLMS_Integration_WPForms extends LLMS_Abstract_Integration {

	/**
	 * Integration ID
	 *
	 * @var  string
	 */
	public $id = 'wpforms';

	/**
	 * Integration title
	 *
	 * @var  string
	 */
	public $title = '';

	/**
	 * Integration Description
	 *
	 * @var  string
	 */
	public $description = '';

	/**
	 * Integration Missing Dependencies Description
	 * Should be defined by extending class in configure() function (so it can be i18n)
	 * Displays on the settings screen when $this->is_installed() is false
	 * to help users identify what requirements are missing
	 *
	 * @var  string
	 */
	public $description_missing = '';

	/**
	 * Integration Priority
	 * Detemines the order of the settings on the Integrations settings table
	 * Core integrations fire at 5
	 *
	 * @var  integer
	 */
	protected $priority = 20;

	/**
	 * URL to the WPForms Product
	 *
	 * @var string
	 */
	private $product_url = 'http://lifterlikes.com/wpforms';

	/**
	 * Integration Constructor
	 *
	 * @since    1.0.0
	 * @version  1.1.0
	 */
	protected function configure() {

		$this->title       = __( 'LifterLMS WPForms', 'lifterlms-wpforms' );
		$this->description = __( 'Seamlessly add WPForms to LifterLMS lessons, add form entries to the LMS reporting, create a custom registration form, and more', 'lifterlms-wpforms' );
		// Translators: %1$s = opening anchor html; %2$s = closing anchor html.
		$this->description_missing = sprintf( __( 'You need to install the %1$sWPForms Core%2$s add-on to use this integration.', 'lifterlms-wpforms' ), '<a href="' . $this->product_url . '" target="_blank">', '</a>' );

		if ( ! $this->is_available() ) {
			return;
		}

		add_filter( 'llms_show_mark_complete_button', array( $this, 'maybe_show_mark_complete' ), 20, 2 );

		add_filter( 'wpforms_frontend_load', array( $this, 'maybe_show_form' ) );

		add_action( 'wpforms_process_complete', array( $this, 'maybe_mark_complete' ), 20, 4 );

		add_filter( 'llms_allow_lesson_completion', array( $this, 'maybe_prevent_lesson_completion' ), 10, 5 );

		add_filter( 'llms_metabox_fields_lifterlms_course_options', array( $this, 'add_post_settings' ) );
		add_filter( 'llms_metabox_fields_lifterlms_lesson', array( $this, 'add_post_settings' ) );

		add_action( 'save_post_course', array( $this, 'save_post_settings' ), 20, 2 );
		add_action( 'save_post_lesson', array( $this, 'save_post_settings' ), 20, 2 );

		add_filter( 'llms_table_get_student-course_columns', array( $this, 'add_reporting_col' ), 10, 2 );
		add_filter( 'llms_table_get_data_student-course', array( $this, 'add_reporting_data' ), 10, 5 );

		add_action( 'wpforms_entry_details_sidebar_details', array( $this, 'output_entry_meta' ) );

		/**
		 * Need help
		 *
		 * @todo  need WPForms to expose what kind of record is deleted here
		 *        currently only the row id is passed to the callback
		 *        this same hook is used for deleting entries, entry fields, and entry meta
		 *        since it's hooked after the deletion event we can't know what is actually being deleted
		 *
		 * once that's fixed we can use the hook to cleanup user postmeta data related to the entry
		 */
		// add_action( 'wpforms_post_delete', array( $this, 'delete_entry' ) );.
		if ( $this->is_addon_available( 'user_registration' ) ) {

			// replace login form.
			add_action( 'llms_before_person_login_form', array( $this, 'form_modify_login' ) );

			// replace checkout form for logged out users with the custom checkout form.
			add_action( 'lifterlms_pre_checkout_form', array( $this, 'form_modify_checkout' ) );

			// replace open registration form with the custom registration form.
			add_action( 'lifterlms_before_person_register_form', array( $this, 'form_modify_registration' ) );

			add_action( 'wpforms_user_registered', array( $this, 'user_registered' ), 10, 4 );

		}

	}

	/**
	 * This function creates the array of content that
	 *
	 * @param    array $settings  existing course settings.
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function add_post_settings( $settings ) {

		$loc = get_post_type();

		$settings[] = array(
			'title'  => __( 'WPForms', 'lifterlms-wpforms' ),
			'fields' => array(
				array(
					'allow_null' => false,
					'type'       => 'select',
					'label'      => __( 'Lesson Completion', 'lifterlms-wpforms' ),
					'desc'       => __( 'When a WPForm is present on a lesson in this course, determine if the form must be submitted in order for the lesson to be marked as completed.', 'lifterlms-wpforms' ),
					'id'         => '_llms_wpf_lesson_progression',
					'class'      => 'input-full llms-select2',
					'value'      => $this->get_progression_options( $loc ),
					'group'      => '',
					'default'    => 'default',
				),
			),
		);

		return $settings;

	}

	/**
	 * Add custom reporting columns to display form entry links / completion on student course reporting tabs
	 *
	 * @param    array  $cols     reporting table column data.
	 * @param    string $context  table display content.
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function add_reporting_col( $cols, $context ) {

		$cols = llms_assoc_array_insert(
			$cols,
			'grade',
			'wpf_entry_id',
			array(
				'title' => __( 'WPForms Entry', 'lifterlms-wpforms' ),
			)
		);

		return $cols;
	}

	/**
	 * Output reporting data related to form entries
	 *
	 * @param    mixed  $value     reporting cell value.
	 * @param    string $key       keyname.
	 * @param    obj    $lesson    LLMS_Lesson.
	 * @param    string $context   display contenxt.
	 * @param    obj    $table     LLMS_Admin_Table object.
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function add_reporting_data( $value, $key, $lesson, $context, $table ) {

		if ( 'wpf_entry_id' === $key ) {

			$value = '&ndash;';

			if ( $this->lesson_has_form( $lesson->get( 'id' ) ) ) {

				$id = $this->get_user_entry_id( $table->student->get_id(), $lesson->get( 'id' ) );
				if ( 'yes' === $id ) {
					$value = '&#10004;';
				} elseif ( is_numeric( $id ) ) {
					$value = sprintf(
						'<a href="%1$s" title="%2$s">%2$s</a>',
						add_query_arg(
							array(
								'view'     => 'details',
								'entry_id' => $id,
							),
							admin_url( 'admin.php?page=wpforms-entries' )
						),
						esc_html__( 'View Entry', 'lifterlms-wpforms' )
					);
				}
			}
		}

		return $value;

	}

	/**
	 * Determine if a post has a WPForm
	 *
	 * @param   obj|int $post WP_Post or WP_Post ID.
	 * @return  bool
	 * @since   1.1.0
	 * @version 1.1.0
	 */
	public function does_post_have_form( $post ) {

		$ret  = false;
		$post = get_post( $post );

		if ( $post ) {

			$block_name = 'wpforms/form-selector';

			// Look for shortcode.
			if ( has_shortcode( $post->post_content, 'wpforms' ) ) {

				$ret = true;

				// Check if blocks exist and then look for the WPForms block.
			} elseif ( function_exists( 'has_block' ) && has_block( $block_name, $post->post_content ) ) {

				// Loop through all blocks, we need to ensure that the block has a form selected.
				foreach ( parse_blocks( $post->post_content ) as $block ) {

					// Only check WPForms blocks & skip any without a formId selected.
					if ( $block_name === $block['blockName'] && ! empty( $block['attrs']['formId'] ) ) {

						// Found it, we can break.
						$ret = true;
						break;

					}
				}
			}
		}

		return apply_filters( 'llms_wpf_does_post_have_form', $ret, $post );

	}

	/**
	 * Modify the checkout form to output a WPForm if a user reg form is selected
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function form_modify_checkout() {

		if ( is_user_logged_in() ) {
			return;
		}

		$shortcode = $this->get_shortcode( 'form_checkout_reg' );
		if ( $shortcode ) {
			echo do_shortcode( $shortcode );

			// swallow the rest of the checkout form for logged out users.
			ob_start();

			// complete output buffering after the default checkout form.
			add_action( 'lifterlms_post_checkout_form', array( $this, 'form_modify_end' ) );
		}

	}

	/**
	 * Called via $this->form_modify_checkout() to end output buffering after the checkout form
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function form_modify_end() {
		ob_get_clean();
	}

	/**
	 * Modify the login form to output a WPForm if a user reg form is selected
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function form_modify_login() {

		$shortcode = $this->get_shortcode( 'form_login' );
		if ( $shortcode ) {

			echo do_shortcode( $shortcode );

			// quick js to make the login form work like native lifterlms.
			?>
			<script>(function($){
				var $wrap = $( '.llms-checkout-wrapper' );
				$wrap.find( '.wpforms-container' ).first().hide();
				$( 'a[href="#llms-show-login"]' ).on( 'click', function( e ) {
					e.preventDefault();
					$( this ).closest( '.llms-notice' ).slideUp( 400 );
					$wrap.find( '.wpforms-container' ).first().slideDown( 400 );
				} );
			})(jQuery);
			</script>
			<?php

			// swallow the rest of the login form for logged out users.
			ob_start();

			// complete output buffering after the default checkout form.
			add_action( 'llms_after_person_login_form', array( $this, 'form_modify_end' ) );

		}

	}


	/**
	 * Modify the reg form to output a WPForm if a user reg form is selected
	 *
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function form_modify_registration() {

		if ( is_user_logged_in() ) {
			return;
		}

		$shortcode = $this->get_shortcode( 'form_reg' );
		if ( $shortcode ) {
			echo do_shortcode( $shortcode );

			// swallow the rest of the checkout form for logged out users.
			ob_start();

			// complete output buffering after the default checkout form.
			add_action( 'lifterlms_after_person_register_form', array( $this, 'form_modify_end' ) );
		}

	}

	/**
	 * Get additional settings specific to the integration
	 * extending classes should override this with the settings
	 * specific to the integration
	 *
	 * @return   array
	 * @since    1.0.0
	 * @version  1.1.0
	 */
	protected function get_integration_settings() {

		$settings = array();

		if ( ! $this->is_available() ) {
			return $settings;
		}

		$settings[] = array(
			'class'   => 'llms-select2',
			'default' => 'required',
			'desc'    => __( 'When a WPForm is present on a lesson, determine if the form must be submitted in order for the lesson to be marked as complete. This can be overriden for individual courses and lessons.', 'lifterlms-wpforms' ),
			'id'      => $this->get_option_name( 'lesson_progression' ),
			'options' => $this->get_progression_options( 'global' ),
			'title'   => __( 'Lesson Completion', 'lifterlms-wpforms' ),
			'type'    => 'select',
		);

		$user_reg = $this->is_addon_available( 'user_registration' );

		$settings[] = array(
			'type'  => 'subtitle',
			'title' => __( 'User Management Forms', 'lifterlms-wpforms' ),
			'desc'  => __( 'Replace default LifterLMS user forms with custom WPForms user registration forms.', 'lifterlms-wpforms' ),
		);

		if ( ! $user_reg ) {

			$settings[] = array(
				'type'  => 'custom-html',
				// Translators: %1$s = opening anchor html; %2$s = closing anchor html.
				'value' => '<em>' . sprintf( __( 'You need to upgrade to %1$sWPForms Pro%2$s and install the User Registration Add-on to unlock these features.', 'lifterlms-wpforms' ), '<a href="' . $this->product_url . '" target="_blank">', '</a>' ) . '</em>',
			);

		}

		$base = array(
			'class'             => 'llms-select2-post',
			'custom_attributes' => array(
				'data-no-view-button' => true,
				'data-post-type'      => 'wpforms',
				'data-placeholder'    => __( 'Select a form...', 'lifterlms-wpforms' ),
			),
			'disabled'          => ( ! $user_reg ),
			'type'              => 'select',
		);

		$settings[] = wp_parse_args(
			array(
				'desc'    => '<br>' . __( 'This form will be used in place of the default LifterLMS login form.', 'lifterlms-wpforms' ),
				'id'      => $this->get_option_name( 'form_login' ),
				'options' => llms_make_select2_post_array( $this->get_option( 'form_login' ) ),
				'title'   => __( 'Login Form', 'lifterlms-wpforms' ),
			),
			$base
		);

		$settings[] = wp_parse_args(
			array(
				'desc'    => '<br>' . __( 'This form will be used in place of the default LifterLMS Registration Form during enrollment and purchases for new users.', 'lifterlms-wpforms' ),
				'id'      => $this->get_option_name( 'form_checkout_reg' ),
				'options' => llms_make_select2_post_array( $this->get_option( 'form_checkout_reg' ) ),
				'title'   => __( 'Checkout Registration Form', 'lifterlms-wpforms' ),
			),
			$base
		);

		$settings[] = wp_parse_args(
			array(
				'desc'    => '<br>' . __( 'This form will be used in place of the default LifterLMS Open Registation Form.', 'lifterlms-wpforms' ),
				'id'      => $this->get_option_name( 'form_reg' ),
				'options' => llms_make_select2_post_array( $this->get_option( 'form_reg' ) ),
				'title'   => __( 'Open Registration Form', 'lifterlms-wpforms' ),
			),
			$base
		);

		$settings[] = array(
			'desc'     => __( 'Display form title when outputting custom user registration forms.', 'lifterlms-wpforms' ),
			'default'  => 'yes',
			'disabled' => ( ! $user_reg ),
			'id'       => $this->get_option_name( 'form_show_title' ),
			'title'    => __( 'Show Form Titles', 'lifterlms-wpforms' ),
			'type'     => 'checkbox',
		);

		$settings[] = array(
			'desc'     => __( 'Display the form description when outputting custom user registration forms.', 'lifterlms-wpforms' ),
			'default'  => 'no',
			'disabled' => ( ! $user_reg ),
			'id'       => $this->get_option_name( 'form_show_desc' ),
			'title'    => __( 'Show Form Descriptions', 'lifterlms-wpforms' ),
			'type'     => 'checkbox',
		);

		$settings[] = array(
			'desc'     => __( 'If checked, users will be automatically logged in when registering through a WPForms user registration form.', 'lifterlms-wpforms' ),
			'default'  => 'yes',
			'disabled' => ( ! $user_reg ),
			'id'       => $this->get_option_name( 'auto_login' ),
			'title'    => __( 'Login During Registration', 'lifterlms-wpforms' ),
			'type'     => 'checkbox',
		);

		return $settings;

	}

	/**
	 * Retrieve the progression setting for an object
	 * Cascades up: lesson -> course -> global -> default hard coded filterable setting
	 *
	 * @param    int $object_id  WP Post ID.
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_progression_setting( $object_id ) {

		// default value to use if the object doesn't have a setting & the global option isn't set.
		$default = apply_filters( 'llms_wpf_get_progression_setting_default', 'required', $object_id );

		// get the postmeta setting.
		$setting = get_post_meta( $object_id, '_llms_wpf_lesson_progression', true );

		// if we're looking at a lesson and the setting is define as parent (course) or the setting isn't set.
		// cascade up to find the course's setting.
		if ( 'lesson' === get_post_type( $object_id ) && ( ! $setting || 'parent' === $setting ) ) {

			$course = llms_get_post_parent_course( $object_id );
			if ( $course ) {
				$setting = $this->get_progression_setting( $course->get( 'id' ) );
			}

			// if the setting is set as global or the setting isn't set.
		} elseif ( 'global' === $setting || ! $setting ) {
			$setting = $this->get_option( 'lesson_progression', $default );
		}

		// ensure we return at least the hard coded default.
		$setting = $setting ? $setting : $default;

		return apply_filters( 'llms_wpf_get_progression_setting', $setting, $object_id );

	}

	/**
	 * Retrieve an array of options for lesson progression settings based on the display location
	 *
	 * @param    string $location  display location for the settings [global|course|lesson].
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_progression_options( $location = 'global' ) {

		$req_text = esc_attr__( 'Submission required', 'lifterlms-wpforms' );
		$opt_text = esc_attr__( 'Submission optional', 'lifterlms-wpforms' );

		$options = array(
			'optional' => esc_attr__( 'Form submission is optional', 'lifterlms-wpforms' ),
			'required' => esc_attr__( 'Form submission is required for lesson completion', 'lifterlms-wpforms' ),
		);

		switch ( $location ) {

			case 'lesson':
				$desc    = 'required' === $this->get_progression_setting( get_the_ID() ) ? $req_text : $opt_text;
				$options = array_merge(
					array(
						/* Translators: %s = translated current global setting */
						'parent' => sprintf( esc_attr__( 'Use course setting (%s)', 'lifterlms-wpforms' ), $desc ),
					),
					$options
				);
				// no break.
			case 'course':
				$desc = 'required' === $this->get_option( 'lesson_progression', 'required' ) ? $req_text : $opt_text;

				$options = array_merge(
					array(
						/* Translators: %s = translated current global setting */
						'global' => sprintf( esc_attr__( 'Use global setting (%s)', 'lifterlms-wpforms' ), $desc ),
					),
					$options
				);

				break;

		}

		return apply_filters( 'llms_wpf_progression_options', $options, $this );

	}

	/**
	 * Retrieve a shortcode for a given custom form
	 *
	 * @param    string $setting  setting key/name (eg: form_checkout_reg).
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_shortcode( $setting ) {

		$form_id = $this->get_option( $setting );
		if ( $form_id ) {
			$title = llms_parse_bool( $this->get_option( 'form_show_title', 'yes' ) ) ? 'true' : 'false';
			$desc  = llms_parse_bool( $this->get_option( 'form_show_desc', 'no' ) ) ? 'true' : 'false';
			return '[wpforms id="' . $form_id . '" title="' . $title . '" description="' . $desc . '"]';
		}

		return '';

	}

	/**
	 * Retrieve the entry ID of a form for a given student and lesson
	 *
	 * @param    int $user_id    WP_User ID.
	 * @param    int $lesson_id  WP_Post ID.
	 * @return   mixed               (int)     Form Entry ID when form is submitted and pro version installed
	 *                               (string)  "yes" when the form has been submitted via lite version
	 *                               (string)  "" (empty string) when the form has not been submitted
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_user_entry_id( $user_id, $lesson_id ) {

		return llms_get_user_postmeta( $user_id, $lesson_id, '_wpf_entry_id', true );

	}

	/**
	 * Determine if a WPForms add-on is available
	 *
	 * @param    string $addon  id for the add-on [user_registration].
	 * @return   bool
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function is_addon_available( $addon = '' ) {

		if ( 'user_registration' === $addon && defined( 'WPFORMS_USER_REGISTRATION_VERSION' ) ) {
			return true;
		} elseif ( 'pro' === $addon && wpforms()->pro ) {
			return true;
		}

		return false;

	}

	/**
	 * Determine if integration dependencies are available
	 *
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.1.0
	 */
	public function is_installed() {
		return function_exists( 'wpforms' );
	}

	/**
	 * Determine if a lesson contains a WPForm
	 *
	 * @param    int $lesson_id WP_Post ID of a lesson.
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function lesson_has_form( $lesson_id ) {
		return llms_parse_bool( get_post_meta( $lesson_id, '_llms_wpf_has_form', true ) );
	}

	/**
	 * Trigger lesson completion when a form is submitted on a lesson
	 *
	 * @param    array $fields     form field data.
	 * @param    array $entry      entry data.
	 * @param    array $form_data  submitted form data.
	 * @param    int   $entry_id   ID of the entry.
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.1
	 */
	public function maybe_mark_complete( $fields, $entry, $form_data, $entry_id ) {

		$post_id = get_the_ID();

		// return early if the form isn't on a lesson.
		if ( 'lesson' !== get_post_type( $post_id ) || ! $this->lesson_has_form( $post_id ) ) {
			return;
		}

		// for pro, record some meta info that can be reviewed on the single entry view on the admin panel.
		if ( $this->is_addon_available( 'pro' ) ) {

			wpforms()->entry_meta->add(
				array(
					'entry_id' => $entry_id,
					'form_id'  => $form_data['id'],
					'user_id'  => get_current_user_id(),
					'type'     => 'llms_lesson_id',
					'data'     => $post_id,
				),
				'entry_meta'
			);

		}

		$this->record_entry( get_current_user_id(), $post_id, $entry_id );

		if ( 'required' !== $this->get_progression_setting( $post_id ) ) {
			return;
		}

		do_action( 'llms_trigger_lesson_completion', get_current_user_id(), $post_id, 'lesson_' . $post_id );

	}

	/**
	 * Before a lesson is marked as complete, check if all the lesson's quiz requirements are met
	 *
	 * @filter   llms_allow_lesson_completion
	 * @param    bool   $allow_completion  whether or not to allow completion (true by default, false if something else has already prevented).
	 * @param    int    $user_id           WP User ID of the student completing the lesson.
	 * @param    int    $lesson_id         WP Post ID of the lesson to be completed.
	 * @param    string $trigger           text string to record the reason why the lesson is being completed.
	 * @param    array  $args              optional additional arguements from the triggering function.
	 * @return   bool
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function maybe_prevent_lesson_completion( $allow_completion, $user_id, $lesson_id, $trigger, $args ) {

		// if allow completion is already false, we don't need to run any form checks.
		if ( ! $allow_completion ) {
			return $allow_completion;
		}

		if ( 'required' === $this->get_progression_setting( $lesson_id ) && $this->lesson_has_form( $lesson_id ) ) {

			$allow_completion = ( $this->get_user_entry_id( $user_id, $lesson_id ) );

		}

		return $allow_completion;

	}

	/**
	 * Determine if a form should be hidden because the lesson is already completed
	 *
	 * @param    bool $show  whether or not to show the form.
	 * @return   bool
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function maybe_show_form( $show ) {

		// return early if the form isn't on a lesson.
		if ( 'lesson' !== get_post_type() ) {
			return apply_filters( 'llms_wpf_maybe_show_form', $show );
		}

		if ( $this->lesson_has_form( get_the_ID() ) && ( llms_is_complete( get_current_user_id(), get_the_ID(), 'lesson' ) && $this->get_user_entry_id( get_current_user_id(), get_the_ID() ) ) ) {
			return apply_filters( 'llms_wpf_maybe_show_form', false );
		}

		return apply_filters( 'llms_wpf_maybe_show_form', $show );

	}

	/**
	 * Determine if mark complete button should be hidden on a lesson due to the presence of a WPForm
	 *
	 * @param    bool $show    Default value of the display.
	 * @param    obj  $lesson  LLMS_Lesson.
	 * @return   bool
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function maybe_show_mark_complete( $show, $lesson ) {

		if ( 'required' === $this->get_progression_setting( $lesson->get( 'id' ) ) && $this->lesson_has_form( $lesson->get( 'id' ) ) && ! llms_is_complete( get_current_user_id(), $lesson->get( 'id' ), 'lesson' ) ) {
			return false;
		}

		return $show;

	}

	/**
	 * Output a link to the lesson related to the entry
	 *
	 * @param    obj $entry      wpf entry object.
	 * @return   void
	 * @since    1.0.1
	 * @version  1.0.1
	 */
	public function output_entry_meta( $entry ) {

		$meta = wpforms()->entry_meta->get_meta(
			array(
				'entry_id' => $entry->entry_id,
				'type'     => 'llms_lesson_id',
			)
		);

		if ( ! $meta ) {
			return;
		}

		$lesson_id = absint( $meta[0]->data );
		?>
		<p class="wpforms-entry-modified">
			<span class="dashicons dashicons-admin-links"></span>
			<?php esc_html_e( 'Related Lesson:', 'lifterlms-wpforms' ); ?>
			<strong><a href="<?php echo esc_url( get_edit_post_link( $lesson_id ) ); ?>"><strong><?php echo get_the_title( $lesson_id ); ?> (#<?php echo $lesson_id; ?>)</strong></a></strong>
		</p>
		<?php

	}

	/**
	 * Records form entry to the user postmeta table for a user / lesson
	 *
	 * @param    int $user_id      WP User ID.
	 * @param    int $lesson_id    WP Post ID of the lesson.
	 * @param    int $entry_id     WPF Entry ID.
	 * @return   boolean
	 * @since    1.0.1
	 * @version  1.0.1
	 */
	public function record_entry( $user_id, $lesson_id, $entry_id ) {
		// lite version of WPForms doesn't store entries so we'll store "yes" instead.
		// pro version will allow reports to display a link to the entry.
		$stored_val = $entry_id ? $entry_id : 'yes';
		return llms_update_user_postmeta( $user_id, $lesson_id, '_wpf_entry_id', $stored_val );
	}

	/**
	 * When editing lesson content, update meta value to determine if the lesson has a WPForm
	 *
	 * @param    int $post_id  WP_Post ID.
	 * @param    obj $post     WP_Post.
	 * @return   void
	 * @since    1.0.0
	 * @version  1.1.0
	 */
	public function save_post_settings( $post_id, $post ) {

		$val = filter_input( INPUT_POST, '_llms_wpf_lesson_progression', FILTER_SANITIZE_STRING );
		if ( $val ) {
			update_post_meta( $post_id, '_llms_wpf_lesson_progression', $val );
		}

		if ( 'lesson' === $post->post_type ) {

			$val = $this->does_post_have_form( $post ) ? 'yes' : 'no';
			update_post_meta( $post_id, '_llms_wpf_has_form', $val );

		}

	}

	/**
	 * Trigger core registration actions
	 * and possibly auto login depending on integration settings
	 *
	 * @param    int   $user_id    WP User ID.
	 * @param    array $fields     The fields that have been submitted.
	 * @param    array $form_data  The information for the form.
	 * @param    array $userdata   user data from WP registration methods.
	 * @return   void
	 * @since    1.0.0
	 * @version  1.1.0
	 */
	public function user_registered( $user_id, $fields, $form_data, $userdata ) {

		do_action( 'lifterlms_user_registered', $user_id, $form_data, 'wpf_integration' );
		do_action( 'lifterlms_created_person', $user_id );

		if ( ! llms_parse_bool( $this->get_option( 'auto_login', 'yes' ) ) ) {
			return;
		}

		$signon = wp_signon(
			apply_filters(
				'lifterlms_login_credentials',
				array(
					'user_login'    => $userdata['user_login'],
					'user_password' => $userdata['user_pass'],
					'remember'      => true,
				)
			),
			is_ssl()
		);

		if ( is_wp_error( $signon ) ) {

			llms_add_notice( $signon->get_error_message(), 'error' );

		} else {

			wp_redirect( filter_input( INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL ) );
			// intentionally not exiting.
		}

	}

}
