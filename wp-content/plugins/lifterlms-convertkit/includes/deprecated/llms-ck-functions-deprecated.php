<?php
/**
 * Deprecated Functions
 *
 * @package  LifterLMS_ConvertKit/Deprecated/Functions
 * @since    2.1.0
 * @version  2.1.0
 */

defined( 'ABSPATH' ) || exit;
// phpcs:disable

/**
 * LLMS_ConvertKit_Api renamed to LLMS_CK_API for consistency and coding standards adherance
 *
 * @since      2.1.0
 * @version    2.1.0
 * @deprecated 2.1.0
 */
class_alias( 'LLMS_CK_API', 'LLMS_ConvertKit_Api' );

/**
 * LLMS_ConvertKit_Posts_Settings renamed to LLMS_ConvertKit_Posts_Settings for consistency and coding standards adherance
 *
 * @since      2.1.0
 * @version    2.1.0
 * @deprecated 2.1.0
 */
class_alias( 'LLMS_CK_Posts_Settings', 'LLMS_ConvertKit_Posts_Settings' );

/**
 * LLMS_ConvertKit_User_Actions renamed to LLMS_CK_User_Actions for consistency and coding standards adherance
 *
 * @since      2.1.0
 * @version    2.1.0
 * @deprecated 2.1.0
 */
class_alias( 'LLMS_CK_User_Actions', 'LLMS_ConvertKit_User_Actions' );

/**
 * Returns the main instance of the LLMS_CK_API class.
 *
 * @return     LLMS_CK_API.
 * @since      1.0.0
 * @version    2.1.0
 * @deprecated 2.1.0
 */
function LLMSCK() {

	llms_deprecated_function( 'LLMSCK', '2.1.0', 'LLMS_ConvertKit()->api()' );
	return LLMS_CK_API::instance();

}

// phpcs:enable
