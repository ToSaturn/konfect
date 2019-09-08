<?php
/**
 * Multi Select Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Multiselect extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;

        $this->get_page_options();
    }

    protected function set_option_value($use_default = false)
    {
        if ($use_default)
        {
            $this->option_value = $this->value['default'];
        }
        else if (isset( $_POST[$this->value['id']]))
        {
            foreach($_POST[$this->value['id']] as $k => $v)
            {
                $_POST[$this->value['id']][$k] = sanitize_text_field(stripslashes($v));
            }
            $this->option_value = $_POST[$this->value['id']];
        }
        else
        {
            $this->option_value = '';
        }

        return $this;
    }
}
