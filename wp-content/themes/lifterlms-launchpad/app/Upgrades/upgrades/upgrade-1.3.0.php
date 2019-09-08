<?php

/**
 * Add defaults for new new options added in 1.3.0
 */
add_option( 'launchpad_settings_header_layout', 'branding_nav_cols' );
add_option( 'launchpad_settings_header_layout_cols', 'four_eight' );
add_option( 'launchpad_settings_padding_top_header', '40' );
add_option( 'launchpad_settings_padding_bottom_header', '40' );
add_option( 'launchpad_settings_padding_right_header', '0' );
add_option( 'launchpad_settings_padding_left_header', '0' );
add_option( 'launchpad_settings_logo_width', '260' );
add_option( 'launchpad_settings_padding_top_button', '10' );
add_option( 'launchpad_settings_padding_bottom_button', '10' );
add_option( 'launchpad_settings_padding_right_button', '20' );
add_option( 'launchpad_settings_padding_left_button', '20' );

/**
 * Fix default options for these 3 settings which had "15px" hardcoded as their default values
 */
$fontsizefixes = array(
	'launchpad_settings_font_size_product_tile_price',
	'launchpad_settings_font_size_product_tile_metas',
	'launchpad_settings_font_size_product_tile_button',
);
foreach( $fontsizefixes as $option ) {
	if ( strpos( get_option( $option ), 'px' ) !== false ) {
		update_option( $option, '15' );
	}
}

return true;