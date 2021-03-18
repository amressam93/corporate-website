<?php


require ($_SERVER['DOCUMENT_ROOT'].'/webinty_globals.php');
require(WEBINTY_MODELS . '/webinty_usersModel.php');
require(WEBINTY_CONTROLLERS . '/webinty_loginController.php');
$loginController = new webinty_loginController();

$loginController->userLogin();




