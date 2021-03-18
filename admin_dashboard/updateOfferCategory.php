<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_offerCategoriesModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminOfferCategoriesController.php');

$offerCategoryModel      = new webinty_offerCategoriesModel();
$offerCategoryController = new webinty_adminOfferCategoriesController($offerCategoryModel);
$offerCategoryController->updateOfferCategory();