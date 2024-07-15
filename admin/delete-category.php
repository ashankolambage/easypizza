<?php
include('../config/constants.php');
//check id and image name set or not

if (isset($_GET['id']) and isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Delete image file from folder

    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        $remove = unlink($path);

        //check image deleted or not
        if ($remove == FALSE) {
            die();  // If image file could not delted stop the process data deleting from database
            $_SESSION['remove'] =  "<div class='error text-center'>Failed to Remove Image File</div>";
            header("location:" . SITEURL . 'admin/manage-category.php');
        }
    }

    //Delete from DB

    $sql = "DELETE FROM pizza_category WHERE id_category='$id'";
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        $_SESSION['delete'] = "<div class='success text-center'>Category Delete Successfully</div>";
        header("location:" . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['delete'] =  "<div class='error text-center'>Failed to Delete Category</div>";
        header("location:" . SITEURL . 'admin/manage-category.php');
    }
} else {
    header("location:" . SITEURL . 'admin/manage-category.php');
}