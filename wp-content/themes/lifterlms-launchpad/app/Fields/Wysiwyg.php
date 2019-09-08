<?php
/**
 * Email Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Wysiwyg extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;

        $this->get_settings();
    }

    protected function get_settings()
    {

        if ( ! array_key_exists('settings', $this->value))
        {
            $this->value['settings'] = [];
        }
    }
}
