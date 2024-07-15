<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  //Display Message
            unset($_SESSION['add']);  //Clear the message for next window refresh
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];  //Display Message
            unset($_SESSION['upload']);  //Clear the message for next window refresh
        }
        ?>

        <br><br>

        <!-- Start of Add Category Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Cateogry Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- End of Add Category Form -->



        <!-- Start of Form Submit Process -->
        <?php
        if (isset($_POST['submit'])) {

            //Get form Data
            $title = $_POST['title'];

            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            //show selected image source path and image name
            //print_r($_FILES['image']);
            //die();

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];

                //Upload image if only image selected
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
                        header("location:" . SITEURL . 'admin/add-category.php');
                        die();  //stop the add categfory process if the image upload faild
                    }
                }
            } else {
                $image_name = "";
            }


            //SQL Query
            $sql = "INSERT INTO pizza_category SET 
            title='$title', 
            image_name='$image_name', 
            featured='$featured', 
            active='$active'
            ";

            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $_SESSION['add']  = "<div class='success text-center'>Category Added Successfully</div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add']  = "<div class='error text-center'>Failed to  Add Category</div>";
                header("location:" . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
        <!-- End of Form Submit Process -->

    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>