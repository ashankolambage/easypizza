<?php
include('../config/constants.php');
unset($_SESSION['user']); //login session unset
session_destroy(); //login session destroyed
header("location:" . SITEURL . 'admin/login.php');
?>