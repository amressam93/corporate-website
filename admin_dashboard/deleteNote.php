<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_usersModel.php');
require (WEBINTY_MODELS.'/webinty_clientTicketModel.php');
require (WEBINTY_MODELS.'/webinty_clientNotesModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminClientNotesController.php');

$clientNotestModel          = new webinty_clientNotesModel();
$clientNotesController      = new webinty_adminClientNotesController($clientNotestModel);
$clientNotesController->deleteNote();