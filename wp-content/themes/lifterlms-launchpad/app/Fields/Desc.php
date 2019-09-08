<?php
/**
 * Desc Label
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Desc extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
