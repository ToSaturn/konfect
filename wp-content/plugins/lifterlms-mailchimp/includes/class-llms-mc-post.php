<?php
defined( 'ABSPATH' ) || exit;

/**
 * Load MailChimp settings on a course / membership
 * @since    2.2.0
 * @version  3.0.0
 */
class LLMS_Settings_Post_Mailchimp {

	/**
	 * Postmeta Key Prefix
	 * @var  string
	 */
	public $prefix = '_';

	/**
	 * Constructor
	 * @return   void
	 * @since    2.2.0
	 * @version  3.0.0
	 */
	public function __construct() {

		add_filter( 'llms_metabox_fields_lifterlms_course_options', array( $this, 'get_settings' ) );
		add_filter( 'llms_metabox_fields_lifterlms_membership', array( $this, 'get_settings' ) );

		add_action( 'save_post', array( $this, 'save' ) );

	}

	/**
	 * Get the current post type without a prefix
	 * @return   string
	 * @since    2.2.0
	 * @version  2.2.0
	 */
	private function get_post_type( $post = null ) {

		if ( ! $post ) {

			global $post;

		}


		if ( is_a( $post, 'WP_Post' ) ) {
			return str_replace( 'llms_', '', $post->post_type );
		}

		return '';

	}

	/**
	 * Add settings to course/membership metaboxes
	 * @param    array     $content  array of tabs & fields for the metabox
	 * @return   array
	 * @since    2.2.0
	 * @version  2.2.0
	 */
	public function get_settings( $content ) {

		global $post;

		$lists = array();
		foreach ( LLMS_MailChimp()->get_integration()->get_lists() as $id => $name ) {
			$lists[] = array(
				'key' => $id,
				'title' => $name,
			);
		}

		$metakey = $this->prefix . $this->get_post_type( $post ) . '_registration_list';

		$groups = LLMS_MailChimp()->get_integration()->get_groups_formatted( get_post_meta( $post->ID, $metakey, true ) );

		$fields = array(
			'title' => 'MailChimp',
			'fields' => array(
				array(
						'type'		=> 'select',
						'label'		=> 'New Enrollment List',
						'desc' 		=> 'Select a list to add a user to when they enroll in this course.',
						'id' 		=> $this->prefix . $this->get_post_type( $post ) . '_registration_list',
						'class' 	=> 'input-full llms-select2',
						'value' 	=> $lists,
						'desc_class'=> 'd-all',
						'group' 	=> '',
						'data_attributes' => array(
							'group' => '#' . $this->prefix . $this->get_post_type( $post ) . '_registration_group',
						),
				),
				array(
						'type'		=> 'select',
						'label'		=> 'New Enrollment Group',
						'desc' 		=> 'Select a group(s) to add users to when they enroll in this course.',
						'id' 		=> $this->prefix . $this->get_post_type( $post ) . '_registration_group',
						'class' 	=> 'input-full llms-select2',
						'value' 	=> $groups,
						'desc_class'=> 'd-all',
						'group' 	=> '',
				),
			),
		);

		array_push( $content, $fields );

		return apply_filters( 'llms_mc_get_metabox_fields', $content );

	}

	/**
	 * Save custom field data to post meta table
	 * @return   void
	 * @since    2.2.0
	 * @version  2.2.0
	 */
	public function save( $post_id ) {

		$list = $this->prefix . $this->get_post_type() . '_registration_list';
		if ( isset( $_POST[ $list ] ) ) {
			update_post_meta( $post_id, $list, $_POST[ $list ] );
		}

		$group = $this->prefix . $this->get_post_type() . '_registration_group';
		if ( isset( $_POST[ $group ] ) ) {
			update_post_meta( $post_id, $group, $_POST[ $group ] );
		}
	}
}

return new LLMS_Settings_Post_Mailchimp();
