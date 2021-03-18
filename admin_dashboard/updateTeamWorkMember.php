<?php

require ($_SERVER['DOCUMENT_ROOT'].'/webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_teamWorkSectionsModel.php');
require (WEBINTY_MODELS.'/webinty_teamWorkModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminTeamWorkController.php');

$teamWorkModel             = new webinty_teamWorkModel();
$teamWorkController        = new webinty_adminTeamWorkController($teamWorkModel);
$teamWorkController->updateMember();