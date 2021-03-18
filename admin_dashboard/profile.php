<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_usersModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminUsersController.php');

$usersModel      = new webinty_usersModel();
$usersController = new webinty_adminUsersController($usersModel);
$usersController->userProfile();