<?php


require ($_SERVER['DOCUMENT_ROOT'].'/webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_publicInfoModel.php');
require (WEBINTY_MODELS.'/webinty_offerCategoriesModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_frontEndController.php');
$frontEndController = new webinty_frontEndController();
$frontEndController->resturant_website_design();