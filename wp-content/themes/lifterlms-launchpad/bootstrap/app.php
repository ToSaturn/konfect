<?php

/*
|--------------------------------------------------------------------------
| Initialize The Configuration Object
|--------------------------------------------------------------------------
|
| The first thing we need to do is instantiate an instance of our config
| class. This object will be used by LaunchPad to determine namespaces,
| paths and any number of other configurations set with the theme.
|
*/

$config = apply_filters('initialize_launchpad_config', new LaunchPad\Config\ConfigurationLive());


/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The second thing we need to do is create a new instance of the LaunchPad
| application. This will serve as the "glue" of the application theme.
| This will load up the framework classes and configurations needed.
|
*/

$app = new SkyLab\Foundation\Application($config);

/*
|--------------------------------------------------------------------------
| Enqueue Scripts and Styles
|--------------------------------------------------------------------------
|
| The third thing we need to do is enqueue the themes scripts and styles.
| We load these through the EnqueueScripts class. The EnqueueScripts
| class can be used to add / modify additional scripts and styles.
|
*/

$scripts = new LaunchPad\Scripts\EnqueueScripts();

/*
|--------------------------------------------------------------------------
| Enqueue Scripts and Styles
|--------------------------------------------------------------------------
|
| The forth thing we need to do is load up the LayoutSettings class
| The layout settings is used to manage the style and structure
| of the theme based on any number of configuration settings.
|
*/

$layout = new LaunchPad\ThemeLayout\LayoutSettings($config);


/*
|--------------------------------------------------------------------------
| Initialize The Ajax Controller
|--------------------------------------------------------------------------
|
| Finally we initialize the Ajax Controller. This class will make ajax
| easy for you. All you need to do is create a method inside the
| controller class and the method name will be the ajax method
| you call from your javascript file. Super duper simple.
|
*/

$ajax = new LaunchPad\Http\AjaxRequestController($config);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| Finally we need to return the application instance. The instance is
| passed to the calling script so we can separate the instances.
| This will discern the current application and responses.
|
*/

return $app;
