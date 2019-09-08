<?php

namespace SkyLab\Foundation;

use SkyLab\Menus\MenuGenerator;
use SkyLab\Config\Configuration;
use SkyLab\Settings\SettingsMenu;
use SkyLab\Metaboxes\MetaboxLoader;
use SkyLab\Loaders\ActionClassLoader;
use SkyLab\Sidebars\SidebarGenerator;
use SkyLab\Settings\SettingGenerator;
use SkyLab\Shortcodes\ShortcodeGenerator;
use SkyLab\Customizer\CustomizeSectionLoader;


/**
 * Base Application Class
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class Application
{
    /**
     * The LaunchPad Framework Version
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    const VERSION = '0.0.1';

    /**
     * The base path for the LaunchPad installation
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $base_path;

    /**
     * Indicates if the theme has been bootstrapped before.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var bool
     */
    protected $has_been_bootstrapped = false;

    /**
     * Instance of Configuration class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    public static $config;

    /**
     * Application constructor.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        self::$config = $config;

        $this->add_actions();

        add_action('after_setup_theme', [$this, 'theme_setup'], 11);
    }

    /**
     * Add Actions
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    private function add_actions()
    {
        $this->initialize_objects();

        $this->initialize_admin_only_objects();
    }

    public function theme_setup()
    {
        // Language loading
        load_theme_textdomain('lifterlms-launchpad', trailingslashit(get_template_directory()) . 'languages');
        // HTML5 support
        add_theme_support( 'html5', array( 'search-form', 'gallery' ) );
        // Automatic feed links
        add_theme_support( 'automatic-feed-links' );
        // Post Thumbnails
        add_theme_support( 'post-thumbnails' );

        $this->install_default_settings();
    }

    /**
     * Install Default Settings
     * If force_reset is false it will always check if the default
     * settings have already been installed. set force_reset to true
     * to reset the default settings if they have already been set.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     */
    public function install_default_settings()
    {
        $default_settings = (new SettingGenerator(self::$config))->save_default_settings();
    }

    /**
     * Initialize Objects
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    public function initialize_objects()
    {
        new SidebarGenerator(self::$config);
        new MenuGenerator(self::$config);
        new ActionClassLoader(self::$config);
    }

    /**
     * Initialize admin only objects
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    public function initialize_admin_only_objects()
    {
        if (is_admin())
        {
            new SettingsMenu(self::$config);
            new MetaboxLoader(self::$config);
            new CustomizeSectionLoader(self::$config);
        }
    }

}
