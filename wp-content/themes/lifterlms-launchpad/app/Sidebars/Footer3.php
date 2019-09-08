<?php

namespace LaunchPad\Sidebars;

use SkyLab\Sidebars\Sidebar;

class Footer3 extends Sidebar
{
    public $id = 'launchpad-footer-three';

    public $template = 'view.footerwidget.php';

    public function register()
    {
        return apply_filters('launchpad_sidebar_footer_three', [
            'name'          => __( 'Footer Widget #3', 'lifterlms-launchpad' ),
            'id'            => $this->id,
            'description'   => __( 'Appears on the right of the footer.', 'lifterlms-launchpad' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>'
        ]
        );
    }
}