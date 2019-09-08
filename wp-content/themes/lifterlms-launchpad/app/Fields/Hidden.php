<?php
/**
 * Hidden Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Hidden extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
