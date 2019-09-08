<?php
/**
 * Title Label
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Subtitle extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
