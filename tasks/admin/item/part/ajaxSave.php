<?php

//    error_reporting(E_ALL);
//    ini_set('display_errors', '1');
    $part_id = $_POST['part_id'];
// Get configuration settings
require_once $_SERVER['DOCUMENT_ROOT'] .  '/constants.php';

// Connect to Database
$conn = new mysqli(RA_DB_SERVER, RA_DB_USER, RA_DB_PASSWORD, RA_DB_NAME) or  die('There was a problem connecting to the database.');

    require_once  '../../../../classes/Part.php';
    $part = new Part();
    $part->getPart($conn,$part_id);
    foreach($_POST as $key=>$value) {
        if($key != $part_id) {
            $part->$key = $value;
        }
    }
    $result = $part->updatePart($conn);
    echo $result;
   
?>