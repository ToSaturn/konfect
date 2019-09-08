<?php

namespace LaunchPad\ThemeLayout;

use SkyLab\Config\Configuration;

/**
 * Content Layout
 *
 * @package LaunchPad
 * @author codeBOX
 * @since 0.0.1
 */
class ContentLayout
{
    /**
     * Instance of Configuration class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private $config;

    /**
     * Instance of layout class
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private
     * @var array
     */
    private $main_layout;

    private $col_info = array(
        'twelve' => 12,
        'eleven' => 11,
        'ten' => 10,
        'nine' => 9,
        'eight' => 8,
        'seven' => 7,
        'six' => 6,
        'five' => 5,
        'four' => 4,
        'three' => 3,
        'two' => 2,
        'one' => 1,
    );

    /**
     * ContentLayout constructor.
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param Configuration $config
     * @param Layout $main_layout
     */
    public function __construct(Configuration $config, LayoutSettings $main_layout)
    {
        add_filter('launchpad_content_width', [$this, 'get_content_width'], 10);

        $this->config = $config;

        $this->main_layout = $main_layout;

        return $this;
    }

    /**
     * Get Content Width
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $width
     * @return string
     */
    public function get_content_width($width)
    {
        $layout = $this->main_layout->get_layout_setting();
        $sidebar_width = $this->col_info[ get_option( 'launchpad_settings_sidebar_width', 'four' ) ];

        $flip = array_flip( $this->col_info );

        switch ($layout) {
            case 'content_sidebar' :
            case 'sidebar_content' :
                return $flip[ 12 - $sidebar_width ];
                break;

            case 'content' :
                return 'twelve';
                break;

            case 'sidebar_content_sidebar' :
                return $flip[ 12 - ( $sidebar_width * 2 ) ];
                break;

            default :
                return 'twelve';
                break;
        }
    }
}