<?php

namespace SkyLab\Templating;

use SkyLab\Foundation\Application;

/**
 * Abstract Template Class
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class Template
{
    /**
     * Get Template
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $name
     * @param $args
     * @param string $path
     */
    public function get($name, $args, $path = '')
    {
        if ($args && is_array($args))
        {
            extract($args);
        }

        $located = $this->locate($name, $path);

        do_action('launchpad_before_template_part', $name, $path, $located, $args);

        ob_start();

        include($located);

        $output = ob_get_clean();

        do_action('launchpad_after_template_part', $name, $path, $located, $args);

        return do_shortcode($output);
    }

    /**
     * Locate Template
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $name
     * @param $path
     * @return mixed
     */
    private function locate($name, $path)
    {
        if ( ! $path)
        {
            $path = $this->get_template_path();
        }

        $template = $path . $name;

        // Return template
        return apply_filters('launchpad_locate_template', $template, $name, $path);
    }

    /**
     * Get Template Path
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return mixed
     */
    private function get_template_path()
    {
        return apply_filters('launchpad_template_path',
            Application::$config->get_views_directory()
        );
    }

}
