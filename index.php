<?php
/**
 * Home Page
 */


require ('webinty_globals.php');

require (WEBINTY_MODELS.'/webinty_clientNotesModel.php');







$model = new webinty_clientNotesModel();
$data = $model->getAllNotes();

echo '<pre>';
print_r($data);








//$ip = $_SERVER['REMOTE_ADDR'];



