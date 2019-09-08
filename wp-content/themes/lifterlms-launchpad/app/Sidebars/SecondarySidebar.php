<?php

namespace LaunchPad\Sidebars;

use SkyLab\Sidebars\Sidebar;

class SecondarySidebar extends Sidebar
{
    public $id = 'launchpad-secondary-sidebar';

    public $template = 'view.sidebar.php';

    public function register()
    {
        return apply_filters(
            'launchpad_secondary_sidebar', [
                'name'          => __( 'Secondary Sidebar', 'lifterlms-launchpad' ),
                'id'            => $this->id,
                'description'   => __( 'Appears on the right when using a two sidebar layout.', 'lifterlms-launchpad' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>'
            ]
        );
    }
}