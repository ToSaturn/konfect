<?php

namespace SkyLab\Foundation;

/**
 * Base Enqueue Class
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class Enqueue
{
    /**
     * Script Name
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $script_name = '';

    /**
     * Script Variables
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var array
     */
    protected $script_vars = [];

    /**
     * script handle
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $script_handle = 'launchpad';

    /**
     * script suffix
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $suffix = '.min';

    /**
     * script namespace
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $ns = 'wp';

    /**
     * Admin Screens
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var array
     */
    protected $admin_screens = [];

    /**
     * Javascript Dependencies
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var array
     */
    protected $javascript_dependencies = [];

    /**
     * Style Sheet Dependencies
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var array
     */
    protected $stylesheet_dependencies = [];

    /**
     * Style Sheet Bundle Dependencies
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var array
     */
    protected $stylesheet_bundle_dependencies = [];

    /**
     * Admin Page ID's
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var array
     */
    protected $admin_page_ids = [];

    /**
     * Enqueue constructor.
     * Initialize the class
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * Initialize
     * Add Actions
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function init()
    {
        $this->add_actions();
    }

    /**
     * Add Actions
     * Enqueues scripts
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    protected function add_actions()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    /**
     * Get Suffix
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return string
     */
    protected function get_suffix()
    {
        if (WP_DEBUG === true)
        {
            $this->suffix = '';
        }

        return $this->suffix;
    }

    /**
     * Get Script Variables
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    protected function get_script_vars()
    {
        $this->script_vars = apply_filters('launchpad_script_vars', $this->script_vars);

        return $this->script_vars;
    }

    /**
     * Get Script Name
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return string
     */
    protected function get_script_name()
    {
        // Default script name
        if (empty($this->script_name))
        {
            $this->script_name = '-launchpad';
        }

        return $this->script_name;
    }

    /**
     * Get Javascript Dependencies
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    protected function get_javascript_dependencies()
    {
        $this->javascript_dependencies = apply_filters('launchpad_javascript_dependencies',
            $this->javascript_dependencies
        );

        return $this->javascript_dependencies;
    }

    /**
     * Get Stylesheet dependencies
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    protected function get_stylesheet_dependencies()
    {
        $this->stylesheet_dependencies = apply_filters('launchpad_stylesheet_dependencies',
            $this->stylesheet_dependencies
        );

        return $this->stylesheet_dependencies;
    }

    /**
     * Enqueue Scripts
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    public function enqueue_scripts()
    {
        if ( ! is_admin() || $this->can_load_script_on_admin_page())
        {
            $this->enqueue_javascript_dependencies();

            $this->enqueue_javascript_bundle();

            $this->enqueue_javascript_comments();

            wp_localize_script($this->script_handle, 'launchpad_vars', $this->get_script_vars());

            $this->enqueue_stylesheet_dependencies();

            $this->enqueue_stylesheet_bundle();
        }
    }

    /**
     * Can load scripts on admin page?
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return bool
     */
    protected function can_load_script_on_admin_page()
    {
        $allow = false;

        if (is_admin())
        {
            $screen = get_current_screen();

            if (in_array($screen->id, $this->get_admin_page_ids()))
            {
                $allow = true;
            }
        }

        return $allow;
    }

    /**
     * Enqueue javascript dependencies
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    protected function enqueue_javascript_dependencies()
    {
        foreach ((array)$this->get_javascript_dependencies() as $dependency)
        {
            if (is_array($dependency))
            {
                call_user_func_array('wp_enqueue_script', $dependency);
            }
            else
            {
                wp_enqueue_script($dependency);
            }
        }
    }

    /**
     * Enqueue stylesheet dependencies
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    protected function enqueue_stylesheet_dependencies()
    {
        foreach ((array)$this->get_stylesheet_dependencies() as $dependency)
        {
            if (is_array($dependency))
            {
                call_user_func_array('wp_enqueue_style', $dependency);
            }
            else
            {
                wp_enqueue_style($dependency);
            }
        }
    }

    /**
     * Enqueue Javascript bundle
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    protected function enqueue_javascript_bundle()
    {
        // Load theme-specific JavaScript bundles with versioning based on last modified time.
        wp_enqueue_script($this->script_handle,
            get_stylesheet_directory_uri() . '/js/' . $this->ns . $this->get_script_name() . $this->get_suffix() . '.js', array('jquery'),
            filemtime(get_template_directory() . '/js/' . $this->ns . $this->get_script_name() . $this->get_suffix() . '.js'),
            true
        );
    }

    /**
     * Enqueue Javascript Comments
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    protected function enqueue_javascript_comments()
    {
        if ( is_singular() && comments_open() )
            wp_enqueue_script( 'comment-reply' );
    }

    /**
     * Enqueue Stylesheet bundle
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    protected function enqueue_stylesheet_bundle()
    {
        if ( ! is_admin())
        {
            wp_register_style($this->script_handle . '-style',
                get_stylesheet_directory_uri() . '/assets/public/css/style.css',
                $this->stylesheet_bundle_dependencies,
                filemtime(get_template_directory() . '/assets/public/css/style.css')
            );
            wp_enqueue_style($this->script_handle . '-style');
        }
        else
        {
            wp_register_style($this->script_handle . '-admin-style',
                get_stylesheet_directory_uri() . '/assets/admin/css/admin.css',
                $this->stylesheet_bundle_dependencies,
                filemtime(get_template_directory() . '/assets/admin/css/admin.css')
            );
            wp_enqueue_style($this->script_handle . '-admin-style');
        }
    }

    /**
     * Get Admin Page ID's
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    function get_admin_page_ids()
    {
        return apply_filters( 'lifterlms_admin_page_ids', $this->admin_page_ids);
    }

}
