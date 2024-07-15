<?php

include('../config/constants.php');

//Get Selected User ID
$id = $_GET['id'];

//Delete SQL Query
$sql = "DELETE FROM admin_account WHERE id_admin=$id";
$res = mysqli_query($conn, $sql);

//Check Query Success
if($res==TRUE)
{
    $_SESSION['delete'] = "<div class='success text-center'>Admin Deleted Succesfully</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');  //Redirect to manage admin page
}
else
{
    $_SESSION['delete'] = "<div class='error text-center'>Admin Deleted Failed</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');  //Redirect to manage admin page
}

?>