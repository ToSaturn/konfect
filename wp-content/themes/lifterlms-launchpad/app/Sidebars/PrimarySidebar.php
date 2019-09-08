<?php

namespace LaunchPad\Sidebars;

use SkyLab\Sidebars\Sidebar;

class PrimarySidebar extends Sidebar
{

    public $id = 'launchpad-primary-sidebar';

    public $template = 'view.sidebar.php';

    public function register()
    {
        return apply_filters(
            'launchpad_primary_sidebar', [
                'name'          => __( 'Primary Sidebar', 'lifterlms-launchpad' ),
                'id'            => $this->id,
                'description'   => __( 'Appears on the right or left depending upon your settings.', 'lifterlms-launchpad' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>'
            ]
        );
    }
}