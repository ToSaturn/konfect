<?php
/**
 * Checkbox Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Checkbox extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;

        $this->visibility_settings();
    }

    /**
     * Execute Visibility Methods
     * @return $this
     */
    protected function visibility_settings()
    {
        $this->value['visibility_class'] = [];

        $this->set_hidden_options()->set_visibility_toggles();

        return $this;
    }

    /**
     * Set Visibility Toggles
     * Assigns the appropriate class names to any fields with the show / hide value as 'option'
     * @return $this
     */
    protected function set_visibility_toggles()
    {
        // if hide_if_checked is 'option' set fieldset class to hide_options_if_checked
        if ($this->value['hide_if_checked'] == 'option')
        {
            $this->value['visibility_class'][] = 'hide_options_if_checked';
        }

        // if show_if_checked is 'option' set fieldset class to show_options_if_checked
        if ($this->value['show_if_checked'] == 'option')
        {
            $this->value['visibility_class'][] = 'show_options_if_checked';
        }

        return $this;
    }

    /**
     * Sets the option as hidded if it is marked as show / hide with a true or yes value
     * @return $this
     */
    protected function set_hidden_options()
    {
        // if hide_if_checked is not set make if false
        if ( ! isset( $this->value['hide_if_checked']))
        {
            $this->value['hide_if_checked'] = false;
        }

        // if show_if_checked is not set make if false
        if ( ! isset( $this->value['show_if_checked']))
        {
            $this->value['show_if_checked'] = false;
        }

        // if hide_if_checked is yes or show_if_checked is yes set the visibility class to hidden_option
        if ($this->value['hide_if_checked'] == 'yes' || $this->value['show_if_checked'] == 'yes')
        {
            $this->value['visibility_class'][] = 'hidden_option';
        }

        return $this;
    }

    protected function set_option_value($use_default = false)
    {
        if ($use_default)
        {
            $this->option_value = $this->value['default'];
        }
        else if (isset($_POST[$this->value['id']]))
        {
            $this->option_value = 'yes';
        }
        else
        {
            $this->option_value = 'no';
        }

        return $this;
    }



}
