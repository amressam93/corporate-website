<?php

require ('../webinty_globals.php');
require (WEBINTY_MODELS.'/webinty_usersModel.php');
require (WEBINTY_MODELS.'/webinty_clientTicketModel.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminController.php');
require (WEBINTY_CONTROLLERS.'/webinty_adminClientTicketController.php');

$clientTicketModel          = new webinty_clientTicketModel();
$clientTicketController     = new webinty_adminClientTicketController($clientTicketModel);
$clientTicketController->getAllClientTickets();