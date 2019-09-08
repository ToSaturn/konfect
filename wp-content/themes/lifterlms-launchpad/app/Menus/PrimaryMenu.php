<?php

namespace LaunchPad\Menus;


class PrimaryMenu
{
    public $location;

    public $description;

    public function __construct()
    {
        $this->location = 'header';

        $this->description = 'Header Menu';
    }
}