<?php

session_start();

/**
 * any global Files
 */



define('ROOT',dirname(__FILE__));

define('WEBINTY_CONTROLLERS',ROOT.'/webinty_includes/webinty_controllers');
define('WEBINTY_MODELS',ROOT.'/webinty_includes/webinty_models');
define('WEBINTY_ASSETS',ROOT.'/webinty_assets');
define('WEBINTY_VIEWS',WEBINTY_ASSETS.'/views');

/*
 * include Important Files
 */

require(ROOT .'/webinty_includes/webinty_config.php');
require (WEBINTY_MODELS.'/webinty_model.php');
require (WEBINTY_CONTROLLERS.'/webinty_controller.php');
require(ROOT . '/webinty_includes/webinty_system.php');
require (ROOT.'/webinty_includes/webinty_mysql.php');
require (ROOT.'/webinty_includes/webinty_pluggable.php');
require (ROOT.'/webinty_includes/webinty_vaildator.php');


/*
 * Store Important Objects
 */

webinty_system::Store('database',new webinty_mysql());
webinty_system::Store('validator',new validation());


