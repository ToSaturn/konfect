<?php

namespace LaunchPad\Scripts;

use SkyLab\Foundation\Enqueue;

class EnqueueScripts extends Enqueue
{
    protected $script_name = '';
    protected $script_vars = [];
    protected $script_handle = 'launchpad';
    protected $suffix = '.min';
    protected $ns = 'wp';
    protected $admin_screens = [];
    protected $javascript_dependencies = [];
    protected $stylesheet_dependencies = [];
    protected $stylesheet_bundle_dependencies = [];

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->add_actions();
    }

    protected function get_script_vars()
    {
        $this->script_vars = [
            'ajax_url'          => admin_url( 'admin-ajax.php' ),
            'nonce'             => wp_create_nonce('launchpad-ajax'),
            'nameSpaced'        => [
                'test1'         => __( 'Testing 1, 2, 3!', 'lifterlms-launchpad' ),
                'test2'         => __( 'This is easier than it looks :)', 'lifterlms-launchpad' )
            ]
        ];

        return $this->script_vars = apply_filters('launchpad_script_vars', $this->script_vars);
    }

    protected function get_javascript_dependencies()
    {
        $this->javascript_dependencies = [
              'jquery'
            , 'thickbox'
            , 'media-upload'
            , [
                'iris'
                , admin_url('js/iris.min.js')
                , ['jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch']
                , false
                , 1
              ]
        ];

        $this->javascript_dependencies = apply_filters('launchpad_javascript_dependencies',
            $this->javascript_dependencies
        );

        return $this->javascript_dependencies;
    }

    protected function get_stylesheet_dependencies()
    {
        $this->stylesheet_dependencies = [
              'thickbox'
            , 'wp-color-picker'
        ];

        $this->stylesheet_dependencies = apply_filters('launchpad_stylesheet_dependencies',
            $this->stylesheet_dependencies
        );

        return $this->stylesheet_dependencies;
    }

    function get_admin_page_ids()
    {
        $this->admin_page_ids = [
                  'appearance_page_launchpad-settings'
                , 'launchpad-settings'
                , 'post'
                , 'page'
                , 'course'
                , 'lesson'
                , 'llms_membership'
                , 'llms_quiz'
        ];

        return apply_filters( 'lifterlms_admin_page_ids', $this->admin_page_ids);
    }

}
