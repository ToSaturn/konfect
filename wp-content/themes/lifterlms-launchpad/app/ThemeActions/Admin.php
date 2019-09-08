<?php

namespace LaunchPad\ThemeActions;

use SkyLab\Templating\Template;

class Admin
{

    public function __construct()
    {
        add_filter('launchpad_settings_default_tab', [$this, 'settings_default_tab']);
    }

    public function settings_default_tab( $tab )
    {
    	return 'header';
    }

}