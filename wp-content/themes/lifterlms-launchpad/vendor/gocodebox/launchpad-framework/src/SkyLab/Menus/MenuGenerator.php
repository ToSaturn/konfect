<?php

namespace SkyLab\Menus;

use SkyLab\Config\Configuration;

/**
 * Menu Generator
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class MenuGenerator
{
    /**
     * Menus array
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private static $menus = [];

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
     * MenuGenerator constructor.
     * Initializes sidebars on action widgets_init
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function __construct(Configuration $config)
    {
        add_action('init', [$this, 'generate_menus']);

        $this->config = $config;

        return $this;
    }

    /**
     * Generate Menus
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function generate_menus()
    {
        $menus = $this->get_menus();

        foreach($menus as $menu)
        {
            register_nav_menu( $menu->location, $menu->description );
        }
    }

    /**
     * Get Menus
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    private function get_menus()
    {
        if (empty(self::$sidebars))
        {
            $menus = [];

            $files = glob(trailingslashit(get_template_directory())
                . $this->config->get_menus_directory() . '*.php');

            foreach ($files as $file)
            {
                $file = $this->config->get_menus_namespace() . str_replace('.php', '', basename($file));
                $menus[] = new $file;
            }

            self::$menus = apply_filters('launchpad_register_menus', $menus);

        }

        $menus = apply_filters('launchpad_menus', self::$menus);

        return $menus;
    }

}
