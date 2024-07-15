<?php
if(!isset($_SESSION['admin_login'])) // check user logged in
{
    //User not loged in. Redirect to login page
    $_SESSION['no-logged-in'] =  "<div class='error text-center'>Please Log in to the System</div>";
    header("location:" . SITEURL . 'admin/login.php');
}
?>