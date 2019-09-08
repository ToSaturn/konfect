<?php
/**
 * Text Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Text extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
