<?php

namespace SkyLab\Settings;

/**
 * Abstract Setting Class
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
abstract class Setting extends SettingsPage implements SettingInterface
{
    /**
     * Add Actions And Filters
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * Applies a filter for the child class to add it to the settings page
     * Applies an action for outputting the fields to the page
     * Applies an action for saving the fields
     * Applies an action for applying additional hooks to the save method
     */
    public function add_actions_and_filters()
    {
        add_filter('launchpad_settings_tabs_array', [$this, 'add_new_settings_page'], $this->menu_order);
        add_action('launchpad_settings_' . $this->id, [$this, 'output']);
        add_action('launchpad_settings_save_' . $this->id, [$this, 'save']);
        add_action('launchpad_settings_save_' . $this->id, [$this, 'register_hooks']);
    }

    /**
     * Get Settings
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * Override with child class
     * @return array of fields to display on settings tab
     */
    public function get_settings(){}

    /**
     * save settings to the database
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return LLMS_Admin_Settings::save_fields
     */
    public function save()
    {
        $settings = $this->get_settings();

        SettingGenerator::save_fields($settings);
    }

    /**
     * get settings from the database
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    public function output()
    {
        $settings = $this->get_settings();

        SettingGenerator::output_fields($settings);
    }

    /**
     * register hooks on save method
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    public function register_hooks(){}
}
