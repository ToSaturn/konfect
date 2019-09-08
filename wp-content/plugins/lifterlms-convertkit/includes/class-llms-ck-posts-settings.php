<?php
/**
 * This class contains the logic required to add
 * the new content to the course & membership meta boxes
 *
 * @package  LifterLMS_ConvertKit/Classes
 * @since      1.0.0
 * @version    2.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_CK_Posts_Settings class.
 */
class LLMS_CK_Posts_Settings {

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 * @version  2.0.0
	 */
	public function __construct() {

		add_filter( 'llms_metabox_fields_lifterlms_course_options', array( $this, 'add_tab' ) );
		add_filter( 'llms_metabox_fields_lifterlms_membership', array( $this, 'add_tab' ) );

		add_action( 'save_post', array( $this, 'save' ), 10, 2 );

	}

	/**
	 * Add a tab to the course and membership options area.
	 *
	 * @param array $content Default settings.
	 * @return array
	 * @since 1.0.0
	 * @version 2.1.0
	 */
	public function add_tab( $content ) {

		$fields   = $this->get_thing_fields();
		$fields[] = array(
			'id'    => '_llms_ck_posts_settings_nonce_field',
			'type'  => 'custom-html',
			'label' => '',
			'value' => wp_nonce_field( 'llms-ck-save-post-settings', '_llms_ck_posts_settings_nonce', false ),
		);

		$content[] = array(
			'title'  => 'ConvertKit',
			'fields' => $fields,
		);

		return $content;

	}

	/**
	 * Retrieve settings fields for the sequence and tag options
	 *
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_thing_fields() {

		$fields = array();

		$things = array(
			'tags'      => array(
				// Translators: %s = post type name.
				'desc' => sprintf( __( 'Apply these tags when a student enrolls in this %s.', 'lifterlms-convertkit' ), $this->get_post_type( 'name' ) ),
				'name' => __( 'tags', 'lifterlms-convertkit' ),
			),
			'sequences' => array(
				// Translators: %s = post type name.
				'desc' => sprintf( __( 'Add students to these sequences when a student enrolls in this %s.', 'lifterlms-convertkit' ), $this->get_post_type( 'name' ) ),
				'name' => __( 'sequences', 'lifterlms-convertkit' ),
			),
		);

		foreach ( $things as $key => $data ) {

			$fields[] = array(
				'class' => 'input-full llms-select2',
				'desc'  => $data['desc'],
				'id'    => '_' . $this->get_post_type() . '_ck_' . $key,
				// Translators: %s = type of item ("tags" or "sequences").
				'label' => sprintf( __( 'New enrollment %s', 'lifterlms-convertkit' ), $data['name'] ),
				'multi' => true,
				'type'  => 'select',
				'value' => $this->get_things( $key ),
			);

		}

		return $fields;

	}

	/**
	 * Retrieve the singular name of the post type for the current screen
	 *
	 * @param  string $field field to retrieve the name for.
	 * @return string
	 * @since    1.0.0
	 * @version  2.1.0
	 */
	private function get_post_type( $field = 'name' ) {

		$post_type = get_post_type();

		switch ( $field ) {

			case 'name':
				$ret = $post_type;
				break;

			case 'label':
				$obj = get_post_type_object( $post_type );
				$ret = strtolower( $obj->label );
				break;

		}

		return $ret;

	}

	/**
	 * Get tags / sequenences from the API and format them for the multi-select field.
	 *
	 * @param   string $thing thing name, tags or sequences.
	 * @return  array
	 * @since   2.1.0
	 * @version 2.1.0
	 */
	private function get_things( $thing ) {

		$func = sprintf( 'get_%s', $thing );

		$things = array();
		foreach ( LLMS_ConvertKit()->api()->{$func}() as $id => $name ) {

			$things[] = array(
				'key'   => $id,
				'title' => $name,
			);

		}

		return $things;

	}

	/**
	 * Saves ConvertKit tag and sequence data to the postmeta table on post save
	 *
	 * @param  int $post_id  post id being saved.
	 * @param  obj $post     post object.
	 * @return void
	 * @since  1.0.0
	 * @version 2.1.0
	 */
	public function save( $post_id, $post ) {

		if ( ! llms_verify_nonce( '_llms_ck_posts_settings_nonce', 'llms-ck-save-post-settings' ) ) {
			return;
		}

		// ensure we're only running this on the course and membership pages.
		if ( ! in_array( $post->post_type, array( 'course', 'llms_membership' ), true ) ) {
			return;
		}

		$saved = array();

		foreach ( array( 'sequences', 'tags' ) as $thing ) {

			$key             = sprintf( '_%1$s_ck_%2$s', $this->get_post_type( 'name' ), $thing );
			$things          = array_values(
				array_filter(
					array_map(
						'absint',
						(array) llms_filter_input( INPUT_POST, $key, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY )
					)
				)
			);
			$saved[ $thing ] = $things;
			update_post_meta( $post_id, $key, $things );

		}

		do_action( 'llms_ck_post_settings_saved', $post_id, $saved );

	}

}


return new LLMS_CK_Posts_Settings();
