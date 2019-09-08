<?php
/**
 * Javascript Textarea Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Script extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Override parent set_option_value method
     * Applies wp_kses_post, trim then stripslashes to textarea content
     * @return $this
     */
    protected function set_option_value($use_default = false)
    {
        if ($use_default)
        {
            $this->option_value = $this->value['default'];
        }
        else if (isset($_POST[$this->value['id']]))
        {
            $this->option_value = trim( stripslashes( $_POST[ $this->value['id'] ] ) );
        }
        else
        {
            $this->option_value = '';
        }

        return $this;
    }

}
