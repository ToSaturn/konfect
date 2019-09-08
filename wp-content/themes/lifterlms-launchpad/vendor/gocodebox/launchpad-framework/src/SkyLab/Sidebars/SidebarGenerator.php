<?php

namespace SkyLab\Sidebars;

use SkyLab\Templating\Template;
use SkyLab\Config\Configuration;

/**
 * Sidebar Generator
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class SidebarGenerator
{
    /**
     * Sidebars array
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private static $sidebars = [];

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
     * SidebarGenerator constructor.
     * Initializes sidebars on action widgets_init
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function __construct(Configuration $config)
    {
        add_action('widgets_init', [$this, 'initialize_sidebars']);

        $this->config = $config;

        return $this;
    }

    /**
     * Get Sidebar
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param Sidebar $sidebar
     * @param array $args
     */
    public function get_sidebar(Sidebar $sidebar, $args=[])
    {
        echo (new Template)->get($sidebar->template, ['id' => $sidebar->id]);
    }

    /**
     * Initialize Sidebars
     * Loops through and registers sidebars
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function initialize_sidebars() {

        $sidebars = $this->get_sidebars();

        foreach($sidebars as $sidebar)
        {
            register_sidebar($sidebar);
        }
    }

    /**
     * Get Sidebars
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    public function get_sidebars()
    {
        if (empty(self::$sidebars))
        {
            $sidebars = [];

            $files = glob(trailingslashit(get_template_directory())
                . $this->config->get_sidebars_directory() . '*.php');

            foreach ($files as $file)
            {
                $file = $this->config->get_sidebars_namespace() . str_replace('.php', '', basename($file));
                $sidebars[] = (new $file)->register();
            }

            self::$sidebars = apply_filters('launchpad_register_sidebars', $sidebars);

        }

        $sidebars = apply_filters('launchpad_sidebars', self::$sidebars);

        return $sidebars;
    }

}
