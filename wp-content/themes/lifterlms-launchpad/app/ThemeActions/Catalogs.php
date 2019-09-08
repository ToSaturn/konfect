<?php

namespace LaunchPad\ThemeActions;

use SkyLab\Templating\Template;
use LaunchPad\Metaboxes\Layout;

class Catalogs
{
     public function __construct()
     {
         if (is_lifterlms_enabled())
         {
             add_filter('lifterlms_loop_columns', array( $this, 'lifterlms_loop_columns' ) );
             add_filter( 'lifterlms_show_page_title', array( $this, 'llms_archive_title' ) );
         }

     }

    public function llms_archive_title( $bool ) {


        if ( is_courses() || is_memberships() ) {

            $bool = ( 'yes' !== Layout::get_setting( 'launchpad_hide_page_title', 'no' ) );

        }

        return $bool;
    }

    public function lifterlms_loop_columns($icon)
    {
         return get_option( 'launchpad_settings_catalog_columns', '3' );
    }
}