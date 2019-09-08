<div class="wrap launchpad">

    <form method="post" id="mainform" action="" enctype="multipart/form-data">
        <div class="container full sticky">
            <div class="row">
                <div id="launchpad-settings-nav" class="four columns" >
                    <ul class="launchpad-nav-tab-wrapper" >
                        <?php foreach ( $tabs as $name => $label )

                        echo '<li><a href="' . admin_url( 'admin.php?page=launchpad-settings&tab=' . $name ) . '" class="settings-menu-primary launchpad-nav-tab-settings '
                                . ( $current_tab == $name ? 'launchpad-nav-tab-active' : '' ) . '">' . $label . '</a></li>';

                        do_action( 'lifterlms_settings_tabs' ); ?>
                    </ul>
                </div>

                <div id="launchpad-settings-tile" class="eight columns">
                    <?php
                    do_action( 'launchpad_sections_' . $current_tab );
                    do_action( 'launchpad_settings_' . $current_tab );
                    do_action( 'launchpad_settings_tabs_' . $current_tab );
                    ?>
                    <div id="launchpad-form-wrapper">
                        <div class="launchpad-notice"></div>
                        <p class="submit">
                            <input name="reset" class="button-secondary" type="button" value="<?php _e( 'Reset Options', 'lifterlms-launchpad' ); ?>" />
                            <input name="save" class="button-primary" type="submit" value="<?php _e( 'Save Changes', 'lifterlms-launchpad' ); ?>" />
                            <input type="hidden" name="action" value="launchpad-settings" />
                            <input type="hidden" name="subtab" id="last_tab" />
                            <?php wp_nonce_field( 'launchpad-settings' ); ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </form>

</div>