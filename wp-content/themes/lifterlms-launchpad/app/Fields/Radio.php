<?php
/**
 * Radio Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Radio extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;

        $this->get_page_options();
    }
}
