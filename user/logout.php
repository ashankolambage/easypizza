<?php
include('../config/constants.php');
unset($_SESSION['customer_login']); //login session unset
unset($_SESSION['customer_login_id']);
session_destroy(); //login session destroyed
header("location:" . SITEURL . 'user');
?>