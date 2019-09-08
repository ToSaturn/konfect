<?php

namespace SkyLab\Customizer;

use SkyLab\Config\Configuration;

/**
 * Customize Section Loader
 * Loads Customize Sections and Fields
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
class CustomizeSectionLoader
{
    /**
     * Sections array
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private static $sections = [];

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
     * CustomizeSectionLoader constructor.
     * Call load_customizer_sections method on WP customize_register action
     *
     * @since 0.0.1
     * @version 0.0.1
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;

        add_action('customize_register', [$this, 'load_customizer_sections']);
    }

    /**
     * Load Customizer Sections
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $wp_customize
     */
    public function load_customizer_sections($wp_customize)
    {
        $sections = $this->get_sections();

        foreach ($sections as $section)
        {
            $this->register_section($section, $wp_customize);
        }

    }

    /**
     * Get Sections
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return array
     */
    private function get_sections()
    {
        if (empty(self::$sections))
        {
            $sections = [];

            $files = glob(trailingslashit(get_template_directory())
                . $this->config->get_customizer_directory() . '*.php');

            foreach ($files as $file)
            {
                $file = $this->config->get_customizer_namespace() . str_replace('.php', '', basename($file));
                $sections[] = (new $file)->get_settings();
            }

            self::$sections = apply_filters('launchpad_customizer_sections', $sections);
        }

        return self::$sections;
    }

    /**
     * Register Section
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $sections
     * @param $wp_customize
     */
    private function register_section($sections, $wp_customize)
    {
        $type = $sections['id'];
        $title = $sections['title'];

        $wp_customize->add_section($type, array(
            "title" => $title,
            "priority" => 30,
        ));

        foreach ($sections['settings'] as $key => $value)
        {

            $settings_values = [
                  'default'                 => isset($value['default']) ? $value['default'] : ''
                , 'type'                    => 'option'
                , 'capability'              => isset($value['capability']) ? $value['capability'] : 'edit_theme_options'
                , 'transport'               => isset($value['transport']) ? $value['transport'] : 'refresh'
                , 'sanitize_callback'       => isset($value['sanitize_callback']) ? $value['sanitize_callback'] : ''
                , 'sanitize_js_callback'    => isset($value['sanitize_js_callback']) ? $value['sanitize_js_callback'] : ''
            ];

            $control_values = [
                  'label'           => isset($value['label']) ? $value['label'] : ''
                , 'description'     => isset($value['desc']) ? $value['desc'] : ''
                , 'section'         => $type
                , 'priority'        => isset($value['priority']) ? $value['priority'] : ''
                , 'type'            => $value['type']
                , 'settings'        => $value['id']
            ];

            if (isset($value['options']))
            {
                $control_values['choices'] = $value['options'];
            }

            if (strcmp($value['type'], 'color') === 0)
            {
                $class = '\WP_Customize_Color_Control';

                // wordpress bug: if type is set there is a js wpColorpicker init error.
                unset($control_values['type']);
            }
            else if ( ! isset($value['class']))
            {
                $class = '\WP_Customize_Control';
            }
            else
            {
                $class = '\\' . $value['class'];
                // wordpress bug: if type is set there is a js wpColorpicker init error.
                unset($control_values['type']);
            }

            // array merge a sanitize callback default because theme check won't pass otherwise
            $wp_customize->add_setting($value['id'], array_merge( [ 'sanitize_callback' => 'esc_url_raw' ], $settings_values ) );

            $wp_customize->add_control(
                new $class(
                    $wp_customize,
                    $value['id'],
                    $control_values
                )
            );

        }

    }

}
