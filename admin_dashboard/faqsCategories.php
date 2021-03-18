<?php


require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_faqCategoriesModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminFaqCategoriesController.php');

$faqCategoryModel      = new webinty_faqCategoriesModel();
$faqCategoryController = new webinty_adminFaqCategoriesController($faqCategoryModel);
$faqCategoryController->getFaqCategories();