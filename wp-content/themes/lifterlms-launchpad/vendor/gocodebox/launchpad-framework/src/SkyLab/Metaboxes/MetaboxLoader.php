<?php

namespace SkyLab\Metaboxes;

use SkyLab\Config\Configuration;

/**
 * Handles Metabox Generation
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class MetaboxLoader
{
    /**
     * Metaboxes
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var array
     */
    public static $metaboxes;

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
     * MetaboxGenerator constructor.
     * Loads metabox classes on load-post and load-post-new
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     */
    public function __construct(Configuration $config)
    {
        if (is_admin())
        {
            add_action('load-post.php', [$this, 'load_metaboxes']);
            add_action('load-post-new.php', [$this, 'load_metaboxes']);
        }

        $this->config = $config;

        return $this;

    }

    /**
     * Search the Metaboxes folder and load any classes that exist
     * @return mixed
     */
    public function load_metaboxes()
    {
        if (empty(self::$metaboxes))
        {
            $metaboxes = [];

            $files = glob(trailingslashit(get_template_directory())
                . $this->config->get_metaboxes_directory() . '*.php');

            foreach ($files as $file) {
                $file = $this->config->get_metaboxes_namespace() . str_replace('.php', '', basename($file));
                $metaboxes[] = new $file;
            }

            self::$metaboxes = apply_filters('launchpad_load_metaboxes', $metaboxes);
        }

        return self::$metaboxes;
    }

}
