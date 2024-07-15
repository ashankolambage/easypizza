<?php
if(!isset($_SESSION['customer_login'])) // check user logged in
{
    //User not loged in. Redirect to login page
    $_SESSION['no-logged-in'] =  "<div class='error text-center'>Please Log in to the System</div>";
    header("location:" . SITEURL . 'user/user-login.php');
}
?>