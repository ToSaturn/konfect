<?php
/**
 * Color Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Color extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
