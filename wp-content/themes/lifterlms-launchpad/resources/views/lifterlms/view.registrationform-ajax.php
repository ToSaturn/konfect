<?php

if ( ! is_user_logged_in())
{
    llms_get_template( 'myaccount/form-registration.php' );

    llms_get_template( 'checkout/form-checkout.php' );
}
else
{
    printf(__('You are logged in as %s', 'lifterlms-launchpad'), $args['current_user']->display_name);
}
