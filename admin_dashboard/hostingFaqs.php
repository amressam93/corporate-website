<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_usersModel.php');
require (WEBINTY_MODELS.'/webinty_hostingSingleFaqModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminHostingSingleFaqController.php');

$HostingFaqModel                 = new webinty_hostingSingleFaqModel();
$HostingFaqController            = new webinty_adminHostingSingleFaqController($HostingFaqModel);
$HostingFaqController->getHostingFaqs();