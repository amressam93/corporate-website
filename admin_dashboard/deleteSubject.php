<?php



require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_subjectsCategoriesModel.php');
require (WEBINTY_MODELS.'/webinty_subjectsModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminSubjectsController.php');

$subjectModel     = new webinty_subjectsModel();
$subjectContrller = new webinty_adminSubjectsController($subjectModel);
$subjectContrller->deleteSubject();
