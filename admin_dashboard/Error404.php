<?php


require ('../webinty_globals.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');

$adminController = new webinty_adminController();
$adminController->Error404();