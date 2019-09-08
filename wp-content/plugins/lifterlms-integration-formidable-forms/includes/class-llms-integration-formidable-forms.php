<?php
defined( 'ABSPATH' ) || exit;

/**
 * LifterLMS Formidable Forms Integration Class
 * @since    1.0.0
 * @version  1.0.3
 */
class LLMS_Integration_Formidable_Forms extends LLMS_Abstract_Integration {

	/**
	 * Integration ID
	 * @var  string
	 */
	public $id = 'formidable_forms';

	/**
	 * Integration title
	 * @var  string
	 */
	public $title = '';

	/**
	 * Integration Description
	 * @var  string
	 */
	public $description = '';

	/**
	 * Integration Priority
	 * Detemines the order of the settings on the Integrations settings table
	 * Core integrations fire at 5
	 * @var  integer
	 */
	protected $priority = 20;

	/**
	 * Integration Constructor
	 * @since    1.0.0
	 * @version  1.0.2
	 */
	protected function configure() {

		$this->title = __( 'LifterLMS Formidable Forms', 'lifterlms-formidable-forms' );
		$this->description = __( 'Seamlessly add Formidable Forms to LifterLMS lessons, add form entries to the LMS reporting, create a custom registration form, and more.', 'lifterlms-formidable-forms' );
		$this->description_missing = sprintf( __( 'You need to install the %1$sFormidable Forms Core%2$s add-on to use this integration.', 'lifterlms-formidable-forms' ), '<a href="https://wordpress.org/plugins/formidable/" target="_blank">', '</a>' );

		if ( ! $this->is_available() ) {
			return;
		}

		add_filter( 'llms_show_mark_complete_button', array( $this, 'maybe_show_mark_complete' ), 20, 2 );

		add_filter( 'frm_filter_final_form', array( $this, 'maybe_show_form' ) );

		add_action( 'frm_after_create_entry', array( $this, 'maybe_mark_complete' ), 20 );
		add_action( 'frm_after_update_entry', array( $this, 'maybe_mark_complete' ), 20 );

		add_filter( 'llms_allow_lesson_completion', array( $this, 'maybe_prevent_lesson_completion' ), 10, 5 );

		// update user postmeta during destruction of entries
		add_action( 'frm_before_destroy_entry', array( $this, 'trash_entry' ), 10, 2 );

		// course & lesson settings
		add_filter( 'llms_metabox_fields_lifterlms_course_options', array( $this, 'add_post_settings' ) );
		add_filter( 'llms_metabox_fields_lifterlms_lesson', array( $this, 'add_post_settings' ) );

		// save course & lesson settings
		add_action( 'save_post_course', array( $this, 'save_post_settings' ), 20, 2 );
		add_action( 'save_post_lesson', array( $this, 'save_post_settings' ), 20, 2 );

		// add reporting information
		add_filter( 'llms_table_get_student-course_columns', array( $this, 'add_reporting_col' ), 10, 2 );
		add_filter( 'llms_table_get_data_student-course', array( $this, 'add_reporting_data' ), 10, 5 );

		if ( $this->is_addon_available( 'user_registration' ) ) {

			// modify required person fields for llms forms which have been replaced with an nf form
			add_filter( 'lifterlms_get_person_fields', array( $this, 'modify_person_fields' ), 1, 2 );

			// replace checkout form for logged out users with the custom checkout form
			add_action( 'lifterlms_pre_checkout_form', array( $this, 'form_modify_checkout' ) );

			// replace account edit form on dashboard
			add_action( 'lifterlms_before_person_edit_account_form', array( $this, 'form_modify_account_update' ) );

			// replace open registration form with the custom registration form
			add_action( 'lifterlms_before_person_register_form', array( $this, 'form_modify_registration' ) );

			// trigger user registration actions & do auto-login if enabled
			add_action( 'frmreg_after_create_user', array( $this, 'user_registered' ), 10, 4 );

		}

	}

