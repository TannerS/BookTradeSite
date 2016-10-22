<?php

header('Cache-Control: no-cache, no-store, must-revalidate');
require_once('includes/php/db_helper.php');
require_once('includes/php/session.php');

session_start();

if(isset($_SESSION['USER_ID']) && isset($_SESSION['FINGER_PRINT']))
{
    $user_id = $_SESSION['USER_ID'];
    $db = new db_helper();
    $db->deleteSession($user_id);
    session_destroy();
}

header('Location: index.php');