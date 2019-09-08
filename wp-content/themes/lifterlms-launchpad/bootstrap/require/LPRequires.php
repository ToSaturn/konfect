<?php

/**
 * Server Configuration Requirements
 *
 * @package LaunchPad
 * @author codeBOX
 * @since 0.0.1
 */
class LPRequires
{
    /**
     * Minimum PHP Version
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @access private static
     * @var array
     */
    private static $min_php_version = '5.4.0';

    /**
     * LPRequires constructor.
     * Require server check classes
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     */
    public function __construct()
    {
        require_once('PhpVersion.php');
    }

    /**
     * Check if server meets minimum requirements
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return bool
     */
    public function does_install_meet_requirements()
    {
        return $this->require_php_version();
    }

    /**
     * Check if PHP Version installed on server meets theme requirements
     *
     * @since 0.0.1
     * @version 0.0.1
     *
     * @return bool
     */
    private function require_php_version()
    {
        $php_version = new PhpVersion(self::$min_php_version);

        return $php_version->does_it_meet_required_php_version( PHP_VERSION );
    }

}
