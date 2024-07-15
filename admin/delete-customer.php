<?php

include('../config/constants.php');

//Get Selected User ID
$id = $_GET['id'];

//Delete SQL Query
$sql = "UPDATE customer SET active='No' WHERE id_customer=$id";
$res = mysqli_query($conn, $sql);

//Check Query Success
if($res==TRUE)
{
    $_SESSION['delete'] = "<div class='success text-center'>Customer Deleted Succesfully</div>";
    header('location:'.SITEURL.'admin/manage-customer.php');  //Redirect to manage admin page
}
else
{
    $_SESSION['delete'] = "<div class='error text-center'>Customer Deleted Failed</div>";
    header('location:'.SITEURL.'admin/manage-customer.php');  //Redirect to manage admin page
}

?>