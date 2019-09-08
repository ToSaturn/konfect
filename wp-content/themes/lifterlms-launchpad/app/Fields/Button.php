<?php
/**
 * Button Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Button extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
