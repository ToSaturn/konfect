<?php

namespace LaunchPad\Menus;


class FooterMenu
{
    public $location;

    public $description;

    public function __construct()
    {
        $this->location = 'footer';

        $this->description = 'Footer Menu';
    }
}