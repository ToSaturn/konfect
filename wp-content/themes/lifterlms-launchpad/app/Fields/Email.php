<?php
/**
 * Email Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Email extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
