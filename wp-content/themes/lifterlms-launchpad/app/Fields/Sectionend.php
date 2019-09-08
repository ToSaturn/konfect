<?php
/**
 * Section End
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Sectionend extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
