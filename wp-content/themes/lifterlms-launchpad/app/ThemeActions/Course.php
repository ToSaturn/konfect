<?php

namespace LaunchPad\ThemeActions;

use SkyLab\Templating\Template;

class Course
{
     public function __construct()
     {
         if (is_lifterlms_enabled())
         {
             add_filter('lifterlms_lesson_complete_icon', array( $this, 'lesson_complete_icon' ) );

             add_action( 'lifterlms_after_loop_item_title', array( $this, 'course_excerpt' ), 5 );

         }

     }

    public function course_excerpt() {
        $excerpt = get_post_meta( get_the_ID(), 'launchpad_course_excerpt', true );
        if ( $excerpt ) {
            echo '<div class="llms-meta lp-excerpt">';
            echo wp_kses_post( wpautop( $excerpt ) );
            echo '</div>';
        }
    }

    public function lesson_complete_icon($icon)
    {
         return get_option( 'launchpad_settings_icon_lesson_complete', 'check-square' );
    }
}