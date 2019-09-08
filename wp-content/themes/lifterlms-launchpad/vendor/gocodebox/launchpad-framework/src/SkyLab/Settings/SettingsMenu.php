<?php

namespace SkyLab\Settings;

use SkyLab\Config\Configuration;

/**
 * Settings Menus API
 *
 * @since 0.0.1
 * @package SkyLab
 * @author CodeBOX
 */
class SettingsMenu
{
    /**
     * menu slug
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    private static $menu_slug = 'launchpad-settings';

    /**
     * settings object
     * @var Settings
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    private $settings;

    /**
     * Settings sections
     * @var array
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    private $sections;

    /**
     * Instance of Configuration class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private $config;

    /**
     * SettingsMenu constructor.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @filter 'launchpad_settings_sections'
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        add_action( 'admin_menu', array( $this, 'display_settings_menu') );

        $this->config = $config;

        $this->settings = new SettingGenerator($this->config);
    }

    /**
     * Display the settings menu
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function display_settings_menu()
    {
        add_theme_page(
            __('LaunchPad','launchpad'),
            __('LaunchPad','launchpad'),
            'edit_theme_options',
            self::$menu_slug,
            [$this->settings,'output']
        );
    }


    /**
     * This function registers the settings sections that
     * are present in the options page.
     *
     * @return void
     * @since 0.0.1
     * @version 0.0.1
     */
    public function RegisterSettings()
    {
        foreach ($this->sections as $id => $title)
        {
            $this->settings->registerSection($id, $title);
        }
    }

}
