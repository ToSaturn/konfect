<?php

namespace SkyLab\Fields;

use SkyLab\Templating\Template;

/**
 * Abstract Field Class
 *
 * @package SkyLab
 * @author codeBOX
 * @since 0.0.1
 */
abstract class Field
{
    /**
     * Field Value
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var array
     */
    protected $value = [];

    /**
     * Option Value
     * Either default / value to set or value returned from database
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var mixed
     */
    protected $option_value;

    /**
     * Output Field
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     */
    public function output()
    {
        // get field class name
        $class_name = (new \ReflectionClass($this))->getShortName();

        // set option value (default value is REQUIRED)
        if (isset($this->value['default']))
        {
            $this->value['option_value'] = $this->get_option($this->value['id'], $this->value['default']);
        }

        // set parameters to empty or default values if they don't exist
        $this->set_default_parameters();

        // parse custom attributes
        $this->parse_custom_attributes();

        return (new Template)->get('admin/fields/view.field.' . strtolower($class_name) . '.php',
            apply_filters($this->value['id'].'_values', $this->value));
    }

    /**
     * Set Default Parameters
     * Set any parameters that were not included to empty or default values
     * This is easier than checking for the values in every template or field class.
     * This can be overridden in any child field class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     */
    protected function set_default_parameters()
    {

        // set type to text if nothing was provided
        if ( ! isset($this->value['type']))
        {
            $this->value['type'] = 'text';
        }

        // custom attributes
        if ( ! isset($this->value['custom_attributes']))
        {
            $this->value['custom_attributes'] = [];
        }

        // id
        if ( ! isset($this->value['id']))
        {
            $this->value['id'] = '';
        }

        // name
        if ( ! isset($this->value['title']))
        {
            $this->value['title'] = isset($this->value['name'] ) ? $this->value['name'] : '';
        }

        // class
        if ( ! isset($this->value['class']))
        {
            $this->value['class'] = '';
        }

        // css
        if ( ! isset( $this->value['css'] ) )
        {
            $this->value['css'] = '';
        }

        // default
        if ( ! isset( $this->value['default'] ) )
        {
            $this->value['default'] = '';
        }

        // desc
        if ( ! isset( $this->value['desc']))
        {
            $this->value['desc'] = '';
        }

        // wrapper_class
        // only used for radio and checkbox elements
        if ( ! isset( $this->value['wrapper_class']))
        {
            $this->value['wrapper_class'] = '';
        }

        if ( ! isset( $this->value['sanitize_field']))
        {
            $this->value['sanitize_field'] = true;
        }

    }

    /**
     * Parse Custom Attributes
     *
     * Convert custom attributes from key value pares to a single string.
     * key value pairs become key="value"
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     */
    protected function parse_custom_attributes()
    {
        $custom_attributes = [];

        if ( isset($this->value['custom_attributes']) && is_array($this->value['custom_attributes']))
        {
            foreach ( $this->value['custom_attributes'] as $attribute => $attribute_value )
            {
                $this->value['custom_attributes'] = esc_attr($attribute) . '="' . esc_attr($attribute_value) . '"';
            }
        }
    }

    /**
     * * Save Field
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param bool $use_default
     * @return $this
     */
    public function save($use_default = false)
    {
        return $this->set_option_value($use_default)->set_option();
    }

    /**
     * Get Option
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $option_name
     * @param string $default
     * @return array|null|string
     */
    protected function get_option($option_name, $default = '')
    {
        global $post;

        // Array value
        if (strstr($option_name, '[' ))
        {
            parse_str( $option_name, $option_array );

            // Option name is first key
            $option_name = current(array_keys($option_array));

            // Get value
            if (is_null($post))
            {
                $option_values = get_option($option_name, '');
            }
            else
            {
                $option_values = get_post_meta($post->ID, $option_name, true);

                // if false set to empty string
                $option_values = empty($option_values) ? '' : $option_values;
            }

            $key = key($option_array[ $option_name ]);

            if (isset( $option_values[ $key ]))
            {
                $option_value = $option_values[$key];
            }
            else
            {
                $option_value = null;
            }

        // Single value
        }
        else
        {
            if (is_null($post))
            {
                $option_value = get_option($option_name, null);
            }
            else
            {
                $option_value = get_post_meta($post->ID, $option_name, true);

                // if false set to null
                $option_value = empty($option_value) ? null : $option_value;
            }
        }

        if (is_array($option_value))
        {
            $option_value = array_map('stripslashes', $option_value);
        }

        elseif ( ! is_null($option_value))
        {
            $option_value = stripslashes($option_value);
        }

        return is_null($option_value) ? $default : $option_value;
    }

    /**
     * Save Option value to database
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return $this
     */
    protected function set_option()
    {
        global $post;

        if (is_null($post))
        {
            update_option($this->value['id'], $this->option_value);
        }
        else
        {
            update_post_meta($post->ID, $this->value['id'], $this->option_value);
        }

        return $this;
    }

    /**
     * Get Option Value
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     */
    protected function get_option_value()
    {
        $this->option_value = $this->get_option($this->value['id'], $this->value['default']);
    }

    /**
     * Set Option Value
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return $this
     */
    protected function set_option_value($use_default = false)
    {
        $this->set_default_parameters();

        if ($use_default)
        {
            $this->option_value = $this->value['default'];
        }
        else if (isset($_POST[$this->value['id']]))
        {
            if ($this->value['sanitize_field'])
            {
                $_POST[$this->value['id']] = sanitize_text_field($_POST[$this->value['id']]);
            }
			// Set numeric values to default if null
			if( strcmp( $this->value['type'], 'number') == 0 ){

				if( $_POST[$this->value['id']] == '' ){

					$this->option_value = $this->value['default'];
				}
				else{
					$this->option_value = stripslashes($_POST[$this->value['id']]);
				}

			}
			else{
				$this->option_value = stripslashes($_POST[$this->value['id']]);
			}


        }
        else
        {
            $this->option_value = '';
        }

        return $this;
    }

    /**
     * Get Page Options
     * Can be used for selects, radios, multi-selects and checkboxes
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return $this
     */
    public function get_page_options()
    {
        if (isset($this->value['post_type']))
        {
            if (!isset($this->value['parameters']))
            {
                $this->value['parameters'] = [];
            }

            // default parameters
            $parameters = [
                'posts_per_page' => 1000,
                'offset' => 0,
                'category' => '',
                'category_name' => '',
                'orderby' => 'post_title',
                'order' => 'ASC',
                'post_type' => $this->value['post_type'],
                'suppress_filters' => true
            ];

            // if parameters have been passed merge with the defaults
            // override any default with any parameter passed by the user
            if (isset($this->value['parameters']))
            {
                $this->value['parameters'] = array_merge($parameters, $this->value['parameters']);
            }

            $posts = get_posts($this->value['parameters']);

            foreach ($posts as $key => $post)
            {
                $this->value['options'][$key] = $post->post_title;
            }
        }

        return $this;
    }

}
