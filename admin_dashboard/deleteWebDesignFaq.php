<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_usersModel.php');
require (WEBINTY_MODELS.'/webinty_webDesignSingleFaqModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminWebDesignSingleFaqController.php');

$webDesignFaqModel               = new webinty_webDesignSingleFaqModel();
$webDesignFaqController          = new webinty_adminWebDesignSingleFaqController($webDesignFaqModel);
$webDesignFaqController->deleteWebDesignFaq();