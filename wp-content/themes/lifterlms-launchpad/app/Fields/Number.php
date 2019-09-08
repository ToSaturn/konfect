<?php
/**
 * Number Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Number extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
