<?php include('partials/menu.php') ?>


<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql2 = "SELECT * FROM pizza_item WHERE id_pizza='$id'";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['id_category'];
    $featured = $row2['featured'];
    $active = $row2['active'];
} else {
    header("location:" . SITEURL . 'admin/manage-pizza.php');
}
?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Pizza Type</h1>
        <br>

        <br><br>

        <!-- Start of Update Pizza Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Pizza Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Pizza Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            echo "<div class='error'>Image Not Added</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/pizza/<?php echo $current_image; ?>" width="150px">
                        <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Pizza Category:</td>
                    <td>

                        <select name="category">

                            <?php
                            //Import All Active Category names from DB
                            $sql = "SELECT * FROM pizza_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id_category'];
                                    $category_title = $row['title'];

                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php
                                }
                            } else {
                                echo "<option value='0'>Category Not Available</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Pizza" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- End of Update Pizza Form -->

        <!-- Start of Form Submit Process -->

<?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                //Upload image if only image selected
                if ($image_name != "") {
                    //auto rename the image
                    $tmp = explode('.', $image_name);
                    $ext = end($tmp);
                    //new image name
                    $image_name = "Pizza_Item_" . rand(0000, 9999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/pizza/" . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == FALSE) {
                        $_SESSION['update'] =  "<div class='error text-center'>Failed to  Upload Image</div>";
                        echo "hjjfjghjgh";
                        header("location:" . SITEURL . 'admin/manage-pizza.php');
                        die();  //stop the add categfory process if the image upload faild
                    }

                    if ($current_image != "") {
                        $path = "../images/pizza/" . $current_image;
                        $remove = unlink($path);

                        if ($remove == FALSE) {
                            $_SESSION['remove-image'] =  "<div class='error text-center'>Failed to  Delete the Old Image</div>";
                            echo "hjjfjghjgh";
                            header("location:" . SITEURL . 'admin/manage-pizza.php');
                            die();  //stop the add categfory process if the image upload faild
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }


            $sql3 = "UPDATE pizza_item SET
            title='$title', 
            description='$description',
            price=$price,
            image_name='$image_name', 
            id_category='$category', 
            featured='$featured', 
            active='$active' 
            WHERE id_pizza=$id
            ";

            $res3 = mysqli_query($conn, $sql3);

            if ($res3 == TRUE) {
                $_SESSION['update']  = "<div class='success text-center'>Pizza Item Update Successfully</div>";
                echo "ssssss";
                header("location:" . SITEURL . 'admin/manage-pizza.php');
                echo "dddd";
            } else {
                $_SESSION['update']  = "<div class='error text-center'>Failed to  Update Pizza Item</div>";
                echo "ffff";
                header("location:" . SITEURL . 'admin/manage-pizza.php');
            }
        }
?>

        <!-- End of Form Submit Process -->

    </div>
</div>
<!-- Main Content Section End -->


<?php include('partials/footer.php') ?>