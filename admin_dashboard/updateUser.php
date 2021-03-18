<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_usersModel.php');
require (WEBINTY_MODELS.'/webinty_usersGroupsModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminUsersController.php');

$userModel      = new webinty_usersModel();
$userController = new webinty_adminUsersController($userModel);
$userController->updateUser();