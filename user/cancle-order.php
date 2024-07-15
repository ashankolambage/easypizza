<?php
include('../config/constants.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    //Get data from DB
    $sql = "SELECT * FROM order_detail WHERE id_order = '$id'";
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);

        $status = $row['order_status'];

        if ($status == "Ordered") {

            $sql2 = "UPDATE order_detail SET order_status='Cancelled' WHERE id_order = '$id'";
            $res2 = mysqli_query($conn, $sql2);

            $_SESSION['cancle'] = "<div class='success text-center'>Order Cancelled Successfully</div>";
            header("location:" . SITEURL . 'user/view-orders.php');

        } else {
            $_SESSION['cancle'] = "<div class='error text-center'>Order is Processing. Can not Cancle</div>";
            header("location:" . SITEURL . 'user/view-orders.php');
        }
    } else {
        $_SESSION['no-order'] = "<div class='error text-center'>Order not Found</div>";
        header("location:" . SITEURL . 'user/view-orders.php');
    }
} else {
    header("location:" . SITEURL . 'admin/manage-category.php');
}
