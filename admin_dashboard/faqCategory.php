<?php


require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_faqCategoriesModel.php');
require (WEBINTY_MODELS.'/webinty_faqModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminFaqController.php');

$faqModel      = new webinty_faqModel();
$faqController = new webinty_adminFaqController($faqModel);
$faqController->getAllFaqsByCategory();