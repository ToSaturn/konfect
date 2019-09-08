<?php

namespace LaunchPad\ThemeActions;

use SkyLab\Templating\Template;

class AccessPlans
{
     public function __construct()
     {
         if (is_lifterlms_enabled())
         {
             add_filter('lifterlms_featured_access_plan_text', [$this, 'featured_text']);
         }

     }

    public function featured_text($icon)
    {
         return get_option( 'launchpad_settings_access_plan_featured_text', __( 'FEATURED', 'lifterlms-launchpad' ) );
    }
}