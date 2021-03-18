<?php

require ($_SERVER['DOCUMENT_ROOT'].'/webinty_globals.php');

session_start();
session_destroy();

$redirectUrl = WEBINTY_AR_PATH ;
header("location:$redirectUrl");