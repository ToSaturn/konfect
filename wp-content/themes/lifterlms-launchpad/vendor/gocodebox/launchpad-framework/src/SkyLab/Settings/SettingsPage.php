<?php

namespace SkyLab\Settings;

/**
 * Generates Settings Pages
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
abstract class SettingsPage {

    /**
     * Add the settings page
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    public function add_new_settings_page($pages) {
        $pages[ $this->id ] = $this->label;

        return $pages;
    }

    /**
     * Get the page sections
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    public function get_sections() {
        return array();
    }

    /**
     * Output settings sections as tabs and set post href
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    public function output_sections() {
        global $current_section;

        $sections = $this->get_sections();

        if ( empty( $sections ) ) {
            return;
        }

        echo '<ul>';

        $array_keys = array_keys( $sections );

        foreach ( $sections as $id => $label ) {
            echo '<li><a href="' . admin_url( 'admin.php?page=' . $this->id . '&section=' . sanitize_title( $id ) )
                . '"class="' . ($current_section == $id ? 'current' : '' ) . '">' . ( end( $array_keys ) == $id ? '' : '|' ) . '</li>';

            echo '</ul><br class="clear" />';
        }

    }

    /**
     * Output the settings fields
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return LLMS_Admin_SettingGenerator::output_fields
     */
    public function output() {
        $settings = $this->get_settings();

        SettingGenerator::output_fields($settings);
    }

    /**
     * Save the settings field values
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    public function save() {
        global $current_section;

        $settings = $this->get_settings();
        SettingGenerator::save_fields( $settings );

        if ( $current_section )
            do_action( 'launchpad_update_options_' . $this->id . '_' . $current_section );

    }

}