<?php include('partials/menu.php') ?>

<!-- Main Content Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Add Pizza Type</h1>
        <br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];  //Display Message
            unset($_SESSION['add']);  //Clear the message for next window refresh
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <br><br>

        <!-- Start of Add Category Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Pizza Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Pizza Title">
                    </td>
                </tr>

                <tr>
                    <td>Pizza Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Enter Pizza Description"></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="Enter Pizza Price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
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

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id_category'];
                                $title = $row['title'];

                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                             <option value="0">No Categories Found</option>
                            <?php
                        }
                        ?>
                        </select>
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
                        <input type="submit" name="submit" value="Add Pizza" class="btn-secondary">
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
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

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
                    $tmp = explode('.', $image_name);
                    $ext = end($tmp);
                    //new image name
                    $image_name = "Pizza_Item_" . rand(0000, 9999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/pizza/" . $image_name;

                    $upload = move_uploaded_file($source_path, $destination_path);

                    if ($upload == FALSE) {
                        $_SESSION['upload'] =  "<div class='error text-center'>Failed to  Upload Image</div>";
                        header("location:" . SITEURL . 'admin/add-pizza.php');
                        die();  //stop the add categfory process if the image upload faild
                    }
                }
            } else {
                $image_name = "";
            }


            //SQL Query
            $sql2 = "INSERT INTO pizza_item SET 
            id_category=$category, 
            title='$title', 
            description='$description', 
            price=$price, 
            image_name='$image_name', 
            featured='$featured', 
            active='$active'
            ";

            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == TRUE) {
                $_SESSION['add']  = "<div class='success text-center'>Pizza Type Added Successfully</div>";
                header("location:" . SITEURL . 'admin/manage-pizza.php');
            } else {
                $_SESSION['add']  = "<div class='error text-center'>Failed to  Add Pizza Type</div>";
                header("location:" . SITEURL . 'admin/add-pizza.php');
            }
        }
        ?>
        <!-- End of Form Submit Process -->

    </div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php') ?>