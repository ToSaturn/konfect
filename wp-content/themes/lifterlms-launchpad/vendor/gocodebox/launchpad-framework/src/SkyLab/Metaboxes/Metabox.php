<?php

namespace SkyLab\Metaboxes;

use SkyLab\Fields\FieldGenerator;

/**
 * Abstract Metabox Class
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
abstract class Metabox
{
    /**
     * Screens
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var array
     */
    protected $screens = ['post'];

    /**
     * Title
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $title = '';

    /**
     * Id
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $id = '';

    /**
     * Context
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $context = 'normal';

    /**
     * Priority
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var string
     */
    protected $priority = 'high';

    /**
     * Init
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * Add actions to add meta_box and save post
     */
    protected function init()
    {
        add_action('add_meta_boxes', [$this, 'add_meta_box'], 11, 1);
        add_action('save_post', [$this, 'save' ], 10, 1);
    }

    /**
     * Add Meta Box
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $post_type
     */
    public function add_meta_box($post_type)
    {
        if (in_array($post_type, $this->screens))
        {
            add_meta_box(
                  $this->id
                , $this->title
                , [$this, 'output']
                , $post_type
                , $this->context
                , $this->priority
            );
        }
    }

    /**
     * Get Fields
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    protected function get_fields(){}

    /**
     * Output Fields
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return echo html
     */
    public function output()
    {
        $settings = $this->get_fields();

        $fields = new FieldGenerator($settings);

        $fields->output();
    }

    /**
     * Save Fields
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $post_id
     */
    public function save($post_id)
    {
        $settings = $this->get_fields();

        $fields = new FieldGenerator($settings);

        $fields->save();
    }
}