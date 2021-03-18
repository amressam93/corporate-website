<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_subjectsCategoriesModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminSubjectsCategoriesController.php');

$subjectCategoryModel      = new webinty_subjectsCategoriesModel();
$subjectCategoryController = new webinty_adminSubjectsCategoriesController($subjectCategoryModel);
$subjectCategoryController->deleteSubjectCategory();