<?php
/**
 * Title Label
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Title extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
