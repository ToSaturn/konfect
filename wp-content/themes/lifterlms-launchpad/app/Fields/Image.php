<?php
/**
 * Text Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Image extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;

        $this->remove_button_class();
    }

    public function remove_button_class() {

        if ( $this->get_option($this->value['id']) ) {
            $this->value['remove_button_visibility_class'] = '';
            return;
        }

        $this->value['remove_button_visibility_class'] = 'hidden';
    }
}
