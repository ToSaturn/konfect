<?php
namespace LaunchPad\Upgrades;
/**
 * Run Database and related upgrades on admin init
 * @since  1.3.0
 * @version  1.3.0
 */
class Upgrades
{

	/**
	 * Stored version number from the last upgrade
	 * @var string
	 * @since 1.3.0
	 * @version 1.3.0
	 */
	private $db_version;

	/**
	 * Current version of the theme
	 * @var string
	 * @since 1.3.0
	 * @version 1.3.0
	 */
	private $version;

	/**
	 * Constructor
	 * Add actions
	 * @since 1.3.0
	 * @version 1.3.0
	 */
    public function __construct()
    {

    	add_action( 'admin_init', [$this, 'check_upgrades'] );

    }

    /**
     * Setup version numbers
     * Check if an upgrade needs to be run
     * Run the upgrade
     * If successful, update db_version in the database
     * @return void
     * @since 1.3.0
     * @version 1.3.0
     */
    public function check_upgrades()
    {

    	$this->db_version = get_option( 'lifterlms_launchpad_db_version', '1.0.0' );
    	$this->version = wp_get_theme()->Version;

    	// stored db version is less than the current version
    	// find potential upgrades & run them
    	if ( version_compare( $this->db_version, $this->version, '<' ) ) {

    		// if upgrades all run successfully, upgrade the DB version
    		if ( $this->do_upgrades() ) {

    			update_option( 'lifterlms_launchpad_db_version', $this->version );

    		}

    	}

    }

    /**
     * Grab all upgrades and check if they need to be run & run those that do
     * @return boolean
     * @since 1.3.0
     * @version 1.3.0
     */
    private function do_upgrades()
    {

    	$upgrades = glob( get_template_directory() . '/app/Upgrades/upgrades/upgrade-*.php' );
    	foreach( $upgrades as $file ) {
    		// get version number from the file
    		$ver = str_replace( 'upgrade-', '', basename( $file, '.php' ) );
    		// if the db version is less than the upgrade's version, run the upgrade
    		if ( version_compare( $this->db_version, $ver, '<' ) ) {
    			// upgrade file should return 'true'
    			$upgrade = include $file;
    			if ( ! $upgrade ) {
    				return false;
    			}
    		}
    	}
    	return true;

    }

}
