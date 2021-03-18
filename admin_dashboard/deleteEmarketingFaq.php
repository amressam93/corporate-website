<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_usersModel.php');
require (WEBINTY_MODELS.'/webinty_emarketingSingleFaqModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminEmarketingSingleFaqController.php');

$emarketingFaqModel                = new webinty_emarketingSingleFaqModel();
$emarketingFaqController           = new webinty_adminEmarketingSingleFaqController($emarketingFaqModel);
$emarketingFaqController->deleteEmarketingFaq();