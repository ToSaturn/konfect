<?php

define('LAUNCHPAD_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| One of the most frustrating things about OOP PHP is manaully loading
| classes. Composer makes this brainless simple for us. We require
| the Composer autoload class here and now we never have to
| worry about loading our classes manually ever again.
|
*/

require (trailingslashit(get_template_directory()) .'vendor/autoload.php');
