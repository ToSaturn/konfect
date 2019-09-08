<?php

namespace SkyLab\Loaders;

use SkyLab\Config\Configuration;

class ActionClassLoader
{
    /**
     * Action Classes array
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private static $actions = [];

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
        add_action( 'init', [ $this, 'load_action_classes' ], 1);

        $this->config = $config;
    }

    /**
     * Load class actions
     * Instantiates an instance of each action class
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function load_action_classes()
    {
        $actions = $this->get_actions();

        foreach ($actions as $action)
        {
            new $action;
        }
    }

    /**
     * Get Actions
     * Returns all files in the ThemeActions folder
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    private function get_actions()
    {
        if (empty(self::$actions))
        {
            $actions = [];

            $files = glob(trailingslashit(get_template_directory())
                . $this->config->get_actions_directory() . '*.php');

            foreach ($files as $file)
            {
                $file = $this->config->get_actions_namespace() . str_replace('.php', '', basename($file));
                $actions[] = $file;
            }

            self::$actions = apply_filters('launchpad_add_action_classes', $actions);

        }

        $actions = apply_filters('launchpad_action_classes', self::$actions);

        return $actions;
    }

}