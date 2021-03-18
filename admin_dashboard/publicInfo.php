<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_publicInfoModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminPublicInfoController.php');

$publicInfoModels      = new webinty_publicInfoModel();
$publicInfoControllers = new webinty_adminPublicInfoController($publicInfoModels);
$publicInfoControllers->getInformations();