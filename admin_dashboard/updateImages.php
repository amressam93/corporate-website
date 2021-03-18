<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_subjectsModel.php');
require (WEBINTY_MODELS.'/webinty_articlesModel.php');
require (WEBINTY_MODELS.'/webinty_articleImagesModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminArticlesController.php');

$articlesModel      = new webinty_articlesModel();
$articlesController = new webinty_adminArticlesController($articlesModel);
$articlesController->getImages();
