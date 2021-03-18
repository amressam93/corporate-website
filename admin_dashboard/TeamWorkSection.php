<?php


require ($_SERVER['DOCUMENT_ROOT'].'/webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_teamWorkSectionsModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminTeamWorkSectionController.php');

$teamWorkSectionModel      = new webinty_teamWorkSectionsModel();
$teamWorkSectionController = new webinty_adminTeamWorkSectionController($teamWorkSectionModel);
$teamWorkSectionController->getTeamWorkSectionById();