<?php
namespace LaunchPad;

/*
|--------------------------------------------------------------------------
| Server Check
|--------------------------------------------------------------------------
|
| This is where you run a server check before theme activation. Launchpad
| requires a minimum PHP version of 5.5. There may also be additional
| requirements you have for your theme. Before we kick off the theme
| we need to make sure the server meets our requirements
|
*/

require_once(trailingslashit(get_template_directory()).'/bootstrap/require/LPRequires.php');

$requirements = new \LPRequires();

if ($requirements->does_install_meet_requirements()) {

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient way to auto-magically load classes and
| manage namespaces. All we need to do is include it here and we
| can be sure that when we create a new class it's loaded
|
*/

require trailingslashit(get_template_directory()).'/bootstrap/autoload.php';


/*
|--------------------------------------------------------------------------
| Bootstrap the Application
|--------------------------------------------------------------------------
|
| Before we can use LaunchPad it needs to load up a few things first.
| All we need to do here is require the bootstrap/app file and
| LaunchPad will do the rest for us. Now we are good to go!
|
*/

$app = require_once trailingslashit(get_template_directory()).'/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Add your own functions below (at your own risk)
|--------------------------------------------------------------------------
|
| Below this line you are free to add your own functions for your theme.
| We say "at your own risk" because LaunchPad is chock full of OO and
| abstracted tools to make building and customizing themes easier.
| We firmly believe that if you stick to the simple architecture
| we provided you will forget why you ever thought you needed a
| functions file in the first place. Cheers and Good Luck!
|
*/

} // end server requirements wrapper DO NOTHING BELOW THIS LINE!