	/**
	 * This function creates the array of content that
	 * @param    array  $settings  existing course settings
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function add_post_settings( $settings ) {

		$loc = get_post_type();

		$settings[] = array(
			'title' => __( 'Formidable', 'lifterlms-formidable-forms' ),
			'fields' => array(
				array(
					'allow_null' => false,
					'type'		=> 'select',
					'label'		=> __( 'Lesson Completion', 'lifterlms-formidable-forms' ),
					'desc' 		=> __( 'When a Formidable Form is present on a lesson in this course, determine if the form must be submitted in order for the lesson to be marked as completed.', 'lifterlms-formidable-forms' ),
					'id' 		=> '_llms_ff_lesson_progression',
					'class' 	=> 'input-full llms-select2',
					'value' 	=> $this->get_progression_options( $loc ),
					'group' 	=> '',
					'default'   => 'default',
				),
			),
		);

		return $settings;

	}

	/**
	 * Add custom reporting columns to display form entry links / completion on student course reporting tabs
	 * @param    array     $cols     reporting table column data
	 * @param    string    $context  table display content
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function add_reporting_col( $cols, $context ) {

		$cols = llms_assoc_array_insert( $cols, 'grade', 'ff_entry_id', array(
			'title' => __( 'Formidable Forms Entry', 'lifterlms-formidable-forms' ),
		) );

		return $cols;
	}

	/**
	 * Output reporting data related to form entries
	 * @param    mixed      $value     reporting cell value
	 * @param    string     $key       keyname
	 * @param    obj        $lesson    LLMS_Lesson
	 * @param    string     $context   display contenxt
	 * @param    obj        $table     LLMS_Admin_Table object
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function add_reporting_data( $value, $key, $lesson, $context, $table ) {

		if ( 'ff_entry_id' === $key ) {

			$value = '&ndash;';

			if ( $this->lesson_has_form( $lesson->get( 'id' ) ) ) {

				$id = $this->get_user_entry_id( $table->student->get_id(), $lesson->get( 'id' ) );
				if ( is_numeric( $id ) ) {
					$value = sprintf(
						'<a href="%1$s" title="%2$s">%2$s</a>',
						add_query_arg(
							array(
								'frm_action' => 'show',
								'id'         => $id,
							),
							admin_url( 'admin.php?page=formidable-entries' )
						),
						esc_html__( 'View Entry', 'lifterlms-formidable-forms' )
					);
				}

			}

		}

		return $value;

	}

	/**
	 * Modify the checkout form to output a Formidable Form if a user reg form is selected
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function form_modify_account_update() {

		$shortcode = $this->get_shortcode( 'form_account_update' );
		if ( $shortcode ) {

			echo do_shortcode( $shortcode );

		}

	}

	/**
	 * Modify the checkout form to output a Formidable Form if a user reg form is selected
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function form_modify_checkout() {

		// registration
		if ( ! is_user_logged_in() ) {

			$shortcode = $this->get_shortcode( 'form_checkout_reg' );
			if ( $shortcode ) {

				echo do_shortcode( $shortcode );

				// swallow the rest of the checkout form for logged out users
				ob_start();

				// complete output buffering after the default checkout form
				add_action( 'lifterlms_post_checkout_form', array( $this, 'form_modify_end' ) );
			}

		// update
		} else {

			$shortcode = $this->get_shortcode( 'form_checkout_update' );
			if ( $shortcode ) {
				echo do_shortcode( $shortcode );
			}

		}

	}

	/**
	 * Called via form modification actions to end output buffering
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function form_modify_end() {
		ob_get_clean();
	}

	/**
	 * Modify the reg form to output a Formidable Form if a user reg form is selected
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

			// swallow the rest of the checkout form for logged out users
			ob_start();

			// complete output buffering after the default checkout form
			add_action( 'lifterlms_after_person_register_form', array( $this, 'form_modify_end' ) );
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

		if ( ! $this->is_available() ) {
			return $settings;
		}

		$settings[] = array(
			'class' => 'llms-select2',
			'default' => 'required',
			'desc' => __( 'When a Formidable Form is present on a lesson, determine if the form must be submitted in order for the lesson to be marked as complete. This can be overriden for individual courses and lessons.', 'lifterlms-formidable-forms' ),
			'id' => $this->get_option_name( 'lesson_progression' ),
			'options' => $this->get_progression_options( 'global' ),
			'title' => __( 'Lesson Completion', 'lifterlms-formidable-forms' ),
			'type' => 'select',
		);

		$user_reg = $this->is_addon_available( 'user_registration' );

		$settings[] = array(
			'type' => 'subtitle',
			'title' => __( 'User Management Forms', 'lifterlms-formidable-forms' ),
			'desc' => __( 'Replace default LifterLMS forms with your own custom Formidable Forms powered by the Formidable Forms User Registration add-on.', 'lifterlms-formidable-forms' ),
		);

		if ( ! $user_reg ) {

			$settings[] = array(
				'type' => 'custom-html',
				'value' => '<em>' . sprintf( __( 'You need to install the %1$sFormidable Forms User Registration%2$s add-on to unlock these features.', 'lifterlms-formidable-forms' ), '<a href="https://formidableforms.com/downloads/user-registration/" target="_blank">', '</a>' ) . '</em>',
			);

		}

		$forms = array(
			'' => esc_attr__( 'Select a form...', 'lifterlms-formidable-forms' ),
		);

		foreach( FrmForm::get_published_forms() as $form ) {
			$forms[ $form->id ] = sprintf( '%1$s (#%2$d)', $form->name, $form->id );
		}

		$base = array(
			'class' => 'llms-select2',
			'custom_attributes' => array(
				'data-allow-clear' => true,
				'data-placeholder' => esc_attr__( 'Select a form...', 'lifterlms-formidable-forms' )
			),
			'disabled' => ( ! $user_reg ),
			'options' => $forms,
			'type' => 'select',
		);

		$settings[] = wp_parse_args( array(
			'desc' => '<br>' . __( 'This form will be used in place of the default LifterLMS registration form during enrollment and purchases for new users. The form should include an "Register User" action which creates the user.', 'lifterlms-formidable-forms' ),
			'id' => $this->get_option_name( 'form_checkout_reg' ),
			'title' => __( 'Checkout Registration Form', 'lifterlms-formidable-forms' ),
		), $base );

		$settings[] = wp_parse_args( array(
			'desc' => '<br>' . __( 'This form will be used in place of the default LifterLMS registration form during enrollment and purchases for existing users. The form should include an "Register User" action which updates the user.', 'lifterlms-formidable-forms' ),
			'id' => $this->get_option_name( 'form_checkout_update' ),
			'title' => __( 'Checkout Update Form', 'lifterlms-formidable-forms' ),
		), $base );

		$settings[] = wp_parse_args( array(
			'desc' => '<br>' . __( 'This form will be used in place of the default LifterLMS open registation form. The form should include an "Register User" action which creates the user.', 'lifterlms-formidable-forms' ),
			'id' => $this->get_option_name( 'form_reg' ),
			'title' => __( 'Open Registration Form', 'lifterlms-formidable-forms' ),
		), $base );

		$settings[] = wp_parse_args( array(
			'desc' => '<br>' . __( 'This form will be used in place of the default LifterLMS edit account form on the student dashboard. The form should include an "Update Profile" action which updates the user.', 'lifterlms-formidable-forms' ),
			'id' => $this->get_option_name( 'form_account_update' ),
			'title' => __( 'Account Update Form', 'lifterlms-formidable-forms' ),
		), $base );

		$settings[] = array(
			'desc' => __( 'Display form title when outputting custom user registration forms.', 'lifterlms-formidable-forms' ),
			'default' => 'yes',
			'disabled' => ( ! $user_reg ),
			'id' => $this->get_option_name( 'form_show_title' ),
			'title' => __( 'Show Form Titles', 'lifterlms-formidable-forms' ),
			'type' => 'checkbox',
		);

		$settings[] = array(
			'desc' => __( 'Display the form description when outputting custom user registration forms.', 'lifterlms-formidable-forms' ),
			'default' => 'no',
			'disabled' => ( ! $user_reg ),
			'id' => $this->get_option_name( 'form_show_desc' ),
			'title' => __( 'Show Form Descriptions', 'lifterlms-formidable-forms' ),
			'type' => 'checkbox',
		);

		$settings[] = array(
			'desc' => __( 'If checked the current page will be automatically reloaded after users are registered through a Formidale User Registration form.', 'lifterlms-formidable-forms' ),
			'default' => 'yes',
			'disabled' => ( ! $user_reg ),
			'id' => $this->get_option_name( 'auto_reload' ),
			'title' => __( 'Reload After Registration', 'lifterlms-formidable-forms' ),
			'type' => 'checkbox',
		);

		return $settings;

	}

	/**
	 * Retrieve the progression setting for an object
	 * Cascades up: lesson -> course -> global -> default hard coded filterable setting
	 * @param    int     $object_id  WP Post ID
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_progression_setting( $object_id ) {

		// default value to use if the object doesn't have a setting & the global option isn't set
		$default = apply_filters( 'llms_ff_get_progression_setting_default', 'required', $object_id );

		// get the postmeta setting
		$setting = get_post_meta( $object_id, '_llms_ff_lesson_progression', true );

		// if we're looking at a lesson and the setting is define as parent (course) or the setting isn't set
		// cascade up to find the course's setting
		if ( 'lesson' === get_post_type( $object_id ) && ( ! $setting || 'parent' === $setting ) ) {

			$course = llms_get_post_parent_course( $object_id );
			if ( $course ) {
				$setting = $this->get_progression_setting( $course->get( 'id' ) );
			}

		// if the setting is set as global or the setting isn't set
		} elseif ( 'global' === $setting || ! $setting ) {
			$setting = $this->get_option( 'lesson_progression', $default );
		}

		// ensure we return at least the hard coded default
		$setting = $setting ? $setting : $default;

		return apply_filters( 'llms_ff_get_progression_setting', $setting, $object_id );

	}

	/**
	 * Retrieve an array of options for lesson progression settings based on the display location
	 * @param    string     $location  display location for the settings [global|course|lesson]
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_progression_options( $location = 'global' ) {

		$req_text = esc_attr__( 'Submission required', 'lifterlms-formidable-forms' );
		$opt_text = esc_attr__( 'Submission optional', 'lifterlms-formidable-forms' );

		$options = array(
			'optional' => esc_attr__( 'Form submission is optional', 'lifterlms-formidable-forms' ),
			'required' => esc_attr__( 'Form submission is required for lesson completion', 'lifterlms-formidable-forms' ),
		);

		switch ( $location ) {

			case 'lesson':

				$desc = 'required' === $this->get_progression_setting( get_the_ID() ) ? $req_text : $opt_text;
				$options = array_merge(
					array(
						/* Translators: %s = translated current global setting */
						'parent' => sprintf( esc_attr__( 'Use course setting (%s)', 'lifterlms-formidable-forms' ), $desc ),
					),
					$options
				);

			case 'course':

				$desc = 'required' === $this->get_option( 'lesson_progression', 'required' ) ? $req_text : $opt_text;

				$options = array_merge(
					array(
						/* Translators: %s = translated current global setting */
						'global' => sprintf( esc_attr__( 'Use global setting (%s)', 'lifterlms-formidable-forms' ), $desc ),
					),
					$options
				);

			break;

		}

		return apply_filters( 'llms_ff_progression_options', $options, $this );

	}

	/**
	 * Retrieve a shortcode for a given custom form
	 * @param    string     $setting  setting key/name (eg: form_checkout_reg)
	 * @return   string
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_shortcode( $setting ) {

		$form_id = $this->get_option( $setting );
		if ( $form_id ) {
			$title = llms_parse_bool( $this->get_option( 'form_show_title', 'yes' ) ) ? 'true' : 'false';
			$desc = llms_parse_bool( $this->get_option( 'form_show_desc', 'no' ) ) ? 'true' : 'false';
			return '[formidable id="' . $form_id . '" title="' . $title . '" description="' . $desc . '"]';
		}

		return '';

	}

	/**
	 * Retrieve the entry ID of a form for a given student and lesson
	 * @param    int     $user_id    WP_User ID
	 * @param    int     $lesson_id  WP_Post ID
	 * @return   mixed               (int)     Form Entry ID when form is submitted and pro version installed
	 *                               (string)  "yes" when the form has been submitted via lite version
	 *                               (string)  "" (empty string) when the form has not been submitted
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function get_user_entry_id( $user_id, $lesson_id ) {

		return llms_get_user_postmeta( $user_id, $lesson_id, '_ff_entry_id', true );

	}

	/**
	 * Determine if a Formidable Forms add-on is available
	 * @param    string     $addon  id for the add-on [user_registration]
	 * @return   bool
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function is_addon_available( $addon = '' ) {

		if ( 'user_registration' === $addon && function_exists( 'frmreg_forms_autoloader' ) ) {
			return true;
		}

		return false;

	}

	/**
	 * Determine if integration dependencies are available
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function is_installed() {
		return function_exists( 'load_formidable_forms' );
	}

	/**
	 * Determine if a lesson contains a Formidable Form
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function lesson_has_form( $lesson_id ) {
		return llms_parse_bool( get_post_meta( $lesson_id, '_llms_ff_has_form', true ) );
	}

	/**
	 * Trigger lesson completion when a form is submitted on a lesson
	 * @param    array     $entry_id     form entry submission id
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.2
	 */
	public function maybe_mark_complete( $entry_id ) {

		$referrer = isset( $_POST['_wp_http_referer'] ) ? $_POST['_wp_http_referer'] : wp_get_referer();
		if ( ! $referrer ) {
			return;
		}

		$post_id = url_to_postid( $referrer );

		// no post ID is set when updating on the admin panel & we don't want to mark complete if an admin edits anyway
		if ( ! $post_id ) {
			return;
		}

		// return early if the form isn't on a lesson
		if ( 'lesson' !== get_post_type( $post_id ) || ! $this->lesson_has_form( $post_id ) ) {
			return;
		}

		$this->record_entry( get_current_user_id(), $post_id, $entry_id );

		if ( 'required' !== $this->get_progression_setting( $post_id ) ) {
			return;
		}


		do_action( 'llms_trigger_lesson_completion', get_current_user_id(), $post_id, 'lesson_' . $post_id );

	}

	/**
	 * Before a lesson is marked as complete, check if all the lesson's quiz requirements are met
	 * @filter   llms_allow_lesson_completion
	 * @param    bool     $allow_completion  whether or not to allow completion (true by default, false if something else has already prevented)
	 * @param    int      $user_id           WP User ID of the student completing the lesson
	 * @param    int      $lesson_id         WP Post ID of the lesson to be completed
	 * @param    string   $trigger           text string to record the reason why the lesson is being completed
	 * @param    array    $args              optional additional arguements from the triggering function
	 * @return   bool
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function maybe_prevent_lesson_completion( $allow_completion, $user_id, $lesson_id, $trigger, $args ) {

		// if allow completion is already false, we don't need to run any form checks
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
	 * @param    string  $form  form html to display
	 * @return   bool
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function maybe_show_form( $form ) {

		// return early if the form isn't on a lesson
		if ( 'lesson' !== get_post_type() ) {
			return apply_filters( 'llms_ff_maybe_show_form', $form );
		}

		if ( $this->lesson_has_form( get_the_ID() ) && llms_is_complete( get_current_user_id(), get_the_ID(), 'lesson' ) && $this->get_user_entry_id( get_current_user_id(), get_the_ID() ) ) {
			return apply_filters( 'llms_ff_maybe_show_form', '' );
		}

		return apply_filters( 'llms_ff_maybe_show_form', $form );

	}

	/**
	 * Determine if mark complete button should be hidden on a lesson due to the presence of a Formidable Form
	 * @param    bool     $show    Default value of the display
	 * @param    obj      $lesson  LLMS_Lesson
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
	 * Modify required core form fields when the forms are replaced with custom user reg forms
	 * @param    array      $fields  field data
	 * @param    string     $screen  screen id
	 * @return   array
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function modify_person_fields( $fields, $screen ) {

		if ( 'checkout' === $screen && $this->get_option( 'form_checkout_update', false ) && is_user_logged_in() ) {
			$fields = array();
		} elseif ( 'account' === $screen && $this->get_option( 'form_account_update', false ) ) {
			$fields = array();
		}

		return $fields;

	}

	/**
	 * Records form submission to the user postmeta table for a user / lesson
	 * @param    int     $user_id     WP User ID
	 * @param    int     $lesson_id   WP Post ID of the lesson
	 * @param    int     $entry       WP Post ID of the FF entry
	 * @return   boolean
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function record_entry( $user_id, $lesson_id, $entry ) {
		return llms_update_user_postmeta( $user_id, $lesson_id, '_ff_entry_id', $entry );
	}

	/**
	 * Reload the page
	 * @return  void
	 * @since   1.0.3
	 * @version 1.0.3
	 */
	public function reload() {

		wp_redirect( $_SERVER['HTTP_REFERER'] );
		exit;

	}

	/**
	 * When editing lesson content, update meta value to determine if the lesson has a Formidable Form
	 * @param    int     $post_id  WP_Post ID
	 * @param    obj     $post     WP_Post
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function save_post_settings( $post_id, $post ) {

		if ( isset( $_POST['_llms_ff_lesson_progression'] ) ) {
			update_post_meta( $post_id, '_llms_ff_lesson_progression', sanitize_text_field( $_POST['_llms_ff_lesson_progression'] ) );
		}

		if ( 'lesson' === $post->post_type ) {

			$val = has_shortcode( $post->post_content, 'formidable' ) ? 'yes' : 'no';
			update_post_meta( $post_id, '_llms_ff_has_form', $val );

		}

	}

	/**
	 * When a submission is trashed user postmeta data for that submission is also deleted
	 * @param    int     $entry_id  FF Entry ID
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.0
	 */
	public function trash_entry( $entry_id, $entry ) {

		if ( empty( $entry->description ) || empty( $entry->user_id ) ) {
			return;
		}

		$desc = maybe_unserialize( $entry->description );
		if ( ! $desc || ! isset( $desc['referrer'] ) ) {
			return;
		}

		$post_id = url_to_postid( $desc['referrer'] );
		if ( 'lesson' !== get_post_type( $post_id ) ) {
			return;
		}

		llms_delete_user_postmeta( $entry->user_id, $post_id, '_ff_entry_id', $entry_id );

	}

	/**
	 * Trigger core registration actions
	 * and possibly auto redirect depending on integration settings
	 * @param    int        $user_id    WP User ID
	 * @return   void
	 * @since    1.0.0
	 * @version  1.0.3
	 */
	public function user_registered( $user_id ) {

		do_action( 'lifterlms_user_registered', $user_id, array(), 'ff_integration' );
		do_action( 'lifterlms_created_person', $user_id );

		if ( ! llms_parse_bool( $this->get_option( 'auto_reload', 'yes' ) ) ) {
			return;
		}

		add_action( 'wp_login', array( $this, 'reload' ) );

	}

}
