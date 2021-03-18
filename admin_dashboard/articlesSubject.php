<?php


require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_subjectsCategoriesModel.php');
require (WEBINTY_MODELS.'/webinty_articleImagesModel.php');
require (WEBINTY_MODELS.'/webinty_subjectsModel.php');
require (WEBINTY_MODELS.'/webinty_articlesModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminSubjectsController.php');

$subjectsModel      = new webinty_subjectsModel();
$subjectsController = new webinty_adminSubjectsController($subjectsModel);
$subjectsController->getArticlesBySubjectId();