<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_offerCategoriesModel.php');
require (WEBINTY_MODELS.'/webinty_offerModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminOfferControllers.php');

$offerModel      = new webinty_offerModel();
$offerController = new webinty_adminOfferControllers($offerModel);
$offerController->updateOffer();