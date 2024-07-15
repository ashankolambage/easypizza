<?php
//Start Session
ob_start();  // to fix the "Cannot modify header info" error

session_start();
define('SITEURL', 'http://localhost/BIT%20Work/easypizza/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'easypizza');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die();
$db_select = mysqli_select_db($conn, DB_NAME) or die();
?>