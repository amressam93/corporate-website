<?php


require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_usersGroupsModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminUserGroupsController.php');

$userGroupsModel = new webinty_usersGroupsModel();

$userGroupsController = new webinty_adminUserGroupsController($userGroupsModel);
$userGroupsController->deleteUserGroups();