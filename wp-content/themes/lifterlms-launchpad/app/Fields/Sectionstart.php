<?php
/**
 * Section Start
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Sectionstart extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
