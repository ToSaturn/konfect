<?php

namespace SkyLab\Settings;

/**
 * Contract for Setting Section Classes
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
interface SettingInterface
{
    /**
     * Register section and fields
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function get_settings();

    /**
     * Generate HTML output
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function output();

    /**
     * Save
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function save();

    /**
     * Register Hooks
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function register_hooks();

}
