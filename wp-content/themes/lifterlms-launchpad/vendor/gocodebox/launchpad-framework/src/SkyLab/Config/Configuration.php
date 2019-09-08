<?php

namespace SkyLab\Config;

/**
 * Abstract Configuration Class
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
abstract class Configuration
{
    /**
     * Primary Sidebar
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $primary_sidebar = 'PrimarySidebar';

    /**
     * Secondary Sidebar
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $secondary_sidebar = 'SecondarySidebar';

    /**
     * Admin Views Uri
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $admin_views_uri;

    /**
     * Stylesheet Directory
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $stylesheet_directory;

    /**
     * Template Directory
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $template_directory;

    /**
     * Views Directory
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $views_directory = 'resources/views/';

    /**
     * Admin Views Directory
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $admin_views_directory = 'admin/';

    /**
     * Fields Namespace
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $fields_namespace = 'LaunchPad\Fields\\';

    /**
     * Settings Namespace
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $settings_namespace = 'LaunchPad\Settings\\';

    /**
     * Customizer Namespace
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $customizer_namespace = 'LaunchPad\Customize\\';

    /**
     * Sidebars Namespace
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $sidebars_namespace = 'LaunchPad\Sidebars\\';

    /**
     * Menus Namespace
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $menus_namespace = 'LaunchPad\Menus\\';

    /**
     * Metabox Namespace
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $metaboxes_namespace = 'LaunchPad\Metaboxes\\';

    /**
     * Actions Namespace
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $actions_namespace = 'LaunchPad\ThemeActions\\';

    /**
     * Settings Directory
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $settings_directory = '/app/Settings/';

    /**
     * Primary Sidebar
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $metaboxes_directory = '/app/Metaboxes/';

    /**
     * Customizer Directory
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $customizer_directory = '/app/Customize/';

    /**
     * Sidebars Directory
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $sidebars_directory = '/app/Sidebars/';

    /**
     * Menus Directory
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $menus_directory = '/app/Menus/';

    /**
     * Actions Directory
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $actions_directory = '/app/ThemeActions/';

    /**
     * Get Style Sheet Directory
     *
     * @return string
     */
    public function get_stylesheet_directory()
    {
        return apply_filters('launchpad_stylesheet_directory',
            trailingslashit(get_stylesheet_directory())
        );
    }

    /**
     * Get Template Directory
     *
     * @return string
     */
    public function get_template_directory()
    {
        return apply_filters('launchpad_template_directory',
            trailingslashit( get_template_directory() )
        );
    }

    /**
     * Get Views Directory
     *
     * @return string
     */
    public function get_views_directory()
    {
        return apply_filters('launchpad_views_directory',
            $this->get_stylesheet_directory() . $this->views_directory
        );
    }

    /**
     * Get Admin Views Directory
     *
     * @return string
     */
    public function get_admin_views_directory()
    {
        return apply_filters('launchpad_admin_views_directory',
            $this->get_views_directory() . $this->admin_views_directory
        );
    }

    /**
     * Get Fields Namespace
     *
     * @return string
     */
    public function get_fields_namespace()
    {
        return $this->fields_namespace;
    }

    /**
     * Get Metaboxes Namespace
     *
     * @return string
     */
    public function get_metaboxes_namespace()
    {
        return $this->metaboxes_namespace;
    }

    /**
     * Get Settings Namespace
     *
     * @return string
     */
    public function get_settings_namespace()
    {
        return $this->settings_namespace;
    }

    /**
     * Get Customizer Namespace
     *
     * @return string
     */
    public function get_customizer_namespace()
    {
        return $this->customizer_namespace;
    }

    /**
     * Get Sidebars Namespace
     *
     * @return string
     */
    public function get_sidebars_namespace()
    {
        return $this->sidebars_namespace;
    }

    /**
     * Get Menus Namespace
     *
     * @return string
     */
    public function get_menus_namespace()
    {
        return $this->menus_namespace;
    }

    /**
     * Get Actions Namespace
     *
     * @return string
     */
    public function get_actions_namespace()
    {
        return $this->actions_namespace;
    }

    /**
     * Get Metaboxes Directory
     *
     * @return string
     */
    public function get_metaboxes_directory()
    {
        return $this->metaboxes_directory;
    }

    /**
     * Get Settings Directory
     *
     * @return string
     */
    public function get_settings_directory()
    {
        return $this->settings_directory;
    }

    /**
     * Get Customizer Directory
     *
     * @return string
     */
    public function get_customizer_directory()
    {
        return $this->customizer_directory;
    }

    /**
     * Get Sidebars Directory
     *
     * @return string
     */
    public function get_sidebars_directory()
    {
        return $this->sidebars_directory;
    }

    /**
     * Get Menus Directory
     *
     * @return string
     */
    public function get_menus_directory()
    {
        return $this->menus_directory;
    }

    /**
     * Get Actions Directory
     *
     * @return string
     */
    public function get_actions_directory()
    {
        return $this->actions_directory;
    }

    /**
     * Get Primary Sidebar
     *
     * @return string
     */
    public function get_primary_sidebar()
    {
        $sidebar = $this->get_sidebars_namespace() . $this->primary_sidebar;
        return new $sidebar;
    }

    /**
     * Get Secondary Sidebar
     *
     * @return string
     */
    public function get_secondary_sidebar()
    {
        $sidebar = $this->get_sidebars_namespace() . $this->secondary_sidebar;
        return new $sidebar;
    }

    /**
     * Get Footer Sidebar
     *
     * @param $sidebar_class
     * @return mixed
     */
    public function get_footer_sidebar($sidebar_class)
    {
        $sidebar = $this->get_sidebars_namespace() . $sidebar_class;
        return new $sidebar;
    }

}
