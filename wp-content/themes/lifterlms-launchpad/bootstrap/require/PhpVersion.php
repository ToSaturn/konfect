<?php

/**
 * Minimum PHP Version Required Check
 *
 * @package LaunchPad
 * @author codeBOX
 * @since 0.0.1
 */
class PhpVersion
{
    /**
     * Minimum PHP version
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @var String
     */
    private $minimum_version;

    /**
     * PhpVersion constructor
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $minimum_version
     */
    public function __construct( $minimum_version ) {
        $this->minimum_version = $minimum_version;
    }

    /**
     * Does server meet required php version check
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $version
     * @return bool
     */
    public function does_it_meet_required_php_version( $version ) {
        if ( $this->is_minimum_php_version( $version ) ) {
            return true;
        }

        $this->load_minimum_required_version_notice();
        return false;
    }

    /**
     * Is minimum PHP Version
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @param $version
     * @return boolean
     */
    private function is_minimum_php_version( $version ) {
        return version_compare( $this->minimum_version, $version, '<=' );
    }

    /**
     * Load minimum php required version notice
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return void
     */
    private function load_minimum_required_version_notice() {
        if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
            add_action( 'admin_notices', array( $this, 'admin_notice' ) );
        }
    }

    /**
     * Display Admin Notice
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return echo html
     */
    public function admin_notice() {
        echo '<div class="error">';
        echo '<p>Unfortunately, this plugin can not run on PHP versions older than '. $this->minimum_version .'. Read more information about <a href="http://www.wpupdatephp.com/update/">how you can update</a>.</p>';
        echo '</div>';
    }

}
