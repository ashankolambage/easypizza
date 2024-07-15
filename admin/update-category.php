<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>

        <br><br>

        <!-- Start of Form data Filling -->
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //Get data from DB
            $sql = "SELECT * FROM pizza_category WHERE id_category = '$id'";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category'] = "<div class='error text-center'>Category not Found</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            }
        } else {
            header("location:" . SITEURL . 'admin/manage-category.php');
        }
        ?>
        <!-- End of Form data Filling -->

        <!-- Start of Update Category Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Cateogry Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>

                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $current_image; ?>" width="150px">

                        <?php
                        } else {
                            echo "<div class='error'>Image Not Added</div>";
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
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- End of Update Category Form -->



        <!-- Start of Form Submit Process -->

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //check new image select or not
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                //Upload new image if only image selected
                if ($image_name != "") {

                    //auto rename the image
                    $ext = end(explode('.', $image_name));  //split image nem by fullstop sign and get last splited section as the extention

                    //new image name
                    $image_name = "Pizza_Category_" . rand(0000, 9999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == FALSE) {
                        $_SESSION['upload'] =  "<div class='error text-center'>Failed to  Upload Image</div>";
                        header("location:" . SITEURL . 'admin/manage-category.php');
                        die();  //stop the add categfory process if the image upload faild
                    }

                    //Delete Current Image File on if Old image is available

                    if ($current_image != "") {
                        $path = "../Images/Category/". $current_image;
                        $remove = unlink($path);

                        if ($remove == FALSE) {
                            $_SESSION['remove-image'] =  "<div class='error text-center'>Failed to  Delete the Old Image</div>";
                            header("location:" . SITEURL . 'admin/manage-category.php');
                            die();  //stop the add categfory process if the image upload faild
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            $sql2 = "UPDATE pizza_category SET
            title='$title', 
            image_name='$image_name', 
            featured='$featured', 
            active='$active' 
            WHERE id_category=$id
            ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {
                $_SESSION['update']  = "<div class='success text-center'>Category Update Successfully</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update']  = "<div class='error text-center'>Failed to  Update Category</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            }
        }
        ?>

        <!-- End of Form Submit Process -->

    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>