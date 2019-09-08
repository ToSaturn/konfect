<?php
/**
 * Select Field
 */

namespace LaunchPad\Fields;

use SkyLab\Fields\Field;

class Select extends Field
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;

        $this->get_page_options();
    }

}
